<?php
defined('BASEPATH') or exit('No direct script access allowed');

class affiliates_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_item($params = null, $option = null)
    {
        switch ($option['task']) {
            case 'get-referral-uid-on-sign-up':
                // The params['referral_key'] is the uid in our simplified system
                $ref_key = $params['referral_key'];
                return is_numeric($ref_key) ? $ref_key : 0;
        }
        return false;
    }

    public function save_item($params = null, $option = null)
    {
        switch ($option['task']) {
            case 'add-item-when-user-visit':
                $ref_key = $params['ref_key'];
                if (is_numeric($ref_key)) {
                    $this->db->set('visitors', 'visitors+1', FALSE);
                    $this->db->where('uid', $ref_key);
                    $this->db->update(AFFILIATE);
                    
                    if ($this->db->affected_rows() == 0) {
                        $this->db->insert(AFFILIATE, ['uid' => $ref_key, 'visitors' => 1]);
                    }
                    set_cookie("referral_key", $ref_key, 2592000); // 30 days
                }
                break;

            case 'referral':
                // from add_funds_model
                $uid = $params['id'];
                $txn_amount = $params['amount'];
                
                $rate = get_option('affiliate_commission_rate', 10);
                $commission = ($txn_amount * $rate) / 100;
                
                $this->db->set('total_earnings', 'total_earnings+' . $commission, FALSE);
                $this->db->set('available_earnings', 'available_earnings+' . $commission, FALSE);
                $this->db->where('uid', $uid);
                $this->db->update(AFFILIATE);
                break;
        }
    }
}
