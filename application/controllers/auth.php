<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $message = $this->session->flashdata('message');

        $data['title'] = 'Cut Out Image Service Portal';
        $data['message'] = $message;
        // $data['message'] = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.';
        $data['header'] = $this->load->view('tpl_header', $data, TRUE);
        $data['content'] = $this->load->view('auth/general_message', $data, TRUE);
        $data['footer'] = $this->load->view('tpl_footer', $data, TRUE);

        if ($message) {
            $this->load->view('tpl_external', $data);
        } else {
            redirect('/auth/login/');
            // $this->load->view('tpl_external', $data);
        }
    }

    function pull() {
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');

        $output = array();

        $page_url = isset($_GET['page']) ? $_GET['page'] : '';
        $page_url = parse_url($page_url);
        $page_url = array_values(array_filter(explode('/', $page_url['path'])));

        if ($page_url) {
            $output['controller'] = isset($page_url[0]) ? $page_url[0] : '';
            $output['method'] = isset($page_url[1]) ? $page_url[1] : '';
        }

        if ($this->tank_auth->is_logged_in()) {
            $output['login'] = 1;
            $output['notifications'] = ''; //$this->portal_lib->get_notifications(new stdClass());
        } else {
            $output['login'] = 0;
        }

        echo json_encode($output);
    }

    function popup_tos() {
        $this->load->view('popup_tos');
    }

    /**
     * Validate for ipn v1 and v2 
     */
    function payza_ipn_validate() {
        $this->load->library('email_lib');
        $this->email_lib->debug_email($_POST);

        $this->load->library('payza_lib');

        $token = $this->input->post('token');
        if ($token) {
            $res = $this->payza_lib->ipnv2_handler($token);
        } else if (isset($_POST)) {
            $res = $this->payza_lib->ipnv1_handler($_POST);
        } else {
            die('Fatal Error!');
        }


        if ($res && $res['transactionStatus'] == 'Success') {
            $this->email_lib->debug_email($res);

            $values['payment_by'] = $res['paidby_user_id'];
            $values['order_id'] = $res['order_id'];
            $values['payment_method'] = 'payza';
            $values['payment_amount'] = $res['totalAmountReceived'];
            $values['payment_status'] = 1;
            $values['transaction_id'] = $res['transactionReferenceNumber'];
            $values['payment_date'] = date("Y-m-d H:i:s", time());
            $values['payment_info'] = print_r($res, TRUE);

            $this->mod_portal->insert_payment_info($values);
            $this->mod_portal->update_order_payment_status($res['order_id'], 1);
        }
    }

    /**
     * Invite user
     */
    function invite() {
        $key = $this->input->get('key');
        $info = $this->portal_lib->check_invite_key($key);
        if (!$info) {
            die("Invalid key!");
        }

        $company = $this->portal_lib->get_company_by_id($info->invite_for);
        if (!$company) {
            die("Invited for company is invalid or deactivated!");
        }

        $this->portal_lib->set_invitation_cookie($key);
        $user = $this->users->get_user_by_email($info->invite_to);

        //echo '<pre>'; print_r($company); die();

        if ($user) {
            if ($this->tank_auth->is_logged_in()) {
                $added = $this->mod_portal->add_company_member($user->id, $info->invite_for);
                if ($added) {
                    $this->mod_portal->delete_invitation($info->invite_id);

                    $comArray['id'] = $company->id;
                    $comArray['name'] = $company->name;
                    $comArray['user_id'] = $company->user_id; //Owner
                    $this->portal_lib->set_active_company($comArray);
                    delete_cookie("invite_ref");

                    $data['owner_id'] = $company->user_id;
                    $data['compnay_name'] = $company->name;
                    $data['company_id'] = $company->id;

                    $this->load->library('email_lib');
                    $this->email_lib->invitation_accepted($data);
                }
                redirect(site_url('/'));
            } else {
                redirect(site_url('/auth/login'));
            }
        } else {
            $this->tank_auth->logout();
            redirect(site_url('/auth/register'));
        }
        exit('Success');
    }

    /**
     * Lock screen
     */
    function lock() {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $data['user_ref'] = $this->portal_lib->get_cookie('user_ref');
            $this->load->view('tpl_lock_screen', $data);
        } else {
            $this->logout();
        }
    }

    /**
     * Login user on the site
     *
     * @return void
     */
    function login() {
        if ($this->tank_auth->is_logged_in()) {         // logged in
            redirect('/');
        } elseif ($this->tank_auth->is_logged_in(FALSE)) {      // logged in, not activated
            redirect('/auth/send_again/');
        } else {
            $data['login_by_username'] = ($this->config->item('login_by_username', 'tank_auth') AND $this->config->item('use_username', 'tank_auth'));
            $data['login_by_email'] = $this->config->item('login_by_email', 'tank_auth');

            $this->form_validation->set_rules('login', 'Login', 'trim|required|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
            $this->form_validation->set_rules('remember', 'Remember me', 'integer');

            // Get login for counting attempts to login
            if ($this->config->item('login_count_attempts', 'tank_auth') AND ( $login = $this->input->post('login'))) {
                $login = $this->security->xss_clean($login);
            } else {
                $login = '';
            }
            $data['use_recaptcha_login'] = $this->config->item('use_recaptcha_login', 'tank_auth');
            $data['use_recaptcha'] = $this->config->item('use_recaptcha', 'tank_auth');
            if ($data['use_recaptcha_login']) {
                if ($this->tank_auth->is_max_login_attempts_exceeded($login)) {
                    if ($data['use_recaptcha'])
                        $this->form_validation->set_rules('recaptcha_response_field', 'Confirmation Code', 'trim|xss_clean|required|callback__check_recaptcha');
                    else
                        $this->form_validation->set_rules('captcha', 'Confirmation Code', 'trim|xss_clean|required|callback__check_captcha');
                }
            }
            $data['errors'] = array();

            if ($this->form_validation->run()) {        // validation ok
                if ($this->tank_auth->login(
                                $this->form_validation->set_value('login'), 
                                $this->form_validation->set_value('password'), 
                                $this->form_validation->set_value('remember'), 
                                $data['login_by_username'], 
                                $data['login_by_email'])) { // success
                    
                    $user_id = $this->session->userdata('user_id');
                    $user_profile = $this->mod_portal->get_user($user_id);
                    if (!$user_profile) {
                        die('user not found');
                    }
                    
                    if($user_profile->role_id > 1){ //if user not admin
                    	$ip = $this->input->ip_address();
	                    $is_banned = $this->portal_lib->is_blocked_user($user_id, $ip);
	                    if ($is_banned) {
	                        $this->session->set_userdata("is_banned", 'yes');
	                    }
	                }

                    $this->mod_portal->audit_log('User login', '', $user_profile->user_id, $user_profile->fullname);
                    delete_cookie('user_ref');
                    $user_ref = array(
                        "name" => $user_profile->fullname,
                        "email" => $user_profile->email,
                        "avatar" => $user_profile->avatar,
                    );
                    $this->portal_lib->set_cookie('user_ref', $user_ref);
                    $invite_key = $this->input->cookie('invite_ref', TRUE);
                    if (isset($invite_key) && !empty($invite_key)) {
                        $info = $this->portal_lib->check_invite_key($invite_key);
                        if ($info) {
                            $company = $this->portal_lib->get_company_by_id($info->invite_for);
                            if ($company) {
                                $user_info = $this->users->get_user_by_email($info->invite_to);
                                if ($user_info) {
                                    $added = $this->mod_portal->add_company_member($user_info->id, $info->invite_for);
                                    if ($added) {
                                        $this->mod_portal->delete_invitation($info->invite_id);
                                        $comArray['id'] = $company->id;
                                        $comArray['name'] = $company->name;
                                        $comArray['user_id'] = $company->user_id; //Owner
                                        $this->portal_lib->set_active_company($comArray);
                                        delete_cookie("invite_ref");
                                        $this->mod_portal->audit_log('Join to company', print_r($comArray, TRUE), $user_profile->user_id, $user_profile->fullname);
                                    }
                                }
                            }
                        }
                    }

                    $ref_url = $this->input->get('ref');
                    if ($ref_url) {
                        redirect(urldecode($ref_url));
                    }
                    redirect('/');
                } else {
                    $errors = $this->tank_auth->get_error_message();
                    if (isset($errors['banned'])) {        // banned user
                        $this->_show_message($this->lang->line('auth_message_banned') . ' ' . $errors['banned']);
                    } elseif (isset($errors['not_activated'])) {    // not activated user
                        redirect('/auth/send_again/');
                    } else {             // fail
                        foreach ($errors as $k => $v)
                            $data['errors'][$k] = $this->lang->line($v);
                    }
                }
            }

            $data['show_captcha'] = FALSE;
            if ($this->tank_auth->is_max_login_attempts_exceeded($login)) {
                $data['show_captcha'] = TRUE;
                if ($data['use_recaptcha']) {
                    $data['recaptcha_html'] = $this->_create_recaptcha();
                } else {
                    $data['captcha_html'] = $this->_create_captcha();
                }
            }

            $data['title'] = 'Login - Cut Out Image Service Portal';
            $data['header'] = $this->load->view('tpl_header', $data, TRUE);
            $data['content'] = $this->load->view('auth/login_form', $data, TRUE);
            $data['footer'] = $this->load->view('tpl_footer', $data, TRUE);

            $this->load->view('tpl_external', $data);
        }
    }

    /**
     * Logout user
     *
     * @return void
     */
    function logout() {
        $this->session->unset_userdata("is_banned");
        $this->mod_portal->audit_log('User logout');
        $this->tank_auth->logout();

        $this->_show_message($this->lang->line('auth_message_logged_out'));
    }

    /**
     * Register user on the site
     *
     * @return void
     */
    function register() {
        if ($this->tank_auth->is_logged_in()) {         // logged in
            redirect('/');
        } elseif ($this->tank_auth->is_logged_in(FALSE)) {      // logged in, not activated
            redirect('/auth/send_again/');
        } elseif (!$this->config->item('allow_registration', 'tank_auth')) { // registration is off
            $this->_show_message($this->lang->line('auth_message_registration_disabled'));
        } else {
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

            $use_username = $this->config->item('use_username', 'tank_auth');
            if ($use_username) {
                $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|min_length[' . $this->config->item('username_min_length', 'tank_auth') . ']|max_length[' . $this->config->item('username_max_length', 'tank_auth') . ']|alpha_dash');
            }
            $this->form_validation->set_rules('fullname', 'Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|min_length[' . $this->config->item('password_min_length', 'tank_auth') . ']|max_length[' . $this->config->item('password_max_length', 'tank_auth') . ']');
            //$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|xss_clean|matches[password]');
            $this->form_validation->set_rules('company', 'Company', 'trim|required|xss_clean|min_length[3]');
            $this->form_validation->set_rules('country', 'Country', 'trim|required|xss_clean');
            $this->form_validation->set_rules('phone', 'phone', 'trim|required|xss_clean|min_length[9]');

            $captcha_registration = $this->config->item('captcha_registration', 'tank_auth');
            $use_recaptcha = $this->config->item('use_recaptcha', 'tank_auth');
            if ($captcha_registration) {
                if ($use_recaptcha) {
                    $this->form_validation->set_rules('recaptcha_response_field', 'Confirmation Code', 'trim|xss_clean|required|callback__check_recaptcha');
                } else {
                    $this->form_validation->set_rules('captcha', 'Confirmation Code', 'trim|xss_clean|required|callback__check_captcha');
                }
            }
            $data['errors'] = array();

            $email_activation = $this->config->item('email_activation', 'tank_auth');

            if ($this->form_validation->run()) {        // validation ok
                //CREATE USER
                $username = $use_username ? $this->form_validation->set_value('username') : '';
                $email = $this->form_validation->set_value('email');
                $password = $this->form_validation->set_value('password');

                $data = $this->tank_auth->create_user($username, $email, $password, $email_activation);

                if (!is_null($data)) {      // success
                    $profile['fullname'] = $this->form_validation->set_value('fullname');
                    $profile['company'] = $this->form_validation->set_value('company');
                    $profile['country'] = $this->form_validation->set_value('country');
                    $profile['phone'] = $this->form_validation->set_value('phone');
                    $this->users->update_profile($data['user_id'], $profile);

                    // $this->mod_portal->audit_log('New User Registered', print_r($profile, TRUE));
                    //Create new Company
                    $company['company'] = $this->form_validation->set_value('company');
                    $company['country'] = $this->form_validation->set_value('country');
                    $company['phone'] = $this->form_validation->set_value('phone');
                    $this->users->create_company($data['user_id'], $company);

                    // $this->mod_portal->audit_log('New company created', print_r($company, TRUE));
                    /* ENd */
                    /*
                     * Create new contacts in aircall
                     */
                    $nameArr = splitFullname($this->form_validation->set_value('fullname'));
                    $contacts = array(
                        'first_name' => $nameArr[0],
                        'last_name' => $nameArr[1],
                        'company' => $this->form_validation->set_value('company'),
                        'country' => $this->form_validation->set_value('country'),
                        'phone' => $this->form_validation->set_value('phone'),
                        'email' => $email
                    );
                    $this->portal_lib->aircallAPI($contacts);

                    $data['site_name'] = $this->config->item('website_name', 'tank_auth');
                    $data['profile'] = $profile;

                    if ($email_activation) {         // send "activate" email
                        $data['activation_period'] = $this->config->item('email_activation_expire', 'tank_auth') / 3600;

                        $this->_send_email('activate', $data['email'], $data);

                        unset($data['password']); //Clear password (just for any case)

                        $this->_show_message($this->lang->line('auth_message_registration_completed_1'));
                    } else {
                        if ($this->config->item('email_account_details', 'tank_auth')) { // send "welcome" email
                            $this->_send_email('welcome', $data['email'], $data);
                        }
                        unset($data['password']); // Clear password (just for any case)

                        $this->_show_message($this->lang->line('auth_message_registration_completed_2') . ' ' . anchor('/auth/login/', 'Login'));
                    }
                } else {
                    $errors = $this->tank_auth->get_error_message();
                    foreach ($errors as $k => $v)
                        $data['errors'][$k] = $this->lang->line($v);
                }
            }
            if ($captcha_registration) {
                if ($use_recaptcha) {
                    $data['recaptcha_html'] = $this->_create_recaptcha();
                } else {
                    $data['captcha_html'] = $this->_create_captcha();
                }
            }
            $data['use_username'] = $use_username;
            $data['captcha_registration'] = $captcha_registration;
            $data['use_recaptcha'] = $use_recaptcha;

            $data['title'] = 'Register - Cut Out Image Service Portal';
            $data['header'] = $this->load->view('tpl_header', $data, TRUE);
            $data['content'] = $this->load->view('auth/register_form', $data, TRUE);
            $data['footer'] = $this->load->view('tpl_footer', $data, TRUE);

            $this->load->view('tpl_external', $data);
        }
    }

    /**
     * Send activation email again, to the same or new email address
     *
     * @return void
     */
    function send_again() {
        if (!$this->tank_auth->is_logged_in(FALSE)) {       // not logged in or activated
            redirect('/auth/login/');
        } else {
            $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');

            $data['errors'] = array();

            if ($this->form_validation->run()) {        // validation ok
                if (!is_null($data = $this->tank_auth->change_email(
                                $this->form_validation->set_value('email')))) {   // success
                    $data['site_name'] = $this->config->item('website_name', 'tank_auth');
                    $data['activation_period'] = $this->config->item('email_activation_expire', 'tank_auth') / 3600;

                    $this->_send_email('activate', $data['email'], $data);

                    $this->_show_message(sprintf($this->lang->line('auth_message_activation_email_sent'), $data['email']));
                } else {
                    $errors = $this->tank_auth->get_error_message();
                    foreach ($errors as $k => $v)
                        $data['errors'][$k] = $this->lang->line($v);
                }
            }
            $this->load->view('auth/send_again_form', $data);
        }
    }

    /**
     * Activate user account.
     * User is verified by user_id and authentication code in the URL.
     * Can be called by clicking on link in mail.
     *
     * @return void
     */
    function activate() {
        $user_id = $this->uri->segment(3);
        $new_email_key = $this->uri->segment(4);

        // Activate user
        if ($this->tank_auth->activate_user($user_id, $new_email_key)) {  // success
            $this->tank_auth->logout();
            $this->_show_message($this->lang->line('auth_message_activation_completed') . ' ' . anchor('/auth/login/', 'Login'));
        } else {                // fail
            $this->_show_message($this->lang->line('auth_message_activation_failed'));
        }
    }

    /**
     * Generate reset code (to change password) and send it to user
     *
     * @return void
     */
    function forgot_password() {
        if ($this->tank_auth->is_logged_in()) {         // logged in
            redirect('/');
        } elseif ($this->tank_auth->is_logged_in(FALSE)) {      // logged in, not activated
            redirect('/auth/send_again/');
        } else {
            $this->form_validation->set_rules('login', 'Email or login', 'trim|required|xss_clean');

            $data['errors'] = array();

            if ($this->form_validation->run()) {        // validation ok
                if (!is_null($data = $this->tank_auth->forgot_password($this->form_validation->set_value('login')))) {

                    $data['site_name'] = $this->config->item('website_name', 'tank_auth');

                    // Send email with password activation link
                    $this->_send_email('forgot_password', $data['email'], $data);

                    $this->_show_message($this->lang->line('auth_message_new_password_sent'));
                } else {
                    $errors = $this->tank_auth->get_error_message();
                    foreach ($errors as $k => $v) {
                        $data['errors'][$k] = $this->lang->line($v);
                    }
                }
            }

            $data['title'] = 'Retrive Password - Cut Out Image Service Portal';
            $data['header'] = $this->load->view('tpl_header', $data, TRUE);
            $data['content'] = $this->load->view('auth/forgot_password_form', $data, TRUE);
            $data['footer'] = $this->load->view('tpl_footer', $data, TRUE);

            $this->load->view('tpl_external', $data);
        }
    }

    /**
     * Replace user password (forgotten) with a new one (set by user).
     * User is verified by user_id and authentication code in the URL.
     * Can be called by clicking on link in mail.
     *
     * @return void
     */
    function reset_password() {
        $user_id = $this->uri->segment(3);
        $new_pass_key = $this->uri->segment(4);



        $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|xss_clean|min_length[' . $this->config->item('password_min_length', 'tank_auth') . ']|max_length[' . $this->config->item('password_max_length', 'tank_auth') . ']|alpha_dash');
        $this->form_validation->set_rules('confirm_new_password', 'Confirm New Password', 'trim|required|xss_clean|matches[new_password]');

        $data['errors'] = array();

        if ($this->form_validation->run()) {        // validation ok
            if (!is_null($data = $this->tank_auth->reset_password($user_id, $new_pass_key, $this->form_validation->set_value('new_password')))) { // success
                $data['site_name'] = $this->config->item('website_name', 'tank_auth');
                $data['support_email'] = $this->config->item('support_email', 'tank_auth');

                // Send email with new password
                $this->_send_email('reset_password', $data['email'], $data);

                $this->_show_message($this->lang->line('auth_message_new_password_activated') . ' ' . anchor('/auth/login/', 'Login'));
            } else {              // fail
                $this->_show_message($this->lang->line('auth_message_new_password_failed'));
            }
        } else {
            // Try to activate user by password key (if not activated yet)
            if ($this->config->item('email_activation', 'tank_auth')) {
                $this->tank_auth->activate_user($user_id, $new_pass_key, FALSE);
            }

            if (!$this->tank_auth->can_reset_password($user_id, $new_pass_key)) {
                $this->_show_message($this->lang->line('auth_message_new_password_failed'));
            }
        }
        $data['title'] = 'Reset Password - CutOutImage';
        $data['header'] = $this->load->view('tpl_header', $data, TRUE);
        $data['content'] = $this->load->view('auth/reset_password_form', $data, TRUE);
        $data['footer'] = $this->load->view('tpl_footer', $data, TRUE);

        $this->load->view('tpl_external', $data);

        // $this->load->view('auth/reset_password_form', $data);
    }

    /**
     * Change user password
     *
     * @return void
     */
    function change_password() {
        if (!$this->tank_auth->is_logged_in()) {        // not logged in or not activated
            redirect('/auth/login/');
        } else {
            $this->form_validation->set_rules('old_password', 'Old Password', 'trim|required|xss_clean');
            $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|xss_clean|min_length[' . $this->config->item('password_min_length', 'tank_auth') . ']|max_length[' . $this->config->item('password_max_length', 'tank_auth') . ']|alpha_dash');
            $this->form_validation->set_rules('confirm_new_password', 'Confirm new Password', 'trim|required|xss_clean|matches[new_password]');

            $data['errors'] = array();
            $user = $this->users->get_user_by_id($this->tank_auth->get_user_id(), TRUE);

            if ($this->form_validation->run()) {        // validation ok
                if ($this->tank_auth->change_password(
                                $this->form_validation->set_value('old_password'), $this->form_validation->set_value('new_password'))) { // success
                    $data['user_id'] = $user->id;
                    $data['email'] = $user->email;
                    $this->_send_email('change_password', $data['email'], $data);

                    $this->_show_message($this->lang->line('auth_message_password_changed'));
                } else {              // fail
                    $errors = $this->tank_auth->get_error_message();
                    foreach ($errors as $k => $v)
                        $data['errors'][$k] = $this->lang->line($v);
                }
            }
            // $this->load->view('auth/change_password_form', $data);
            $data['title'] = 'Reset Password - CutOutImage';
            $data['header'] = $this->load->view('tpl_header', $data, TRUE);
            $data['content'] = $this->load->view('auth/change_password_form', $data, TRUE);
            $data['footer'] = $this->load->view('tpl_footer', $data, TRUE);

            $this->load->view('tpl_external', $data);
        }
    }

    /**
     * Change user email
     *
     * @return void
     */
    function change_email() {
        if (!$this->tank_auth->is_logged_in()) {        // not logged in or not activated
            redirect('/auth/login/');
        } else {
            $user = $this->mod_portal->get_user($this->tank_auth->get_user_id());

            $data['old_email'] = $user->email;
            $data['fullname'] = $user->fullname;

            $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');

            $data['errors'] = array();

            if ($this->form_validation->run()) {        // validation ok
                if (!is_null($data = $this->tank_auth->set_new_email(
                                $this->form_validation->set_value('email'), $this->form_validation->set_value('password')))) {   // success
                    $data['site_name'] = $this->config->item('website_name', 'tank_auth');

                    // Send email with new email address and its activation link
                    $this->_send_email('change_email', $data['new_email'], $data);

                    $this->_show_message(sprintf($this->lang->line('auth_message_new_email_sent'), $data['new_email']));
                } else {
                    $errors = $this->tank_auth->get_error_message();
                    foreach ($errors as $k => $v)
                        $data['errors'][$k] = $this->lang->line($v);
                }
            }
            $data['title'] = 'Reset Password - CutOutImage';
            $data['header'] = $this->load->view('tpl_header', $data, TRUE);
            $data['content'] = $this->load->view('auth/change_email_form', $data, TRUE);
            $data['footer'] = $this->load->view('tpl_footer', $data, TRUE);

            $this->load->view('tpl_external', $data);
        }
    }

    /**
     * Replace user email with a new one.
     * User is verified by user_id and authentication code in the URL.
     * Can be called by clicking on link in mail.
     *
     * @return void
     */
    function reset_email() {
        $user_id = $this->uri->segment(3);
        $new_email_key = $this->uri->segment(4);

        // Reset email
        if ($this->tank_auth->activate_new_email($user_id, $new_email_key)) { // success
            $this->tank_auth->logout();
            $this->_show_message($this->lang->line('auth_message_new_email_activated') . ' ' . anchor('/auth/login/', 'Login'));
        } else {                // fail
            $this->_show_message($this->lang->line('auth_message_new_email_failed'));
        }
    }

    /**
     * Delete user from the site (only when user is logged in)
     *
     * @return void
     */
    function unregister() {
        if (!$this->tank_auth->is_logged_in()) {        // not logged in or not activated
            redirect('/auth/login/');
        } else {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

            $data['errors'] = array();

            if ($this->form_validation->run()) {        // validation ok
                if ($this->tank_auth->delete_user(
                                $this->form_validation->set_value('password'))) {  // success
                    $this->_show_message($this->lang->line('auth_message_unregistered'));
                } else {              // fail
                    $errors = $this->tank_auth->get_error_message();
                    foreach ($errors as $k => $v)
                        $data['errors'][$k] = $this->lang->line($v);
                }
            }
            $this->load->view('auth/unregister_form', $data);
        }
    }

    /**
     * Show info message
     *
     * @param	string
     * @return	void
     */
    function _show_message($message) {
        $this->session->set_flashdata('message', $message);
        redirect('/auth/');
    }

    /**
     * Send email message of given type (activate, forgot_password, etc.)
     *
     * @param	string
     * @param	string
     * @param	array
     * @return	void
     */
    function _send_email($type, $email, &$data) {
        /* $this->load->library('email');
          $this->email->from($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
          $this->email->reply_to($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
          $this->email->to($email);
          $this->email->subject(sprintf($this->lang->line('auth_subject_'.$type), $this->config->item('website_name', 'tank_auth')));
          $this->email->message($this->load->view('email/'.$type.'-html', $data, TRUE));
          $this->email->set_alt_message($this->load->view('email/'.$type.'-txt', $data, TRUE));
          $this->email->send(); */

        $this->load->library('email_lib');

        switch ($type) {
            case 'activate':
                $this->email_lib->user_mail_activate($email, $data);
                $this->email_lib->admin_mail_activate($email, $data);
                break;

            case 'welcome':
                $this->email_lib->user_mail_welcome($email, $data);
                $this->email_lib->admin_mail_welcome($data);
                break;

            case 'forgot_password':
                $this->email_lib->user_mail_forgot_password($email, $data);
                $this->email_lib->admin_mail_forgot_password($email, $data);
                break;

            case 'reset_password':
                $this->email_lib->user_mail_reset_password($email, $data);
                $this->email_lib->admin_mail_reset_password($email, $data);
                break;

            case 'change_password':
                $this->email_lib->user_mail_change_password($email, $data);
                $this->email_lib->admin_mail_change_password($email, $data);
                break;

            case 'change_email':
                $this->email_lib->user_mail_change_email($email, $data);
                $this->email_lib->admin_mail_change_email($email, $data);
                break;

            default:
                # code...
                break;
        }
        return;
        /* $to = $email;
          $subject = sprintf($this->lang->line('auth_subject_'.$type), $this->config->item('website_name', 'tank_auth'));
          $content = $this->load->view('email/'.$type.'-html', $data, TRUE);
          return $this->email_lib->send($to, $subject, $content); */
    }

    /**
     * Create CAPTCHA image to verify user as a human
     *
     * @return	string
     */
    function _create_captcha() {
        $this->load->helper('captcha');

        $cap = create_captcha(array(
            'img_path' => './' . $this->config->item('captcha_path', 'tank_auth'),
            'img_url' => base_url() . $this->config->item('captcha_path', 'tank_auth'),
            'font_path' => './' . $this->config->item('captcha_fonts_path', 'tank_auth'),
            'font_size' => $this->config->item('captcha_font_size', 'tank_auth'),
            'img_width' => $this->config->item('captcha_width', 'tank_auth'),
            'img_height' => $this->config->item('captcha_height', 'tank_auth'),
            'show_grid' => $this->config->item('captcha_grid', 'tank_auth'),
            'expiration' => $this->config->item('captcha_expire', 'tank_auth'),
        ));

        // Save captcha params in session
        $this->session->set_flashdata(array(
            'captcha_word' => $cap['word'],
            'captcha_time' => $cap['time'],
        ));

        return $cap['image'];
    }

    /**
     * Callback function. Check if CAPTCHA test is passed.
     *
     * @param	string
     * @return	bool
     */
    function _check_captcha($code) {
        $time = $this->session->flashdata('captcha_time');
        $word = $this->session->flashdata('captcha_word');

        list($usec, $sec) = explode(" ", microtime());
        $now = ((float) $usec + (float) $sec);

        if ($now - $time > $this->config->item('captcha_expire', 'tank_auth')) {
            $this->form_validation->set_message('_check_captcha', $this->lang->line('auth_captcha_expired'));
            return FALSE;
        } elseif (($this->config->item('captcha_case_sensitive', 'tank_auth') AND
                $code != $word) OR
                strtolower($code) != strtolower($word)) {
            $this->form_validation->set_message('_check_captcha', $this->lang->line('auth_incorrect_captcha'));
            return FALSE;
        }
        return TRUE;
    }

    /**
     * Create reCAPTCHA JS and non-JS HTML to verify user as a human
     *
     * @return	string
     */
    function _create_recaptcha() {
        $this->load->helper('recaptcha');

        // Add custom theme so we can get only image
        $options = "<script>var RecaptchaOptions = {theme: 'custom', custom_theme_widget: 'recaptcha_widget'};</script>\n";

        // Get reCAPTCHA JS and non-JS HTML
        $html = recaptcha_get_html($this->config->item('recaptcha_public_key', 'tank_auth'));

        return $options . $html;
    }

    /**
     * Callback function. Check if reCAPTCHA test is passed.
     *
     * @return	bool
     */
    function _check_recaptcha() {
        $this->load->helper('recaptcha');

        $resp = recaptcha_check_answer($this->config->item('recaptcha_private_key', 'tank_auth'), $_SERVER['REMOTE_ADDR'], $_POST['recaptcha_challenge_field'], $_POST['recaptcha_response_field']);

        if (!$resp->is_valid) {
            $this->form_validation->set_message('_check_recaptcha', $this->lang->line('auth_incorrect_captcha'));
            return FALSE;
        }
        return TRUE;
    }

}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */