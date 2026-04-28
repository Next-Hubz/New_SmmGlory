<?php
defined('BASEPATH') or exit('No direct script access allowed');

class affiliates extends My_AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->controller_name = 'affiliates';
        if (!is_current_logged_staff()) redirect(admin_url('logout'));
    }

    public function index()
    {
        $this->db->select('ap.*, u.email, u.first_name, u.last_name');
        $this->db->from(AFFILIATE_PAYOUT . ' ap');
        $this->db->join(USERS . ' u', 'u.id = ap.uid');
        $this->db->order_by('ap.id', 'DESC');
        $payouts = $this->db->get()->result();

        $data = array(
            "controller_name" => $this->controller_name,
            "payouts"         => $payouts,
        );

        $this->template->build('affiliates/index', $data);
    }

    public function payout_update()
    {
        $type = get('type');
        $id = get('ids'); // in admin helper, it passes ids=$id usually, or we use standard id
        // Let's just do a simple update
        $payout = $this->db->get_where(AFFILIATE_PAYOUT, ['id' => $id])->row();
        if ($payout && $payout->status == 0) {
            if ($type == 'approve') {
                $this->db->update(AFFILIATE_PAYOUT, ['status' => 1, 'updated' => NOW], ['id' => $id]);
                
                // Add amount to user's main balance
                $user = $this->db->get_where(USERS, ['id' => $payout->uid])->row();
                if ($user) {
                    $this->db->set('balance', 'balance+' . $payout->amount, FALSE);
                    $this->db->where('id', $payout->uid);
                    $this->db->update(USERS);
                    
                    // Log the transaction
                    $this->db->insert(TRANSACTION_LOGS, [
                        'ids' => ids(),
                        'uid' => $payout->uid,
                        'type' => 'Affiliate Payout',
                        'transaction_id' => 'AFF_PAYOUT_' . $payout->id,
                        'amount' => $payout->amount,
                        'status' => 1,
                        'created' => NOW
                    ]);
                }
            } else if ($type == 'reject') {
                $this->db->update(AFFILIATE_PAYOUT, ['status' => 2, 'updated' => NOW], ['id' => $id]);
                // refund available earnings
                $this->db->set('available_earnings', 'available_earnings+' . $payout->amount, FALSE);
                $this->db->where('uid', $payout->uid);
                $this->db->update(AFFILIATE);
            }
        }
        redirect(admin_url('affiliates'));
    }
}
