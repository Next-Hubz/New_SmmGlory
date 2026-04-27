<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class home extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(get_class($this).'_model', 'model');
        if (session('uid')) {
            redirect(cn('new_order'));
        }
    }

    public function index()
    {
        $home_page_type =  get_theme();
        if (get_option("enable_disable_homepage") && !in_array($home_page_type, ['monoka'])) {
            redirect(cn("auth/login"));
        }
        $this->load->model('services/services_model', 'services_model');
        $popular_services = $this->services_model->list_items(['cate_id' => 0], [
            'task'     => 'list-items',
            'no_group' => true,
            'limit'    => 5,
        ]);

        $this->load->model('blog/blog_model', 'blog_model');
        $current_item_lang = get_lang_code_defaut();
        $latest_posts = $this->blog_model->list_items([
            'status'           => 1,
            'limit'            => 3,
            'lang_code'        => $current_item_lang->code
        ], ['task' => 'list-items-last-post']);

        $data = [
            'lang_current' => get_lang_code_defaut(),
			'languages'    => $this->model->fetch("*", LANGUAGE_LIST, "status = 1"),
            'popular_services' => $popular_services,
            'latest_posts' => $latest_posts,
        ];
        $this->template->set_layout('blank_page');
        $this->template->build('../../../themes/'.$home_page_type.'/views/index', $data);
    }
    
}
