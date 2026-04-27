<?php
defined('BASEPATH') or exit('No direct script access allowed');

class child_panel extends My_UserController
{
    public function __construct()
    {
        parent::__construct();
        $this->controller_name = 'child_panel';
    }

    public function index()
    {
        $data = array(
            "controller_name" => $this->controller_name,
            "module"          => get_class($this),
        );
        $this->template->set_layout('user');
        $this->template->build('index', $data);
    }

    public function submit()
    {
        if (!is_ajax_call()) redirect(cn($this->controller_name));

        $domain = post('domain');
        $admin_user = post('admin_user');
        $admin_password = post('admin_password');

        if (empty($domain) || empty($admin_user) || empty($admin_password)) {
            _validation('error', 'Please fill in all required fields.');
        }

        // We will create a ticket on behalf of the user
        $subject = 'Child Panel Request: ' . $domain;
        $description = "Domain: $domain\nAdmin Username: $admin_user\nAdmin Password: $admin_password\n\nPlease process this child panel request.";

        $data_ticket = array(
            "ids"         => ids(),
            "uid"         => session('uid'),
            "subject"     => $subject,
            "description" => $description,
            'user_read'   => 0,
            'admin_read'  => 1,
            "changed"     => NOW,
            "created"     => NOW,
        );

        $this->db->insert(TICKETS, $data_ticket);
        if ($this->db->affected_rows() > 0) {
            $ticket_id = $this->db->insert_id();
            
            // Send notice to admin with new Ticket
            if (get_option('is_ticket_notice_email_admin', 0)) {
                $author = $_SESSION['user_current_info']['first_name'] . ' ' . $_SESSION['user_current_info']['last_name'];
                $mail_params = [
                    'template' => [
                        'subject' => get_option("website_name", "SmartPanel") . " - New Ticket #" . $ticket_id . " - [" . $subject . "]",
                        'message' => $description,
                        'type' => 'default',
                    ],
                    'from_email_data' => [
                        'from_email' => $_SESSION['user_current_info']['email'],
                        'from_email_name' => $author,
                    ],
                ];
                
                $staff_mail = $this->db->select("email")->from(STAFFS)->order_by("id", "ASC")->limit(1)->get()->row()->email;
                if ($staff_mail) {
                    $this->load->model('child_panel_model');
                    $this->child_panel_model->send_mail_template($mail_params['template'], $staff_mail, $mail_params['from_email_data']);
                }
            }

            ms(["status" => "success", "message" => "Your Child Panel request has been submitted successfully! We will update you via tickets shortly.", 'redirect_url' => cn('tickets')]);
        } else {
            ms(["status" => "error", "message" => lang("There_was_an_error_processing_your_request_Please_try_again_later")]);
        }
    }
}
