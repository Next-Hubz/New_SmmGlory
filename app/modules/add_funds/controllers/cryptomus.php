<?php
defined('BASEPATH') or exit('No direct script access allowed');

class cryptomus extends MX_Controller
{
    public $tb_users;
    public $tb_transaction_logs;
    public $tb_payments;
    public $tb_payments_bonuses;
    public $payment_type;
    public $payment_id;
    public $currency_code;
    public $merchant_id;
    public $payment_key;
    public $take_fee_from_user;

    public function __construct($payment = "")
    {
        parent::__construct();
        $this->load->model('add_funds_model', 'model');

        $this->tb_users = USERS;
        $this->payment_type = 'cryptomus';
        $this->tb_transaction_logs = TRANSACTION_LOGS;
        $this->tb_payments = PAYMENTS_METHOD;
        $this->tb_payments_bonuses = PAYMENTS_BONUSES;
        $this->currency_code = get_option("currency_code", "USD");
        if ($this->currency_code == "") {
            $this->currency_code = 'USD';
        }

        if (!$payment) {
            $payment = $this->model->get('id, type, name, params', $this->tb_payments, ['type' => $this->payment_type]);
        }
        $this->payment_id = $payment->id;
        $params                   = $payment->params;
        $option                   = get_value($params, 'option');
        $this->take_fee_from_user = get_value($params, 'take_fee_from_user');
        
        // Options
        $this->merchant_id        = get_value($option, 'merchant_id');
        $this->payment_key        = get_value($option, 'payment_key');
    }

    public function index()
    {
        redirect(cn("add_funds"));
    }

    /**
     * Create payment
     */
    public function create_payment($data_payment = "")
    {
        _is_ajax($data_payment['module']);
        $amount = $data_payment['amount'];
        if (!$amount) {
            _validation('error', lang('There_was_an_error_processing_your_request_Please_try_again_later'));
        }

        if ($this->merchant_id == "" || $this->payment_key == "") {
            _validation('error', lang('this_payment_is_not_active_please_choose_another_payment_or_contact_us_for_more_detail'));
        }

        $users = session('user_current_info');
        $order_id = ids(); // Generate a unique ID for the transaction log first? No, usually we insert first or use a temp ID. 
        // Let's insert pending transaction first to get an ID or use the 'ids()' which seems to be a UUID generator.
        
        $data_tnx_log = array(
            "ids" => ids(),
            "uid" => session("uid"),
            "type" => $this->payment_type,
            "transaction_id" => "", // Will update later or use order_id
            "amount" => $amount,
            "status" => 0,
            "created" => NOW,
        );
        $this->db->insert($this->tb_transaction_logs, $data_tnx_log);
        $transaction_id = $this->db->insert_id();
        
        // Prepare payload for Cryptomus
        $payload = [
            'amount' => (string)$amount,
            'currency' => $this->currency_code,
            'order_id' => (string)$transaction_id,
            'url_return' => cn("add_funds/cryptomus/complete"), // Redirect after success (though Cryptomus might not redirect immediately)
            'url_callback' => cn("add_funds/cryptomus/ipn"),
            'is_payment_multiple' => false,
            'lifetime' => 3600,
            // 'to_currency' => 'USDT' // Optional, but good for defaults
        ];

        $response = $this->call_api('v1/payment', $payload);

        // Check if $response is null (JSON decode failed)
        if ($response === null) {
             _validation('error', 'Failed to connect to Cryptomus API. Please check your internet connection or try again later.');
        }

        if (isset($response['state']) && $response['state'] == 0 && isset($response['result']['url'])) {
            // Update transaction with the actual UUID from Cryptomus if needed, but we used our DB ID as order_id
            $this->db->update($this->tb_transaction_logs, ['transaction_id' => $response['result']['uuid']], ['id' => $transaction_id]);
            
            if ($this->input->is_ajax_request()) {
                ms(['status' => 'success', 'redirect_url' => $response['result']['url']]);
            }
        } else {
            // Log the full response for debugging purposes (optional, but recommended)
            // log_message('error', 'Cryptomus API Error: ' . print_r($response, true));
            
            $error_message = lang('There_was_an_error_processing_your_request_Please_try_again_later');
            if (isset($response['message'])) {
                 $error_message = $response['message'];
                 if (isset($response['errors']) && is_array($response['errors'])) {
                     // Append validation errors if available
                     $error_message .= ': ' . implode(', ', array_map(function($k, $v) { return "$k: " . (is_array($v) ? implode(', ', $v) : $v); }, array_keys($response['errors']), $response['errors']));
                 }
            }
            _validation('error', $error_message);
        }
    }

    /**
     * IPN Handler
     */
    public function ipn()
    {
        $payload = file_get_contents('php://input');
        if (empty($payload)) {
            log_message('error', 'Cryptomus IPN: empty payload');
            exit('No data');
        }

        $json = json_decode($payload, true);
        if (!$json) {
            log_message('error', 'Cryptomus IPN: invalid JSON payload');
            exit('Invalid JSON');
        }

        if (!isset($json['sign'])) {
            log_message('error', 'Cryptomus IPN: missing sign field');
            exit('Missing signature');
        }

        $sign = $json['sign'];
        unset($json['sign']);
        $hash = md5(base64_encode(json_encode($json, JSON_UNESCAPED_UNICODE)) . $this->payment_key);

        if (!$sign || !hash_equals($hash, $sign)) {
            log_message('error', 'Cryptomus IPN: bad signature for order_id ' . ($json['order_id'] ?? 'unknown'));
            exit('Bad signature');
        }

        // Process payment
        $status = $json['status'] ?? ''; // paid, process, cancel, fail
        $order_id = isset($json['order_id']) ? (int) $json['order_id'] : 0;

        if (!$order_id) {
            log_message('error', 'Cryptomus IPN: missing order_id');
            exit('Missing order_id');
        }

        if ($status == 'paid' || $status == 'paid_over') {
            $transaction = $this->model->get('*', $this->tb_transaction_logs, ['id' => $order_id, 'status' => 0, 'type' => $this->payment_type]);
            
            if ($transaction) {
                // Update transaction
                $this->db->update($this->tb_transaction_logs, [
                    'status' => 1,
                    'transaction_id' => $json['uuid'] // Ensure we have the remote ID
                ], ['id' => $order_id]);

                // Add funds
                $result = $this->model->add_funds_bonus_email($transaction, $this->payment_id);
                if (!$result) {
                    log_message('error', 'Cryptomus IPN: add_funds_bonus_email failed for order_id ' . $order_id);
                    exit('Balance update failed');
                }

                exit('OK');
            }
            log_message('error', 'Cryptomus IPN: transaction not found or already processed for order_id ' . $order_id);
        }
        exit('Ignored');
    }
    /**
     * Complete (Return URL)
     * Just checks status and redirects
     */
    public function complete()
    {
        // Cryptomus redirects here. We can check transaction status or just redirect to success.
        // Since it's crypto, it might take time.
        redirect(cn("add_funds"));
    }
    private function call_api($endpoint, $data)
    {
        $data_json = json_encode($data);
        $sign = md5(base64_encode($data_json) . $this->payment_key);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.cryptomus.com/" . $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'merchant: ' . $this->merchant_id,
            'sign: ' . $sign,
            'Content-Type: application/json'
        ]);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $response = curl_exec($ch);
        
        if ($response === false) {
             log_message('error', 'Curl error: ' . curl_error($ch));
             return null;
        }
        curl_close($ch);

        return json_decode($response, true);
    }
}
