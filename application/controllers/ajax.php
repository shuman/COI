<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ajax extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->output->enable_profiler(FALSE);

        if (ENVIRONMENT == 'production') {
            if (!$this->input->is_ajax_request()) {
                if (isset($_SERVER['HTTP_REFERER'])) {
                    redirect($_SERVER['HTTP_REFERER'], 'refresh');
                    die();
                }
                exit('No direct script access allowed!');
            }
        }
    }

    function index() {
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');
        echo json_encode(array('status' => 'KO'));
    }

    function upload_avatar() {
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');

        $output['status'] = 'KO';

        if (!$this->tank_auth->is_logged_in()) {
            echo json_encode($output);
            exit();
        }

        $user_id = $this->user_id;

        if ($user_id) {
            //start of file upload code
            $config['upload_path'] = FCPATH . 'assets/avatar/';
            if (!is_dir($config['upload_path'])) {
                @mkdir($config['upload_path']);
            }

            $config['allowed_types'] = 'gif|jpg|png';
            $this->load->library('upload', $config);


            $field_name = "file";
            $upload_data = $this->upload->data();

            $upload = $this->upload->do_multi_upload($field_name);
            if (!$upload) {
                $error = array('error' => $this->upload->display_errors());
                $output['msg'] = $error;
                $output['status'] = 'KO';
            } else {
                $res = $this->upload->data();
                $output['filename'] = $res['file_name'];
                $output['status'] = 'OK';
                $this->users->update_profile($user_id, array('avatar' => $res['file_name']));
            }
        } else {
            $output['msg'] = 'Session expired!';
        }
        echo json_encode($output);
    }

    function get_notifications() {
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');
        echo json_encode($this->notifications);
    }

    /*
     * Place new order form #orderForm
     */

    function place_order() {
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');

        $this->form_validation->set_rules('o_service', 'Service Type', 'required');
        $service_type = $something = $this->input->post('o_service');

        switch ($service_type) {
            case 'cutout':
                $this->form_validation->set_rules('service_option_cutout', 'Service', 'required');
                break;
            case 'masking':
                $this->form_validation->set_rules('service_option_mask', 'Service', 'required');
                break;
            case 'retouch':
                $this->form_validation->set_rules('service_option_retouch', 'Service', 'required');
                break;
        }

        $this->form_validation->set_rules('tat', 'Turnaround Times', 'required');
        $this->form_validation->set_rules('payment_option', 'Payment Form', 'required');
        $this->form_validation->set_rules('job_title', 'Order Title', 'required');

        if ($this->form_validation->run()) {
            //Insert Job
            $res = $this->portal_lib->place_new_order($_POST);
            if (!$res) {
                $output['status'] = 'KO';
            } else {
                $output['job_title'] = $this->input->post('job_title');
                $output['job_desc'] = $this->input->post('job_desc');
                $output['payment_method'] = strtolower($this->input->post('payment_method'));
                $output['payment_option'] = str_replace(' ', '', strtolower($this->input->post('payment_option')));
                $output['service_id'] = $res['service_id'];
                $output['quote_id'] = isset($res['quote_id']) ? $res['quote_id'] : '';
                $output['order_id'] = isset($res['order_id']) ? $res['order_id'] : '';
                $output['job_type'] = $res['job_type'];
                $output['status'] = 'OK';

                //Send email
                $this->load->library('email_lib');
                if ($res['job_type'] == 'quote') {
                    $output['quote_details'] = $this->mod_portal->quote_details($output['quote_id'], $this->company->id);
                    $this->email_lib->admin_mail_quote_submit($output);
                    $check_order_quote = $this->$this->mod_portal->get_settings_notifications($this->user_id, NOTIFY_QUOTE_CONFIRM);
                    if ($check_order_quote) {
                        $this->email_lib->user_mail_quote_submit($output);
                    }

                    // If user is not owner of this company send email to owner.
                    if ($this->company->id != $this->companies[0]->id) {
                        $this->email_lib->owner_mail_quote_submit($output);
                    }
                    //Activity Log
                    $this->mod_portal->audit_log('New Quote Submitted');
                } else {
                    $output['order_details'] = $this->mod_portal->order_details($output['order_id'], $this->company->id);

                    $this->email_lib->admin_mail_order_submit($output);
                    $check_order_submit = $this->mod_portal->get_settings_notifications($this->user_id, NOTIFY_ORDER_CONFIRM);
                    if ($check_order_submit) {
                        $this->email_lib->user_mail_order_submit($output);
                    }

                    // If user is not owner of this company send email to owner.
                    if ($this->user_id != $this->company->user_id) {
                        $this->email_lib->owner_mail_quote_submit($output);
                    }
                    //Activity Log
                    $this->mod_portal->audit_log('New Order Submitted');
                }
            }
        } else {
            $output['status'] = 'KO';
            $output['msg'] = 'Validation Failed!';
            $output['error'] = validation_errors();
        }

        echo json_encode($output);
    }

    /*
     * Place new quote form #quoteForm
     */

    function place_quote() {
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');

        $this->form_validation->set_rules('job_title', 'Quote Title', 'required');
        $this->form_validation->set_rules('job_desc', 'Detailed Requirements', 'required');

        if ($this->form_validation->run()) {
            $res = $this->portal_lib->place_new_quote($_POST);
            if (!$res) {
                $output['status'] = 'KO';
            } else {
                $output['job_title'] = $res['job_title'];
                $output['job_desc'] = $res['job_desc'];
                $output['service_id'] = $res['service_id'];
                $output['quote_id'] = isset($res['quote_id']) ? $res['quote_id'] : '';
                $output['order_id'] = '';
                $output['job_type'] = $res['job_type'];
                $output['status'] = 'OK';

                //Send email
                $this->load->library('email_lib');
                $output['quote_details'] = $this->mod_portal->quote_details($output['quote_id'], $this->company->id);
                $this->email_lib->admin_mail_quote_submit($output);
                $this->email_lib->user_mail_quote_submit($output);

                // If user is not owner of this company send email to owner.
                if ($this->company->id != $this->companies[0]->id) {
                    $this->email_lib->owner_mail_quote_submit($output);
                }
                //Activity Log
                $this->mod_portal->audit_log('New Quote Submitted');
            }
        } else {
            $output['status'] = 'KO';
            $output['msg'] = 'Validation Failed!';
            $output['error'] = validation_errors();
        }
        echo json_encode($output);
        exit();
    }

    /*
     * Place new order (old form)
     */

    function post_new_order() {
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');

        $this->form_validation->set_rules('o_service', 'Service Type', 'required');
        $service_type = $something = $this->input->post('o_service');

        switch ($service_type) {
            case 'cutout':
                $this->form_validation->set_rules('service_option_cutout', 'Service', 'required');
                break;
            case 'masking':
                $this->form_validation->set_rules('service_option_mask', 'Service', 'required');
                break;
            case 'retouch':
                $this->form_validation->set_rules('service_option_retouch', 'Service', 'required');
                break;
        }

        $this->form_validation->set_rules('tat', 'Turnaround Times', 'required');
        $this->form_validation->set_rules('payment_option', 'Payment Form', 'required');
        $this->form_validation->set_rules('job_title', 'Order Title', 'required');

        if ($this->form_validation->run()) {
            //Insert Job
            $res = $this->portal_lib->place_new_order($_POST);
            if (!$res) {
                $output['status'] = 'KO';
            } else {
                $output['job_title'] = $this->input->post('job_title');
                $output['job_desc'] = $this->input->post('job_desc');
                $output['payment_method'] = strtolower($this->input->post('payment_method'));
                $output['payment_option'] = str_replace(' ', '', strtolower($this->input->post('payment_option')));
                $output['service_id'] = $res['service_id'];
                $output['quote_id'] = isset($res['quote_id']) ? $res['quote_id'] : '';
                $output['order_id'] = isset($res['order_id']) ? $res['order_id'] : '';
                $output['job_type'] = $res['job_type'];
                $output['status'] = 'OK';

                //Send email
                $this->load->library('email_lib');
                if ($res['job_type'] == 'quote') {
                    $output['quote_details'] = $this->mod_portal->quote_details($output['quote_id'], $this->company->id);
                    $this->email_lib->admin_mail_quote_submit($output);
                    $this->email_lib->user_mail_quote_submit($output);

                    // If user is not owner of this company send email to owner.
                    if ($this->company->id != $this->companies[0]->id) {
                        $this->email_lib->owner_mail_quote_submit($output);
                    }
                    //Activity Log
                    $this->mod_portal->audit_log('New Quote Submitted');
                } else {
                    $output['order_details'] = $this->mod_portal->order_details($output['order_id'], $this->company->id);

                    $this->email_lib->admin_mail_order_submit($output);
                    $this->email_lib->user_mail_order_submit($output);

                    // If user is not owner of this company send email to owner.
                    if ($this->user_id != $this->company->user_id) {
                        $this->email_lib->owner_mail_quote_submit($output);
                    }

                    //Activity Log
                    $this->mod_portal->audit_log('New Order Submitted');
                }
            }
        } else {
            $output['status'] = 'KO';
            $output['msg'] = 'Validation Failed!';
        }

        echo json_encode($output);
    }

    function post_quote2order() {

        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');
        $output['status'] = "KO";

        $user_id = $this->user_id;
        $company_id = $this->company->id;
        $order_id_temp = $this->input->post('order_id');
        $quote_id = $this->input->post('quote_id');
        $service_id = $this->input->post('service_id');

        if ($quote_id && $order_id_temp) {
            $service_info = $this->mod_portal->get_service_by_id($service_id);

            if ($service_info && $service_info->is_flat_rate == 1) {

                $job_title = $this->input->post('job_title');
                $job_desc = $this->input->post('job_desc');
                $payment_option = str_replace(' ', '', strtolower($this->input->post('payment_option')));
                $payment_method = strtolower($this->input->post('payment_method'));

                /* Count files */
                $upload_temp_dir = FCPATH . 'upload_temp/' . $order_id_temp;
                $file_quantity = $this->portal_lib->count_dir_files($upload_temp_dir);

                if ($file_quantity > 0) {
                    $next_order_id = $this->mod_portal->get_order_next_id();

                    $values['service_id'] = $service_id;
                    $values['job_title'] = $job_title;
                    $values['job_desc'] = $job_desc;
                    $values['quantity'] = $file_quantity;
                    $values['total_value'] = number_format($file_quantity * $service_info->unit_price, 2, '.', '');

                    $oi['prefix'] = 'COI';
                    $oi['id'] = str_pad($next_order_id, 6, '0', STR_PAD_LEFT);
                    $oi['tat'] = $service_info->turnaround_time;
                    $oi['user_id'] = $user_id;
                    $oi['date'] = date("Ymd");

                    $order_id = implode('-', $oi);


                    $res = $this->portal_lib->insert_order($user_id, $company_id, $order_id, $values);
                    if ($res) {
                        $upload_temp_dir = FCPATH . 'upload_temp/' . $order_id_temp;
                        $upload_dir = FCPATH . 'uploads/' . $order_id;
                        //Move file 
                        @rename($upload_temp_dir, $upload_dir);

                        $output['order_id'] = $order_id;
                        $output['job_type'] = "order";
                        $output['job_desc'] = $job_desc;
                        $output['job_title'] = $job_title;
                        $output['payment_option'] = $payment_option;
                        $output['payment_method'] = $payment_method;
                        $output['status'] = "OK";

                        $output['order_details'] = $this->mod_portal->order_details($order_id, $company_id);

                        $this->load->library('email_lib');
                        $this->email_lib->admin_mail_order_submit($output);
                        $this->email_lib->user_mail_order_submit($output);
                        $this->email_lib->owner_mail_order_submit($output);
                        echo json_encode($output);
                        exit();
                    }
                } else {
                    $output['status'] = "KO";
                    $output['msg'] = "Please Upload Some Images";
                }
            }
        }
        echo json_encode($output);
    }

    function quote2order() {
        $quote_id = $this->input->post('quote_id');
        $order_id_tmp = $this->input->post('order_id');
        $service_id = $this->input->post('service_id');
        $payment_option = $this->input->post('payment_option');
        $payment_method = $this->input->post('payment_method');

        if (!$order_id_tmp || !$quote_id || !$service_id) {
            exit('Invalid ID');
        }

        $user_id = $this->user_id;
        $company_id = $this->company->id;
        if (!$user_id || !$company_id) {
            exit(lang('msg_1'));
        }

        $order_id = $this->portal_lib->quote_to_order($user_id, $company_id, $quote_id, $service_id, $order_id_tmp);
        if ($order_id) {
            $this->mod_portal->quote_update($quote_id, array("quote_status" => QUOTE_ACCEPTED));
        } else {
            exit(lang('msg_2'));
        }

        if ($payment_option == "pay_now") {
            //Go to payment gateway
            if ($payment_method == "paypal") {
                $this->mod_portal->audit_log('Redirecting to payment gateway', array('order_id' => $order_id));
                redirect(site_url('/payment/' . $order_id));
            } else if ($payment_method == "payza") {
                exit(lang('msg_4'));
            } else {
                //default exception
                exit(lang('msg_3'));
            }
        } else {
            //Redirect to quote page
            redirect(site_url('/quotation'), 'refresh');
            exit();
        }
    }

    function logout() {
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');

        $this->mod_portal->audit_log('User logout');

        $user_ref = array(
            "name" => $this->user_profile->fullname,
            "email" => $this->user_profile->email,
            "avatar" => $this->user_profile->avatar,
        );
        $this->portal_lib->set_cookie('user_ref', $user_ref);

        $this->tank_auth->logout();

        echo json_encode(array('status' => 'OK'));
    }

    function uploader() {
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');

        if (!$this->tank_auth->is_logged_in()) {
            $output['status'] = 'KO';
            $output['code'] = '318';
            $output['msg'] = 'Session expired!';
            echo json_encode($output);
            exit();
        }

        // $order_id = $this->session->userdata('order_id');
        $order_id = $this->input->get('order_id');
        $user_id = $this->user_id;

        if ($user_id && $order_id) {
            //start of file upload code
            $config['upload_path'] = './upload_temp/' . $order_id;
            $config['allowed_types'] = '*';
            // $config['allowed_types'] = "jpg|jpeg|png|psd|tiff|pdf|eps|ai|svg|3fr|ari|arw|srf|sr2|bay|crw|cr2|cap|iiq|eip|dcs|dcr|drf|k25|kdc|dng|erf|fff|mef|mdc|mos|mrw|nef|nrw|orf|pef|ptx|pxn|R3D|raf|raw|rw2|raw|rwl|dng|rwz|srw|x3f";
            $this->load->library('upload', $config);

            $field_name = "file";
            if (!$this->upload->do_multi_upload($field_name)) {

                $error = array('error' => $this->upload->display_errors());
                $output['msg'] = $error;
                $output['code'] = '';
                $output['status'] = 'KO';
            } else {
                $response = $this->upload->get_multi_upload_data();
                if ($response) {
                    foreach ($response as $res) {
                        $filenames[] = $res['file_name'];
                        $size = getimagesize(base_url() . "upload_temp/{$order_id}/" . $res['file_name']);
                        if ($size['mime'] == "image/gif" || $size['mime'] == "image/jpeg" || $size['mime'] == "image/png") {
                            $preview[] = base_url() . "assets/timthumb.php?src=upload_temp/{$order_id}/" . $res['file_name'] . '&h=50&w=100';
                        } else {
                            $preview[] = base_url() . "assets/images/no-preview.png";
                            // $preview[] = ''; //Image load from bg css style
                        }
                    }
                    $output['debug'] = $size;
                    $output['debug2'] = base_url() . "upload_temp/{$order_id}/" . $res['file_name'];
                    $output['filenames'] = $filenames;
                    $output['preview'] = $preview;
                    $output['status'] = 'OK';
                }
            }
        } else {

            $output['status'] = 'KO';
            $output['code'] = '';
            $output['msg'] = "Order ID missing!";
        }

        echo json_encode($output);
    }

    function remove_tmp_file() {
        if (!$this->tank_auth->is_logged_in()) {
            exit();
        }
        $output['status'] = 'KO';

        $order_id = $this->input->get('order_id');
        $user_id = $this->user_id;

        $filenames = (isset($_POST['filenames']) && !empty($_POST['filenames'])) ? $_POST['filenames'] : false;
        if ($filenames && $user_id && $order_id) {
            foreach ($filenames as $filename) {
                $file_loc = FCPATH . 'upload_temp/' . $order_id . '/' . $filename;
                if (file_exists($file_loc)) {
                    $output['status'] = 'OK';
                    unlink($file_loc);
                }
            }
        }

        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');

        echo json_encode($output);
    }

    function get_order() {
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');

        if (!isset($_POST)) {
            echo json_encode(array('status' => 'KO'));
            exit();
        }

        $user_id = $this->user_id;
        $company_id = $this->company->id;

        $limit = ($this->input->post('limit')) ? $this->input->post('limit') : 25;
        $paged = ($this->input->post('paged')) ? $this->input->post('paged') : 1;

        $res = $this->portal_lib->get_order($user_id, $company_id, $paged, $limit);
        if ($res) {
            $output['data'] = $res;
            $output['status'] = 'OK';
        } else {
            $output['status'] = 'KO';
        }
        echo json_encode($output);
    }

    function get_quotes() {
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');

        if (!isset($_POST)) {
            echo json_encode(array('status' => 'KO'));
            exit();
        }

        $user_id = $this->user_id;
        $company_id = $this->company->id;

        $res = $this->portal_lib->get_quotes($user_id, $company_id, 1, 10);
        if ($res) {
            $output['data'] = $res;
            $output['status'] = 'OK';
        } else {
            $output['msg'] = 'Not Found';
            $output['status'] = 'KO';
        }

        echo json_encode($output);
    }

    function quote_action() {
        $action = $this->input->post('action');
        $quote_id = $this->input->post('quote_id');

        $output['status'] = 'KO';
        $output['quote_id'] = $quote_id;

        if ($action == 'accept') {
            $status = array('quote_status' => QUOTE_ACCEPTED);

            $this->load->library('email_lib');
            $check_quote_accept = $this->mod_portal->get_settings_notifications($this->user_id, NOTIFY_QUOTE_ACCEPT);
            if ($check_quote_accept) {
                $this->email_lib->user_mail_quote_accepted($output);
            }
            $this->email_lib->admin_mail_quote_accepted($output);

            $this->mod_portal->audit_log('Quote Accepted');
        } else if ($action == 'reject') {
            $status = array('quote_status' => QUOTE_REJECTED);

            $this->load->library('email_lib');
            $this->email_lib->admin_mail_quote_rejected($output);
            $check_quote_reject = $this->mod_portal->get_settings_notifications($this->user_id, NOTIFY_QUOTE_REJECT);
            if ($check_quote_reject) {
                $this->email_lib->user_mail_quote_rejected($output);
            }
            $this->mod_portal->audit_log('Quote Rejected');
        }
        $res = $this->mod_portal->quote_update($quote_id, $status);
        if ($res) {
            $output['status'] = 'OK';
        }

        echo json_encode($output);
    }

    function get_invoices() {
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');

        if (!isset($_POST)) {
            echo json_encode(array('status' => 'KO'));
            exit();
        }
        $user_id = $this->user_id;
        $company_id = $this->company->id;

        $limit = ($this->input->post('limit')) ? $this->input->post('limit') : 25;
        $paged = ($this->input->post('paged')) ? $this->input->post('paged') : 1;

        $res = $this->portal_lib->get_invoices($user_id, $company_id, $paged, $limit);
        if ($res) {
            $output['data'] = $res;
            $output['status'] = 'OK';
        } else {
            $output['status'] = 'KO';
        }
        echo json_encode($output);
    }

    function update_profile() {
        $this->load->library('email_lib');

        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');

        $values = array();
        $output = array();

        $output['status'] = 'KO';

        if (isset($_POST)) {
            $fullname = $this->input->post('fullname');
            $company = $this->input->post('company');
            $email = $this->input->post('email');
            $designation = $this->input->post('designation');
            $phone = $this->input->post('phone');
            $address1 = $this->input->post('address1');
            $address2 = $this->input->post('address2');
            $city = $this->input->post('city');
            $postal_code = $this->input->post('postal_code');
            $vat_id = $this->input->post('vat_id');
            $website = $this->input->post('website');

            if (!$fullname) {
                $output['msg'] = getErrMsg('_ERR001');
                die(json_encode($output));
            }
            if (!$company) {
                $output['msg'] = getErrMsg('_ERR002');
                die(json_encode($output));
            }
            if (!$email) {
                $output['msg'] = getErrMsg('_ERR003');
                die(json_encode($output));
            }
            if (!$phone) {
                $output['msg'] = getErrMsg('_ERR004');
                die(json_encode($output));
            }
            if (!$city) {
                $output['msg'] = getErrMsg('_ERR005');
                die(json_encode($output));
            }
            if (!$postal_code) {
                $output['msg'] = getErrMsg('_ERR006');
                die(json_encode($output));
            }

            $old_email = $this->user_profile->email;
            if ($email != $old_email) {
                $output['msg'] = 'Please go to <a class="text-danger" href="' . site_url('/auth/change_email') . '">this link</a> for reset email address!';
                $output['msg'] = getErrMsg('_ERR006');
                die(json_encode($output));
            }

            /*
             * User Profile Information
             */
            if ($fullname) {
                $values['user_profiles']['fullname'] = $fullname;
            }
            if ($designation) {
                $values['user_profiles']['designation'] = $designation;
            }
            if ($company) {
                $values['user_profiles']['company'] = $company;
            }
            if ($phone) {
                $values['user_profiles']['phone'] = $phone;
            }
            if ($website) {
                $values['user_profiles']['website'] = $website;
            }
            /*
             * User Information
             */
            if ($email) {
                $values['users']['email'] = $email;
            }
            /*
             * Company Information
             */
            if ($company) {
                $values['company']['name'] = $company;
            }
            if ($website) {
                $values['company']['website'] = $website;
            }
            if ($email) {
                $values['company']['email'] = $email;
            }
            if ($address1) {
                $values['company']['address1'] = $address1;
            }
            if ($address2) {
                $values['company']['address2'] = $address2;
            }
            if ($postal_code) {
                $values['company']['postal_code'] = $postal_code;
            }
            if ($city) {
                $values['company']['city'] = $city;
            }
            if ($vat_id) {
                $values['company']['vat_id'] = $vat_id;
            }
            if ($phone) {
                $values['company']['phone'] = $phone;
            }

            $res = $this->mod_portal->save_profile($this->user_id, $values);

            if ($res) {
                $output['msg'] = 'Successfully updated profile';
                $output['status'] = 'OK';
                $check_profile_changes = $this->mod_portal->get_settings_notifications($this->user_id, NOTIFY_PROFILE_UPDATE);
                if ($check_profile_changes) {
                    $output['mail'] = $this->email_lib->user_mail_update_profile($this->user_id);
                }
                $this->mod_portal->audit_log('Profile Updated');
            }
        }

        echo json_encode($output);
    }

    function profile() {
        $this->load->library('email_lib');

        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');

        $output['status'] = 'KO';

        if (isset($_POST)) {

            $newpassword = $this->input->post('newpassword');
            $newpassword2 = $this->input->post('newpassword2');
            if (!empty($newpassword) && $newpassword != $newpassword2) {

                $output['msg'] = 'Password not matched!';
                echo json_encode($output);
                die();
            }
            $fullname = $this->input->post('fullname');
            if ($fullname) {
                $values['users']['username'] = str_replace(' ', '-', strtolower($fullname));
            }

            $old_email = $this->user_profile->email;
            $new_email = $this->input->post('email');

            if ($new_email != $old_email) {
                $output['msg'] = 'Please go to <a class="text-danger" href="' . site_url('/auth/change_email') . '">this link</a> for reset email address!';
                echo json_encode($output);
                die();
                //Email can't change from profile page
                // $values['users']['email']         	= $email;
            }

            if ($newpassword) {
                /* Disabled for profile page */
                //$values['users']['password']        = $this->tank_auth->generate_hashpass($newpassword);
            }

            if ($fullname) {
                $values['user_profiles']['fullname'] = $fullname;
            }

            $newsletter = $this->input->post('newsletter');
            $values['settings']['newsletter'] = ($newsletter) ? 0 : 1;


            $res = $this->mod_portal->save_profile($this->user_id, $values);
            if ($res) {
                $output['msg'] = 'Update Success';
                $output['status'] = 'OK';

                $output['mail'] = $this->email_lib->user_mail_update_profile($this->user_id);

                $this->mod_portal->audit_log('Profile Updated');
            }
        }

        echo json_encode($output);
    }

    function company() {
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');

        $output['status'] = 'KO';

        if (isset($_POST['action'])) {
            $values['name'] = $this->input->post('name');
            $values['email'] = $this->input->post('email');
            $values['website'] = $this->input->post('website');
            $values['address1'] = $this->input->post('address1');
            $values['address2'] = $this->input->post('address2');
            $values['city'] = $this->input->post('city');
            $values['postal_code'] = $this->input->post('postal_code');
            $values['vat_id'] = $this->input->post('vat_id');
            $values['phone'] = $this->input->post('phone');

            $res = $this->mod_portal->save_company($this->user_id, $values);
            if ($res) {
                //delete_cookie("company");
                $output['status'] = 'OK';
                $this->load->library('email_lib');
                $this->email_lib->user_mail_update_profile($this->user_id);
                $this->mod_portal->audit_log('Company Updated');
            }
        }

        echo json_encode($output);
    }

    function settings() {
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');

        $output['status'] = 'KO';
        echo json_encode($_POST);
        die();
        if (isset($_POST)) {
            $notify_order_submit = $this->input->post(NOTIFY_ORDER_SUBMIT);
            $NOTIFY_QUOTE_REVIEWED = $this->input->post(NOTIFY_QUOTE_REVIEWED);
            $NOTIFY_QUOTE_ACCEPT = $this->input->post(NOTIFY_QUOTE_ACCEPT);
            $notify_order_received = $this->input->post(NOTIFY_ORDER_RECEIVED);
            $notify_order_ready = $this->input->post(NOTIFY_ORDER_READY);
            $notify_billing_payment = $this->input->post(NOTIFY_BILLING_PAYMENT);

            $settings[NOTIFY_ORDER_SUBMIT] = ($notify_order_submit) ? 1 : 0;
            $settings[NOTIFY_QUOTE_REVIEWED] = ($NOTIFY_QUOTE_REVIEWED) ? 1 : 0;
            $settings[NOTIFY_QUOTE_ACCEPT] = ($NOTIFY_QUOTE_ACCEPT) ? 1 : 0;
            $settings[NOTIFY_ORDER_RECEIVED] = ($notify_order_received) ? 1 : 0;
            $settings[NOTIFY_ORDER_READY] = ($notify_order_ready) ? 1 : 0;
            $settings[NOTIFY_BILLING_PAYMENT] = ($notify_billing_payment) ? 1 : 0;

            $res = $this->mod_portal->save_settings($this->user_id, $settings);
            if ($res) {
                $this->load->library('email_lib');
                $this->email_lib->user_mail_update_profile($this->user_id);
                $this->mod_portal->audit_log('Settings Updated');
                $output['status'] = 'OK';
            }
        }

        echo json_encode($output);
    }

    function check_user() {
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');

        $email = $this->input->post("email");
        if ($email) {
            $user = $this->users->get_user_by_email($email);
            if ($user) {
                $profile = $this->mod_portal->get_user($user->id);
                $output['status'] = 'OK';
                $output['user']['id'] = $profile->user_id;
                $output['user']['fullname'] = $profile->fullname;
                $output['user']['email'] = $profile->email;
                $output['user']['avatar'] = get_avatar($profile->user_id, array(100, 100));
                $output['user']['company_name'] = $profile->company;
                // $output['user']['all']   = $profile;
            } else {
                $output['status'] = 'KO';
            }
        } else {
            $output['status'] = 'KO';
        }
        echo json_encode($output);
    }

    function invite_user() {
        $email = $this->input->post('email');
        if ($email) {
            $this->load->library('email');
            $this->load->library('email_lib');
            $fullname = $this->input->post("fullname");

            if ($this->email->valid_email($email)) {
                $invited_by = $this->mod_portal->get_user($this->user_id);
                $invite_to = $this->mod_portal->get_user_by_email($email);

                $data['invited_by_id'] = $invited_by->id;
                $data['invited_by_name'] = $invited_by->fullname;
                $data['invited_by_email'] = $invited_by->email;

                if ($invite_to) {
                    $data['invite_to_id'] = $invite_to->id;
                    $data['invite_to_name'] = $invite_to->fullname;
                    $data['invite_to_email'] = $invite_to->email;
                } else {
                    $data['invite_to_name'] = $fullname;
                    $data['invite_to_email'] = $email;
                }

                $company = $this->portal_lib->get_active_company();
                $data['company_id'] = $company->id;
                $data['company_name'] = $company->name;

                if ($this->mod_portal->is_alreay_invited($data)) {
                    $output['status'] = "KO";
                    $output['msg'] = "Already invited this user!";
                } else if ($invite_to && $this->mod_portal->is_alreay_member($data)) {
                    $output['status'] = "KO";
                    $output['msg'] = "Already added this user!";
                } else if ($invite_to && $this->mod_portal->is_company_owner($data)) {
                    $output['status'] = "KO";
                    $output['msg'] = "You can't invite owner of the same company.";
                } else {

                    $key = $this->portal_lib->generate_invite_key($data);
                    if ($key) {

                        $data['invite_key'] = $key;

                        //Email notification
                        $this->email_lib->invite_user($data);

                        $this->mod_portal->audit_log('New User Invited');

                        $output['status'] = "OK";
                    } else {
                        $output['status'] = "KO";
                        $output['msg'] = "Database error";
                    }
                }
            } else {
                $output['status'] = "KO";
                $output['msg'] = "Invalid email address";
            }

            header('Cache-Control: no-cache, must-revalidate');
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
            header('Content-type: application/json');

            echo json_encode($output);
        } else {
            $this->load->view('com_inviteuser');
        }
    }

    function add_user() {
        if (isset($_POST['email'])) {
            header('Cache-Control: no-cache, must-revalidate');
            header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
            header('Content-type: application/json');

            $this->load->model('tank_auth/users');

            $output['status'] = 'KO';
            $company = $this->mod_portal->company_by_userid($this->user_id);
            $fullname = $this->input->post('fullname');
            $phone = $this->input->post('phone');

            $username = str_replace(' ', '-', strtolower($fullname)) . substr(time(), 0, -2);
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $data = $this->tank_auth->create_user($username, $email, $password, false);
            if (!is_null($data)) {
                $profile['fullname'] = $fullname;
                $profile['company'] = '';
                $profile['phone'] = $phone;
                $this->users->update_profile($data['user_id'], $profile);

                $this->mod_portal->add_company_member($data['user_id'], $$company->id);
                $output['status'] = 'OK';
            } else {
                $errors = $this->tank_auth->get_error_message();

                if (isset($errors['email'])) {
                    $user = $this->users->get_user_by_email($email);

                    $this->mod_portal->add_company_member($user->id, $company->id);
                    $this->mod_portal->audit_log('New User Added');
                    $output['status'] = 'OK';
                } else {
                    foreach ($errors as $k => $v) {
                        $output['errors'][$k] = $this->lang->line($v);
                    }
                    $output['status'] = 'KO';
                }
            }
            echo json_encode($output);
        } else {
            $this->load->view('com_adduser');
        }
    }

    function change_active_company() {
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');

        $output['status'] = "KO";
        $id = (int) $this->input->post('id');
        if ($id > 0) {
            $company = $this->portal_lib->get_company_by_id($id);
            if ($company) {
                $comArray['id'] = $company->id;
                $comArray['name'] = $company->name;
                $comArray['user_id'] = $company->user_id; //Owner

                $this->portal_lib->set_active_company($comArray);
                $output['status'] = "OK";
                $this->mod_portal->audit_log('Switch Active Company');
            } else {
                $output['status'] = "KO";
            }
        }

        echo json_encode($output);
    }

    function send_message() {
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');

        $output['status'] = "KO";
        $subject = $this->input->post('subject');
        $message_type = $this->input->post('message_type');
        $message = $this->input->post('message');
        $parent_id = $this->input->post('parent_id');
        if ($message) {
            $values['msg_hashid'] = strtoupper(uniqid());
            $values['msg_company_id'] = $this->company->id;
            $values['msg_sender_id'] = $this->user_id;
            $values['msg_receiver_id'] = 0; // 0=Admin
            $values['msg_content'] = strip_tags($message, $this->config->item('allowed_tags'));
            $values['msg_time'] = date("Y-m-d H:i:s");
            $values['last_sender_id'] = $this->user_id;
            $values['message_type'] = $message_type;
            if ($parent_id) {
                $values['msg_parent_id'] = $parent_id;
                $values['msg_subject'] = $this->mod_portal->get_message_by_parent_id($parent_id)->msg_subject;
            } else if ($subject) {
                $values['msg_subject'] = strip_tags($subject);
            } else {
                $output['msg'] = 'Subject Missing!';
                echo json_encode($output);
                exit();
            }

            $message_id = $this->mod_portal->add_message($values);

            if ($parent_id) {
                // Increament message counter
                $this->mod_portal->update_message_thread($parent_id, $this->user_id);
                // Add message status
                $this->mod_portal->add_message_status($values['msg_receiver_id'], $values['msg_company_id'], $parent_id);
            } else {
                // Add message status
                $this->mod_portal->add_message_status($values['msg_receiver_id'], $values['msg_company_id'], $values['msg_hashid']);
            }
            $output['status'] = "OK";
            $this->mod_portal->audit_log('Message Sent');

            $this->load->library('email_lib');
            $this->email_lib->admin_mail_receive_message($values);
        } else {
            $output['msg'] = 'Message body cannot be empty!';
        }
        echo json_encode($output);
    }

    function get_messages() {
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');

        $output['status'] = "KO";
        $messages = $this->portal_lib->load_messages(300);
        if ($messages) {
            $output['messages'] = $messages;
            $output['status'] = "OK";
        }
        echo json_encode($output);
    }

    /* =================== Popup =================== */

    function popup_order_details() {
        $order_id = $this->input->get('order_id');
        $company_id = $this->company->id;

        if ($order_id && !empty($order_id) && $company_id) {
            $data['order'] = $this->mod_portal->order_details($order_id, $company_id);
            $data['success'] = TRUE;
        } else {
            $data['success'] = FALSE;
        }

        $this->load->view('popup_order_details', $data);
    }

    function popup_quote_details() {
        $quote_id = $this->input->get('quote_id');
        $company_id = $this->company->id;

        if ($quote_id && !empty($quote_id) && $company_id) {
            $data['quote'] = $this->mod_portal->quote_details($quote_id, $company_id);
            $data['success'] = TRUE;
        } else {
            $data['success'] = FALSE;
        }
        $this->load->view('popup_quote_details', $data);
    }

    function popup_invoice() {
        $inv_id = $this->input->get('id');

        if ($inv_id && strlen($inv_id) > 8) {
            $raw_id = substr($inv_id, 8);

            $order = $this->mod_portal->get_order_by_id("COI-$raw_id");
            $data['inv_id'] = $inv_id;
            $data['invoice_info'] = $order;
            $data['company'] = $this->mod_portal->get_company_by_id($this->company->id);
            $data['services'] = $this->mod_portal->get_services(array('service_id' => $order->service_id));

            if ($order->company_id != $data['company']->id) {
                die('Invalid request!');
            }
            $this->load->view('popup_invoice', $data);
        } else {
            echo 'Invalid ID';
        }
    }

    function popup_quote_order() {
        $quote_id = $this->input->get('quote_id');
        if ($quote_id) {
            $data['quote_id'] = $quote_id;
            $this->load->view('popup_quote_order', $data);
        } else {
            exit("Invalid ID");
        }
    }

    function edit_profile($user_id) {
        $this->load->view('page_edit_profile');
    }

    function permission_user($user_id) {
        $data['company_members'] = $this->mod_portal->get_company_member_data($user_id, $this->company->id);
        $this->load->view('page_permission_user', $data);
    }

    function set_permission() {

        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');

        $output = array();
        $output['status'] = "KO";

        $action = $_POST['action'];
        $status = $_POST['status'];
        $user = $_POST['user'];
        $new_status = ($status == 1) ? 0 : 1;

        $res = $this->mod_portal->set_company_member_permission($user, $this->company->id, array($action => $new_status));
        if ($res) {
            $output['cur_state'] = $new_status;
            $output['status'] = "OK";
        }
        echo json_encode($output);
        die();
    }

    function metadata_info() {
        $this->load->view('popup_metadata');
    }

    function add_fund() {
        $this->load->view('popup_add_fund');
    }

    function withdraw_fund() {
        $this->load->view('popup_withdraw_fund');
    }

    function portal_help() {
        $this->load->view('popup_portal_help');
    }

    function tat_extra() {
        $this->load->view('popup_tat_extra');
    }

    function tat_discount() {

        $this->load->view('popup_tat_discount');
    }

    function why_credit() {
        $this->load->view('popup_why_credit');
    }

    function pay_later() {
        $this->load->view('popup_pay_later');
    }

    function popup_check_data() {
        $this->load->view('popup_check_data_bolian');
    }

    function message_send($user_id = NULL) {
        $data['user_id'] = $user_id;
        $this->load->view('page_message', $data);
    }

    function user_remove($id = null) {
        $data['id'] = $id;
        $this->load->view('page_manager_delete', $data);
    }

    function delete_member() {
        $json = array();
        $member_id = $this->input->post('member_id');
        $result = $this->mod_portal->remove_permission_by_id($member_id);
        if ($result) {
            $json['status'] = 'OK';
            $json['msg'] = "Success";
        } else {
            $json['status'] = 'KO';
            $json['msg'] = "Somethong went wrong.";
        }
        echo json_encode($json);
    }

    function permission_set_edit() {
        $status = array();
        $member_id = $this->input->post('member_id');
        $order_status = $this->input->post('order_status');
        $quote_status = $this->input->post('quote_status');
        $billing_status = $this->input->post('billing_status');
        $manage_status = $this->input->post('manage_status');
        $message_status = $this->input->post('message_status');
        /*
         * {"create_order":0,"billing":0,"message_board":1,"manage_user":0,"quote_approve":0}
         */
        $permission = json_encode(array(
            "create_order" => $order_status,
            "billing" => $billing_status,
            "message_board" => $message_status,
            "manage_user" => $manage_status,
            "quote_approve" => $quote_status
        ));

        $permission_update = $this->mod_portal->permission_by_member_id($member_id, $permission);
        if ($permission_update) {
            $status['status'] = "OK";
            $status['msg'] = 'Well done ! Successfully permission saved.';
        } else {
            $status['status'] = "KO";
            $status['msg'] = "Something went wrong.";
        }
        echo json_encode($status);
    }

    function send_message_to_user() {
        $result = array();
        $data['msg_company_id'] = $this->company->id;
        $data['msg_sender_id'] = $this->user_id;
        $data['msg_receiver_id'] = $this->input->post('company_id');
        $data['msg_subject'] = $this->input->post('subject');
        $data['msg_content'] = $this->input->post('message');
        $data['msg_time'] = date('Y-m-d h:i:s');
        $data['last_sender_id'] = $this->user_id;
        $data['last_update'] = date('Y-m-d h:i:s');
        $send = $this->mod_portal->sending_message_user($data);
        if ($send) {
            $result['status'] = "OK";
            $result['msg'] = "Success";
        } else {
            $result['status'] = "KO";
            $result['msg'] = "Something went wrong";
        }
        echo json_encode($result);
    }

    function set_email_notification() {
        $output = array();
        $settings_name = $this->input->post('name');
        $settings_value = $this->input->post('value');
        $data['user_id'] = $this->user_id;
        $data['settings_name'] = $settings_name;
        $data['settings_value'] = $settings_value;
        $notify_set = $this->mod_portal->email_notification_for_user($data);
        if ($notify_set && $settings_value == '1') {
            $output['status'] = "OK";
            $output['value'] = $settings_value;
            $output['msg'] = "Notification OFF";
        } else if ($notify_set && $settings_value == '0') {
            $output['status'] = "OK";
            $output['value'] = $settings_value;
            $output['msg'] = "Notification ON";
        } else {
            $output['status'] = "KO";
            $output['value'] = $settings_value;
            $output['msg'] = "Request Failed !";
        }
        echo json_encode($output);
    }

    /**
     * delete_aws function
     *
     * By providing foldername and file name it will remove that content from bucket
     *
     * @param string Folder name
     *
     * @return mixed
     * */
    function delete_aws($folder, $file) {
        if (!$folder || !$file) {
            return 0;
        }
        $folder = $folder . '/' . $file;
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

        $output['status'] = 'KO';

        $contents = $s3->getBucket($sourceBucket, $sourceKeyname);
        if (!empty($contents)) {
            foreach ($contents as $eachItem) {
                $s3->deleteObject($sourceBucket, $eachItem['name']);
            }
            $output['status'] = 'OK';
        }
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');

        echo json_encode($output);
    }

}
