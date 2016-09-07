<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

// require_once('phpass-0.3/PasswordHash.php');
class Admin_lib {

    function __construct() {
        $this->ci = & get_instance();
    }

    public function get_orders($paged = 1, $limit = 10) {
        $table_data = array();
        $only_due_data = array();
        $filter = false;

        $orders = $this->ci->mod_admin->load_orders($paged, $limit);

        // var_dump($orders); exit();
        if ($orders) {
            $i = 0;
            foreach ($orders as $order) {
                $table_data[$i]['user_id'] = $order->user_id;
                $table_data[$i]['user_profile'] = $this->ci->mod_portal->get_user($order->user_id);
                $table_data[$i]['order_id'] = $order->order_id;
                $table_data[$i]['service_id'] = $order->service_id;
                $table_data[$i]['title'] = $order->order_title;
                $table_data[$i]['order_date'] = date("M j, Y", strtotime($order->order_date));

                if ($order->order_status == ORDER_COMPLETED) {
                    $table_data[$i]['order_status'] = 'Completed';

                    $done_before = secondsToTime(strtotime($order->complete_date) - strtotime($order->order_date));
                    if ($order->turnaround_time > 0 && $done_before['h'] > $order->turnaround_time) {
                        $table_data[$i]['expired'] = true;
                    }
                    $table_data[$i]['done_before'] = implode(':', $done_before);
                    $table_data[$i]['success'] = true;
                    $table_data[$i]['download_key'] = base64_encode($order->order_id);
                } else if ($order->order_status == ORDER_CANCELLED) {
                    $table_data[$i]['order_status'] = 'Cancelled';
                    $table_data[$i]['done_before'] = implode(':', secondsToTime(strtotime($order->complete_date) - strtotime($order->order_date)));
                    $table_data[$i]['cancelled'] = true;
                } else {
                    $table_data[$i]['order_status'] = 'Pending';
                    if ($order->turnaround_time == 0) {
                        $table_data[$i]['countup'] = true;
                    }
                    $table_data[$i]['timer'] = date("D M d Y H:i:s e", strtotime($order->order_date . " +" . $order->turnaround_time . " Hours"));
                }
                $table_data[$i]['tat'] = $order->turnaround_time;
                $table_data[$i]['quantity'] = $order->order_quantity;
                $table_data[$i]['unit_price'] = $order->unit_price;
                $table_data[$i]['is_flat_rate'] = $order->is_flat_rate;
                $table_data[$i]['total_value'] = $order->total_value;
                $table_data[$i]['downloaded'] = $order->downloaded;

                $i++;
            }
            return $table_data;
        }
        return false;
    }

    /**
     * @param paged int pagination
     * @param limit int
     */
    public function get_quotes($paged = 0, $limit = 20) {
        $table_data = array();
        $filter = false;

        $quotes = $this->ci->mod_admin->load_quotes($paged, $limit);
        if ($quotes) {
            $i = 0;
            foreach ($quotes as $quote) {
                $table_data[$i]['quote_id'] = $quote->quote_id;
                $table_data[$i]['service_id'] = $quote->service_id;
                $table_data[$i]['user_profile'] = $this->ci->mod_portal->get_user($quote->user_id);
                $table_data[$i]['title'] = $quote->quote_title;
                $table_data[$i]['quote_date'] = date("M j, Y", strtotime($quote->quote_date));

                if ($quote->quote_status == QUOTE_ACCEPTED) {
                    $table_data[$i]['quote_status'] = 'Accepted';
                    $table_data[$i]['accepted'] = true;
                } else if ($quote->quote_status == QUOTE_REJECTED) {
                    $table_data[$i]['quote_status'] = 'Rejected';
                    $table_data[$i]['rejected'] = true;
                } else if ($quote->quote_status == QUOTE_REVIEWED) {
                    $table_data[$i]['quote_status'] = 'Reviewed';
                    $table_data[$i]['reviewed'] = true;
                } else {
                    $table_data[$i]['quote_status'] = 'Waiting';
                    $table_data[$i]['waiting'] = true;
                }
                if ($quote->is_flat_rate > 0) {
                    $table_data[$i]['unit_price'] = $quote->unit_price;
                    if ($quote->unit_price < 1 || $quote->quantity < 1) {
                        $table_data[$i]['total_price'] = '0.00';
                    } else {
                        $table_data[$i]['total_price'] = number_format($quote->unit_price * $quote->quantity, 2, '.', '');
                    }
                } else {
                    if ($quote->total_value < 1 || $quote->quantity < 1) {
                        $table_data[$i]['unit_price'] = '0.00';
                    } else {
                        $table_data[$i]['unit_price'] = number_format($quote->total_value / $quote->quantity, 2, '.', '');
                    }
                    $table_data[$i]['total_price'] = $quote->total_value;
                }
                $table_data[$i]['tat'] = $quote->turnaround_time;
                $table_data[$i]['is_flat_rate'] = $quote->is_flat_rate;
                $table_data[$i]['quantity'] = $quote->quantity;

                $i++;
            }
            return $table_data;
        }
        return false;
    }

    public function get_invoices($paged = 0, $limit = 20) {
        $table_data = array();
        $filter = false;


        $orders = $this->ci->mod_admin->load_orders($paged, $limit);
        if ($orders) {
            $i = 0;
            foreach ($orders as $order) {
                $table_data[$i]['invoice_id'] = str_replace("COI-", "COI-INV-", $order->order_id);
                $table_data[$i]['order_id'] = $order->order_id;
                $table_data[$i]['service_id'] = $order->service_id;
                $table_data[$i]['user_profile'] = $this->ci->mod_portal->get_user($order->user_id);
                $table_data[$i]['title'] = $order->order_title;
                $table_data[$i]['order_date'] = date("M j, Y", strtotime($order->order_date));
                $table_data[$i]['due_date'] = date("M j, Y", strtotime($order->order_date . ' +7 Days'));

                if ($order->order_status == ORDER_COMPLETED) {
                    $table_data[$i]['order_status'] = 'Completed';
                    $table_data[$i]['done_before'] = implode(':', secondsToTime(strtotime($order->complete_date) - strtotime($order->order_date)));
                    $table_data[$i]['success'] = true;
                } else if ($order->order_status == ORDER_CANCELLED) {
                    $table_data[$i]['order_status'] = 'Cancelled';
                    $table_data[$i]['done_before'] = implode(':', secondsToTime(strtotime($order->complete_date) - strtotime($order->order_date)));
                    $table_data[$i]['cancelled'] = true;
                } else {
                    $table_data[$i]['order_status'] = 'Pending';
                    $table_data[$i]['timer'] = date("Y-m-d H:i:s", strtotime($order->order_date . " +" . $order->turnaround_time . " Hours"));
                }
                if ($order->payment_status > 0) {
                    $table_data[$i]['paid'] = true;
                } else {
                    $table_data[$i]['unpaid'] = true;
                }
                $table_data[$i]['unit_price'] = $order->unit_price;
                $table_data[$i]['total_value'] = number_format($order->total_value, 2, '.', '');
                $table_data[$i]['tat'] = $order->turnaround_time;
                $table_data[$i]['quantity'] = $order->order_quantity;
                $table_data[$i]['downloaded'] = $order->downloaded;

                $i++;
            }
            return $table_data;
        }
        return false;
    }

    public function quote_details_by_id($quote_id) {

        $quote = $this->ci->mod_admin->load_quote($quote_id);
        return $quote;
    }

    public function set_flat_rate($quote_id, $service_id, $flat_rate) {
        $quote_info = $this->quote_details_by_id($quote_id);
        if ($quote_info == false) {
            return false;
        }
        $total_value = $quote_info->quantity * $flat_rate;

        $values['is_flat_rate'] = 1;
        $values['unit_price'] = $flat_rate;
        $values['total_value'] = $total_value;

        $res = $this->ci->mod_admin->update_service($service_id, $values);
        if ($res) {
            $q_val['quote_status'] = QUOTE_REVIEWED;
            return $this->ci->mod_admin->update_quote($quote_id, $q_val);
        } else {
            return false;
        }
    }

    /**
     * Load message from db 
     * @return object
     */
    public function load_message_threads($paged = 0, $limit = 0, $company_id = false) {

        $messages = $this->ci->mod_admin->get_message_threads($paged, $limit, $company_id);
        if ($messages) {
            $i = 0;
            foreach ($messages as $message) {
                $company = $this->ci->portal_lib->get_company_by_id($message->msg_company_id);
                if ($message->msg_sender_id > 0) {
                    $user = $this->ci->mod_portal->get_user($message->msg_sender_id);
                    $messages[$i]->sender_name = $user->fullname;
                    $messages[$i]->sender_designation = ($this->ci->user_id == $message->msg_sender_id) ? 'You' : $user->designation;
                } else {
                    $messages[$i]->sender_name = 'CutOutImage';
                    $messages[$i]->sender_designation = 'Support Team';
                }
                if ($message->msg_receiver_id > 0) {
                    $user = $this->ci->mod_portal->get_user($message->msg_receiver_id);
                    $messages[$i]->receiver_name = $user->fullname;
                    $messages[$i]->receiver_designation = $user->designation;
                } else {
                    $messages[$i]->receiver_name = 'CutOutImage';
                    $messages[$i]->receiver_designation = 'Support Team';
                }
                $messages[$i]->company_name = $company->name;
                $messages[$i]->msg_time = date("c", strtotime($message->msg_time));
                $i++;
            }

            return $messages;
        } else {
            return false;
        }
    }

    public function load_message_single($thread) {

        $messages = $this->ci->mod_admin->get_messages_by_id($thread);
        if ($messages) {

            $company = $this->ci->portal_lib->get_company_by_id($messages[0]->msg_company_id);
            $i = 0;
            foreach ($messages as $message) {
                if ($message->msg_sender_id > 0) {
                    $user = $this->ci->mod_portal->get_user($message->msg_sender_id);
                    $messages[$i]->sender_name = $user->fullname;
                    $messages[$i]->sender_designation = ($this->ci->user_id == $message->msg_sender_id) ? 'You' : $user->designation;
                } else {
                    $messages[$i]->sender_name = 'CutOutImage';
                    $messages[$i]->sender_designation = 'Support Team';
                }
                if ($message->msg_receiver_id > 0) {
                    $user = $this->ci->mod_portal->get_user($message->msg_receiver_id);
                    $messages[$i]->receiver_name = $user->fullname;
                    $messages[$i]->receiver_designation = $user->designation;
                } else {
                    $messages[$i]->receiver_name = 'CutOutImage';
                    $messages[$i]->receiver_designation = 'Support Team';
                }

                $messages[$i]->company_name = $company->name;
                $messages[$i]->msg_time = date("c", strtotime($message->msg_time));
                $i++;
            }

            return array('messages' => $messages, 'company' => $company);
        } else {
            return false;
        }
    }

    public function load_company_by_recent_message() {
        $messages = $this->ci->mod_admin->get_company_by_recent_message();
        if ($messages) {
            return $messages;
        }
        return false;
    }

    /**
     * Create new user on the site and return some data about it:
     * user_id, username, password, email, new_email_key (if any).
     *
     * @param	string
     * @param	bool
     * @return	array
     */
    public function admin_create_user() {
        $this->ci->load->model('users');
        $email_activation = $this->ci->config->item('email_activation', 'tank_auth');
        $use_username = $this->ci->config->item('use_username', 'tank_auth');

        // Create new User
        $username = $use_username ? $this->ci->input->post('username') : '';
        $email = $this->ci->input->post('email');
        $password = $this->ci->input->post('password');
        $data = $this->ci->tank_auth->create_user($username, $email, $password, $email_activation);

        return $data;
    }

    public function create_user_company_profile($data) {


        if (!is_null($data)) {

            // Create new profile
            $profile['fullname'] = $this->ci->input->post('fullname');
            $profile['company'] = $this->ci->input->post('company');
            $profile['country'] = $this->ci->input->post('country');
            $profile['phone'] = $this->ci->input->post('phone');
            $create_profile = $this->ci->users->update_profile($data['user_id'], $profile);



            //Create new Company
            $company = array(
                'user_id' => $data['user_id'],
                'name' => $this->ci->input->post('company'),
                'phone' => $this->ci->input->post('phone'),
                'email' => $this->ci->input->post('email'),
                'website' => $this->ci->input->post('website'),
                'address1' => $this->ci->input->post('address1'),
                'address2' => $this->ci->input->post('address2'),
                'country' => $this->ci->input->post('country'),
                'postal_code' => $this->ci->input->post('zip'),
                'city' => $this->ci->input->post('town'),
                'vat_id' => $this->ci->input->post('vatId')
            );

            $create_company = $this->ci->users->admin_create_company($company);

            if ($create_profile) {
                return $create_profile;
            }
            if ($create_company) {
                return $create_company;
            }
        } else {
            return false;
        }
    }

    /*
     * Data process to insert data
     * Get data.
     */

    public function update_user_data_by_id($user_id) {

        if (!empty($user_id)) {
            $this->ci->load->model('users');

            $password = $this->ci->input->post('password');

            $hasher = new PasswordHash(
                    $this->ci->config->item('phpass_hash_strength', 'tank_auth'), $this->ci->config->item('phpass_hash_portable', 'tank_auth')
            );
            $hashed_password = $hasher->HashPassword($password);

            $values1 = array(
                'username' => $this->ci->input->post('fullname'),
                'email' => $this->ci->input->post('email')
            );

            $values2 = array(
                'name' => $this->ci->input->post('company'),
                'phone' => $this->ci->input->post('phone'),
                'email' => $this->ci->input->post('email'),
                'website' => $this->ci->input->post('website'),
                'address1' => $this->ci->input->post('address1'),
                'address2' => $this->ci->input->post('address2'),
                'country' => $this->ci->input->post('country'),
                'postal_code' => $this->ci->input->post('zip'),
                'city' => $this->ci->input->post('town'),
                'vat_id' => $this->ci->input->post('vatId')
            );

            $new_pass_key = md5(rand() . microtime());

            // $values3 = array(
            // 	'password' 	=> 	$hashed_password
            // );

            $users = $this->ci->mod_portal->update_user_record($values1, $user_id);
            $company = $this->ci->mod_portal->update_company_record($values2, $user_id);
            $password = $this->ci->users->reset_password($user_id, $hashed_password, $new_pass_key, NULL);

            if ($users) {
                return $users;
            }
            if ($company) {
                return $company;
            }
            if ($condition) {
                return $password;
            }
        }
        return false;
    }

    /*
     * Pass user order data  viw details page.
     * Data pass by object.
     */

    function user_details_info($user_id) {
        $data = new stdClass();
        $data->count_total_orders_by_id = $this->ci->mod_admin->count_total_orders($user_id);
        $data->count_pending_orders = $this->ci->mod_admin->count_pending_orders($user_id);
        $data->count_completed_orders = $this->ci->mod_admin->count_completed_orders($user_id);
        $data->count_cancelled_orders = $this->ci->mod_admin->count_cancelled_orders($user_id);
        $data->count_reviewed_quote = $this->ci->mod_admin->count_reviewed_quote($user_id);
        $data->count_waiting_review = $this->ci->mod_admin->count_waiting_review($user_id);
        $data->count_accepted_quotes = $this->ci->mod_admin->count_accepted_quotes($user_id);
        $data->count_rejected_quotes = $this->ci->mod_admin->count_rejected_quotes($user_id);
        $data->count_paid_invoices = $this->ci->mod_admin->count_paid_invoices($user_id);
        $data->count_unpaid_invoices = $this->ci->mod_admin->count_unpaid_invoices($user_id);
        $data->total_due = number_format($this->ci->mod_admin->count_total_due($user_id), 2, '.', '');
        return $data;
    }

}
