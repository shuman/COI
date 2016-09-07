<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Portal_lib {

    function __construct() {
        $this->ci = & get_instance();
    }

    /**
     * Actions=======
     * quote_accept
     * quote_reject
     */
    function notification($action_name, $action_value) {
        switch ($action_name) {
            case 'quote_accept':
                # code...
                break;

            case 'quote_reject':
                # code...
                break;

            default:
                # code...
                break;
        }
    }

    /**
     * @param paged int pagination
     * @param limit int
     */
    public function get_order($user_id, $company_id, $paged = 1, $limit = 10) {
        $table_data = array();
        $only_due_data = array();
        $filter = false;
        $orders = $this->ci->mod_portal->load_order($company_id, $paged, $limit);
        if ($orders) {
            $i = 0;
            foreach ($orders as $order) {
                $table_data[$i]['key_id'] = get_key($order->order_id);
                $get_o_id = substr($order->order_id, 0, -8) . date("j M, Y", strtotime($order->order_date));
                $table_data[$i]['order_id1'] = $get_o_id;
                $table_data[$i]['order_id'] = $order->order_id;
                $table_data[$i]['service_id'] = $order->service_id;
                $table_data[$i]['title'] = $order->order_title;
                $table_data[$i]['order_date'] = date("M d, Y", strtotime($order->order_date));
                $status = "";
                $flagstatus = true;
                if (!empty($order->complete_date)) {
                    $expiredValue = 30;
                    $completeDate = strtotime($order->complete_date);
                    $currentDate = strtotime(date('Y-m-d h:s:i'));
                    $value = floor(($currentDate - $completeDate) / (60 * 60 * 24));
                    if ($value > 30) {
                        $status = "Download Expired";
                        $flagstatus = false;
                    } else {
                        $status = 'Will Expire In ' . ($expiredValue - $value) . ' Days';
                    }
                }
                if ($order->order_status == ORDER_COMPLETED) {
                    $table_data[$i]['order_status'] = 'Completed';
                    $done_before = secondsToTime(strtotime($order->complete_date) - strtotime($order->order_date));
                    if ($order->turnaround_time > 0 && $done_before['h'] > $order->turnaround_time) {
                        $table_data[$i]['expired'] = true;
                    }
                    $table_data[$i]['date_diff_value'] = $value;
                    $table_data[$i]['complete_date'] = $status;
                    $table_data[$i]['flagstatus'] = $flagstatus;
                    $table_data[$i]['done_before'] = implode(':', $done_before);
                    $table_data[$i]['success'] = true;
                    $table_data[$i]['download_key'] = base64_encode($order->order_id);
                    $table_data[$i]['download_url'] = get_short_url(site_url('/download/') . '?key=' . base64_encode($order->order_id));
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
                $table_data[$i]['downloaded'] = sprintf("%02d", $order->downloaded);

                $i++;

                /* remove flexible items for only due items display */
                if (isset($_POST['due']) && !isset($_POST['order_status'])) {
                    if ($order->turnaround_time == 0) {
                        $i -= 1;
                        unset($table_data[$i]);
                    }
                }

                /* Skip filtered items */
                if (!isset($_POST['due']) && isset($_POST['order_status'])) { //Remove due item from array
                    $due_date = strtotime($order->order_date . " +" . $order->turnaround_time . " H");
                    if ($this->is_order_due(strtotime($order->order_date), $due_date, $order->order_status) && $order->turnaround_time > 0) {
                        $i -= 1;
                        unset($table_data[$i]);
                    }
                }
            }
            return $table_data;
        }
        return false;
    }

    /**
     * @param paged int pagination
     * @param limit int
     */
    public function get_quote_by_id($quote_id) {
        $quote_info = $this->ci->mod_portal->get_quote_by_quote_id($quote_id);
        if ($quote_info) {
            return $quote_info;
        } else {
            return false;
        }
    }

    /**
     * @param paged int pagination
     * @param limit int
     */
    public function get_quotes($user_id, $company_id, $paged = 1, $limit = 10, $filters = array()) {
        $table_data = array();
        $filter = false;


        $quotes = $this->ci->mod_portal->load_quotes($company_id, $paged = 1, $limit = 10, $filters);
        if ($quotes) {
            $i = 0;
            foreach ($quotes as $quote) {
                $table_data[$i]['key_id'] = get_key($quote->quote_id);
                $get_q_id = substr($quote->quote_id, 0, -8) . date("j  M, Y", strtotime($quote->quote_date));
                $table_data[$i]['quote_id1'] = $get_q_id;
                $table_data[$i]['quote_id'] = $quote->quote_id;
                $table_data[$i]['service_id'] = $quote->service_id;
                $table_data[$i]['title'] = $quote->quote_title;
                $table_data[$i]['quote_date'] = date("M d, Y", strtotime($quote->quote_date));

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
                $table_data[$i]['quantity'] = $quote->quantity;

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
    public function get_invoices($user_id, $company_id, $paged = 1, $limit = 10) {
        $table_data = array();
        $filter = false;


        $orders = $this->ci->mod_portal->load_all_orders($company_id, $paged, $limit);
        if ($orders) {
            $i = 0;
            foreach ($orders as $order) {
                $table_data[$i]['key_id'] = get_key($order->order_id);
                $table_data[$i]['invoice_id'] = str_replace("COI-", "COI-INV-", $order->order_id);
                $table_data[$i]['order_id'] = $order->order_id;
                $table_data[$i]['service_id'] = $order->service_id;
                $table_data[$i]['title'] = $order->order_title;
                $table_data[$i]['order_date'] = date("M d, Y", strtotime($order->order_date));

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

    public function get_notifications(&$notifications) {
        $company_id = $this->ci->company->id;
        $notifications->count_total_orders = $this->ci->mod_portal->count_total_orders($company_id);
        $notifications->count_pending_orders = $this->ci->mod_portal->count_pending_orders($company_id);
        $notifications->count_completed_orders = $this->ci->mod_portal->count_completed_orders($company_id);
        $notifications->count_cancelled_orders = $this->ci->mod_portal->count_cancelled_orders($company_id);
        $notifications->count_total_quotes = $this->ci->mod_portal->count_total_quotes($company_id);
        $notifications->count_reviewed_quote = $this->ci->mod_portal->count_reviewed_quote($company_id);
        $notifications->count_waiting_review = $this->ci->mod_portal->count_waiting_review($company_id);
        $notifications->count_accepted_quotes = $this->ci->mod_portal->count_accepted_quotes($company_id);
        $notifications->count_rejected_quotes = $this->ci->mod_portal->count_rejected_quotes($company_id);
        $notifications->count_paid_invoices = $this->ci->mod_portal->count_paid_invoices($company_id);
        $notifications->count_unpaid_invoices = $this->ci->mod_portal->count_unpaid_invoices($company_id);
        $notifications->count_messages = $this->ci->mod_portal->count_messages($company_id);
        $notifications->unread_messages = $this->ci->mod_portal->unread_messages($company_id);
        $notifications->total_due = number_format($this->ci->mod_portal->count_total_due($company_id), 2, '.', '');
        $notifications->total_paid = number_format($this->ci->mod_portal->count_total_paid($company_id), 2, '.', '');
        $notifications->total_managers = $this->ci->mod_portal->count_total_managers($company_id);
        $notifications->todays_order = $this->ci->mod_portal->count_todays_order($company_id);
        $notifications->weeks_order = $this->ci->mod_portal->count_weeks_order($company_id);
        $notifications->months_order = $this->ci->mod_portal->count_months_order($company_id);
        $notifications->total_files_processed = $this->ci->mod_portal->count_total_files_processed($company_id);
        $notifications->today_file_processed = $this->ci->mod_portal->count_todys_file_processed($company_id);
        $notifications->weeks_file_processed = $this->ci->mod_portal->count_weeks_file_processed($company_id);
        $notifications->months_file_processed = $this->ci->mod_portal->count_months_file_processed($company_id);
        return $notifications;
    }

    public function is_order_due($order_date, $due_date, $order_status) {
        if ($order_status == 1) {
            if ($due_date < time()) {
                return true;
            }
        }
        return false;
    }

    public function init_order() {
        $order_id = date("Ymd") . '-' . strtoupper(uniqid());
        return $order_id;
        /*
          $order_dir = FCPATH.'upload_temp/'.$order_id;

          if(!mkdir($order_dir)){
          die('directory create failed!');
          }
          return $order_id;
         */
    }

    /**
     * @param array POST values
     */
    public function place_new_order($data) {

        $user_id = $this->ci->user_id;
        $company_id = $this->ci->company->id;
        $order_id_tmp = $data['order_id'];
        if (!$user_id || !$order_id_tmp) {
            $output['msg'] = lang('order_id_expire_msg');
            $output['result'] = "KO";
            $output['refresh'] = true;
            echo json_encode($output);
            exit();
        }
        $res = $this->insert_service($data);
        if ($res) {
            $tat = isset($data['tat']) ? $data['tat'] : 48;

            $output['job_type'] = ''; //exception

            /* INSERT NEW QUOTE/ORDER */
            if ($data['payment_option'] == 'Request Quote') {
                $next_quote_id = $this->ci->mod_portal->get_quote_next_id();
// Generate new quoteid
                $oi['prefix'] = 'COI-QR';
                $oi['id'] = str_pad($next_quote_id, 6, '0', STR_PAD_LEFT);
                $oi['tat'] = ($tat < 1) ? 'FX' : $tat;
                $oi['user_id'] = str_pad($user_id, 5, '0', STR_PAD_LEFT);
                $oi['date'] = date("Ymd");

                $quoteid = implode('-', $oi);

                $insert_id = $this->insert_quote($user_id, $company_id, $quoteid, $res);
                if ($insert_id) {
                    if ($insert_id != $next_quote_id) {
                        $oi['id'] = str_pad($insert_id, 6, '0', STR_PAD_LEFT);
                        $quoteid_new = implode('-', $oi);
                        $this->ci->mod_portal->quote_update($quoteid, array('quote_id' => $quoteid_new));
                        $quoteid = $quoteid_new;
                    }
                    $upload_path = FCPATH . 'uploads';

                    $oldpath = FCPATH . 'upload_temp/' . $order_id_tmp;
                    $newpath = $upload_path . '/' . $quoteid;
                    if (!is_dir($upload_path)) {
                        mkdir($upload_path);
                    }
                    if (!is_dir($newpath)) {
                        mkdir($newpath);
                    }
//Move folder upload_temp to uploads folder 
                    rename($oldpath, $newpath);
                    $output['job_type'] = 'quote';
                    $output['quote_id'] = $quoteid;
                }
            } else {
                $next_order_id = $this->ci->mod_portal->get_order_next_id();
// Generate new order_id
                $oi['prefix'] = 'COI';
                $oi['id'] = str_pad($next_order_id, 6, '0', STR_PAD_LEFT);
                $oi['tat'] = ($tat < 1) ? 'FX' : $tat;
                $oi['user_id'] = str_pad($user_id, 5, '0', STR_PAD_LEFT);
                $oi['date'] = date("Ymd");

                $order_id = implode('-', $oi);

                $insert_id = $this->insert_order($user_id, $company_id, $order_id, $res);
                if ($insert_id) {
                    if ($insert_id != $next_order_id) {
                        $oi['id'] = str_pad($insert_id, 6, '0', STR_PAD_LEFT);
                        $order_id_new = implode('-', $oi);
                        $this->ci->mod_portal->quote_update($order_id, array('order_id' => $order_id_new));
                        $order_id = $order_id_new;
                    }

                    $upload_path = FCPATH . 'uploads';
                    $oldpath = FCPATH . 'upload_temp/' . $order_id_tmp;
                    $newpath = $upload_path . '/' . $order_id;
                    if (!is_dir($upload_path)) {
                        @mkdir($upload_path);
                    }
                    if (!is_dir($newpath)) {
                        @mkdir($newpath);
                    }
//Move folder upload_temp to uploads folder 
                    @rename($oldpath, $newpath);
                    $output['job_type'] = 'order';
                    $output['order_id'] = $order_id;
                }
            }
// $this->ci->session->unset_userdata('order_id');

            $output['service_id'] = $res['service_id'];
            return $output;
        } else {
            return false;
        }
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
        $CI = & get_instance();

        $CI->load->library('s3');

// Define credientials
        if (!defined('awsAccessKey'))
            define('awsAccessKey', 'AKIAIGZJPUUTGWEPZBRQ');
        if (!defined('awsSecretKey'))
            define('awsSecretKey', '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');

//instantiate the class
        $s3 = new S3(awsAccessKey, awsSecretKey);

        $sourceBucket = 'www-cutoutimage-com';
        $sourceKeyname = 'XX ALL TEMPORARY FILES/' . $folder;
        $targetBucket = 'www-cutoutimage-com';

        $contents = $s3->getBucket($sourceBucket, $sourceKeyname);
        if (!empty($contents)) {
            foreach ($contents as $eachItem) {
                if ($eachItem['size'] > 0) {
                    $name = explode('/', $eachItem['name']);
                    $targetKeyname = '01. ALL ORDERS/' . $orderId . '/MAIN/' . $name[1] . '/' . $name[2];
                    $s3->copyObject($sourceBucket, $eachItem['name'], $targetBucket, $targetKeyname);
                    $s3->deleteObject($sourceBucket, $eachItem['name']);
                }
            }
        }
    }

    /**
     * update_aws_quote function
     *
     * By providing foldername of bucket it will copy all content
     * and paste with new name and delete previous one
     *
     * @param string Folder name
     *
     * @return mixed
     * */
    function update_aws_quote($folder = 'F-UID-3-TI-1466591252756OID-398', $quoteId = null) {
        if (!$quoteId || empty($folder)) {
            return false;
        }

        // Load library
        $CI = & get_instance();

        $CI->load->library('s3');

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
                $targetKeyname = '02. ALL QUOTES/' . $quoteId . '/MAIN/' . $name[1];
                $s3->copyObject($sourceBucket, $eachItem['name'], $targetBucket, $targetKeyname);
                $s3->deleteObject($sourceBucket, $eachItem['name']);
            }
        }
    }

    public function insert_order($user_id, $company_id, $order_id, $data) {
        $values['user_id'] = $user_id;
        $values['company_id'] = $company_id;
        $values['order_id'] = $order_id;
        $values['service_id'] = $data['service_id'];
        $values['order_title'] = $data['job_title'];
        $values['order_desc'] = $data['job_desc'];
        $values['order_date'] = date("Y-m-d H:i:s", time());
        $values['order_quantity'] = $data['quantity'];
        $values['total_value'] = $data['total_value'];
        $values['aws_alias'] = $data['aws_alias'];
        $values['order_status'] = ORDER_PENDING;

        $insert = $this->ci->db->insert(ORDERS, $values);
        if ($insert) {
// Rename Aws File
            if ($values['aws_alias']) {
                $alias = explode('/', $values['aws_alias']);
                $this->update_aws($alias[1], $values['order_id']);
            }
            return $this->ci->db->insert_id();
        } else {
            return false;
        }
    }

    public function insert_quote($user_id, $company_id, $quoteid, $data) {

        $values['user_id'] = $user_id;
        $values['company_id'] = $company_id;
        $values['quote_id'] = strtoupper($quoteid);
        $values['service_id'] = $data['service_id'];
        $values['quote_title'] = $data['job_title'];
        $values['quote_desc'] = $data['job_desc'];
        $values['quote_date'] = date("Y-m-d H:i:s", time());
        $values['quantity'] = $data['quantity'];
        $values['total_value'] = $data['total_value'];
        $values['aws_alias'] = $data['aws_alias'];
        $values['quote_status'] = QUOTE_AWAITING;

        $insert = $this->ci->db->insert(QUOTES, $values);
        if ($insert) {
            // Rename Aws File
            if ($values['aws_alias']) {
                $alias = explode('/', $values['aws_alias']);
                $this->update_aws_quote($alias[0], $values['quote_id']);
            }
            return $this->ci->db->insert_id();
        } else {
            return false;
        }
    }

    public function insert_service($data) {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        exit();
        $user_id = $this->ci->user_id;
        $company_id = $this->ci->company->id;
        $order_id = $data['order_id'];
        if (!$user_id || !$order_id) {
            exit('Session expired');
        }
        if ($data['o_service'] == 'cutout') {
            $service_option = $data['service_option_cutout'];
            $bg_option = isset($data['cutout_bg_option']) ? $data['cutout_bg_option'] : 'CP Only';
            $bg_color = isset($data['cutout_bg_color']) ? $data['cutout_bg_color'] : '';
            ;
            $service_option_value = $data['image_complexity'];
            $service_flatness = isset($data['cutout_flatness']) ? $data['cutout_flatness'] : NULL;
        } else if ($data['o_service'] == 'masking') {
            $service_option = $data['service_option_mask'];
            $bg_option = $data['masking_bg_option'];
            $bg_color = $data['masking_bg_color'];
            $service_option_value = MASKING_VALUE;
            $service_flatness = $data['masking_flatness'];
        } else if ($data['o_service'] == 'retouch') {
            $service_option = $data['service_option_retouch'];
            $bg_option = $data['retouch_bg_option'];
            $bg_color = NULL;
            $service_option_value = RETOUCH_VALUE;
            $service_flatness = 0;
        } else {
            die('Tempered data!');
        }

        $file_type_value = 0;
        $return_file_type = $data['return_file_type'];
        if ($return_file_type) {
            foreach ($return_file_type as $file) {
                if ($file == 'PSD' || $file == 'TIFF') {
                    $file_type_value += FILE_TYPE;
                }
            }
        }
        //Count File
        $order_dir = FCPATH . 'upload_temp/' . $order_id;
        // $file_quantity = $this->count_dir_files($order_dir);
        $file_quantity = $data['quantity'];

        $service_id = strtoupper(uniqid());
        $job_title = $data['job_title'];
        $job_desc = $data['job_desc'];
        $service_type = isset($data['o_service']) ? $data['o_service'] : 'cutout';
        $image_complexity = isset($data['image_complexity']) ? $data['image_complexity'] : 2;
        $retouch_quality = isset($data['retouch_quality']) ? $data['retouch_quality'] : NULL;
        $shadow_option = isset($data['shadow_option']) ? $data['shadow_option'] : '';
        $shadow_option_value = isset($data['shadow_option_value']) ? $data['shadow_option_value'] : 0;
        $mannequin_option = isset($data['mannequin_option']) ? $data['mannequin_option'] : NULL;
        $mannequin_option_value = (isset($data['mannequin_option_value']) && $data['mannequin_option_value'] != 'none') ? $data['mannequin_option_value'] : 0;
        $straight_n_symmetric = isset($data['staight_value']) ? $data['staight_value'] : 0;
        $fix_imperfection = isset($data['brightness_value']) ? $data['brightness_value'] : 0;
        $fix_imperfection_note = isset($data['fix_imperfection_desc']) ? $data['fix_imperfection_desc'] : NULL;
        $photo_retouch = isset($data['retbasic_value']) ? $data['retbasic_value'] : '';
        $photo_retouch_value = isset($data['retbasic_value']) && $data['retbasic_value'] == 'Basic Photo Retouching' ? 1.0 : 0;
        $photo_retouching_note = isset($data['retouch_desc']) ? $data['retouch_desc'] : NULL;
        $cropping_resizing = isset($data['crop_resize']) ? $data['crop_resize'] : '';
        $cropping_resizing_value = (isset($data['crop_resize']) && $data['crop_resize'] == 'Variation (Upto 3)') ? CROP_RESIZE : 0;
        $cropping_resizing_note = isset($data['crop_resize_desc']) ? $data['crop_resize_desc'] : NULL;
        $color_correction = isset($data['color_fix']) ? $data['color_fix'] : '';
        $color_correction_value = (isset($data['color_fix']) && $data['color_fix'] == 'Basic Adjustment') ? 0.5 : 0;
        $color_correction_note = isset($data['color_fix_desc']) ? $data['color_fix_desc'] : NULL;
        $return_file_format = isset($data['return_file_type']) ? implode('|', $data['return_file_type']) : '';
        $return_file_format_value = $file_type_value;
        $turnaround_time = isset($data['tat']) ? $data['tat'] : 72;
        $quantity = $file_quantity;
        $aws_alias = $data['aws_alias'];
        $unit_price = ($service_option_value + $shadow_option_value +
                $mannequin_option_value +
                $straight_n_symmetric +
                $fix_imperfection +
                $cropping_resizing_value + $photo_retouch_value + $color_correction_value +
                $file_type_value
                );
        $total_value = $unit_price * $file_quantity;

        if ($image_complexity >= 7.00) {
            $image_complexity_txt = 'Complex';
        } else if ($image_complexity >= 3.50) {
            $image_complexity_txt = 'Advanced';
        } else if ($image_complexity >= 2.00) {
            $image_complexity_txt = 'Medium';
        } else if ($image_complexity >= 1.00) {
            $image_complexity_txt = 'Regular';
        } else if ($image_complexity >= 0.50) {
            $image_complexity_txt = 'Basic';
        } else {
            $image_complexity_txt = 'Custom';
        }
        $data = array(
            'service_id' => $service_id,
            'job_title' => $job_title,
            'job_desc' => $job_desc,
            'service_type' => $service_type,
            'service_option' => $service_option,
            'service_option_value' => $service_option_value,
            'bg_option' => $bg_option,
            'bg_color' => $bg_color,
            'image_complexity' => $image_complexity_txt,
            'service_flatness' => $service_flatness,
            'retouch_quality' => $retouch_quality,
            'shadow_option' => $shadow_option,
            'shadow_option_value' => $shadow_option_value,
            'mannequin_option' => $mannequin_option,
            'mannequin_option_value' => $mannequin_option_value,
            'straight_n_symmetric' => $straight_n_symmetric,
            'fix_imperfection' => $fix_imperfection,
            'fix_imperfection_note' => $fix_imperfection_note,
            'photo_retouch' => $photo_retouch,
            'photo_retouch_value' => $photo_retouch_value,
            'photo_retouch_note' => $photo_retouching_note,
            'cropping_resizing' => $cropping_resizing,
            'cropping_resizing_value' => $cropping_resizing_value,
            'cropping_resizing_note' => $cropping_resizing_note,
            'color_correction' => $color_correction,
            'color_correction_value' => $color_correction_value,
            'color_correction_note' => $color_correction_note,
            'return_file_format' => $return_file_format,
            'return_file_format_value' => $return_file_format_value,
            'turnaround_time' => $turnaround_time,
            'quantity' => $quantity,
            'unit_price' => $unit_price,
            'total_value' => $total_value
        );
        $insert = $this->ci->db->insert(SERVICES, $data);
        if ($insert) {
            $response['id'] = $this->ci->db->insert_id();
            $response['service_id'] = $service_id;
            $response['job_title'] = $job_title;
            $response['job_desc'] = $job_desc;
            $response['quantity'] = $quantity;
            $response['total_value'] = $total_value;
            $response['aws_alias'] = $aws_alias;
            return $response;
        } else {
            return false;
        }
    }

    /**
     * New function for insert Quote
     * @param array POST data
     */
    public function place_new_quote($data) {
//        echo "<pre>";
//        print_r($data);
//        echo "</pre>";
//        exit();
        $user_id = $this->ci->user_id;
        $company_id = $this->ci->company->id;
        $order_id_tmp = $data['order_id'];
        if (!$user_id || !$order_id_tmp) {
            $output['msg'] = lang('order_id_expire_msg');
            $output['result'] = "KO";
            $output['refresh'] = true;
            echo json_encode($output);
            exit();
        }
        $new_data = array();
        $new_data['order_id'] = $data['order_id'];
        $new_data['job_title'] = $data['job_title'];
        $new_data['job_desc'] = $data['job_desc'];

        // Generate new quoteid
        $next_quote_id = $this->ci->mod_portal->get_quote_next_id();
        $oi['prefix'] = 'COI-QR';
        $oi['id'] = str_pad($next_quote_id, 6, '0', STR_PAD_LEFT);
        $oi['tat'] = 'FX';
        $oi['user_id'] = str_pad($user_id, 5, '0', STR_PAD_LEFT);
        $oi['date'] = date("Ymd");

        $quoteid = implode('-', $oi);

        //Count File
        $order_dir = FCPATH . 'upload_temp/' . $order_id_tmp;
        $file_quantity = $this->count_dir_files($order_dir);

        /**
         * Prepare values
         */
        $service_id = strtoupper(uniqid());
        $job_title = $data['job_title'];
        $job_desc = $data['job_desc'];
        $service_type = 'cutout';
        $service_option = implode('|', $data['service_types']);
        $bg_option = $data['cutout_bg_option'];
        $bg_color = $data['cutout_bg_color'];
        $image_complexity_txt = 'none';
        $retouch_quality = $data['retouching_opt'];
        $return_file_format = (isset($data['return_file_type'])) ? implode('|', $data['return_file_type']) : '';
        $turnaround_time = 0;
        $quantity = $file_quantity;
        $aws_alias = $data['aws_alias'];
        $unit_price = 0;
        $total_value = 0;

        /**
         * Service value
         */
        $service_data['service_id'] = $service_id;
        $service_data['job_title'] = $job_title;
        $service_data['job_desc'] = $job_desc;
        $service_data['service_type'] = $service_type;
        $service_data['service_option'] = $service_option;
        $service_data['bg_option'] = $bg_option;
        $service_data['bg_color'] = $bg_color;
        $service_data['image_complexity'] = $image_complexity_txt;
        $service_data['retouch_quality'] = $retouch_quality;
        $service_data['return_file_format'] = $return_file_format;
        $service_data['turnaround_time'] = $turnaround_time;
        $service_data['quantity'] = $quantity;
        $service_data['unit_price'] = $unit_price;
        $service_data['total_value'] = $total_value;

        $insert = $this->ci->db->insert(SERVICES, $service_data);
        if ($insert) {
            $response['id'] = $this->ci->db->insert_id();
            $response['service_id'] = $service_id;
            $response['job_title'] = $job_title;
            $response['job_desc'] = $job_desc;
            $response['quantity'] = $quantity;
            $response['total_value'] = $total_value;
            $response['job_type'] = 'quote';
            $response['quote_id'] = $quoteid;


            $quote_data['service_id'] = $service_id;
            $quote_data['job_title'] = $job_title;
            $quote_data['job_desc'] = $job_desc;
            $quote_data['quantity'] = $quantity;
            $quote_data['aws_alias'] = $aws_alias;
            $quote_data['total_value'] = $total_value;

            $quote_insert_id = $this->insert_quote($user_id, $company_id, $quoteid, $quote_data);
            if ($quote_insert_id) {
                return $response;
            }
        }

        return false;
    }

    public function removeDir($dir) {
        $user_id = $this->ci->session->userdata('user_id');

        if (empty($dir) || !$user_id) {
            return false;
        }


        $path = FCPATH . 'uploads/' . $user_id . '/' . $dir;
// Normalise $path.
        $path = rtrim($path, '/') . '/';
// Remove all child files and directories.
        $items = glob($path . '*');

        foreach ($items as $item) {
            is_dir($item) ? $this->removeDir($item) : unlink($item);
        }

// Remove directory.
        if (is_dir($path)) {
            @rmdir($path);
        }
    }

    public function count_dir_files($order_dir) {
        $i = 0;
        if (is_dir($order_dir)) {
            if ($handle = opendir($order_dir)) {
                while (($file = readdir($handle) ) !== false) {
                    if (!in_array($file, array('.', '..')) && !is_dir($order_dir . $file)) {
                        $i++;
                    }
                }
            }
        }
        return $i;
    }

    public function get_company_info($user_id) {
        $res = $this->ci->mod_portal->company_by_userid($user_id);
        if ($res) {
            return $res;
        }
        return false;
    }

    /**
     * Description: Get company info by company id
     * @param $company_id int
     */
    public function get_company_by_id($company_id) {
        $res = $this->ci->mod_portal->get_company_by_id($company_id);
        if ($res) {
            return $res;
        }
        return false;
    }

    /*
     * Description: Get settign data from database and prepare as array
     * @param 	$user_id 	int
     */

    public function set_setting($user_id, $name, $value) {
        $results = $this->ci->mod_portal->set_setting($user_id, $name, $value);
        if ($results) {
            $settings = array();
            foreach ($results as $result) {
                $settings[$result->settings_name] = $result->settings_value;
            }
            return $settings;
        }
        return false;
    }

    /*
     * Description: Get settign data from database and prepare as array
     * @param 	$user_id 	int
     */

    public function get_settings($user_id) {
        $results = $this->ci->mod_portal->get_settings($user_id);
        if ($results) {
            $settings = array();
            foreach ($results as $result) {
                $settings[$result->settings_name] = $result->settings_value;
            }
            return $settings;
        }
        return false;
    }

    /**
     * Description: Get members/employee under the company. Excluding owner info.
     * @param $user_id 	int 	
     */
    public function get_company_members_by_userid($user_id) {
        $company = $this->get_company_info($user_id);

        if ($company) {

            $members = $this->get_company_members_by_id($company->id);
            return $members;
        }
        return false;
    }

    /**
     * Description: Get members/employee under the company. Excluding owner info.
     * @param $company_id 	int 	
     */
    public function get_company_members_by_id($company_id, $active_only = false) {

        $results = $this->ci->mod_portal->get_company_members($company_id, $active_only);
        if ($results) {
            return $results;
        }
        return false;
    }

    /**
     * Description: Get my associated company list. Exclude my company
     * @param $user_id 		int 	
     */
    public function get_companies_by_user_id($user_id) {
        $results = $this->ci->mod_portal->get_companies_by_user_id($user_id);
        if ($results) {
            return $results;
        }
        return false;
    }

    /**
     * @return array mixed
     */
    public function get_company_permission($user_id, $company_id) {
        $res = $this->ci->mod_portal->get_company_member_data($user_id, $company_id);
        if ($res) {
            return json_decode($res['permissions'], true);
        } else {
            return false;
        }
    }

    /**
     * Description: Get my associated company list. Exclude my company
     * @param $user_id 		int 	
     */
    public function get_user_profile_by_order_id($order_id) {
        $order_info = $this->ci->mod_portal->get_order_by_id($order_id);
        if ($order_info) {
            $user_id = $order_info->user_id;
            $user_info = $this->ci->mod_portal->get_user($user_id);
            if ($user_info) {
                return $user_info;
            }
        }
        return false;
    }

    /**
     * Description: Get my associated company list. Exclude my company
     * @param string 	$order_id
     */
    public function get_owner_profile_by_order_id($order_id) {
        $order_info = $this->ci->mod_portal->get_order_by_id($order_id);
        if ($order_info) {
            $company_id = $order_info->company_id;

            $company_info = $this->ci->mod_portal->get_company_by_id($company_id);
            if ($company_info) {
                $owner_id = $company_info->user_id;
                $owner_info = $this->ci->mod_portal->get_user($owner_id);
                return $owner_info;
            }
        }
        return false;
    }

    /**
     * Description: Get my associated company list. Exclude my company
     * @param $quote_id 		int // Atik Edits this function	
     */
    public function get_user_profile_by_quote_id($quote_id) {
        $quote_info = $this->ci->mod_portal->get_quote_by_quote_id($quote_id);
        if ($quote_info) {
            $user_id = $quote_info->user_id;
            $user_info = $this->ci->mod_portal->get_user($user_id);
            if ($user_info) {
                return $user_info;
            }
        }
        return false;
    }

    /**
     * Description: Get my associated company list. Including me (I'm involved with)
     * @param $user_id 		int
     */
    public function get_my_companies($user_id) {
        $company = $this->get_company_info($user_id);

        $all_company = $this->get_companies_by_user_id($user_id);
        if ($all_company) {
            if ($company) {
                array_unshift($all_company, $company);
                return $all_company;
            } else {
                return $all_company;
            }
        } else {
            return array($company);
        }
    }

    /**
     * @param $data 		array 		mixed
     * @return string
     */
    public function generate_invite_key($data) {
        $unique_key = md5(uniqid(rand(), true));
        $values['invite_by'] = $data['invited_by_id'];
        $values['invite_for'] = $data['company_id'];
        $values['invite_to'] = $data['invite_to_email'];
        $values['invite_to_name'] = $data['invite_to_name'];
        $values['invite_key'] = $unique_key;

        $res = $this->ci->mod_portal->add_user_invite($values);
        if ($res) {
            return $unique_key;
        }
        return false;
    }

    public function is_blocked_user($user_id, $ip) {
        $black_listed_countries = array('BD', 'IND', 'PAK');

        if ($this->ci->mod_portal->is_bloced_by_country($user_id, $black_listed_countries)) {
            return TRUE;
        }

        $url = 'http://freegeoip.net/json/' . $ip;
        //  Initiate curl
        $ch = curl_init();
        // Disable SSL verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Set the url
        curl_setopt($ch, CURLOPT_URL, $url);
        // Execute
        $result = curl_exec($ch);
        // Closing
        curl_close($ch);

        // Will dump a beauty json :3
        $data = json_decode($result, true);

        if (is_array($data)) {
            $my_country = $data['country_code'];
            if (in_array($my_country, $black_listed_countries)) {
                $is_whitelisted = $this->ci->mod_portal->is_whitelisted_user($user_id);
                if ($is_whitelisted) {
                    // The user is white listed. Not blocked
                    return FALSE;
                } else {
                    // The user is black listed. Blocked user
                    return TRUE;
                }
            }
        }
        return FALSE;
    }

    /**
     * Description: set cookie
     * @param string
     * @param array/string
     * @return boolean
     */
    public function set_cookie($name, $data) {
        if (is_array($data)) {
            $value = json_encode($data, true);
        } else {
            $value = $data;
        }
        $cookie = array(
            'name' => $name,
            'value' => $value,
            'expire' => 6 * 30 * 24 * 60 * 60, //6mo * mo * h * m * s
            'domain' => '',
            'path' => '/',
            'prefix' => '',
            'secure' => false
        );
        delete_cookie($name);
        $this->ci->input->set_cookie($cookie);
        return true;
    }

    /**
     * @return object/string
     */
    public function get_cookie($name) {
        $cookie = $this->ci->input->cookie($name);
        if ($cookie) {
            $cookie = stripslashes($cookie);
            $data_arr = json_decode($cookie);
            if ($data_arr) {
                return $data_arr;
            } else {
                return $cookie;
            }
        } else {
            return false;
        }
    }

    /**
     * Description: set cookie
     * @param $comArray 	object/array 	company info
     * @return boolean
     */
    public function set_active_company($comArray) {
        $json = json_encode($comArray, true);
        $cookie = array(
            'name' => 'company',
            'value' => $json,
            'expire' => 6 * 30 * 24 * 60 * 60, //6mo * mo * h * m * s
            'domain' => '',
            'path' => '/',
            'prefix' => '',
            'secure' => false
        );
        delete_cookie("company");
        $this->ci->input->set_cookie($cookie);
        return true;
    }

    /**
     * Description: Retrive company data from cookie. If not set default 
     * @return object
     */
    public function get_active_company() {
        $company = $this->get_company_info($this->ci->user_id);
        $cookie = $this->ci->input->cookie('company');

        if ($cookie) {
            $cookie = stripslashes($cookie);
            $comArray = json_decode($cookie);
            $has_access = $this->ci->mod_portal->check_company_access($this->ci->user_id, $comArray->id);

            if ($has_access == true || (isset($company->id) && $company->id == $comArray->id)) {
                return $comArray;
            }
        }

//Set default
        $company_arr['id'] = $company->id;
        $company_arr['name'] = $company->name;
        $company_arr['user_id'] = $company->user_id; //Owner
        $this->set_active_company($company_arr);
        return $company;
    }

    /**
     * Description: Get invited users list
     * @return object
     */
    public function get_invited_users_by_company_id($user_id) {
        $res = $this->ci->mod_portal->invited_users_by_company_id($user_id);
        if ($res) {
            return $res;
        } else {
            return false;
        }
    }

    public function check_invite_key($key) {
        $res = $this->ci->mod_portal->get_invited_user_by_key($key);
        if ($res) {
            return $res;
        } else {
            return false;
        }
    }

    public function check_billing() {
        $company = $this->get_company_info($this->ci->user_id);

        if (empty($company->name) || empty($company->address1) || empty($company->postal_code) || empty($company->city) || empty($company->phone)) {
            return false;
        }
        return true;
    }

    /**
     * Description: set cookie
     * @param $comArray 	object/array 	company info
     * @return boolean
     */
    public function set_invitation_cookie($invite_ref) {
        $cookie = array(
            'name' => 'invite_ref',
            'value' => $invite_ref,
            'expire' => 6 * 30 * 24 * 60 * 60, //6mo * mo * h * m * s
            'domain' => '',
            'path' => '/',
            'prefix' => '',
            'secure' => false
        );
        delete_cookie("invite_ref");
        $this->ci->input->set_cookie($cookie);
        return true;
    }

    /**
     * Load message from db
     * @return object
     */
    public function load_messages($limit = 10) {
        $filter['msg_company_id'] = $this->ci->company->id;
        $filter['msg_parent_id'] = NULL;

        $messages = $this->ci->mod_portal->get_messages($filter, $limit);
        if ($messages) {
            $i = 0;
            foreach ($messages as $message) {
                $company = $this->get_company_by_id($message->msg_company_id);
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

    /**
     * Load message from db
     * @return object
     */
    public function load_message_threads() {
        $filter['msg_company_id'] = $this->ci->company->id;
        $filter['msg_parent_id'] = NULL;
        $search = $this->ci->input->get('search');

        $messages = $this->ci->mod_portal->get_message_thread($filter, $search);
        if ($messages) {
            $i = 0;
            foreach ($messages as $message) {
                $company = $this->get_company_by_id($message->msg_company_id);
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

        $messages = $this->ci->mod_portal->get_messages_by_id($thread);
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

    public function quote_to_order($user_id, $company_id, $quote_id, $service_id, $order_id_tmp) {

        $service = $this->ci->mod_portal->get_service_by_id($service_id);
        if ($service) {
            $next_order_id = $this->ci->mod_portal->get_order_next_id();

            $unit_price = $service->unit_price;

            $oi['prefix'] = 'COI';
            $oi['id'] = str_pad($next_order_id, 6, '0', STR_PAD_LEFT);
            $oi['tat'] = $service->turnaround_time;
            $oi['user_id'] = $user_id;
            $oi['date'] = date("Ymd");

            $order_id = implode('-', $oi);

// Get Image quantity
            $upload_temp_dir = FCPATH . 'upload_temp/' . $order_id_tmp;
            $file_quantity = $this->count_dir_files($upload_temp_dir);

            $values['user_id'] = $user_id;
            $values['company_id'] = $company_id;
            $values['service_id'] = $service_id;
            $values['order_id'] = $order_id;
            $values['order_title'] = $service->job_title;
            $values['order_desc'] = $service->job_desc;
            $values['order_date'] = date("Y-m-d H:i:s", time());
            $values['quantity'] = $file_quantity;
            $values['total_value'] = $unit_price * $file_quantity;
            $values['order_status'] = ORDER_PENDING;

            $res = $this->ci->db->insert(ORDERS, $values);
            if (!$res) {
                return false;
            }

            $insert_id = $this->ci->db->insert_id();

            if ($insert_id != $next_order_id) {
                $oi['id'] = str_pad($insert_id, 6, '0', STR_PAD_LEFT);
                $order_id_new = implode('-', $oi);
                $this->ci->mod_portal->quote_update($order_id, array('order_id' => $order_id_new));
                $order_id = $order_id_new;
            }


// Move folder
            $upload_path = FCPATH . 'uploads';
            $oldpath = FCPATH . 'upload_temp/' . $order_id_tmp;
            $newpath = $upload_path . '/' . $order_id;
            if (!is_dir($upload_path)) {
                mkdir($upload_path);
            }
            if (!is_dir($newpath)) {
                mkdir($newpath);
            }
//Move folder upload_temp to uploads folder 
            @rename($oldpath, $newpath);
// $this->ci->session->unset_userdata('order_id');

            return $order_id;
        }
    }

    public function signup_by_trial($data) {
        $result = array();
        $result['status'] = "KO";

        if ($this->ci->tank_auth->is_logged_in()) {
            $result['msg'] = "You are already logged in. Please go to portal and request a quote.";
// $result['user_id'] = $this->ci->session->userdata('user_id');
        } elseif ($this->ci->tank_auth->is_logged_in(FALSE)) {
            $result['msg'] = lang('msg_9');
        } else {

            $this->ci->form_validation->set_rules('fullname', 'Name', 'trim|required|xss_clean');
            $this->ci->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
            $this->ci->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|min_length[' . $this->ci->config->item('password_min_length', 'tank_auth') . ']|max_length[' . $this->ci->config->item('password_max_length', 'tank_auth') . ']');
            $this->ci->form_validation->set_rules('conf_password', 'Confirm Password', 'trim|required|xss_clean|matches[password]');
            $this->ci->form_validation->set_rules('company', 'Company', 'trim|required|xss_clean|min_length[3]');
            $this->ci->form_validation->set_rules('country', 'Country', 'trim|required|xss_clean');
            $this->ci->form_validation->set_rules('phone', 'phone', 'trim|required|xss_clean|min_length[9]');

            if ($this->ci->form_validation->run()) {
                $username = '';
                $email = $this->ci->form_validation->set_value('email');
                $password = $this->ci->form_validation->set_value('password');

                if ($this->ci->users->is_email_available($email)) {
                    $data = $this->ci->tank_auth->create_user($username, $email, $password, false);
                    if (!is_null($data)) {
                        $profile['fullname'] = $this->ci->form_validation->set_value('fullname');
                        $profile['company'] = $this->ci->form_validation->set_value('company');
                        $profile['country'] = $this->ci->form_validation->set_value('country');
                        $profile['phone'] = $this->ci->form_validation->set_value('phone');
                        $this->ci->users->update_profile($data['user_id'], $profile);

                        //Create new Company
                        $company['company'] = $this->ci->form_validation->set_value('company');
                        $company['country'] = $this->ci->form_validation->set_value('country');
                        $company['phone'] = $this->ci->form_validation->set_value('phone');
                        $this->ci->users->create_company($data['user_id'], $company);


                        $result['status'] = "OK";
                        $result['user_id'] = $data['user_id'];
                        $result['msg'] = 'Success';
                    } else {
                        $result['msg'] = validation_errors();
                    }
                } else {
                    $result['msg'] = 'User already registered with this email address.';
                }
            } else {
                $result['msg'] = validation_errors();
            }
        }

        return $result;
    }

    function aircallAPI($values) {
        $api_id = '5d735743d58411a70aed99282f14fb51';
        $api_token = '4eee8a3b71e4d1dbcc0ecddbea5bb0e1';
        $endpoint = "https://{$api_id}:{$api_token}@api.aircall.io/v1/contacts";

        $id = time();
        $field_data = array(
            "id" => $id,
            "direct_link" => "https://api.aircall.io/v1/contacts/$id",
            "first_name" => $values['first_name'],
            "last_name" => $values['last_name'],
            "information" => "Company:" . $values['company'] . " Country:" . $values['country'],
            "phone_numbers" => array(
                array("label" => "Work", "value" => $values['phone']),
            ),
            "emails" => array(
                array("label" => "Work", "value" => $values['email']),
            )
        );

        $json_data = json_encode($field_data);

        $ch = curl_init();
        $options = array(
            CURLOPT_HTTPHEADER => array('Content-Type: application/json', 'Content-Length: ' . strlen($json_data)),
            CURLOPT_URL => $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $json_data,
            CURLOPT_ENCODING => "",
            CURLOPT_AUTOREFERER => true,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_CONNECTTIMEOUT => 120,
            CURLOPT_TIMEOUT => 120,
            CURLOPT_MAXREDIRS => 10,
        );

        curl_setopt_array($ch, $options);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($httpCode != 200) {
            // echo "Return code is {$httpCode} \n".curl_error($ch);
            // echo '<pre>';
            // print_r($response);
            // echo '</pre>';
            $result = false;
        } else {
            // echo "<pre>".htmlspecialchars($response)."</pre>";
            $result = true;
        }
        curl_close($ch);
        return $result;
    }

}
