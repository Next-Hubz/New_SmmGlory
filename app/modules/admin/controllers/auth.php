<?php
defined('BASEPATH') or exit('No direct script access allowed');

class auth extends MX_Controller
{
    public $tb_staff;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model', 'model');
        $this->tb_staff = STAFFS;
    }

    public function login()
    {
        if (is_current_logged_staff()) {
            redirect(admin_url('statistics'));
        }

        if ($this->input->method() === 'post') {
            $this->ajax_sign_in();
            return;
        }

        $data = array();
        $this->template->set_layout('auth');
        $this->template->build('auth/sign_in', $data);
    }

    public function logout()
    {
        unset_session("sid");
        unset_session("staff_current_info");
        redirect(admin_url('login'));
    }

    public function ajax_sign_in()
    {
        $email = post("email");
        $password = md5(post("password"));

        if ($email == "") {
            ms(array(
                "status" => "error",
                "message" => lang("email_is_required"),
            ));
        }

        if ($password == "") {
            ms(array(
                "status" => "error",
                "message" => lang("Password_is_required"),
            ));
        }

        $user = $this->model->get("id, status, ids, email, password, first_name, last_name, timezone", $this->tb_staff, ['email' => $email]);

        $error = false;
        if (!$user) {
            $error = true;
        } else {
            // check the last hash password
            if ($this->model->app_password_verify(post("password"), $user->password)) {
                $error = false;
            } else {
                $error = true;
            }
        }

        if ($error) {
            ms(array(
                "status" => "error",
                "message" => lang("email_address_and_password_that_you_entered_doesnt_match_any_account_please_check_your_account_again"),
            ));
        }

        if ($user->status != 1) {
            ms(array(
                "status" => "error",
                "message" => lang("your_account_has_not_been_activated"),
            ));
        }

        set_session("sid", $user->id);
        $data_session = array(
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'timezone' => $user->timezone,
        );
        /*----------  Insert User logs  ----------*/
        set_session('staff_current_info', $data_session);
        // set_cookie("verify_maintenance_mode", encrypt_encode("verified"), 1209600); // Not needed for regular login?
        $this->model->history_ip($user->id);
        
        ms(array(
            "status" => "success",
            "message" => lang("Login_successfully"),
        ));
    }
}
