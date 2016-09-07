<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Portal extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $title = 'Welcome To Cut Out Image - Client Area';
        $data['messages'] = $this->portal_lib->load_messages(3);
        // Recent Orders, Completed orders, General Query

        $recent_orders = $this->portal_lib->get_order($this->user_id, $this->company->id, 1, 5);
        $data['messageTopics'] = array('General Query', 'Billing Query', 'Recent Orders' => $recent_orders);

        $page_content = $this->load->view('page_dashboard', $data, TRUE);
        $this->display($title, $page_content);
    }

    function test_create() {
        $data = array();
        $title = 'Place New Order';

        $has_billing = $this->portal_lib->check_billing();
        if (!$has_billing) {
            $data['page_title'] = '';
            $data['msg'] = 'Please fill up your billing information (No Credit Card Required) to create "An Order". <a href="' . site_url('/profile#edit-profile') . '">Click here</a> to continue.';
            $page_content = $this->load->view('page_limit_access', $data, TRUE);
        } elseif (!has_permission('create_order', $this->user_id, $this->company->id)) {
            $data['page_title'] = '';
            $data['msg'] = 'You don\'t have access to "Create Order" for "<strong>' . $this->company->name . '</strong>" !';
            $page_content = $this->load->view('page_limit_access', $data, TRUE);
        } else {
            $data['order_id'] = $this->portal_lib->init_order();
            $page_content = $this->load->view('page_placeorder_test', $data, TRUE);
        }

        $this->display($title, $page_content);
    }

    /**
     * update_aws function
     *
     * By providing foldername of bucket it will copy all content
     * and paste with new name and delete previous one
     *
     * @param string Folder name
     *
     * @return mixed
     * */
    function update_aws($folder = 'F-UID-3-TI-1466591252756OID-398', $orderId = null) {
        if (!$orderId) {
            return false;
        }

        // Load library
        $this->load->library('s3');

        // Define credientials
        if (!defined('awsAccessKey'))
            define('awsAccessKey', 'AKIAIGZJPUUTGWEPZBRQ');
        if (!defined('awsSecretKey'))
            define('awsSecretKey', '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');

        //instantiate the class
        $s3 = new S3(awsAccessKey, awsSecretKey);

        $sourceBucket = 'www-cutoutimage-com';
        $sourceKeyname = $folder;
        $targetBucket = 'www-cutoutimage-com';

        $contents = $s3->getBucket($sourceBucket, $sourceKeyname);
        if (!empty($contents)) {
            foreach ($contents as $eachItem) {
                $name = explode('/', $eachItem['name']);
                $targetKeyname = $folder . '-OID-' . $orderId . '/' . $name[1];
                $s3->copyObject($sourceBucket, $eachItem['name'], $targetBucket, $targetKeyname);
                $s3->deleteObject($sourceBucket, $eachItem['name']);
            }
        }
        var_dump('Done');
        die();
    }

    function create() {
        // $this->output->enable_profiler(TRUE);

        $data = array();
        $title = 'Place New Order';

        $has_billing = $this->portal_lib->check_billing();
        if (!$has_billing) {
            $data['page_title'] = '';
            $data['msg'] = 'Please fill up your billing information (No Credit Card Required) to create "An Order". <a href="' . site_url('/profile#edit-profile') . '">Click here</a> to continue.';
            $page_content = $this->load->view('page_limit_access', $data, TRUE);
        } elseif (!has_permission('create_order', $this->user_id, $this->company->id)) {
            $data['page_title'] = '';
            $data['msg'] = 'You don\'t have access to create "Create Order" for "<strong>' . $this->company->name . '</strong>" !';
            $page_content = $this->load->view('page_limit_access', $data, TRUE);
        } else {
            $data['s3FormDetails'] = getS3Details('www-cutoutimage-com', 'eu-west-1');
            $data['order_id'] = $this->portal_lib->init_order();
            $page_content = $this->load->view('page_placeorder_new', $data, TRUE);
        }

        $this->display($title, $page_content);
    }

    function place_order() {
        // $this->output->enable_profiler(TRUE);

        $data = array();
        $title = 'Place New Order';

        $has_billing = $this->portal_lib->check_billing();
        if (!$has_billing) {
            $data['page_title'] = '';
            $data['msg'] = 'Please fill up your billing information (No Credit Card Required) to create "An Order". <a href="' . site_url('/profile#edit-profile') . '">Click here</a> to continue.';
            $page_content = $this->load->view('page_limit_access', $data, TRUE);
        } elseif (!has_permission('create_order', $this->user_id, $this->company->id)) {
            $data['page_title'] = '';
            $data['msg'] = 'You don\'t have access to create "Create Order" for "<strong>' . $this->company->name . '</strong>" !';
            $page_content = $this->load->view('page_limit_access', $data, TRUE);
        } else {
            $data['order_id'] = $this->portal_lib->init_order();
            $page_content = $this->load->view('page_placeorder', $data, TRUE);
        }

        $this->display($title, $page_content);
    }

    /**
     * @param string quote_id
     */
    function place_order_from_quote($quote_id = NULL) {
        $data = array();
        $title = 'Place New Order From Quote (Flat Rate)';
        $quote_info = $this->mod_portal->get_quote_by_id($this->user_id, $this->company->id, $quote_id);
        if ($quote_info) {
            $data['order_id'] = $this->portal_lib->init_order();
            $data['quote_data'] = $quote_info;
            $page_content = $this->load->view('page_quote2order', $data, TRUE);
            $this->display($title, $page_content);
        } else {
            redirect(site_url('/'), 'refresh');
        }
    }

    function orders() {
        $data = array();
        $title = 'Orders - Cut Out Image';
        $error = $this->session->flashdata('error');
        if ($error && !empty($error)) {
            $data['errors'][] = $error;
        }
//                echo "<pre>";
//                print_r($data);
//                exit();
        $page_content = $this->load->view('page_orders', $data, TRUE);
        $this->display($title, $page_content);
    }

    function get_quote() {
        $title = 'Quotations - Cut Out Image';
        $page_content = 'get_quote';

        $this->display($title, $page_content);
    }

    function quotations() {
        $title = 'Quotations - Cut Out Image';
        $data['is_owner'] = ($this->user_id == $this->company->user_id) ? true : false;
        $data['permission'] = $this->portal_lib->get_company_permission($this->user_id, $this->company->id);
        $page_content = $this->load->view('page_quotations', $data, TRUE);

        $this->display($title, $page_content);
    }

    function invoices($inv_id = null) {
        if (!has_permission('billing', $this->user_id, $this->company->id)) {
            $data['page_title'] = '';
            $data['msg'] = 'You don\'t have access to create "Create Order" for "<strong>' . $this->company->name . '</strong>" !';

            $page_content = $this->load->view('page_limit_access', $data, TRUE);
            $title = 'Invoices - Cut Out Image';
            $this->display($title, $page_content);
        } else {
            if (strlen($inv_id) > 8) {
                $title = 'Invoice';
                $raw_id = substr($inv_id, 8);

                $order = $this->mod_portal->get_order_by_id("COI-$raw_id");
                $data['inv_id'] = $inv_id;
                $data['invoice_info'] = $order;
                $data['company'] = $this->mod_portal->get_company_by_id($this->company->id);
                $data['services'] = $this->mod_portal->get_services(array('service_id' => $order->service_id));

                if ($order->company_id != $data['company']->id) {
                    redirect(site_url('invoices'));
                    exit();
                }
                $this->load->view('tpl_invoice', $data);
            } else {
                $title = 'Invoices';
                $page_content = $this->load->view('page_invoices', '', TRUE);
                $this->display($title, $page_content);
            }
        }
    }

    function billing() {
        $title = 'Billing Section - Cut Out Image';
        $page_content = 'billing';

        $this->display($title, $page_content);
    }

    function profile() {
        $title = 'My Account - Cut Out Image';

        $data['profile'] = $this->user_profile;
        $data['company'] = $this->portal_lib->get_company_info($this->user_id);
        $data['settings'] = $this->portal_lib->get_settings($this->user_id);
        $data['invited_members'] = $this->portal_lib->get_invited_users_by_company_id($this->company->id);
        $data['company_members'] = $this->portal_lib->get_company_members_by_userid($this->user_id);
//                echo "<pre>";
//                print_r($data);
//                echo "</pre>";
//                exit();
        $page_content = $this->load->view('page_client_profile', $data, TRUE);
        // $page_content = $this->load->view('page_profile', $data, TRUE);

        $this->display($title, $page_content);
    }

    function account_manager() {
        $has_billing = $this->portal_lib->check_billing();
        if (!$has_billing) {
            $data['page_title'] = '';
            $data['msg'] = 'Please fill up your billing information to invite user. <a href="' . site_url('/profile#edit-profile') . '">Click here</a> to continue.';
            $page_content = $this->load->view('page_limit_access', $data, TRUE);
        } else {

            $data['invited_members'] = $this->portal_lib->get_invited_users_by_company_id($this->company->id);
            $data['company_members'] = $this->portal_lib->get_company_members_by_userid($this->user_id);

            $page_content = $this->load->view('page_users', $data, TRUE);
        }

        $title = 'Account Managers - Cut Out Image';
        $this->display($title, $page_content);
    }

    function support() {
        $data = array();

        $this->form_validation->set_rules('fullname', 'Fullname', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required|xss_clean');
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required|xss_clean');
        $this->form_validation->set_rules('department', 'Department', 'trim|required|xss_clean');
        $this->form_validation->set_rules('priority', 'Priority', 'trim|required|xss_clean');
        $this->form_validation->set_rules('message', 'Message', 'trim|require|xss_clean');

        $post_nonce = $this->input->post('nonce');

        $nonce = verify_nonce($post_nonce, 'contact_form');

        if ($this->form_validation->run() && $nonce) {
            $fullname = $this->input->post('fullname');
            $email = $this->input->post('email');
            $subject = $this->input->post('subject');
            $department = $this->input->post('department');
            $priority = $this->input->post('priority');
            $message = $this->input->post('message');

            switch ($priority) {
                case 1:
                    # code...
                    $priority_label = 'Emergency';
                    break;
                case 2:
                    # code...
                    $priority_label = 'High';
                    break;
                case 3:
                    # code...
                    $priority_label = 'Normal';
                    break;

                default:
                    $priority_label = 'Normal';
                    break;
            }

            $message_body = '';
            $message_body .= "Name: {$fullname}\n";
            $message_body .= "Email: {$email}\n";
            $message_body .= "Department: " . ucfirst($department) . "\n";
            $message_body .= "Priority: {$priority_label}\n";
            $message_body .= "\n\nMessage body: {$message}\n";

            $email_support = $this->config->item('email_support', 'tank_auth');
            $email_sales = $this->config->item('email_sales', 'tank_auth');
            $email_order = $this->config->item('email_order', 'tank_auth');
            $email_payment = $this->config->item('email_payment', 'tank_auth');
            $email_billing = $this->config->item('email_billing', 'tank_auth');
            $email_technical = $this->config->item('email_technical', 'tank_auth');

            if ($department == 'sales') {
                $recipients[] = $email_sales;
            }
            if ($department == 'billing') {
                $recipients[] = $email_billing;
            }
            if ($department == 'order') {
                $recipients[] = $email_order;
            }
            if ($department == 'payment') {
                $recipients[] = $email_payment;
            }
            if ($department == 'technical') {
                $recipients[] = $email_technical;
            } else {
                $recipients[] = $email_support;
            }

            $this->load->library('email');

            /* Send email */
            $this->email->from($email, $fullname);
            $recipients[] = $this->config->item('webmaster_email', 'tank_auth');

            $this->email->to($recipients);
            $this->email->subject(strtoupper($department) . ' :: ' . $subject);
            $this->email->message(nl2br($message_body));
            $this->email->send();

            //echo $this->email->print_debugger();
            $data['sent'] = true;
        }

        $title = 'Support Panel - Cut Out Image';
        $page_content = $this->load->view('page_support', $data, TRUE);

        $this->display($title, $page_content);
    }

    function payment($order_id = '') {
        if (empty($order_id)) {
            $order_id = $this->input->post('order_id');
        }
        $order_info = $this->mod_portal->get_order_by_id($order_id);

        if ($order_info->order_quantity < 1 || $order_info->total_value <= 0) {
            $this->session->set_flashdata('error', lang('msg_9'));
            redirect('orders', 'refresh');
        }


        if ($order_info) {

            $this->load->library('merchant');
            $this->merchant->load('paypal_express');

            //$settings = $this->merchant->default_settings();

            if ($this->config->item('test_payment') == 1) {
                $settings = array(
                    'username' => 'mrchnt_1320057709_biz_api1.gmail.com',
                    'password' => '1320057749',
                    'signature' => 'A9VQS-DhTo7HcBSk6lKpHj4Wx3w6ALaKoN2zkdDgM0Iy44hmHHOoJQt.',
                    'test_mode' => true);
            } else {
                $settings = array(
                    'username' => 'accounts_api1.cutoutimage.com',
                    'password' => 'T96LT3NKV55EEKMV',
                    'signature' => 'Am.S2ev.K7pCGgTMj4il2ZqLbAPpAUNeumzB-zVxYFpdLNj0x6aHVf2N',
                    'test_mode' => false);
            }

            $this->merchant->initialize($settings);


            $params = array(
                'amount' => $order_info->total_value,
                'description' => $order_info->order_title,
                'currency' => 'USD',
                'return_url' => site_url('/payment/' . $order_id),
                'cancel_url' => site_url('/payment_cancel')
            );

            if (!isset($_GET['token'])) {
                $response = $this->merchant->purchase($params);
                if ($response->status() == 'failed') {
                    $this->session->set_flashdata('error', lang('msg_10'));
                    redirect('orders', 'refresh');
                }
            } else {
                $response = $this->merchant->purchase_return($params);

                if ($response->success()) {
                    // mark order as complete
                    $gateway_reference = $response->reference();

                    $values['payment_by'] = $this->user_id;
                    $values['order_id'] = $order_id;
                    $values['payment_method'] = 'paypal';
                    $values['payment_amount'] = $order_info->total_value;
                    $values['payment_status'] = 1;
                    $values['transaction_id'] = $gateway_reference;
                    $values['payment_date'] = date("Y-m-d H:i:s", time());
                    $values['payment_info'] = '';

                    $this->mod_portal->insert_payment_info($values);
                    $this->mod_portal->update_order_payment_status($order_id, 1);

                    $title = 'Payment Success';
                    $page_content = $this->load->view('page_payment_thankyou', $values, TRUE);
                    $this->display($title, $page_content);
                } else {
                    $message = $response->message();
                    echo('Error Processing Payment: ' . $message);
                    exit;
                }
            }
        } else {
            echo "Invalid ID!";
            exit();
        }
    }

    function paypal_payment($order_id = '') {
        $data['order_id'] = $order_id;
        $data['title'] = 'Processing Payment';
        $data['header'] = $this->load->view('tpl_header', $data, TRUE);
        $data['content'] = $this->load->view('page_payment_redirecting', $data, TRUE);
        $data['footer'] = $this->load->view('tpl_footer', $data, TRUE);
        $data['p_type'] = 'paypal';

        $this->load->view('tpl_external', $data);
    }

    function Checkout2_payment($order_id = '', $type = 'Checkout2_payment') {

        $data['order_id'] = $order_id;
        $data['title'] = 'Processing Payment';
        $data['header'] = $this->load->view('tpl_header', $data, TRUE);
        $data['content'] = $this->load->view('page_payment_redirecting', $data, TRUE);
        $data['footer'] = $this->load->view('tpl_footer', $data, TRUE);
        $data['p_type'] = '2Checkout';

        $this->load->view('tpl_external', $data);
    }

    function payza_payment($order_id = '') {
        $this->load->library('payza_lib');

        $order_info = $this->mod_portal->get_order_by_id($order_id);

        if ($order_info) {
            // var_dump($order_info);
            if ($order_info->total_value > 0) {

                $values['payment_by'] = $this->user_id;
                $values['order_id'] = $order_id;
                $values['payment_method'] = 'payza';
                $values['payment_amount'] = $order_info->total_value;
                $values['payment_status'] = 0;
                $values['transaction_id'] = null;
                $values['payment_date'] = null;
                $values['payment_info'] = null;

                $this->mod_portal->insert_payment_info($values);

                $this->payza_lib->add_field('ap_returnurl', site_url('/payza_return') . "?action=success&order_id=" . $order_id);
                $this->payza_lib->add_field('ap_cancelurl', site_url('/payza_return') . "?action=cancel");
                $this->payza_lib->add_field('ap_totalamount', $order_info->total_value);
                $this->payza_lib->add_field('ap_itemcode', $order_info->order_id);
                $this->payza_lib->add_field('ap_itemname', $order_info->order_title);
                $this->payza_lib->add_field('ap_description', $order_info->order_desc);
                $this->payza_lib->add_field('ap_amount', $order_info->total_value);
                $this->payza_lib->add_field('ap_netamount', $order_info->total_value); //This value can be replaced with posted values as you wished after discount total 
                $this->payza_lib->add_field('ap_quantity', "1");
                $this->payza_lib->add_field('apc_1', $this->user_id);

                $data['message'] = $this->payza_lib->submit_toPayment_post(); // submit the fields to payza

                $data['title'] = 'Processing Payment';
                $data['header'] = $this->load->view('tpl_header', $data, TRUE);
                $data['content'] = $this->load->view('page_payment_redirecting', $data, TRUE);
                $data['footer'] = $this->load->view('tpl_footer', $data, TRUE);

                $this->load->view('tpl_external', $data);
            } else {
                $this->session->set_flashdata('message', lang('msg_7'));
                redirect(site_url('/auth/'));
            }
        } else {
            echo "Invalid ID!";
        }
    }

    function payza_ipn_validate() {
        $this->load->library('payza_lib');

        $token = $this->input->post('token');
        if ($token) {
            $result = $this->payza_lib->ipnv2_handler($token);
        } else {
            $result = $this->payza_lib->ipnv1_handler($_POST);
        }

        if ($result) {
            $order_id = $result['order_id'];
            $values['payment_amount'] = $result['totalAmountReceived'];
            $values['payment_trx_fee'] = $result['payment_trx_fee'];
            $values['payment_status'] = 1;
            $values['transaction_id	'] = $result['transactionReferenceNumber'];
            $values['payment_date'] = date("Y-m-d H:i:s", strtotime($result['transactionDate']));
            $values['payment_info'] = json_encode($result);

            $this->mod_portal->update_payment_info($order_id, $values);

            $this->load->library('email_lib');
            $this->email_lib->admin_mail_ipn_notifications($result);
        }
    }

    function payza_return() {
        $this->load->library('payza_lib');
        $action = $this->input->get('action');
        $order_id = $this->input->get('order_id');

        if ($action == 'success') {
            if ($order_id) {
                $payment_info = $this->mod_portal->get_payment_info_by_oderid($order_id);
                if (!$payment_info) {
                    die(lang('msg_6'));
                }

                $values['payment_by'] = $this->user_id;
                $values['order_id'] = $payment_info->order_id;
                $values['payment_method'] = 'payza';
                $values['payment_amount'] = $payment_info->payment_amount;
                $values['payment_date'] = date("Y-m-d H:i:s", time());

                $title = 'Payment Success';
                $page_content = $this->load->view('page_payment_thankyou', $values, TRUE);
                $this->display($title, $page_content);
            } else {
                echo "Payment Success!";
            }
        } else {
            redirect(site_url('/'), 'location');
        }
    }

    // Moved to "Page" controller
    function download_old() {
        $key = $this->input->get('key');
        if ($key) {
            $order_id = base64_decode($key);
            if (base64_encode($order_id) === $key) {

                $file = FCPATH . "downloads/" . $order_id . ".zip";

                if (file_exists($file)) {
                    $this->mod_portal->update_download_counter($order_id);

                    $this->load->library('email_lib');
                    $this->email_lib->admin_mail_order_downloaded(array('order_id' => $order_id));

                    header('Content-Description: File Transfer');
                    header('Content-Type: application/octet-stream');
                    header('Content-Disposition: attachment; filename=' . basename($file));
                    header('Content-Transfer-Encoding: binary');
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate');
                    header('Pragma: public');
                    header('Content-Length: ' . filesize($file));
                    ob_clean();
                    flush();
                    readfile($file);
                    exit;
                }
            }
        }
        show_404();
        //$this->load->view('download_404');
    }

    function payment_cancel() {
        redirect(site_url('/'), 'location');
    }

    function affiliate() {

        $title = 'Affiliate Program';
        $page_content = $this->load->view('page_affiliate_program', '', TRUE);

        $this->display($title, $page_content);
    }

    function report_bug() {
        $data = array();

        $this->form_validation->set_rules('problem_type', '&nbsp;', 'trim|required|xss_clean');
        $this->form_validation->set_rules('where_is_problem', '&nbsp;', 'trim|xss_clean');
        $this->form_validation->set_rules('problem_summery', '&nbsp;', 'trim|xss_clean');
        $this->form_validation->set_rules('bug_url', '&nbsp;', 'trim|prep_url|xss_clean');
        $this->form_validation->set_rules('email', '&nbsp;', 'trim|valid_email|required|xss_clean');
        $this->form_validation->set_rules('error_message', '&nbsp;', 'trim|xss_clean');

        $post_nonce = $this->input->post('nonce');

        $nonce = verify_nonce($post_nonce, 'bugs');

        if ($this->form_validation->run() && $nonce) {
            $email = $this->input->post('email');
            $email_sales = $this->config->item('email_sales', 'tank_auth');
            $message = '<pre>' . print_r($_POST, TRUE) . '</pre>';

            $this->load->library('email');

            $to = $this->config->item('webmaster_email', 'tank_auth');

            $this->email->from('hello@cutoutimage.com', 'Cut Out Image');
            $this->email->to($to);
            $this->email->subject('COI Bug Report by ' . $email);
            $this->email->message($message);
            $this->email->send();

            $data['sent'] = true;
            // echo $this->email->print_debugger();
        }

        $title = 'Bug Reporting - Cut Out Image';
        $page_content = $this->load->view('page_bug_report', $data, TRUE);

        $this->display($title, $page_content);
    }

}
