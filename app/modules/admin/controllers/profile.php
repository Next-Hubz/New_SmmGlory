<?php
defined('BASEPATH') or exit('No direct script access allowed');

class profile extends My_AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        $this->controller_name = strtolower(get_class($this));
        $this->controller_title = ucfirst(str_replace('_', ' ', get_class($this)));
        $this->path_views = "profile";
        $this->params = [];
    }

    public function index()
    {
        $item = $this->admin_model->get_item(['id' => session('sid')], ['task' => 'get-item-current-admin']);
        $data = array(
            "controller_name" => $this->controller_name,
            "item" => $item,
        );
        $this->template->build($this->path_views . '/profile', $data);
    }

    public function store()
    {
        if (!is_ajax_call()) {
            redirect(admin_url($this->controller_name));
        }

        $store_type = post('store_type');
        $id = session('sid');

        if ($store_type == 'update_info') {
            $this->form_validation->set_rules('first_name', 'First name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('last_name', 'Last name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('timezone', 'Timezone', 'trim|required|xss_clean');

            if (!$this->form_validation->run()) {
                _validation('error', validation_errors());
            }

            $data = [
                'first_name' => post('first_name'),
                'last_name' => post('last_name'),
                'timezone' => post('timezone'),
            ];
            
            $this->db->update($this->tb_main, $data, ['id' => $id]);
            ms(['status' => 'success', 'message' => 'Update successfully']);
        }

        if ($store_type == 'change_pass') {
            $this->form_validation->set_rules('old_password', 'Old Password', 'trim|required|xss_clean');
            $this->form_validation->set_rules('password', 'New Password', 'trim|required|min_length[6]|max_length[25]|xss_clean');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[password]|xss_clean');

            if (!$this->form_validation->run()) {
                _validation('error', validation_errors());
            }

            // Verify old password
            // Use admin_model (loaded in constructor) instead of undefined $this->model
            $user = $this->admin_model->get("id, password", $this->tb_main, ['id' => $id]);
            if (!$this->admin_model->app_password_verify(post('old_password'), $user->password)) {
                 _validation('error', 'The old password does not match');
            }

            $data = [
                'password' => $this->admin_model->app_password_hash(post('password')),
                'changed' => NOW,
            ];

            $this->db->update($this->tb_main, $data, ['id' => $id]);
            ms(['status' => 'success', 'message' => 'Password changed successfully']);
        }
    }
}
