<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mod_Portal extends CI_Model {

    private $user_table = USERS;   // user accounts
    private $profile_table = USER_PROFILES; // user profiles
    private $order_table = ORDERS;
    private $quote_table = QUOTES;
    private $service_table = SERVICES;
    private $company_table = COMPANY;
    private $company_member_table = COMPANY_MEMBER;
    private $user_invite_table = USER_INVITE;
    private $payment_table = PAYMENT;
    private $messages_table = MESSAGES;
    private $message_status_table = MESSAGE_STATUS;
    private $log_table = AUDIT_LOG;

    function __construct() {
        parent::__construct();

        $ci = & get_instance();
        if (!isset($this->user_profile) || empty($this->user_profile)) {
            
        }
        $this->user_profile = $this->get_user($this->session->userdata('user_id'));
    }

    /**
     * Audit Log
     * @param key
     * @param value
     */
    function audit_log($action, $info = '', $user_id = '', $fullname = '') {
        if (empty($action)) {
            return false;
        }

        if ($user_id == '') {
            if (!isset($this->user_profile)) {
                return false;
            }
            $user_id = $this->user_profile->user_id;
        }
        if ($fullname == '') {
            $fullname = $this->user_profile->fullname;
        }

        $info = is_array($info) ? print_r($info, TRUE) : $info;

        $values['user_id'] = $user_id;
        $values['user_name'] = $fullname;
        $values['action'] = $action;
        $values['info'] = $info;
        return $this->db->insert($this->log_table, $values);
    }

    function get_user($id) {
        $this->db->where("{$this->user_table}.id", $id);
        $this->db->from($this->user_table);
        $this->db->join($this->profile_table, "{$this->profile_table}.user_id = {$this->user_table}.id");

        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->row();
        }
        return NULL;
    }

    /**
     * Update user & company record by Id
     *
     * @param	data user id
     * @return	update user data
     */
    function update_company_record($data, $user_id) {

        $this->db->where('id', $user_id);
        $query = $this->db->get($this->company_table);
        if ($query->num_rows() > 0) {
            $this->db->where('id', $user_id);
            return $this->db->update($this->company_table, $data);
        }
        return false;
    }

    function update_user_record($data, $user_id) {
        $this->db->where('id', $user_id);
        $query = $this->db->get($this->user_table);
        if ($query->num_rows() > 0) {
            $this->db->where('id', $user_id);
            return $this->db->update($this->user_table, $data);
        }
        return false;
    }

    function count_users() {

        $query = $this->db->get($this->user_table);
        return $query->num_rows();
    }

    function get_users($ids = array(), $limit = FALSE, $offset = FALSE) {

        $this->db->from($this->user_table);
        $this->db->join($this->profile_table, "{$this->profile_table}.user_id = {$this->user_table}.id");
        if (!empty($ids)) {
            $this->db->where_in("{$this->user_table}.id", $ids);
        }
        $this->db->distinct();
        if ($limit) {
            if ($offset) {
                $this->db->limit($limit, $offset);
            } else {
                $this->db->limit($limit);
            }
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return NULL;
    }

    /*
     * Get User information by id
     * Get User Data by row.
     */

    function get_users_by_id($ids) {
        $this->db->from($this->user_table);
        $this->db->join($this->profile_table, "{$this->profile_table}.user_id = {$this->user_table}.id");
        $this->db->where_in("{$this->user_table}.id", $ids);
        $this->db->distinct();
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return NULL;
    }

    function get_user_by_email($email) {
        //$this->db->where("{$this->user_table}.id", $id);
        $this->db->where("LOWER({$this->user_table}.email)=", strtolower($email));
        $this->db->from($this->user_table);
        $this->db->join($this->profile_table, "{$this->profile_table}.user_id = {$this->user_table}.id");

        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->row();
        }
        return NULL;
    }

    function get_services($where = array()) {
        if (!empty($where)) {
            $this->db->where($where);
        }
        $query = $this->db->get($this->service_table);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_service_by_id($service_id) {
        $this->db->where('service_id', $service_id);
        $query = $this->db->get($this->service_table);

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    function get_order_by_id($order_id) {
        $this->db->where('order_id', $order_id);
        $query = $this->db->get($this->order_table);

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    function order_details($order_id, $company_id) {

        $this->db->from($this->order_table);
        $this->db->join($this->service_table, "{$this->service_table}.service_id = {$this->order_table}.service_id", 'left');
        $this->db->where($this->order_table . '.order_id', $order_id);
        $this->db->where($this->order_table . '.company_id', $company_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }

    function order_update($order_id, $values) {
        $this->db->where('order_id', $order_id);
        $query = $this->db->get($this->order_table);
        if ($query->num_rows() > 0) {
            $this->db->where('order_id', $order_id);
            return $this->db->update($this->order_table, $values);
        }
        return false;
    }

    function load_all_orders($company_id, $paged, $limit) {
        $filter = false;

        $this->db->where($this->order_table . '.company_id', $company_id);

        if (isset($_POST['keyword']) && strlen($_POST['keyword']) > 1) {
            $this->db->like($this->order_table . '.order_title', $this->input->post('keyword'));
            $this->db->or_like($this->order_table . '.order_id', $this->input->post('keyword'));
        }
        if (isset($_POST['period']) && $_POST['period'] != 'all') {
            $current = date("Y-m-d H:i:s", time());
            $today_start = date("Y-m-d", time()) . ' 00:00:00';
            $week_start = date("Y-m-d", strtotime("-7 days")) . ' 00:00:00';
            $month_start = date("Y-m-d", strtotime("-1 month")) . ' 00:00:00';

            if ($_POST['period'] == 'today') {
                $this->db->where($this->order_table . '.order_date >=', $today_start);
            }
            if ($_POST['period'] == 'week') {
                $this->db->where($this->order_table . '.order_date >=', $week_start);
            }
            if ($_POST['period'] == 'month') {
                $this->db->where($this->order_table . '.order_date >=', $month_start);
            }
        }
        $paid = $this->input->post('paid');
        $unpaid = $this->input->post('unpaid');
        if ($paid && !$unpaid) {
            $this->db->where($this->order_table . '.payment_status', 1);
        }

        if ($unpaid && !$paid) {
            $this->db->where($this->order_table . '.payment_status', 0);
        }

        $this->db->from($this->order_table);
        $this->db->join($this->service_table, "{$this->service_table}.service_id = {$this->order_table}.service_id", 'left');
        $this->db->order_by($this->order_table . ".order_date", "DESC");
        $this->db->limit($limit);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }

    function load_order($company_id, $paged, $limit) {
        $filter = false;
        $this->db->from($this->order_table);
        $this->db->join($this->service_table, "{$this->service_table}.service_id = {$this->order_table}.service_id", 'left');

        $this->db->where($this->order_table . '.company_id', $company_id);

        if (isset($_POST['keyword']) && strlen($_POST['keyword']) > 1) {
            $this->db->like($this->order_table . '.order_title', $_POST['keyword']);
            $this->db->or_like($this->order_table . '.order_id', $_POST['keyword']);
        }
        if (isset($_POST['period']) && $_POST['period'] != 'all') {
            $current = date("Y-m-d H:i:s", time());
            $today_start = date("Y-m-d", time()) . ' 00:00:00';
            $week_start = date("Y-m-d", strtotime("-7 days")) . ' 00:00:00';
            $month_start = date("Y-m-d", strtotime("-1 month")) . ' 00:00:00';

            if ($_POST['period'] == 'today') {
                $this->db->where($this->order_table . '.order_date >=', $today_start);
                //$this->db->where('invoiceDate <=', $datetwo);
            }
            if ($_POST['period'] == 'week') {
                $this->db->where($this->order_table . '.order_date >=', $week_start);
            }
            if ($_POST['period'] == 'month') {
                $this->db->where($this->order_table . '.order_date >=', $month_start);
            }
        }
        if (isset($_POST['order_status'])) {
            $this->db->where_in($this->order_table . '.order_status', $_POST['order_status']);
        } else if (!isset($_POST['order_status']) && isset($_POST['due'])) {
            $this->db->where_not_in($this->order_table . '.order_status', array(ORDER_COMPLETED, ORDER_CANCELLED));
        }
        $this->db->order_by($this->order_table . ".order_date", "DESC");
        $this->db->limit($limit);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }

    function load_quotes($company_id, $paged, $limit, $filters = array()) {
        if (!empty($filters)) {
            foreach ($filters as $key => $val) {
                $this->db->where($this->quote_table . '.' . $key, $val);
            }
        }

        $this->db->where($this->quote_table . '.company_id', $company_id);

        if (isset($_POST['keyword']) && strlen($_POST['keyword']) > 1) {
            $this->db->like($this->quote_table . '.quote_title', $_POST['keyword']);
            $this->db->or_like($this->quote_table . '.quote_id', $_POST['keyword']);
        }
        if (isset($_POST['period']) && $_POST['period'] != 'all') {
            $current = date("Y-m-d H:i:s", time());
            $today_start = date("Y-m-d", time()) . ' 00:00:00';
            $week_start = date("Y-m-d", strtotime("-7 days")) . ' 00:00:00';
            $month_start = date("Y-m-d", strtotime("-1 month")) . ' 00:00:00';

            if ($_POST['period'] == 'today') {
                $this->db->where($this->quote_table . '.quote_date >=', $today_start);
            }
            if ($_POST['period'] == 'week') {
                $this->db->where($this->quote_table . '.quote_date >=', $week_start);
            }
            if ($_POST['period'] == 'month') {
                $this->db->where($this->quote_table . '.quote_date >=', $month_start);
            }
        }
        if (isset($_POST['quote_status'])) {
            $this->db->where_in($this->quote_table . '.quote_status', $_POST['quote_status']);
        }
        $this->db->from($this->quote_table);
        $this->db->join($this->service_table, "{$this->service_table}.service_id = {$this->quote_table}.service_id", 'left');
        $this->db->order_by("{$this->quote_table}.quote_date", "DESC");
        $this->db->limit($limit);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }

    function get_quote_by_quote_id($quote_id) {
        $this->db->where($this->quote_table . '.quote_id', $quote_id);
        $this->db->from($this->quote_table);
        $this->db->join($this->service_table, "{$this->service_table}.service_id = {$this->quote_table}.service_id", 'left');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }

    function get_quote_by_id($user_id, $company_id, $quote_id) {
        $this->db->where($this->quote_table . '.user_id', $user_id);
        $this->db->where($this->quote_table . '.company_id', $company_id);
        $this->db->where($this->quote_table . '.quote_id', $quote_id);
        $this->db->from($this->quote_table);
        $this->db->join($this->service_table, "{$this->service_table}.service_id = {$this->quote_table}.service_id", 'left');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }

    function quote_details($quote_id, $company_id) {
        $this->db->from($this->quote_table);
        $this->db->join($this->service_table, "{$this->service_table}.service_id = {$this->quote_table}.service_id", 'left');
        $this->db->where($this->quote_table . '.quote_id', $quote_id);
        $this->db->where($this->quote_table . '.company_id', $company_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }

    function quote_update($quote_id, $values) {
        $this->db->where('quote_id', $quote_id);
        $query = $this->db->get($this->quote_table);
        if ($query->num_rows() > 0) {
            $this->db->where('quote_id', $quote_id);
            return $this->db->update($this->quote_table, $values);
        }
        return false;
    }

    function company_by_userid($user_id) {
        $this->db->where('user_id', $user_id);
        $query = $this->db->get($this->company_table);
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }

    function get_company_by_id($company_id) {
        $this->db->where('id', $company_id);
        $query = $this->db->get($this->company_table);
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }

    function check_company_access($user_id, $company_id) {
        $this->db->where('user_id', $user_id);
        $this->db->where('company_id', $company_id);
        $query = $this->db->get($this->company_member_table);
        if ($query->num_rows() > 0) {
            return true;
        }
        return false;
    }

    function save_profile($user_id, $values) {
        $error = false;
        if (isset($values['users'])) {
            $this->db->where('id', $user_id);
            $res = $this->db->update(USERS, $values['users']);
            if (!$res) {
                $error = true;
            }
        }
        if (isset($values['user_profiles'])) {
            $this->db->where('user_id', $user_id);
            $res = $this->db->update(USER_PROFILES, $values['user_profiles']);
            if (!$res) {
                $error = true;
            }
        }
        if (isset($values['company'])) {
            $this->db->where('user_id', $user_id);
            $res = $this->db->update(COMPANY, $values['company']);
            if (!$res) {
                $error = true;
            }
        }
        if (isset($values['settings'])) {
            $res = $this->save_settings($user_id, $values['settings']);
            if (!$res) {
                $error = true;
            }
        }

        if ($error) {
            return false;
        }
        return true;
    }

    function save_company($user_id, $values) {
        $this->db->where('user_id', $user_id);
        $query = $this->db->get($this->company_table);
        if ($query->num_rows() > 0) {
            $this->db->where('user_id', $user_id);
            $res = $this->db->update($this->company_table, $values);
        } else {
            //Insert
            $res = $this->db->insert($this->company_table, $values);
        }
        return $res;
    }

    function set_setting($user_id, $name, $value) {
        $this->db->set('user_id', $user_id);
        $this->db->set('settings_name', $name);
        $this->db->set('settings_value', $value);
        $query = $this->db->insert(SETTINGS);

        if ($query) {
            return true;
        }
        return false;
    }

    function get_settings($user_id) {
        $this->db->select("settings_name, settings_value");
        $this->db->where("user_id", $user_id);
        $query = $this->db->get(SETTINGS);
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }

    function get_settings_notifications($user_id,$settings_name) {
        $check_notify = $this->get_settings($user_id);
        $this->db->select("settings_name, settings_value");
        if (!empty($check_notify) && $check_notify) {
            $check_notify = array("user_id" => $user_id, "settings_name" => $settings_name);
            $this->db->where($check_notify);
            $result = $this->db->get(SETTINGS);
            if ($result->num_rows() > 0) {
                $where = array(
                    "user_id" => $user_id,
                    "settings_name" => $settings_name,
                    "settings_value" => 0
                );
                $this->db->where($where);
                $query = $this->db->get(SETTINGS);
                if ($query->num_rows() > 0) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return true;
            }
        } else {
            return true;
        }
    }

    function save_settings($user_id, $settings = array()) {
        if (is_array($settings)) {
            foreach ($settings as $key => $val) {

                $this->db->where('user_id', $user_id);
                $this->db->where('settings_name', $key);
                $query = $this->db->get(SETTINGS);

                if ($query->num_rows() > 0) {
                    $this->db->where('user_id', $user_id);
                    $this->db->where('settings_name', $key);
                    $res = $this->db->update(SETTINGS, array('settings_value' => $val));
                } else {
                    $res = $this->db->insert(SETTINGS, array('user_id' => $user_id, 'settings_name' => $key, 'settings_value' => $val));
                }
            }
        }
        return true;
    }

    function add_company_member($user_id, $company_id) {
        $this->db->where("user_id", $user_id);
        $this->db->where("company_id", $company_id);
        $query = $this->db->get($this->company_member_table);
        if ($query->num_rows() == 0) {
            $this->db->insert($this->company_member_table, array('user_id' => $user_id, 'company_id' => $company_id, 'active' => 1));
            return true;
        }
        return false;
    }

    function get_company_members($company_id, $active_only) {
        $this->db->select('user_id');
        $this->db->where('company_id', $company_id);
        if ($active_only) {
            $this->db->where('active', 1);
        }
        $query = $this->db->get($this->company_member_table);

        if ($query->num_rows() > 0) {
            $users = $query->result();
            foreach ($users as $user) {
                $ids[] = $user->user_id;
            }
            return $this->get_users($ids);
        }
        return false;
    }

    function get_company_member_data($user_id, $company_id) {
        $this->db->where('user_id', $user_id);
        $this->db->where('company_id', $company_id);
        $query = $this->db->get($this->company_member_table);
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    /**
     * Update company member table and set permission values
     *
     * @param int 		$user_id
     * @param int 		$company_id
     * @param array 	$values
     */
    function set_company_member_permission($user_id, $company_id, $values) {
        echo "<pre>";
        print_r($values);
        exit();
        $data = $this->get_company_member_data($user_id, $company_id);
        if ($data) {
            $original_values = !empty($data['permissions']) && $data['permissions'] != 'null' ? json_decode(stripslashes($data['permissions']), TRUE) : array();
            $new_values = array_merge($original_values, $values);
            $this->db->where('id', $data['id']);
            $res = $this->db->update($this->company_member_table, array('permissions' => json_encode($new_values)));
            if ($res) {
                return true;
            }
        }
        return false;
    }

    function get_companies_by_user_id($user_id) {

        $query = $this->db->query("SELECT * FROM `{$this->company_table}` WHERE `id` IN (SELECT company_id FROM `{$this->company_member_table}` WHERE user_id=$user_id)");
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }

    function add_user_invite($values) {
        $this->db->insert($this->user_invite_table, $values);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        }
        return false;
    }

    function invited_users_by_company_id($company_id) {
        $this->db->where('invite_for', $company_id);
        $query = $this->db->get($this->user_invite_table);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_invited_user_by_key($key) {
        $this->db->where('invite_key', $key);
        $query = $this->db->get($this->user_invite_table);
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    function delete_invitation($id) {
        $this->db->where('invite_id', $id);
        $this->db->delete($this->user_invite_table);
    }

    function get_payment_info_by_oderid($order_id) {
        $this->db->where('order_id', $order_id);
        $query = $this->db->get($this->payment_table);
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }

    function insert_payment_info($values) {

        /* Is exist */
        $this->db->where('transaction_id', $values['transaction_id']);
        $query = $this->db->get($this->payment_table);
        if ($query->num_rows() > 0) {
            return true;
        }

        $this->db->insert($this->payment_table, $values);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        }
        return false;
    }

    function update_payment_info($order_id, $values) {
        $this->db->where('order_id', $order_id);
        $query = $this->db->get($this->payment_table);
        if ($query->num_rows() > 0) {
            $this->db->flush_cache();
            $this->db->where('order_id', $order_id);
            return $this->db->update($this->payment_table, $values);
        }

        return false;
    }

    function get_message_table_by_hashid($hashid) {
        $this->db->where('msg_hashid', $hashid);
        $query = $this->db->get($this->messages_table);
        if ($query) {
            return $query->row();
        } else {
            return false;
        }
    }

    function update_message_thread($parent_id, $user_id) {
        $this->db->where('msg_hashid', $parent_id);
        $this->db->set('msg_count', 'msg_count+1', FALSE);
        $this->db->set('msg_read', 0, FALSE);
        $this->db->set('last_sender_id', $user_id, FALSE);
        $res = $this->db->update($this->messages_table);
        if ($res) {
            return true;
        }
        return false;
    }

    function add_message($values) {
        $this->db->insert($this->messages_table, $values);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        }
        return false;
    }

    function get_messages($filter, $limit) {
        $this->db->where($filter);
        $this->db->order_by("last_update", "DESC");
        $this->db->limit($limit);
        $query = $this->db->get($this->messages_table);
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_messages_by_id($id) {
        $this->db->or_where('msg_hashid', $id);
        $this->db->or_where('msg_parent_id', $id);
        $query = $this->db->get($this->messages_table);
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }

    function get_message_by_parent_id($parent_id) {
        $this->db->where('msg_hashid', $parent_id);
        $query = $this->db->get($this->messages_table);
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }

    function get_message_thread($filter, $search = false) {
        $this->db->where($filter);
        if ($search) {
            $this->db->where("(msg_subject LIKE '%$search%' OR msg_content LIKE '%$search%')");
        }
        $this->db->order_by("last_update", "DESC");
        $query = $this->db->get($this->messages_table);
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function add_message_status($receiver_id, $company_id, $thread_id) {
        $values['receiver_id'] = $receiver_id;
        $values['company_id'] = $company_id;
        $values['thread_id'] = $thread_id;
        $this->db->insert(MESSAGE_STATUS, $values);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        }
        return false;
    }

    function remove_message_status($receiver_id, $company_id, $thread_id) {
        if (!$thread_id) {
            return false;
        }
        $this->db->where('receiver_id', $receiver_id);
        $this->db->where('company_id', $company_id);
        $this->db->where('thread_id', $thread_id);
        return $this->db->delete(MESSAGE_STATUS);
    }

    function mark_message_read($thread_id, $user_id) {
        if (!$thread_id) {
            return false;
        }
        $this->db->where('msg_hashid', $thread_id);
        $this->db->where('msg_read', 0);
        $this->db->where('last_sender_id !=', $user_id);
        $query = $this->db->get($this->messages_table);
        if ($query->num_rows() > 0) {
            $this->db->flush_cache();
            $this->db->where('msg_hashid', $thread_id);
            return $this->db->update($this->messages_table, array('msg_read' => 1));
        } else {
            return false;
        }
    }

    function update_order_payment_status($order_id, $payment_status) {
        $this->db->where('order_id', $order_id);
        $res = $this->db->update($this->order_table, array('payment_status' => $payment_status));
        if (!$res) {
            $error = true;
        }
    }

    function count_todays_order($company_id) {
        $today_start = date("Y-m-d", time()) . ' 00:00:00';
        $this->db->where($this->order_table . '.order_date =', $today_start);
        $query = $this->db->get($this->order_table);
        return $query->num_rows();
    }

    function count_total_files_processed($company_id) {
        $today_start = date("Y-m-d", time()) . ' 00:00:00';
        $sql = $this->db->query("select SUM(quantity) as total_processed from {$this->service_table} as SRVC left join {$this->order_table} as ORD on ORD.service_id =SRVC.service_id"
                . " where ORD.company_id={$company_id}");
        return $sql->row()->total_processed;
    }

    function count_todys_file_processed($company_id) {
        $today_start = date("Y-m-d", time()) . ' 00:00:00';
        $end_date = date("Y-m-d", time()) . ' 00:59:59';
        $sql = $this->db->query("select SUM(quantity) as total_processed from {$this->service_table} "
                . "as SRVC left join {$this->order_table} as ORD on ORD.service_id =SRVC.service_id "
                . "where ORD.company_id={$company_id} and ORD.order_date between '{$today_start}' and '{$end_date}'");

        return $sql->row()->total_processed;
    }

    function count_weeks_order($company_id) {
        $week_start = date("Y-m-d", strtotime("-7 days")) . ' 00:00:00';
        $this->db->where($this->order_table . '.order_date >=', $week_start);
        $query = $this->db->get($this->order_table);
        return $query->num_rows();
    }

    function count_weeks_file_processed($company_id) {
        $today_start = date("Y-m-d", time()) . ' 00:59:59';
        $week_start = date("Y-m-d", strtotime("-7 days")) . ' 00:00:00';
        $sql = $this->db->query("select SUM(quantity) as total_processed from {$this->service_table} "
                . "as SRVC left join {$this->order_table} as ORD on ORD.service_id =SRVC.service_id "
                . "where ORD.company_id={$company_id} and ORD.order_date between '{$week_start}' and '{$today_start}'");
        if ($sql->num_rows() > 0) {
            return $sql->row()->total_processed;
        }
        return 0;
    }

    function count_months_order($company_id) {
        $month_start = date("Y-m-d", strtotime("-1 month")) . ' 00:00:00';
        $this->db->where($this->order_table . '.order_date >=', $month_start);
        $query = $this->db->get($this->order_table);
        return $query->num_rows();
    }

    function count_months_file_processed($company_id) {
        $today_start = date("Y-m-d", time()) . ' 00:59:59';
        $month_start = date("Y-m-d", strtotime("-1 month")) . ' 00:00:00';
        $sql = $this->db->query("select SUM(quantity) as total_processed from {$this->service_table} "
                . "as SRVC left join {$this->order_table} as ORD on ORD.service_id =SRVC.service_id "
                . "where ORD.company_id={$company_id} and ORD.order_date between '{$month_start}' and '{$today_start}'");
        if ($sql->num_rows() > 0) {
            return $sql->row()->total_processed;
        }
        return 0;
    }

    function count_total_managers($company_id) {
        $this->db->where('company_id', $company_id);
        $query = $this->db->get($this->company_member_table);
        return $query->num_rows();
    }

    function count_paid_invoices($company_id) {
        $this->db->where('company_id', $company_id);
        $this->db->where('payment_status', 1);
        $query = $this->db->get($this->order_table);
        return $query->num_rows();
    }

    function count_unpaid_invoices($company_id) {
        $this->db->where('company_id', $company_id);
        $this->db->where('payment_status', 0);
        $query = $this->db->get($this->order_table);
        return $query->num_rows();
    }

    function count_total_paid($company_id) {
        $sql = $this->db->query("SELECT SUM(total_value) AS `total_payment` FROM {$this->order_table} WHERE `company_id`='{$company_id}' AND `payment_status`=1");
        if ($sql->num_rows() > 0) {
            return $sql->row()->total_payment;
        }
        return 0;
    }

    function count_total_due($company_id) {
        $query = $this->db->query("SELECT SUM(total_value) AS `total_due` FROM {$this->order_table} WHERE `company_id`='{$company_id}' AND `payment_status`=0");
        if ($query->num_rows() > 0) {
            return $query->row()->total_due;
        }
        return 0;
    }

    function count_total_orders($company_id) {
        $this->db->where('company_id', $company_id);
        $query = $this->db->get($this->order_table);
        return $query->num_rows();
    }

    function count_pending_orders($company_id) {
        $this->db->where('company_id', $company_id);
        $this->db->where('order_status', ORDER_PENDING);
        $query = $this->db->get($this->order_table);
        return $query->num_rows();
    }

    function count_completed_orders($company_id) {
        $this->db->where('company_id', $company_id);
        $this->db->where('order_status', ORDER_COMPLETED);
        $query = $this->db->get($this->order_table);
        return $query->num_rows();
    }

    function count_cancelled_orders($company_id) {
        $this->db->where('company_id', $company_id);
        $this->db->where('order_status', ORDER_CANCELLED);
        $query = $this->db->get($this->order_table);
        return $query->num_rows();
    }

    function count_total_quotes($company_id) {
        $this->db->where('company_id', $company_id);
        $query = $this->db->get($this->quote_table);
        return $query->num_rows();
    }

    function count_reviewed_quote($company_id) {
        $this->db->where('company_id', $company_id);
        $this->db->where('quote_status', QUOTE_REVIEWED);
        $query = $this->db->get($this->quote_table);
        return $query->num_rows();
    }

    function count_waiting_review($company_id) {
        $this->db->where('company_id', $company_id);
        $this->db->where('quote_status', QUOTE_AWAITING);
        $query = $this->db->get($this->quote_table);
        return $query->num_rows();
    }

    function count_accepted_quotes($company_id) {
        $this->db->where('company_id', $company_id);
        $this->db->where('quote_status', QUOTE_ACCEPTED);
        $query = $this->db->get($this->quote_table);
        return $query->num_rows();
    }

    function count_rejected_quotes($company_id) {
        $this->db->where('company_id', $company_id);
        $this->db->where('quote_status', QUOTE_REJECTED);
        $query = $this->db->get($this->quote_table);
        return $query->num_rows();
    }

    function count_messages($company_id) {
        $this->db->where('msg_company_id', $company_id);
        $this->db->where('msg_parent_id', NULL);
        $query = $this->db->get($this->messages_table);
        return $query->num_rows();
    }

    function unread_messages($company_id) {
        $this->db->where('receiver_id', $this->user_id);
        $this->db->where('company_id', $company_id);
        $query = $this->db->get(MESSAGE_STATUS);
        return $query->num_rows();
    }

    function update_download_counter($order_id) {
        $this->db->where('order_id', $order_id);
        $query = $this->db->get($this->order_table);
        
        if ($query->num_rows() > 0) {
            $this->db->where('order_id', $order_id);
            $this->db->set('downloaded', 'downloaded+1', FALSE);
            return $this->db->update($this->order_table);
        }
        return FALSE;
    }

    function is_alreay_member($data) {
        $this->db->where('company_id', $data['company_id']);

        if (isset($data['invite_to_id'])) {
            $this->db->where('user_id', $data['invite_to_id']);
        } else {
            return FALSE;
        }

        $query = $this->db->get($this->company_member_table);
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function is_company_owner($data) {
        $this->db->where('id', $data['company_id']);

        if (isset($data['invite_to_id'])) {
            $this->db->where('user_id', $data['invite_to_id']);
        } else {
            return FALSE;
        }

        $query = $this->db->get($this->company_table);
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function is_alreay_invited($data) {
        $invited_by_id = $data['invited_by_id'];
        $company_id = $data['company_id'];
        $invite_to_email = $data['invite_to_email'];

        $this->db->where('invite_by', $invited_by_id);
        $this->db->where('invite_for', $company_id);
        $this->db->where('invite_to', $invite_to_email);
        $query = $this->db->get($this->user_invite_table);
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function get_order_next_id() {
        $query = $this->db->query("SELECT `auto_increment` FROM INFORMATION_SCHEMA.TABLES WHERE table_name = '" . $this->order_table . "';");
        if ($query->num_rows() > 0) {
            return (int) $query->row()->auto_increment;
        } else {
            return false;
        }
    }

    function get_quote_next_id() {
        $query = $this->db->query("SELECT `auto_increment` FROM INFORMATION_SCHEMA.TABLES WHERE table_name = '" . $this->quote_table . "';");
        if ($query->num_rows() > 0) {
            return (int) $query->row()->auto_increment;
        } else {
            return false;
        }
    }

    function get_countries() {
        $query = $this->db->get(COUNTRY);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    function get_country_by_iso($iso) {
        $this->db->where('iso', $iso);
        $query = $this->db->get(COUNTRY);
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }

    function insert_free_trial($values) {
        $this->db->insert(FREE_TRIAL, $values);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        }
        return false;
    }

    function get_error_data($key) {
        $this->db->like('err_alias', $key);
        $query = $this->db->get(ERROR_TABLE);
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }

    function remove_permission_by_id($member_id) {
        $this->db->where('user_id', $member_id);
        $query = $this->db->update($this->company_member_table, array('active' => 0));
        if ($query) {
            return true;
        }
        return false;
    }

    function permission_by_member_id($member_id, $permission) {
        $this->db->where('id', $member_id);
        $update = $this->db->update($this->company_member_table, array('permissions' => $permission));
        if ($update) {
            return true;
        }
        return false;
    }

    function sending_message_user($data) {
        $query = $this->db->insert('messages', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    function email_notification_for_user($data) {
        $check = array('user_id' => $data['user_id'], 'settings_name' => $data['settings_name']);
        $query = $this->db->select('*')->where($check)->get('settings');
        if ($query->num_rows() > 0) {
            $result = $query->row();
            $update = $this->db->where('id', $result->id)->update('settings', array('settings_value' => $data['settings_value']));
            if ($update) {
                return true;
            } else {
                return false;
            }
        } else {
            $sql = $this->db->insert('settings', $data);
            if ($sql) {
                return true;
            } else {
                return false;
            }
        }
    }

    function is_whitelisted_user($user_id) {
        $this->db->where('id', $user_id);
        $this->db->where('whitelisted', 1);
        $query = $this->db->get(USERS);
        if ($query->num_rows() > 0) {
            return true;
        }
        return false;
    }

    public function update_user_list_status($data, $user_id) {
        if (!empty($user_id)) {
            foreach ($user_id as $id_value) {
                $this->db->where('id', $id_value);
                $query = $this->db->update(USERS, $data);
            }
        }
        if ($query) {
            return true;
        }
        return false;
    }

    public function get_user_list() {
        $this->db->select('id,email');
        $this->db->where('whitelisted', '0');
        $query = $this->db->get(USERS);
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return NULL;
    }

    public function get_blacklisted_user() {
        $this->db->from(USERS);
        $this->db->join(USER_PROFILES, USER_PROFILES.'.user_id = '.USERS.'.id', 'left');
        $this->db->where(USERS . '.whitelisted', 1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return NULL;
    }

    public function remove_user_form_whitelist($param, $id) {
        $this->db->where('id', $id);
        $query = $this->db->update(USERS, $param);
        if ($query) {
            return TRUE;
        }
        return FALSE;
    }

    public function is_bloced_by_country($user_id, $countries){
        $this->db->from(USERS);
        $this->db->join(USER_PROFILES, USER_PROFILES.'.user_id = '.USERS.'.id', 'left');
        $this->db->where(USERS . '.id', $user_id);
        $this->db->where(USERS . '.whitelisted !=', 1);
        $this->db->where_in(USER_PROFILES.'.country', $countries);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return TRUE;
        }
        return FALSE;
    }

}
