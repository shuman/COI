<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_Ajax extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->output->enable_profiler(FALSE);
        $this->load->library('admin_lib');
        $this->load->model('mod_admin');

        if (!$this->tank_auth->is_logged_in()) {
            exit();
        }
        $this->user_role = $this->tank_auth->get_role();
        if ($this->user_role != 'admin') {
            exit();
        }

        $this->user_id = $this->session->userdata('user_id');
        $this->user_profile = $this->mod_portal->get_user($this->user_id);
        $this->avatar = avatar();
    }

    function index() {
        echo 'Admin Ajax';
    }

    function popup_order_details() {
        $order_id = $this->input->get('order_id');
        if (!empty($order_id)) {
            $data['order'] = $this->mod_admin->order_details($order_id);
            $data['success'] = TRUE;
        } else {
            $data['success'] = FALSE;
        }
        $this->load->view('admin/page_admin_popup_order_details', $data);
    }

    function make_review() {
        $quote_id = $this->input->get('quote_id');
        $data = array();
        if ($quote_id) {
            $data['quote'] = $this->admin_lib->quote_details_by_id(strtoupper($quote_id));
        }
        $content = $this->load->view("admin/popup_make_review", $data);
    }

    function popup_quote_details() {
        $quote_id = $this->input->get('quote_id');
        $data = array();
        if ($quote_id) {
            $data['quote'] = $this->admin_lib->quote_details_by_id(strtoupper($quote_id));
        }
        $content = $this->load->view("admin/page_admin_popup_quote_details", $data);
    }

    function set_flat_rate() {
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');

        $service_id = $this->input->post('service_id');
        $quote_id = $this->input->post('quote_id');
        $flat_rate = $this->input->post('flat_rate');

        if ($service_id && !empty($flat_rate)) {
            $res = $this->admin_lib->set_flat_rate($quote_id, $service_id, $flat_rate);
            if ($res) {
                $output['status'] = 'OK';
                $output['quote_id'] = $quote_id;
                $output['service_id'] = $service_id;
                $output['flat_rate'] = $flat_rate;

                $this->load->library('email_lib');
                $check_quote_review = $this->mod_portal->get_settings_notifications($res->user_id, NOTIFY_QUOTE_REVIEWED);
                if ($check_quote_review) {
                    $this->email_lib->user_mail_quote_reviewed($output);
                }
                $this->email_lib->admin_mail_quote_reviewed($output);
            } else {
                $output['status'] = 'KO';
            }
        } else {
            $output['status'] = 'KO';
        }
        echo json_encode($output);
    }

    /*
     * Data get by admin.ja function postDataban by id
     */

    function admin_ban_reason() {
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');

        $this->load->model('users');
        $this->form_validation->set_rules('ban_reason', 'Ban Reason', 'trim|required|xss_clean');
        $reason = $this->input->post('ban_reason');
        $user_id = $this->input->post('user_id');

        if ($user_id && !empty($reason)) {
            $output['status'] = 'OK';
            $res = $this->users->ban_user($user_id, $reason);
        } else {
            $output['status'] = 'KO';
        }
        echo json_encode($output);
    }

    function job_complete() {
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');
        $output = array('status' => 'KO');

        $order_id = $this->input->post('order_id');
        if ($order_id) {
            $values['order_status'] = ORDER_COMPLETED;
            $values['complete_date'] = date("Y-m-d H:i:s");
            $res = $this->mod_admin->update_order($order_id, $values);
            if ($res) {
                $values['order_id'] = $order_id;

                $this->load->library('email_lib');
//                $this->email_lib->admin_mail_order_ready($values);
                $check_order_confirm = $this->mod_portal->get_settings_notifications($res->user_id, NOTIFY_ORDER_DELIVERY);
                if ($check_order_confirm) {
                    $this->email_lib->user_mail_order_ready($values);
                }
                // $this->email_lib->owner_mail_order_ready($values);

                $this->mod_portal->audit_log('Job mark as completed. order_id: ' . $order_id);
            }
            $output['status'] = 'OK';
        } else {
            
        }

        echo json_encode($output);
    }

    /**
     * Admin to User message
     */
    function send_message() {
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');
        $output = array('status' => 'KO');

        $message = $this->input->post('message');
        $parent_id = $this->input->post('parent_id');

        if ($parent_id && $message) {
            $thread_info = $this->mod_portal->get_message_table_by_hashid($parent_id);
            if ($thread_info) {
                $values['msg_hashid'] = strtoupper(uniqid());
                $values['msg_company_id'] = $thread_info->msg_company_id;
                $values['msg_parent_id'] = $parent_id;
                $values['msg_sender_id'] = $this->user_id;
                $values['msg_receiver_id'] = $thread_info->msg_sender_id;
                $values['msg_content'] = strip_tags($message, $this->config->item('allowed_tags'));
                $values['msg_time'] = date("Y-m-d H:i:s");
                $values['last_sender_id'] = $this->user_id;

                $res = $this->mod_portal->add_message($values);
                if ($parent_id) {
                    $values['msg_parent_id'] = $parent_id;
                    $values['msg_subject'] = $this->mod_portal->get_message_by_parent_id($parent_id)->msg_subject;
                } else {
                    $output['msg'] = 'Missing values';
                    echo json_encode($output);
                    exit();
                }

                if ($res) {
                    $this->mod_portal->update_message_thread($parent_id, $this->user_id);
                    // Add message status
                    $this->mod_portal->add_message_status($values['msg_receiver_id'], $values['msg_company_id'], $parent_id);

                    $output['status'] = 'OK';
                }
                $this->mod_portal->audit_log('Message Sent');

                $this->load->library('email_lib');
                $this->email_lib->user_mail_receive_message($values);
            }
        }

        echo json_encode($output);
    }

    public function user_band_list() {
        $output['status'] = 'KO';
        $user_id = $this->input->post('user_id');
        $data['whitelisted'] = $this->input->post('status');
        $update_user_listed = $this->mod_portal->update_user_list_status($data, $user_id);
        if ($update_user_listed) {
            $output['status'] = 'OK';
        }
        echo json_encode($output);
    }

    public function remove_from_whitelist() {
        $output['status'] = 'KO';
        $user_id = $this->input->post('user_id');
        $data['whitelisted'] = $this->input->post('status');
        $update_status = $this->mod_portal->remove_user_form_whitelist($data, $user_id);
        if ($update_status) {
            $output['status'] = 'OK';
        }
        echo json_encode($output);
    }

}
