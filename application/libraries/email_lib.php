<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Email_lib {

    private $settings;
    private $admin_email;
    private $user_id;

    function __construct() {
        $this->ci = & get_instance();
        $this->ci->load->library('email');

        if ($this->ci->tank_auth->is_logged_in()) {
            $this->user_id = $this->ci->tank_auth->get_user_id();
            $this->settings = $this->ci->portal_lib->get_settings($this->user_id);
        }

        if (ENVIRONMENT == 'production') {
            // $this->admin_email = 'jobaer.shuman@gmail.com';
            $this->admin_email = 'hello@cutoutimage.com';
        } else {
            $this->admin_email = $this->ci->config->item('admin_email', 'tank_auth');
        }
    }

    /**
     * @param string(comma sep)/array
     * @param string
     * @param html
     * @param array (optional)
     */
    public function send($to, $subject, $content, $from = false, $reply_to = NULL) {
        $this->ci->email->initialize(array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.sendgrid.net',
            'smtp_user' => '',
            'smtp_pass' => '',
            'smtp_port' => 587,
                // 'newline' => "\r\n",
                // 'crlf' => "\r\n",
        ));
        $this->ci->email->set_newline("\r\n");

        $data['asset_path'] = $this->ci->config->item('email_asset');
        $data['unsubscribe'] = site_url('/unsubscribe?email=' . $to . '&key=' . uniqid());
        $data['content'] = $content;
        $message = $this->ci->load->view('email/email_template', $data, TRUE);

        if ($from) {
            $this->ci->email->from($from);
        } else {
            $default_from = $this->ci->config->item('sender_email', 'tank_auth');
            $this->ci->email->from($default_from, $this->ci->config->item('website_name', 'tank_auth'));
        }
        if ($reply_to !== NULL) {
            if (is_array($reply_to)) {
                $this->ci->email->reply_to($reply_to['email'], $reply_to['name']);
            } else {
                $this->ci->email->reply_to($reply_to);
            }
        }
        $this->ci->email->to($to);
        $this->ci->email->subject($subject);
        $this->ci->email->message($message);
        return $this->ci->email->send();
    }

    public function send_report($msg, $data = array()) {
        $to = 'jobaer.shuman@gmail.com';
        $this->ci->email->from('hello@cutoutimage.com', 'Cut Out Image');
        $this->ci->email->to($to);
        $this->ci->email->subject('CutOutImage Error Reports');
        $this->ci->email->message($msg);
        return $this->ci->email->send();
    }

    public function test($data = array()) {

        $to = 'hello@cutoutimage.com, jobaer.shuman@gmail.com';

        $this->ci->email->from('hello@cutoutimage.com', 'Cut Out Image');
        $this->ci->email->to($to);
        $this->ci->email->subject('Test Email');
        $this->ci->email->message('Hello');
        return $this->ci->email->send();
    }

    public function sendgrid_test($data = array()) {

        $this->ci->load->library('email');

        $this->ci->email->initialize(array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.sendgrid.net',
            'smtp_user' => 'atikrahman',
            'smtp_pass' => 'shuman123',
            'smtp_port' => 587,
            'crlf' => "\r\n",
            'newline' => "\r\n"
        ));

        $this->ci->email->from('hello@cutoutimage.com', 'CutOutImage');
        $this->ci->email->to('jobaer.shuman@gmail.com');
        $this->ci->email->subject('Email Test');
        $this->ci->email->message('Testing the email class.');
        $this->ci->email->send();

        echo $this->ci->email->print_debugger();
    }

    /** ==================== START::Tank Auth Registration Emails ==================
     */

    /**
     * User Activation
     * @param string $email
     * @param array $data
     * @return void
     */
    public function user_mail_activate($email, $tankAuth_data) {
        $data['user_id'] = $tankAuth_data['user_id'];
        $data['fullname'] = $tankAuth_data['profile']['fullname'];
        $data['company'] = $tankAuth_data['profile']['company'];
        $data['country'] = $tankAuth_data['profile']['country'];
        $data['phone'] = $tankAuth_data['profile']['phone'];
        $data['activation_period'] = $tankAuth_data['activation_period'];
        $data['new_email_key'] = isset($tankAuth_data['new_email_key']) ? $tankAuth_data['new_email_key'] : '';

        $to = $email;
        $subject = 'Thank you for Signing Up! Just one more step to complete your account.';
        $content = $this->ci->load->view('email/user_sign_up', $data, TRUE);
        return $this->send($to, $subject, $content);
    }

    public function admin_mail_activate($email, $tankAuth_data) {
        $data['user_id'] = $tankAuth_data['user_id'];
        $data['fullname'] = $tankAuth_data['profile']['fullname'];
        $data['company'] = $tankAuth_data['profile']['company'];
        $data['country'] = $tankAuth_data['profile']['country'];
        $data['phone'] = $tankAuth_data['profile']['phone'];

        $to = $email;
        $subject = 'New user activate: ' . $data['fullname'];
        $content = $this->ci->load->view('email/admin_new_signup', $data, TRUE);
        return $this->send($to, $subject, $content);
    }

    /**
     * User Registration
     * @param string $email
     * @param array $data
     * @return void
     */
    public function user_mail_welcome($email, $tankAuth_data) {
        $data['user_id'] = $tankAuth_data['user_id'];
        $data['fullname'] = $tankAuth_data['profile']['fullname'];
        $data['company'] = $tankAuth_data['profile']['company'];
        $data['country'] = $tankAuth_data['profile']['country'];
        $data['phone'] = $tankAuth_data['profile']['phone'];
        $data['activation_period'] = isset($tankAuth_data['activation_period']) ? $tankAuth_data['activation_period'] : '';

        $to = $email;
        $subject = 'Thank you for Signing Up! :-)';
        $content = $this->ci->load->view('email/user_sign_up', $data, TRUE);
        return $this->send($to, $subject, $content);
    }

    public function admin_mail_welcome($tankAuth_data) {
        $data['user_id'] = $tankAuth_data['user_id'];
        $data['fullname'] = $tankAuth_data['profile']['fullname'];
        $data['company'] = $tankAuth_data['profile']['company'];
        $data['country'] = $tankAuth_data['profile']['country'];
        $data['phone'] = $tankAuth_data['profile']['phone'];
        $data['activation_period'] = isset($tankAuth_data['activation_period']) ? $tankAuth_data['activation_period'] : '';

        $to = $this->admin_email;
        $subject = 'New user registration: ' . $data['fullname'];
        $content = $this->ci->load->view('email/admin_new_signup', $data, TRUE);
        return $this->send($to, $subject, $content);
    }

    /**
     * Forgot Password
     * @param string $email
     * @param array $data
     * @return void
     */
    public function user_mail_forgot_password($email, $tankAuth_data) {
        $user_info = $this->ci->mod_portal->get_user($tankAuth_data['user_id']);

        $data['user_id'] = $tankAuth_data['user_id'];
        $data['new_pass_key'] = $tankAuth_data['new_pass_key'];
        $data['fullname'] = $user_info->fullname;

        $to = $email;
        $subject = 'Security notification: Password Assistance';
        $content = $this->ci->load->view('email/user_forget_password', $data, TRUE);

        return $this->send($to, $subject, $content);
    }

    public function admin_mail_forgot_password($email, $tankAuth_data) {
        /* N/A */
    }

    /**
     * Reset Password
     * @param string $email
     * @param array $data
     * @return void
     */
    public function user_mail_reset_password($email, $tankAuth_data) {
        $user_info = $this->ci->mod_portal->get_user($tankAuth_data['user_id']);

        $data['user_id'] = $tankAuth_data['user_id'];
        $data['fullname'] = $user_info->fullname;

        $to = $email;
        $subject = 'Security notification: Password Changed';
        $content = $this->ci->load->view('email/user_password_changed', $data, TRUE);

        return $this->send($to, $subject, $content);
    }

    public function admin_mail_reset_password($email, $tankAuth_data) {
        /* N/A */
    }

    /**
     * Change Password
     * @param string $email
     * @param array $data
     * @return void
     */
    public function user_mail_change_password($email, $tankAuth_data) {
        $user_info = $this->ci->mod_portal->get_user($tankAuth_data['user_id']);

        $data['user_id'] = $tankAuth_data['user_id'];
        $data['fullname'] = $user_info->fullname;

        $to = $email;
        $subject = 'Security notification: Password Changed';
        $content = $this->ci->load->view('email/user_password_changed', $data, TRUE);

        return $this->send($to, $subject, $content);
    }

    public function admin_mail_change_password($email, $tankAuth_data) {
        /* N/A */
    }

    /**
     * Change email
     * @param string $email
     * @param array $data
     * @return void
     */
    public function user_mail_change_email($new_email, $tankAuth_data) {
        $data['user_id'] = $tankAuth_data['user_id'];
        $data['new_email'] = $tankAuth_data['new_email'];
        $data['old_email'] = $tankAuth_data['old_email'];
        $data['new_email_key'] = $tankAuth_data['new_email_key'];

        $to = $tankAuth_data['old_email'];
        $subject = 'Security notification: Email Changed';
        $content = $this->ci->load->view('email/user_email_changed', $data, TRUE);

        return $this->send($to, $subject, $content);
    }

    public function admin_mail_change_email($email, $tankAuth_data) {
        /* N/A */
    }

    /*
     * ==================== END::Tank Auth Registration Emails ==================
     */

    /** ============================ Email for Order ==========================
     */
    /* Free Trial */

    public function admin_mail_free_trial_requested($user_info, $trial_entry, $dir_name) {

        //get user information
        $data['user_info'] = $user_info;
        $data['trial_entry'] = $trial_entry;
        $data['dir_name'] = $dir_name;
        $data['user_ip'] = $this->ci->input->ip_address();

        $to = $this->admin_email;
        $subject = 'Free Trial Request By: ' . $user_info['fullname'];
        $content = $this->ci->load->view('email/admin_free_trial', $data, TRUE);

        $reply_to = array(
            'name' => $user_info['fullname'],
            'email' => $user_info['email'],
        );

        return $this->send($to, $subject, $content, false, $reply_to);
    }

    /**
     * User Registration
     * @param string $email
     * @param array $data
     * @return void
     */
    public function user_mail_free_trial_requested($email, $data) {
        $data['user_id'] = $data['user_id'];
        $data['fullname'] = $data['fullname'];
        $data['company'] = $data['company'];
        $data['country'] = $data['country'];
        $data['phone'] = $data['phone'];

        $to = $email;
        $subject = 'Thank you for Signing Up! :-)';
        $content = $this->ci->load->view('email/user_free_trial', $data, TRUE);
        return $this->send($to, $subject, $content);
    }

    /* Create order */

    public function admin_mail_order_submit($data) {
        $data['order_key'] = "#COI-" . get_key($data['order_id']);
        //get user information
        $user = $this->ci->portal_lib->get_user_profile_by_order_id($data['order_id']);
        $data['user_info'] = $user;

        $to = $this->admin_email;
        $subject = 'New Order By: ' . $user->fullname . ' ' . $data['order_key'];
        $content = $this->ci->load->view('email/admin_new_order', $data, TRUE);

        return $this->send($to, $subject, $content, false, $user->email);
    }

    public function user_mail_order_submit($data) {
        if (isset($this->settings[NOTIFY_ORDER_SUBMIT]) && $this->settings[NOTIFY_ORDER_SUBMIT] == '0') {
            return false;
        }
        $data['order_key'] = get_key($data['order_id']);

        $user = $this->ci->user_profile;
        $data['user_info'] = $user;
        $data['company'] = $this->ci->company;

        $to = $user->email;
        $subject = 'Order Confirmation #COI-' . $data['order_key'];
        $content = $this->ci->load->view('email/user_order_confirmation', $data, TRUE);

        return $this->send($to, $subject, $content);
    }

    public function owner_mail_order_submit($data) {
        $data['order_key'] = get_key($data['order_id']);

        $user = $this->ci->user_profile;
        $owner = $this->ci->mod_portal->get_user($this->company->user_id);
        $data['user_info'] = $user;
        $data['owner_info'] = $owner;
        $data['company'] = $this->ci->company;

        $to = $owner->email;
        $subject = 'New Order By: ' . $user->fullname . ' ' . $data['order_key'];
        $content = $this->ci->load->view('email/owner_order_confirmation', $data, TRUE);

        return $this->send($to, $subject, $content);
    }

    /* Create Quote */

    public function admin_mail_quote_submit($data) {

        $quote_id = $data['quote_id'];
        $data['quote_key'] = get_key($quote_id);
        $service_id = $data['service_id'];

        //get user information
        $user_info = $this->ci->portal_lib->get_user_profile_by_quote_id($quote_id);

        $data['user_info'] = $user_info;

        $to = $this->admin_email;
        $subject = 'Quotation Request By: ' . $user_info->fullname . ' #COI-QR-' . $data['quote_key'];
        $content = $this->ci->load->view('email/admin_new_quote', $data, TRUE);

        return $this->send($to, $subject, $content);
    }

    public function owner_mail_quote_submit($data) {

        $quote_id = $data['quote_id'];
        $data['quote_key'] = get_key($quote_id);
        $service_id = $data['service_id'];

        //get user information
        $user_info = $this->ci->portal_lib->get_user_profile_by_quote_id($quote_id);

        $data['user_info'] = $user_info;

        $owner_email_address = '';
        foreach ($this->companies as $com) {
            if ($com->id == $this->company->id) {
                $owner_email_address = $com->email;
                break;
            }
        }
        if ($owner_email_address != '') {
            $to = $this->admin_email;
            $subject = 'Quotation Request By: ' . $user_info->fullname . ' #COI-QR-' . $data['quote_key'];
            $content = $this->ci->load->view('email/admin_new_quote', $data, TRUE);

            return $this->send($to, $subject, $content);
        }
    }

    public function user_mail_quote_submit($data) {
        if (isset($this->settings[NOTIFY_QUOTE_SUBMIT]) && $this->settings[NOTIFY_QUOTE_SUBMIT] == '0') {
            return false;
        }
        $quote_id = $data['quote_id'];
        $data['quote_key'] = get_key($quote_id);
        $service_id = $data['service_id'];

        $user = $this->ci->user_profile;
        $to = $user->email;
        $subject = 'Quotation Request Received #COI-QR-' . $data['quote_key'];
        $content = $this->ci->load->view('email/user_quote_submission', $data, TRUE);

        return $this->send($to, $subject, $content);
    }

    /* Quote Reviewed */

    public function admin_mail_quote_reviewed($data) {
        $user = $this->ci->portal_lib->get_user_profile_by_quote_id($data['quote_id']);
        $admin_user = $this->ci->user_profile;
        $data['user_info'] = $user;
        $data['admin_user'] = $admin_user;
        $data['quote_key'] = '#COI-QR-' . get_key($data['quote_id']);

        $to = $this->admin_email;
        $subject = 'Quote #COI-QR-' . get_key($data['quote_id']) . ' has been reviewed by: ' . $admin_user->fullname;
        $content = $this->ci->load->view('email/admin_quote_reviewed', $data, TRUE);

        return $this->send($to, $subject, $content);
    }

    public function user_mail_quote_reviewed($data) {
//        if (isset($this->settings[NOTIFY_QUOTE_REVIEWED]) && $this->settings[NOTIFY_QUOTE_REVIEWED] == '0') {
//            return false;
//        }

        $user = $this->ci->portal_lib->get_user_profile_by_quote_id($data['quote_id']);
        $to = $user->email;

        $data['user_info'] = $user;
        $data['quote_key'] = '#COI-QR-' . get_key($data['quote_id']);
        $data['order_details'] = $this->ci->portal_lib->get_quote_by_id($data['quote_id']);


        $subject = 'Quote ' . get_key($data['quote_key']) . ' has been reviewed';
        $content = $this->ci->load->view('email/user_quote_reviewed', $data, TRUE);

        return $this->send($to, $subject, $content);
    }

    /* Quote Accepted */

    public function admin_mail_quote_accepted($data) {

        $data['user_info'] = $this->ci->portal_lib->get_user_profile_by_quote_id($data['quote_id']);
        $data['admin_info'] = $this->ci->user_profile;
        $data['quote_key'] = '#COI-QR-' . get_key($data['quote_id']);
        $data['quote_info'] = $this->ci->portal_lib->get_quote_by_id($data['quote_id']);

        $to = $this->admin_email;
        $subject = 'Quotation Accepted By: ' . $data['user_info']->fullname . ' ' . $data['quote_key'];
        $content = $this->ci->load->view('email/admin_quote_accepted', $data, TRUE);

        return $this->send($to, $subject, $content);
    }

    public function user_mail_quote_accepted($data) {
        $data['user_info'] = $this->ci->user_profile;
        $data['quote_key'] = '#COI-QR-' . get_key($data['quote_id']);
        $data['quote_info'] = $this->ci->portal_lib->get_quote_by_id($data['quote_id']);

        $user = $this->ci->user_profile;
        $to = $user->email;
        $subject = 'You have accepted Quote ' . $data['quote_key'];
        $content = $this->ci->load->view('email/user_quote_accepted', $data, TRUE);

        return $this->send($to, $subject, $content);
    }

    /* Quote Rejected */

    public function admin_mail_quote_rejected($data) {
        $user = $this->ci->portal_lib->get_user_profile_by_quote_id($data['quote_id']);

        $data['quote_key'] = '#COI-QR-' . get_key($data['quote_id']);
        $data['quote_info'] = $this->ci->portal_lib->get_quote_by_id($data['quote_id']);
        $data['admin_info'] = $this->ci->user_profile;
        $data['user_info'] = $user;

        $to = $this->admin_email;
        $subject = 'Quotation Rejected By: ' . $user->fullname . ' ' . $data['quote_info'];
        $content = $this->ci->load->view('email/admin_quote_rejected', $data, TRUE);

        return $this->send($to, $subject, $content);
    }

    public function user_mail_quote_rejected($data) {
        $user = $this->ci->user_profile;
        $data['quote_key'] = '#COI-QR-' . get_key($data['quote_id']);
        $data['quote_info'] = $this->ci->portal_lib->get_quote_by_id($data['quote_id']);
        $data['user_info'] = $user;


        $to = $user->email;
        $subject = 'You have rejected Quote ' . get_key($data['quote_id']);
        $content = $this->ci->load->view('email/user_quote_rejected', $data, TRUE);

        return $this->send($to, $subject, $content);
    }

    /* Download Ready */

    public function admin_mail_order_ready($data = array()) {
        $order_id = $data['order_id'];
        $admin = $this->ci->user_profile;
        $data['admmin_info'] = $admin;
        $data['user_info'] = $this->ci->portal_lib->get_user_profile_by_order_id($data['order_id']);
        $data['order_key'] = '#COI-' . get_key($data['order_id']);
        $data['download_url'] = get_short_url(site_url('/download/') . '?key=' . base64_encode($data['order_id']));

        $to = $this->admin_email;
        $subject = 'Order ' . $data['order_key'] . ' deliverable reported by ' . $admin->fullname;
        $content = $this->ci->load->view('email/admin_order_ready', $data, TRUE);

        return $this->send($to, $subject, $content);
    }

    public function owner_mail_order_ready($data = array()) {
        $order_id = $data['order_id'];

        $admin_info = $this->ci->user_profile;
        $user_info = $this->ci->portal_lib->get_user_profile_by_order_id($data['order_id']);
        $owner_info = $this->ci->portal_lib->get_owner_profile_by_order_id($data['order_id']);

        $data['admin_info'] = $admin_info;
        $data['user_info'] = $user_info;
        $data['owner_info'] = $ownerinfo;
        $data['order_key'] = '#COI-' . get_key($data['order_id']);
        $data['download_url'] = get_short_url(site_url('/download/') . '?key=' . base64_encode($data['order_id']));

        if ($user_info->user_id == $owner_info->user_id) {
            // User and owner is same!
            return;
        }

        $data['order_key'] = '#COI-' . get_key($data['order_id']);

        $to = $owner_info->email;
        $subject = 'Order ' . $data['order_key'] . ' is ready for download';
        $content = $this->ci->load->view('email/owner_order_ready', $data, TRUE);

        return $this->send($to, $subject, $content);
    }

    public function user_mail_order_ready($data = array()) {
        $order_id = $data['order_id'];
        $admin_info = $this->ci->user_profile;
        $user_info = $this->ci->portal_lib->get_user_profile_by_order_id($data['order_id']);

        $data['user_info'] = $user_info;
        $data['admin_info'] = $admin_info;
        $data['order_key'] = '#COI-' . get_key($data['order_id']);
        $data['download_url'] = get_short_url(site_url('/download/') . '?key=' . base64_encode($data['order_id']));

        $to = $user_info->email;
        $subject = 'Order ' . $data['order_key'] . ' is ready for download';
        $content = $this->ci->load->view('email/user_order_ready', $data, TRUE);

        return $this->send($to, $subject, $content);
    }

    /* Order Downloaded */

    public function admin_mail_order_downloaded($data = array()) {
        $order_id = $data['order_id'];

        if ($this->ci->tank_auth->is_logged_in()) {
            $user_id = $this->ci->session->userdata('user_id');
            $user_info = $this->ci->mod_portal->get_user($user_id);
            $downloaded_by = $user_info->fullname;
        } else {
            $downloaded_by = 'Guest (Not logged in user)';
        }

        $manager = $this->ci->portal_lib->get_user_profile_by_order_id($data['order_id']);
        if ($manager) {
            $submitted_by = $manager->fullname;
        } else {
            $this->send_report('admin_mail_order_downloaded -> $manager data is empty');
            $submitted_by = 'Unknown';
        }

        $data['order_key'] = '#COI-' . get_key($data['order_id']);
        $data['order_by'] = $submitted_by;
        $data['downloaded_by'] = $downloaded_by;
        $data['download_url'] = get_short_url(site_url('/download/') . '?key=' . base64_encode($data['order_id']));

        $to = $this->admin_email;
        $subject = 'Order ' . $data['order_key'] . ' has been downloaded';
        $content = $this->ci->load->view('email/admin_order_downloaded', $data, TRUE);

        return $this->send($to, $subject, $content);
    }

    /* Recieve Message */

    public function admin_mail_receive_message($data = array()) {
        $user_info = $this->ci->user_profile;
        $data['user_info'] = $user_info;
        $data['user_name'] = $user_info->fullname;

        $to = $this->admin_email;
        $subject = $data['msg_subject'];
        $content = $this->ci->load->view('email/message', $data, TRUE);

        return $this->send($to, $subject, $content);
    }

    public function user_mail_receive_message($data = array()) {
        if (isset($this->settings[NOTIFY_NEW_MESSAGE]) && $this->settings[NOTIFY_NEW_MESSAGE] == '1') {
            return;
        }
        $user_info = $this->ci->mod_portal->get_user($data['msg_receiver_id']);
        $data['user_info'] = $user_info;
        $data['user_name'] = 'COI Team';

        $to = $user_info->email;
        $subject = $data['msg_subject'];
        $content = $this->ci->load->view('email/message', $data, TRUE);

        return $this->send($to, $subject, $content);
    }

    /* Others Admin Email */

    public function admin_mail_reply_message($data) {
        
    }

    public function admin_mail_new_message($data) {
        
    }

    public function admin_mail_new_signup($data) {

        $order_id = $data['order_id'];
        $service_id = $data['service_id'];

        $to = $this->admin_email;
        $subject = 'New Sign Up # ' . $user_info->fullname;
        $content = $this->ci->load->view('email/admin_new_signup', $data, TRUE);

        return $this->send($to, $subject, $content);
    }

    public function admin_mail_ipn_notifications($data) {
        
    }

    // ============== Email for Users =============
    /**
     * Place new order
     */
    public function user_mail_quote_2_order($data = array()) {
        
    }

    public function user_mail_reply_message($data = array()) {
        
    }

    public function user_mail_payment_order($user_id, $order_id, $payment_info) {
        $this->ci->email->from('hello@cutoutimage.com', 'Cut Out Image');
        $this->ci->email->to('atik.imaging@gmail.com');
        $this->ci->email->subject('Test email');

        $message = $this->ci->load->view('email/test', '', TRUE);
        $this->ci->email->message($message);
        return $this->ci->email->send();
    }

    public function user_mail_payment_invoice($data = array()) {

        $order_id = $data['order_id'];
        $service_id = $data['service_id'];

        $user = $this->ci->user_profile;
        $data['user_info'] = $user;

        $to = $user->email;
        $subject = 'Your Invoice #' . $order_id;
        $content = $this->ci->load->view('email/user_order_invoice', $data, TRUE);

        return $this->send($to, $subject, $content);
    }

    public function user_mail_payment_confirmation($data = array()) {

        $order_id = $data['order_id'];
        $service_id = $data['service_id'];

        $user = $this->ci->user_profile;
        $data['user_info'] = $user;

        $to = $user->email;
        $subject = 'Payment Confirmation #' . $order_id;
        $content = $this->ci->load->view('email/user_payment_info', $data, TRUE);

        return $this->send($to, $subject, $content);
    }

    public function user_mail_due_notice($data = array()) {
        $order_id = $data['order_id'];
        $service_id = $data['service_id'];

        $user = $this->ci->user_profile;
        $data['user_info'] = $user;

        $to = $user->email;
        $subject = 'Invoice Payment Reminder #' . $order_id;
        $content = $this->ci->load->view('email/user_payment_reminder', $data, TRUE);

        return $this->send($to, $subject, $content);
    }

    public function user_mail_update_profile($user_id) {
        $user = $this->ci->user_profile;
        $data['user_info'] = $user;
        $to = $user->email;
        $subject = 'Security notification: Profile Changes';
        $content = $this->ci->load->view('email/user_profile_changed', $data, TRUE);

        return $this->send($to, $subject, $content);
    }

    // ============== External Email =============
    public function invite_user($data) {
        $user = $this->ci->user_profile;
        $data['user_info'] = $user;

        $data['invite_url'] = get_short_url(site_url('/auth/invite') . '?key=' . $data['invite_key']);

        $to = $data['invite_to_email'];
        $subject = 'Invitation to join in ' . $data['company_name'] . ' on CUTOUTIMAGE.COM';
        $content = $this->ci->load->view('email/user_invitation', $data, TRUE);

        return $this->send($to, $subject, $content);
    }

    public function invitation_accepted($data) {
        $user = $this->ci->user_profile;
        $owner_info = $this->ci->mod_portal->get_user($data['owner_id']);

        $data['user_info'] = $user;
        $data['owner_info'] = $owner_info;

        $to = $owner_info->email;
        $subject = $user->fullname . ' accepted your invitation on CUTOUTIMAGE.COM';

        $content = $this->ci->load->view('email/owner_invitation_accepted', $data, TRUE);

        return $this->send($to, $subject, $content);
    }

    public function debug_email($data) {
        $this->ci->email->from('hello@cutoutimage.com', 'Cut Out Image');
        $this->ci->email->to('atik.imaging@gmail.com');
        $this->ci->email->subject('Debugging Email');

        $message = print_r($data, TRUE);
        $this->ci->email->message($message);
        return $this->ci->email->send();
    }

}
