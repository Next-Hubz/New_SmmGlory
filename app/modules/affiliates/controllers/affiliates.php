<?php
defined('BASEPATH') or exit('No direct script access allowed');

class affiliates extends My_UserController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(get_class($this).'_model', 'model');
        $this->controller_name = get_class($this);
    }

    public function index()
    {
        $uid = session('uid');
        $affiliate = $this->model->get('*', AFFILIATE, ['uid' => $uid]);
        if (empty($affiliate)) {
            $this->db->insert(AFFILIATE, ['uid' => $uid]);
            $affiliate = $this->model->get('*', AFFILIATE, ['uid' => $uid]);
        }

        $data = array(
            "controller_name" => $this->controller_name,
            "affiliate"       => $affiliate,
            "referral_link"   => cn('ref/' . $uid)
        );

        $this->template->set_layout('user');
        $this->template->build('index', $data);
    }

    public function payout()
    {
        if (!is_ajax_call()) redirect(cn($this->controller_name));

        $uid = session('uid');
        $amount = post('amount');

        if (empty($amount) || !is_numeric($amount) || $amount <= 0) {
            _validation('error', lang("Invalid amount"));
        }

        $min_payout = get_option('affiliate_minimum_payout', 10);
        if ($amount < $min_payout) {
            _validation('error', "Minimum payout is " . $min_payout);
        }

        $affiliate = $this->model->get('*', AFFILIATE, ['uid' => $uid]);
        if (empty($affiliate) || $affiliate->available_earnings < $amount) {
            _validation('error', "Insufficient available earnings");
        }

        // Deduct available earnings
        $new_available = $affiliate->available_earnings - $amount;
        $this->db->update(AFFILIATE, ['available_earnings' => $new_available], ['uid' => $uid]);

        // Insert payout request
        $this->db->insert(AFFILIATE_PAYOUT, [
            'uid' => $uid,
            'amount' => $amount,
            'status' => 0,
            'created' => NOW,
            'updated' => NOW
        ]);

        ms(['status' => 'success', 'message' => "Payout requested successfully", 'redirect_url' => cn('affiliates')]);
    }
}
