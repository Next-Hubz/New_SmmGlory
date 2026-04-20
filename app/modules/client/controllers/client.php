<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class client extends My_UserController {
    public $tb_users;
    public $tb_subscribers;
    public $tb_order;
    public $tb_categories;
    public $tb_services;
    public $module_name;
    public $module_icon;

    public function __construct(){
        parent::__construct();
        $this->load->model(get_class($this).'_model', 'main_model');
        //Config Module
        $this->tb_users               = USERS;
        $this->tb_subscribers         = SUBSCRIBERS;
        $this->tb_order               = ORDER;
        $this->tb_categories          = CATEGORIES;
        $this->tb_services            = SERVICES;
        $this->controller_name        = strtolower(get_class($this));
    }
    
    public function index(){
        redirect(cn());
    }
    
    public function faq()
    {
        $data = array(
            "controller_name" => $this->controller_name,
            "items"           => $this->main_model->list_items(null, ['task' => 'list-items-faq']),
        );
        if (session('uid')) {
            $this->template->set_layout('user');
        } else {
            $this->template->set_layout('general_page');
        }
        $this->template->build("faq/index", $data);
    }

    public function subscriber()
    {
        $email = post('email');
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $email == "") {
              ms(array(
                'status'  => 'error',
                'message' => lang("invalid_email_format"),
            ));
        }

        $ip_address = get_client_ip();
        $data = array(
            "ids"		=> ids(),
            "ip"		=> $ip_address,
            "email"		=> $email,
            "created"   => NOW,
            "changed"   => NOW,
        );

        $location = get_location_info_by_ip($ip_address);
        if ($location->country != 'Unknown' && $location->country != '') {
            $data['country'] = $location->country;
        }else{
            $data['country'] = 'Unknown';
        }

        $is_exist_email = $this->main_model->get('id', $this->tb_subscribers, ['email' => $email]);
        if (!$is_exist_email) {
            $this->db->insert($this->tb_subscribers, $data);
            if($this->db->affected_rows() > 0) {
                ms(array(
                    'status'   => 'success',
                    'message'  => lang("you_subscribed_successfully_to_our_newsletter_thank_you_for_your_subsrciption"),
                ));
            }else{
                ms(array(
                    'status'   => 'error',
                    'message'  => lang("an_error_occurred_while_subscribing_please_try_again"),
                ));
            }
        }else{
            ms(array(
                'status'   => 'error',
                'message'  => lang("a_subscriber_for_the_specified_email_address_already_exists_try_another_email_address"),
            ));
        }
    }

    public function contact()
    {
        $name    = trim(post('name'));
        $email   = trim(post('email'));
        $subject = trim(post('subject'));
        $message = trim(post('message'));

        if ($name == '' || strlen($name) < 2) {
            ms([
                'status'  => 'error',
                'message' => 'Please enter your name.',
            ]);
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            ms([
                'status'  => 'error',
                'message' => lang("invalid_email_format"),
            ]);
        }

        if ($subject == '') {
            ms([
                'status'  => 'error',
                'message' => 'Please enter a subject.',
            ]);
        }

        if ($message == '' || strlen($message) < 10) {
            ms([
                'status'  => 'error',
                'message' => 'Please enter a message with at least 10 characters.',
            ]);
        }

        $recipient_email = 'support@smmglory.com';

        $mail_params = [
            'subject' => 'New Contact Message: ' . $subject,
            'message' => '
                <h2 style="margin:0 0 15px;">New Contact Form Message</h2>
                <p><strong>Name:</strong> ' . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . '</p>
                <p><strong>Email:</strong> ' . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . '</p>
                <p><strong>Subject:</strong> ' . htmlspecialchars($subject, ENT_QUOTES, 'UTF-8') . '</p>
                <p><strong>Message:</strong></p>
                <div style="padding:12px 15px;background:#f7f7fb;border-radius:8px;color:#333;">' . nl2br(htmlspecialchars($message, ENT_QUOTES, 'UTF-8')) . '</div>
            ',
        ];

        $from_email_data = [
            'from_email'      => $email,
            'from_email_name' => $name,
        ];

        $send_message = $this->main_model->send_mail_template($mail_params, $recipient_email, $from_email_data);
        if ($send_message) {
            ms([
                'status'  => 'error',
                'message' => $send_message,
            ]);
        }

        ms([
            'status'  => 'success',
            'message' => 'Your message has been sent successfully.',
        ]);
    }

    public function terms()
    {
        $data = array();
        if (session('uid')) {
            $this->template->set_layout('user');
        } else {
            $this->template->set_layout('general_page');
        }
        $this->template->build("terms/index", $data);
    }

    public function impressum()
    {
        $data = array();
        if (session('uid')) {
            $this->template->set_layout('user');
        } else {
            $this->template->set_layout('general_page');
        }
        $this->template->build("impressum/index", $data);
    }

    public function cookie_policy(){
        if (!get_option("is_cookie_policy_page")) {
            redirect(cn('statistics'));
        }
        $data = array();
        if (session('uid')) {
            $this->template->set_layout('user');
        } else {
            $this->template->set_layout('general_page');
        }
        $this->template->build("cookies_policy/index", $data);
    }

    public function referral($ref_key = ""){
        if (!session('referral_key') && $ref_key && is_table_exists(AFFILIATE)) {
            $option = ['task'    => 'add-item-when-user-visit'];
            $params = ['ref_key' => $ref_key];
            $this->load->model('affiliates/affiliates_model', 'affiliates');
            $this->affiliates->save_item($params, $option);
        }
        redirect(cn());
    }

    public function news_annoucement()
    {
        if (!$this->input->is_ajax_request()) redirect(cn($this->controller_name));
        set_cookie("news_annoucement", "clicked", 21600);
        $data = array(
            "controller_name" => $this->controller_name,
            "items"           => $this->main_model->list_items(null, ['task' => 'list-items-news']),
        );
        $this->load->view("news/index", $data);
    }

    public function set_language()
    {
        $item = $this->main_model->get_item(['ids' => get('ids')], ['task' => 'get-item-language']);
        if (!empty($item)) {
            unset_session('langCurrent');
            set_session('langCurrent', $item);
        }
        redirect(get('redirect'));
    }

    public function back_to_admin()
    {
        if (session('uid')) {
            $redirect_url = admin_url('users') . '?field=email&query=' . current_logged_user()->email;
            unset_session("uid");
            unset_session("user_current_info");
            ms([
                'status'       => 'success', 
                'message'      => 'Your request is being processed', 
                'redirect_url' => $redirect_url,
            ]);
        } else {
            redirect(cn());
        }
    }
}
