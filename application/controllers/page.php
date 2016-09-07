<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Page extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        redirect(site_url());
    }

    function terms_of_service() {
        $data['title'] = 'Terms of Service';
        $data['header'] = $this->load->view('tpl_header', $data, TRUE);
        $data['content'] = $this->load->view('page_tos', $data, TRUE);
        $data['footer'] = $this->load->view('tpl_footer', $data, TRUE);
        $this->load->view('tpl_static_page', $data);
    }

    function download() {
        $this->load->helper('cookie');
        $this->load->library('email_lib');

        $error = '';

        $key = $this->input->get('key');
        if ($key) {
            $order_id = base64_decode($key);
            if (base64_encode($order_id) === $key) {

                $file = FCPATH . "downloads/" . $order_id . ".zip";

                if (file_exists($file)) {
                    $downloaded_id = $this->input->cookie('download', TRUE);
                    if (isset($downloaded_id) && $downloaded_id == $order_id){
                        //Skip send email
                    }
                    else{
                        $cookie = array(
                            'name'   => 'download',
                            'value'  => $order_id,
                            'expire' => '1800', //30min
                            'path'   => '/',
                            'secure' => TRUE
                        );
                        $this->input->set_cookie($cookie);
                        $this->mod_portal->update_download_counter($order_id);
                        $this->email_lib->admin_mail_order_downloaded(array('order_id' => $order_id));
                    }

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
                } else {
                    $error = "File not exist!";
                }
            } else {
                $error = "Invalid key format!";
            }
        } else {
            $error = "Download key missing!";
        }
        // show_404();
        $error = !empty($error) ? '?reason=' . urlencode($error) : '';
        redirect(site_url('/404') . $error, 'refresh');
    }

    function free_trial() {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Credentials: true");
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
        header('Access-Control-Max-Age: 1000');
        header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
        header('content-type: application/json; charset=utf-8');

        $key = $this->input->post('key');
        if (empty($key)) {
            die('Key Missing');
        }

        $this->form_validation->set_rules('service_opt[]', 'Service Options', 'trim|required');
        $this->form_validation->set_rules('return_file_format', 'Return File Format', 'trim|required|xss_clean');
        $this->form_validation->set_rules('service_occation', 'Use Of Service', 'trim|required|xss_clean');
        $this->form_validation->set_rules('service_type', 'Service Type', 'trim|required|xss_clean');
        $this->form_validation->set_rules('average_files', 'Average Files', 'trim|required|xss_clean');
        $this->form_validation->set_rules('instructions', 'Instructions', 'trim|required|xss_clean');
        $this->form_validation->set_rules('how_find_us', 'How You Find Us', 'trim|required|xss_clean');

        $this->form_validation->set_rules('fullname', 'Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|min_length[' . $this->config->item('password_min_length', 'tank_auth') . ']|max_length[' . $this->config->item('password_max_length', 'tank_auth') . ']');
        $this->form_validation->set_rules('conf_password', 'Confirm Password', 'trim|required|xss_clean|matches[password]');
        $this->form_validation->set_rules('company', 'Company', 'trim|required|xss_clean|min_length[3]');
        $this->form_validation->set_rules('country', 'Country', 'trim|required|xss_clean');
        $this->form_validation->set_rules('phone', 'phone', 'trim|required|xss_clean|min_length[9]');

        if ($this->form_validation->run()) {

            //Signup info
            $signup['fullname'] = $this->input->post('fullname');
            $signup['email'] = $this->input->post('email');
            $signup['password'] = $this->input->post('password');
            $signup['company'] = $this->input->post('company');
            $signup['country'] = $this->input->post('country');
            $signup['phone'] = $this->input->post('phone');


            $signup_response = $this->portal_lib->signup_by_trial($signup);

            if ($signup_response['status'] == "KO") {
                $output['status'] = "KO";
                $output['msg'] = $signup_response['msg'];
                echo json_encode($output);
                exit();
            }

            $user_id = $signup_response['user_id'];

            //Free trial entry to table
            $trial_entry["user_id"] = $user_id;
            $trial_entry["service_options"] = implode('|', $this->input->post("service_opt"));
            $trial_entry["return_file_format"] = $this->input->post('return_file_format');
            $trial_entry["quotation_request"] = $this->input->post('service_type');
            $trial_entry["service_needed"] = $this->input->post('service_occation');
            $trial_entry["avg_monthly_files"] = $this->input->post('average_files');
            $trial_entry["instructions"] = $this->input->post('instructions');
            $trial_entry["how_find_us"] = $this->input->post('how_find_us');
            $trial_entry["total_files"] = 1;
            $trial_entry["status"] = 'Pending';
            $trial_entry["posted_at"] = date("Y-m-d H:m:s");



            $entry_id = $this->mod_portal->insert_free_trial($trial_entry);

            if (!$entry_id) {
                $output['status'] = "KO";
                $output['msg'] = 'Free trial entry failed!';
                echo json_encode($output);
                exit();
            }

            $dir_name = 'COI-FT-' . $user_id;
            @rename("./free_trial/{$key}", "./free_trial/{$dir_name}");


            $email_data['user_id'] = $user_id;
            $email_data['fullname'] = $signup['fullname'];
            $email_data['company'] = $signup['company'];
            $email_data['country'] = $signup['country'];
            $email_data['phone'] = $signup['phone'];

            $this->load->library('email_lib');
            $this->email_lib->admin_mail_free_trial_requested($signup, $trial_entry, $dir_name);
            $this->email_lib->user_mail_free_trial_requested($signup['email'], $email_data);

            $this->mod_portal->audit_log('New trial request submitted');

            // Make logged in
            $this->session->set_userdata(array(
                'user_id' => $user_id,
                'username' => '',
                'role' => 2,
                'status' => STATUS_ACTIVATED,
            ));

            $output['status'] = "OK";
            $output['msg'] = "Success";
            echo json_encode($output);
            exit();
        } else {
            $output['status'] = 'KO';
            $output['msg'] = validation_errors();
        }
        echo json_encode($output);
        exit();
    }

    function trial_uploader() {
        if (!isset($_GET['key']) || empty($_GET['key'])) {
            die('Access denied');
        }

        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Credentials: true");
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
        header('Access-Control-Max-Age: 1000');
        header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
        header('content-type: application/json; charset=utf-8');

        $key = $_GET['key'];
        $path = './free_trial/' . $key;

        if (!@is_dir($path)) {
            @mkdir($path);
        }

        $config['upload_path'] = $path;
        // $config['allowed_types'] = '*';
        $config['allowed_types'] = "jpg|jpeg|png|psd|tiff|pdf|eps|ai|svg|3fr|ari|arw|srf|sr2|bay|crw|cr2|cap|iiq|eip|dcs|dcr|drf|k25|kdc|dng|erf|fff|mef|mdc|mos|mrw|nef|nrw|orf|pef|ptx|pxn|R3D|raf|raw|rw2|raw|rwl|dng|rwz|srw|x3f";
        $this->load->library('upload', $config);

        $field_name = "file";
        if (!$this->upload->do_multi_upload($field_name)) {
            $error = array('error' => $this->upload->display_errors());
            $output['msg'] = $error;
            $output['code'] = '';
            $output['status'] = 'KO';
        } else {
            $response = $this->upload->get_multi_upload_data();
            foreach ($response as $res) {
                $filenames[] = $res['file_name'];
                $file_url = base_url() . "free_trial/{$key}/" . $res['file_name'];
                $size = getimagesize($file_url);
                if ($size['mime'] == "image/gif" || $size['mime'] == "image/jpeg" || $size['mime'] == "image/png") {
                    $preview[] = base_url() . "assets/timthumb.php?src=free_trial/{$key}/" . $res['file_name'] . '&h=50&w=100';
                } else {
                    $preview[] = base_url() . "assets/images/icon-image.png";
                }
            }
            $output['debug'] = $size;
            $output['debug2'] = base_url() . "free_trial/{$key}/" . $res['file_name'];
            $output['filenames'] = $filenames;
            $output['preview'] = $preview;
            $output['status'] = 'OK';
        }

        echo json_encode($output);
    }

    function remove_trial_file() {
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');

        $output['status'] = 'KO';

        $key = $this->input->get('key');
        $filenames = $this->input->post('filenames');

        $filenames = (isset($_POST['filenames']) && !empty($_POST['filenames'])) ? $_POST['filenames'] : false;
        if ($filenames && $key) {
            foreach ($filenames as $filename) {
                $file_loc = FCPATH . 'free_trial/' . $key . '/' . $filename;
                if (file_exists($file_loc)) {
                    $output['status'] = 'OK';
                    unlink($file_loc);
                }
            }
        }

        echo json_encode($output);
        exit();
    }

    function page404() {
        show_404();
    }

}
