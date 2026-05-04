<?php
defined('BASEPATH') or exit('No direct script access allowed');

class crypto_direct extends My_UserController
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
        $this->payment_type = 'crypto_direct';
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
        
        if ($payment) {
            $this->payment_id = $payment->id;
            $params                   = $payment->params;
            $option                   = get_value($params, 'option');
            $this->take_fee_from_user = get_value($params, 'take_fee_from_user');
            
            // Options
            $this->merchant_id        = get_value($option, 'merchant_id');
            $this->payment_key        = get_value($option, 'payment_key');
        }
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
        $crypto_coin = post('crypto_coin'); // expected format "CURRENCY|NETWORK"
        
        if (!$amount) {
            _validation('error', lang('There_was_an_error_processing_your_request_Please_try_again_later'));
        }
        
        if (!$crypto_coin || strpos($crypto_coin, '|') === false) {
            _validation('error', 'Please select a valid cryptocurrency.');
        }

        list($to_currency, $network) = explode('|', $crypto_coin);

        // Check individual limits
        $payment = $this->model->get('id, type, name, params', $this->tb_payments, ['type' => $this->payment_type]);
        if ($payment) {
            $params = $payment->params;
            $option = get_value($params, 'option');
            $prefix = strtolower($to_currency);
            if ($to_currency == 'USDT') $prefix = 'usdt';
            
            $coin_min = get_value($option, $prefix . '_min', false, get_value($params, 'min'));
            $coin_max = get_value($option, $prefix . '_max', false, get_value($params, 'max'));

            if ($amount < $coin_min) {
                _validation('error', lang("minimum_amount_is") . " " . $coin_min);
            }

            if ($coin_max > 0 && $amount > $coin_max) {
                _validation('error', 'Maximal amount is' . " " . $coin_max);
            }
        }

        if ($this->merchant_id == "" || $this->payment_key == "") {
            _validation('error', lang('this_payment_is_not_active_please_choose_another_payment_or_contact_us_for_more_detail'));
        }

        $users = session('user_current_info');
        
        $data_tnx_log = array(
            "ids" => ids(),
            "uid" => session("uid"),
            "type" => $this->payment_type,
            "transaction_id" => "", 
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
            'url_return' => cn("add_funds/crypto_direct/complete"), 
            'url_callback' => cn("add_funds/crypto_direct/ipn"),
            'is_payment_multiple' => false,
            'lifetime' => 3600,
            'to_currency' => $to_currency,
            'network' => $network
        ];

        $response = $this->call_api('v1/payment', $payload);

        if (isset($response['cURL_Error'])) {
             _validation('error', 'cURL Error: ' . $response['cURL_Error']);
        }

        if ($response === null) {
             _validation('error', 'Failed to connect to Crypto API. The API returned an invalid or empty response.');
        }

        if (isset($response['state']) && $response['state'] == 0 && isset($response['result']['url'])) {
            $uuid = $response['result']['uuid'];
            $url = $response['result']['url'];
            $address = $response['result']['address'] ?? '';
            $payer_amount = $response['result']['payer_amount'] ?? 0;
            $payer_currency = $response['result']['payer_currency'] ?? '';
            $network_res = $response['result']['network'] ?? '';
            
            // Update transaction with UUID
            $this->db->update($this->tb_transaction_logs, ['transaction_id' => $uuid], ['id' => $transaction_id]);
            
            // Save to crypto transactions for tracking
            $this->db->insert('general_crypto_transactions', [
                'transaction_log_id' => $transaction_id,
                'uuid' => $uuid,
                'wallet_address' => $address,
                'amount' => $amount,
                'crypto_amount' => $payer_amount,
                'crypto_currency' => $payer_currency,
                'network' => $network_res,
                'status' => 'pending',
                'created_at' => NOW
            ]);
            
            if ($this->input->is_ajax_request()) {
                ms(['status' => 'success', 'redirect_url' => $url]);
            }
        } else {
            $error_message = lang('There_was_an_error_processing_your_request_Please_try_again_later');
            if (isset($response['message'])) {
                 $error_message = $response['message'];
            }
            _validation('error', $error_message);
        }
    }

    public function checkout($id = "")
    {
        if(empty($id)) redirect(cn("add_funds"));
        
        $transaction = $this->model->get('*', $this->tb_transaction_logs, ['id' => $id, 'uid' => session('uid'), 'type' => $this->payment_type]);
        if(!$transaction) redirect(cn("add_funds"));
        
        $crypto_tx = $this->model->get('*', 'general_crypto_transactions', ['transaction_log_id' => $id]);
        if(!$crypto_tx) redirect(cn("add_funds"));
        
        $data = [
            "module"        => 'add_funds',
            "transaction_id"=> $id,
            "amount"        => $crypto_tx->amount,
            "crypto_amount" => $crypto_tx->crypto_amount,
            "crypto_currency"=> $crypto_tx->crypto_currency,
            "network"       => $crypto_tx->network,
            "wallet_address"=> $crypto_tx->wallet_address,
            "currency_symbol"=> get_option('currency_symbol', "$")
        ];
        $this->template->set_layout('user');
        $this->template->build('crypto_direct/checkout', $data);
    }
    
    public function check_status($id = "")
    {
        if(empty($id)) {
            echo json_encode(['status' => 'error']);
            return;
        }
        
        $transaction = $this->model->get('*', $this->tb_transaction_logs, ['id' => $id, 'uid' => session('uid')]);
        if($transaction && $transaction->status == 1) {
            echo json_encode(['status' => 'paid']);
        } else {
            echo json_encode(['status' => 'pending']);
        }
    }

    /**
     * IPN Handler
     */
    public function ipn()
    {
        $payload = file_get_contents('php://input');
        if (empty($payload)) {
            log_message('error', 'Crypto Direct IPN: empty payload');
            exit('No data');
        }

        $json = json_decode($payload, true);
        if (!$json) {
            log_message('error', 'Crypto Direct IPN: invalid JSON payload');
            exit('Invalid JSON');
        }

        if (!isset($json['sign'])) {
            log_message('error', 'Crypto Direct IPN: missing sign field');
            exit('Missing signature');
        }

        $sign = $json['sign'];
        unset($json['sign']);
        $hash = md5(base64_encode(json_encode($json, JSON_UNESCAPED_UNICODE)) . $this->payment_key);

        if (!$sign || !hash_equals($hash, $sign)) {
            log_message('error', 'Crypto Direct IPN: bad signature for order_id ' . ($json['order_id'] ?? 'unknown'));
            exit('Bad signature');
        }

        // Process payment
        $status = $json['status'] ?? ''; // paid, process, cancel, fail
        $order_id = isset($json['order_id']) ? (int) $json['order_id'] : 0;

        if (!$order_id) {
            log_message('error', 'Crypto Direct IPN: missing order_id');
            exit('Missing order_id');
        }

        // Update crypto transaction status
        $this->db->update('general_crypto_transactions', ['status' => $status], ['transaction_log_id' => $order_id]);

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
                    log_message('error', 'Crypto Direct IPN: add_funds_bonus_email failed for order_id ' . $order_id);
                    exit('Balance update failed');
                }

                exit('OK');
            }
            log_message('error', 'Crypto Direct IPN: transaction not found or already processed for order_id ' . $order_id);
        }
        exit('Ignored');
    }

    public function complete()
    {
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
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Disabled for local XAMPP environments
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); // Disabled for local XAMPP environments
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'merchant: ' . $this->merchant_id,
            'sign: ' . $sign,
            'Content-Type: application/json'
        ]);

        $response = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        if ($response === false) {
            return ['cURL_Error' => $error];
        }

        return json_decode($response, true);
    }
}
