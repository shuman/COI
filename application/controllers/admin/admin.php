<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller {

    public $user_profile;
    public $user_id;
    public $user_role;
    public $access_role;
    public $avatar;

    function __construct() {
        parent::__construct();

        $this->load->library('admin_lib');
        $this->load->model('mod_admin');
        $this->load->model('mod_portal');
        if (!$this->tank_auth->is_logged_in()) {
            redirect('/auth/login/?ref=' . urlencode(current_url()));
            exit();
        }
        $this->user_role = $this->tank_auth->get_role();
        if ($this->user_role != 'admin') {
            redirect('/', 'refresh');
            exit();
        }

        $this->user_id = $this->session->userdata('user_id');
        $this->user_profile = $this->mod_portal->get_user($this->user_id);
        $this->avatar = avatar();
        //$this->access_role   = $this->mod_portal->get_user_access_role($this->user_id);
    }

    function test() {
        $result = $this->admin_lib->load_company_by_recent_message();
        var_dump($result);
    }

    function display($title = '', $content = 'No Content') {
        $data['admin'] = TRUE;
        $data['title'] = (!empty($title)) ? $title : 'Cut Out Image Service Portal - Client Area';
        /* Template HTML */
        $html['content'] = $content;
        $html['header'] = $this->load->view('tpl_header', $data, TRUE);
        $html['topfixedbar'] = $this->load->view('admin/tpl_admin_topfixedbar', '', TRUE);
        $html['navigation'] = $this->load->view('admin/tpl_admin_navigation', '', TRUE);
        $html['footer'] = $this->load->view('tpl_footer', '', TRUE);

        $this->load->view('tpl_index', $html);
    }

    function index() {
        $title = "Admin Home";

        $content = $this->load->view("admin/page_admin_dashboard", '', TRUE);

        $this->display($title, $content);
    }

    function orders() {
        $title = lang('all_orders');
        $paged = (int) $this->uri->segment(3);
        $limit = 20; // 0 = Unlimited
        $orders = $this->admin_lib->get_orders($paged, $limit);
        $total_order = $this->mod_admin->count_total_orders();
        $data['user_id'] = $this->session->userdata('user_id');

        if ($total_order > $limit) {
            $this->load->library('pagination');

            $config['base_url'] = site_url('/admin/orders');
            $config['total_rows'] = $total_order;
            $config['per_page'] = $limit;
            $this->pagination->initialize($config);

            $data['pagination'] = $this->pagination->create_links();
            $data['total_order'] = $total_order;
            $paging_min = $paged + 1;
            $paging_max = $paged + $limit;
            $paging_max = ($total_order < $paging_max) ? $total_order : $paging_max;

            $data['showing'] = 'Showing ' . $paging_min . '-' . $paging_max . ' of ' . $total_order . ' orders';
        } else {
            $data['showing'] = 'Showing 1-' . $total_order . ' of ' . $total_order . ' orders';
        }

        $data['orders'] = $orders;
        $content = $this->load->view("admin/page_admin_orders", $data, TRUE);

        $this->display($title, $content);
    }

    /*
     * Admin Create & Custom New Order
     */

    function adminCreateOrder() {
        $title = "Admin Create Order.";
        $content = $this->load->view("admin/page_admin_custom_quotes.php", '', TRUE);
        $this->display($title, $content);
    }

    function quotes() {
        $title = lang('all_quotes');
        $paged = (int) $this->uri->segment(3);
        $limit = 20; // 0 = Unlimited

        $quotes = $this->admin_lib->get_quotes($paged, $limit);
        $total_quotes = $this->mod_admin->count_total_quotes();
        // echo "<pre>";
        // print_r($quotes);
        // exit();
        if ($total_quotes > $limit) {
            $this->load->library('pagination');

            $config['base_url'] = site_url('/admin/quotes');
            $config['total_rows'] = $total_quotes;
            $config['per_page'] = $limit;
            $this->pagination->initialize($config);

            $data['pagination'] = $this->pagination->create_links();
            $data['total_quotes'] = $total_quotes;
            $paging_min = $paged + 1;
            $paging_max = $paged + $limit;
            $paging_max = ($total_quotes < $paging_max) ? $total_quotes : $paging_max;

            $data['showing'] = 'Showing ' . $paging_min . '-' . $paging_max . ' of ' . $total_quotes . ' quotes';
        } else {
            $data['showing'] = 'Showing 1-' . $total_quotes . ' of ' . $total_quotes . ' quotes';
        }

        $data['quotes'] = $quotes;

        //var_dump($data); exit();
        $content = $this->load->view("admin/page_admin_quotes", $data, TRUE);

        $this->display($title, $content);
    }

    function invoices() {
        $title = lang('invoices');
        $paged = (int) $this->uri->segment(3);
        $limit = 20; // 0 = Unlimited

        $invoices = $this->admin_lib->get_invoices($paged, $limit);
        $total_invoices = $this->mod_admin->count_total_orders();

        if ($total_invoices > $limit) {
            $this->load->library('pagination');

            $config['base_url'] = site_url('/admin/invoices');
            $config['total_rows'] = $total_invoices;
            $config['per_page'] = $limit;
            $this->pagination->initialize($config);

            $data['pagination'] = $this->pagination->create_links();
            $data['total_invoices'] = $total_invoices;
            $paging_min = $paged + 1;
            $paging_max = $paged + $limit;
            $paging_max = ($total_invoices < $paging_max) ? $total_invoices : $paging_max;

            $data['showing'] = 'Showing ' . $paging_min . '-' . $paging_max . ' of ' . $total_invoices . ' invoices';

            // var_dump($data);
            // exit();
        } else {
            $data['showing'] = 'Showing 1-' . $total_invoices . ' of ' . $total_invoices . ' invoices';
        }

        $data['invoices'] = $invoices;
        // var_dump($data); exit();

        $content = $this->load->view("admin/page_admin_invoices", $data, TRUE);

        $this->display($title, $content);
    }

    function messages() {
        $title = 'Messages';
        $data['companies'] = $this->admin_lib->load_company_by_recent_message();

        $thread = $this->input->get('thread');
        if ($thread) {
            $data['thread'] = $thread;
            $single_data = $this->admin_lib->load_message_single($thread);
            $data['company'] = $single_data['company'];
            $data['messages'] = $single_data['messages'];
            $data['company_owner'] = $this->mod_portal->get_user($single_data['company']->user_id);
            ;
            $data['company_members'] = $this->portal_lib->get_company_members_by_id($single_data['company']->id, TRUE);
            $page_content = $this->load->view('admin/page_admin_message_single', $data, TRUE);

            $this->display($title, $page_content);
        } else {

            $company_id = (int) $this->input->get('company');

            $paged = (int) $this->input->get('paged');
            $limit = 20; // 0 = Unlimited

            if ($company_id > 0) {
                $threads = $this->admin_lib->load_message_threads($paged, $limit, $company_id);

                $total_threads = $this->mod_admin->count_message_threads($company_id);
                $config['base_url'] = site_url('/admin/messages') . '?company=' . $company_id;
            } else {
                $threads = $this->admin_lib->load_message_threads($paged, $limit);

                $total_threads = $this->mod_admin->count_message_threads();
                $config['base_url'] = site_url('/admin/messages') . '?company=all';
            }


            /* Pagination */
            if ($threads > $limit) {
                $this->load->library('pagination');

                $config['query_string_segment'] = 'paged';
                $config['page_query_string'] = TRUE;
                $config['total_rows'] = $total_threads;
                $config['per_page'] = $limit;
                $this->pagination->initialize($config);

                $data['pagination'] = $this->pagination->create_links();
                $data['total_threads'] = $total_threads;
                $paging_min = $paged + 1;
                $paging_max = $paged + $limit;
                $paging_max = ($total_threads < $paging_max) ? $total_threads : $paging_max;

                $data['showing'] = 'Showing ' . $paging_min . '-' . $paging_max . ' of ' . $total_threads . ' quotes';

                // var_dump($data);
                // exit();
            } else {
                $data['showing'] = 'Showing 1-' . $total_threads . ' of ' . $total_threads . ' quotes';
            }
            $data['threads'] = $threads;
            $page_content = $this->load->view('admin/page_admin_message_thread', $data, TRUE);

            $this->display($title, $page_content);
        }
    }

    function audit_log() {
        $title = 'Audit Log';
        $paged = (int) $this->uri->segment(3);
        $limit = 50; // 0 = Unlimited

        $logs = $this->mod_admin->get_audit_log($paged, $limit);
        $total_logs = $this->mod_admin->total_audit_log();

        if ($total_logs > $limit) {
            $this->load->library('pagination');

            $config['base_url'] = site_url('/admin/audit_log');
            $config['total_rows'] = $total_logs;
            $config['per_page'] = $limit;
            $this->pagination->initialize($config);

            $data['pagination'] = $this->pagination->create_links();
            $data['total_logs'] = $total_logs;
            $paging_min = $paged + 1;
            $paging_max = $paged + $limit;
            $paging_max = ($total_logs < $paging_max) ? $total_logs : $paging_max;

            $data['showing'] = 'Showing ' . $paging_min . '-' . $paging_max . ' of ' . $total_logs;
        } else {
            $data['showing'] = 'Showing 1-' . $total_logs . ' of ' . $total_logs;
        }

        $data['logs'] = $logs;
        $content = $this->load->view("admin/page_admin_audit_log", $data, TRUE);
        $this->display($title, $content);
    }

    /*
     * Admin create new user account
     */

    function add_new_user() {

        $title = "Add New Client";

        if (isset($_POST)) {

            $this->form_validation->set_rules('fullname', 'Fullname', 'trim|required|xss_clean||min_length[3]||is_unique[users.username]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email|is_unique[users.email]|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|min_length[5]|md5');
            $this->form_validation->set_rules('company', 'Company', 'trim|required|xss_clean|min_length[3]');
            $this->form_validation->set_rules('phone', 'phone', 'trim|required|xss_clean|min_length[9]');
            $this->form_validation->set_rules('website', 'Website', 'trim|required|xss_clean');
            $this->form_validation->set_rules('country', 'Country', 'trim|required|xss_clean');
            $this->form_validation->set_rules('address1', 'Address1', 'trim|required|xss_clean');
            $this->form_validation->set_rules('zip', 'Zip', 'trim|required|xss_clean');
            $this->form_validation->set_rules('town', 'Town', 'trim|required|xss_clean');
            $this->form_validation->set_rules('vatId', 'VatId', 'trim|xss_clean');

            if ($this->form_validation->run() == FALSE) {

                $content = $this->load->view('admin/page_admin_add_client', '', TRUE);
                $this->display($title, $content);
            } else {
                $res = $this->admin_lib->admin_create_user();

                if ($res) {

                    $creat_profile = $this->admin_lib->create_user_company_profile($res);

                    if ($creat_profile) {
                        $data['user_id'] = $res['user_id'];
                        $data['create'] = TRUE;
                        $content = $this->load->view('admin/success_message', $data, TRUE);
                        ;
                        $this->display($title, $content);
                    } else {
                        $this->load->model('users');
                        $this->users->delete_user($res['user_id']);
                    }
                }
            }
        }
    }

    /*
     * show all user list
     */

    function user_list() {

        $title = "Client List";
        $this->load->library('pagination');

        $offset = (int) $this->uri->segment(3);
        $limit = 20;

        $data['user_data'] = $this->mod_portal->get_users('', $limit, $offset);
        $total_users = $this->mod_portal->count_users();

        $config['base_url'] = site_url('/admin/user_list');
        $config['total_rows'] = $total_users;
        $config['per_page'] = $limit;

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $data['total_users'] = $total_users;
        $paging_min = $offset + 1;
        $paging_max = $offset + $limit;
        $paging_max = ($total_users < $paging_max) ? $total_users : $paging_max;

        $data['showing'] = 'Showing ' . $paging_min . '-' . $paging_max . ' of ' . $total_users . ' users';


        $content = $this->load->view('admin/page_admin_user_list', $data, TRUE);
        $this->display($title, $content);
    }

    /*
     * show single user info
     */

    function view_user_info($user_id) {

        $title = "User view Page";

        if ($user_id && !empty($user_id)) {

            $data['users_data'] = $this->mod_portal->get_users_by_id($user_id);
            $data['company_data'] = $this->mod_portal->company_by_userid($user_id);
            $data['order_details'] = $this->admin_lib->user_details_info($user_id);
            $data['success'] = TRUE;
        } else {
            $data['success'] = FALSE;
        }

        $this->load->view('admin/popup_user_details', $data);
    }

    /*
     * Get user information to update
     */

    function update_user_details_by_id($user_id) {

        $title = "User Data Update";

        if ($user_id && !empty($user_id)) {

            $data['user_data'] = $this->mod_portal->get_users_by_id($user_id);
            $data['company_data'] = $this->mod_portal->company_by_userid($user_id);

            $data['success'] = TRUE;
        } else {
            $data['success'] = FALSE;
        }

        $content = $this->load->view('admin/page_admin_add_client', $data, TRUE);
        $this->display($title, $content);
    }

    /*
     * User data update
     */

    function update_user_data($user_id) {

        $title = "Error form validation";

        if (isset($_POST)) {

            $this->form_validation->set_rules('fullname', 'Fullname', 'trim|required|xss_clean||min_length[3]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
            // $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|min_length[5]|md5');
            $this->form_validation->set_rules('company', 'Company', 'trim|required|xss_clean|min_length[3]');
            $this->form_validation->set_rules('phone', 'phone', 'trim|required|xss_clean|min_length[9]');
            $this->form_validation->set_rules('website', 'Website', 'trim|required|xss_clean');
            $this->form_validation->set_rules('country', 'Country', 'trim|required|xss_clean');
            $this->form_validation->set_rules('address1', 'Address1', 'trim|required|xss_clean');
            $this->form_validation->set_rules('zip', 'Zip', 'trim|required|xss_clean');
            $this->form_validation->set_rules('town', 'Town', 'trim|required|xss_clean');
            $this->form_validation->set_rules('vatId', 'VatId', 'trim|xss_clean');

            if ($this->form_validation->run() == FALSE) {

                $data['users_data'] = $this->mod_portal->get_users_by_id($user_id);
                $data['company_data'] = $this->mod_portal->company_by_userid($user_id);

                $content = $this->load->view('admin/page_admin_add_client', $data, TRUE);
                $this->display($title, $content);
            } else {

                $res = $this->admin_lib->update_user_data_by_id($user_id);
                if ($res) {
                    $title = "success!";
                    $data['user_id'] = $user_id;
                    $data['success'] = TRUE;

                    $content = $this->load->view('admin/success_message', $data, TRUE);
                    ;
                    $this->display($title, $content);
                    // redirect('/admin/user_list', 'refresh');
                    header("Refresh:3;url=" . site_url() . "/admin/user_list");
                }
            }
        }
    }

    function admin_ban_user($user_id) {

        if (!is_null($user_id)) {
            $data['user_id'] = $user_id;
            $this->load->view('admin/popup_ban_user', $data);
        }
    }

    function admin_unban_user($user_id) {

        if (!is_null($user_id)) {
            $this->load->model('users');
            $res = $this->users->unban_user($user_id);

            if ($res) {
                redirect('admin/user_list');
            }
            return FALSE;
        }
    }

    // Client profile details (Admin)
    function clientProfile($user_id) {
        $title = "User Information";

        // $data['user_id']       = $this->session->userdata('user_id');
        $data['user_profile'] = $this->mod_portal->get_user($user_id);
        $data['avatar'] = avatar();

        $content = $this->load->view('admin/page_admin_client_profile', $data, TRUE);
        $this->display($title, $content);
    }

    // Supplier Profile
    function suppliers_profile() {

        $title = "Client Profile Details";

        $data['user_id'] = $this->session->userdata('user_id');
        $data['user_profile'] = $this->mod_portal->get_user($this->user_id);
        $data['avatar'] = avatar();

        $content = $this->load->view('admin/page_admin_client_profile', $data, TRUE);
        $this->display($title, $content);
    }

    function edit_client_profile($user_id) {
        $this->load->view('admin/page_admin_edit_client_profile');
    }

    function popup_invoices() {
        $inv_id = $this->input->get('invoice');
        if (!empty($inv_id)) {
            $raw_id = substr($inv_id, 8);
            $order = $this->mod_portal->get_order_by_id("COI-$raw_id");
            $data['inv_id'] = $inv_id;
            $data['invoice_info'] = $order;
            $company_id = $order->company_id;
            $service_id = $order->service_id;
            $data['company'] = $this->mod_portal->get_company_by_id($company_id);
            $data['services'] = $this->mod_portal->get_services(array('service_id' => $order->service_id));

            if ($order->company_id != $data['company']->id) {
                redirect(site_url('admin/invoices'));
                exit();
            }
            // echo '<pre>';
            // print_r($data);
            // die();
            $this->load->view('admin/tpl_admin_invoice', $data);
        } else {
            $title = 'Invoices';
            $page_content = $this->load->view('page_invoices', '', TRUE);
            $this->display($title, $page_content);
        }
        // $this->load->view('admin/page_admin_view_invoices');
    }

    function popup_edit_invoices() {
        $this->load->view('admin/page_admin_edit_invoices');
    }

    function order_popup_complete() {
        $this->load->view('admin/popup_order_complete');
    }

    function edit_popup_order() {
        $order_id = $this->input->get('order_id');

        if (!empty($order_id)) {
            $data['order'] = $this->mod_admin->order_details($order_id);
            $data['success'] = TRUE;
        } else {
            $data['success'] = FALSE;
        }

        $this->load->view('admin/page_admin_edit_order', $data);
    }

    function admin_create_order() {
        $title = 'Admin Create Order';

        $content = $this->load->view('admin/page_admin_create_order', '', TRUE);
        $this->display($title, $content);
    }

    function admin_quote_order() {
        $title = 'Admin Create Quote';

        $content = $this->load->view('admin/page_admin_quote_order', '', TRUE);
        $this->display($title, $content);
    }

    function admin_create_invoices() {
        $title = 'Admin Create Invoices';

        $content = $this->load->view('admin/page_admin_create_invoices', '', TRUE);
        $this->display($title, $content);
    }

    function admin_send_message() {
        $title = 'Admin send Messages';
        $content = $this->load->view('admin/page_admin_compose_message', '', TRUE);
        $this->display($title, $content);
    }

    function white_listed_user() {
        $title = "User's white list";
        $data['user_email_list'] = $this->mod_portal->get_user_list();
        $data['user_data'] = $this->mod_portal->get_blacklisted_user();
        $content = $this->load->view('admin/page_white_listed_users', $data, TRUE);
        $this->display($title, $content);
    }

}
