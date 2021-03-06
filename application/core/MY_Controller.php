<?php

class MY_Controller extends CI_Controller {

    public $user_profile;
    public $user_id;
    public $user_settings;
    public $company;
    public $user_role;
    public $access_role;
    public $companies;
    public $avatar;
    public $notifications;

    function __construct() {
        parent::__construct();

        $is_banned = $this->session->userdata("is_banned");
        if (isset($is_banned) && $is_banned == "yes") {
            // show_404();
            echo '<br><br><strong>Fatal error:</strong> Using $this when not in object context. Please check error log for details. <a href="/auth/logout">Try again</a>!';
            die();
        }

        if (!$this->tank_auth->is_logged_in()) {
            redirect('/auth/login/?ref=' . urlencode(current_url()));
            exit();
        }
        $this->user_role = $this->tank_auth->get_role();
        if ($this->user_role == 'admin') {
            redirect('/admin/');
            exit();
        }

        $this->user_id = $this->session->userdata('user_id');
        // $this->access_role   = $this->mod_portal->get_user_access_role($this->user_id);
        $this->user_profile = $this->mod_portal->get_user($this->user_id);
        $this->user_settings = $this->mod_portal->get_settings($this->user_id);
        $this->company = $this->portal_lib->get_active_company();
        $this->companies = $this->portal_lib->get_my_companies($this->user_id);
        $this->avatar = avatar();

        $this->portal_lib->get_notifications($this->notifications = new stdClass());

        // sleep(5);
        //$this->output->enable_profiler(TRUE);
    }

    public function display($title = '', $content = 'No Content') {
        $data['title'] = (!empty($title)) ? $title : 'Cut Out Image Service Portal - Client Area';
        $data['profile'] = $this->user_profile;
        /* Template HTML */
        $html['content'] = $content;
        $html['header'] = $this->load->view('tpl_header', $data, TRUE);
        $html['topfixedbar'] = $this->load->view('tpl_topfixedbar', '', TRUE);
        $html['navigation'] = $this->load->view('tpl_navigation', '', TRUE);
        $html['footer'] = $this->load->view('tpl_footer', '', TRUE);

        $this->load->view('tpl_index', $html);
    }

}
