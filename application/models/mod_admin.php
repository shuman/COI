<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mod_Admin extends CI_Model {

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
    private $log_table = AUDIT_LOG;

    function __construct() {
        parent::__construct();

        $ci = & get_instance();
    }

    function total_audit_log() {
        $this->db->select('id');
        $query = $this->db->get($this->log_table);
        return $query->num_rows();
    }

    function get_audit_log($paged, $limit = 0) {
        $this->db->from($this->log_table);
        $this->db->order_by("id", "DESC");
        if ($limit > 0 && $paged > 0) {
            $this->db->limit($limit, $paged);
        } else if ($limit > 0) {
            $this->db->limit($limit);
        }

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }

    function count_total_orders() {
        $this->db->select('id');
        $query = $this->db->get($this->order_table);
        return $query->num_rows();
    }

    function load_orders($paged, $limit = 0) {
        $filter = false;
        $this->db->from($this->order_table);
        $this->db->join($this->service_table, "{$this->service_table}.service_id = {$this->order_table}.service_id", 'left');
        $this->db->order_by($this->order_table . ".order_date", "DESC");
        if ($limit > 0 && $paged > 0) {
            $this->db->limit($limit, $paged);
        } else if ($limit > 0) {
            $this->db->limit($limit);
        }

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }

    function order_details($order_id) {

        $this->db->from($this->order_table);
        $this->db->join($this->service_table, "{$this->service_table}.service_id = {$this->order_table}.service_id", 'left');
        $this->db->where($this->order_table . '.order_id', $order_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }

    function update_order($order_id, $values) {
        $this->db->where('order_id', $order_id);
        $query = $this->db->get($this->order_table);
        if ($query->num_rows() > 0) {
            $this->db->where('order_id', $order_id);
            $result = $this->db->update($this->order_table, $values);
            if ($result) {
                return $query->row();
            }
            return false;
        }
        return false;
    }

    function load_quotes($paged, $limit = 0) {

        $this->db->from($this->quote_table);
        $this->db->join($this->service_table, "{$this->service_table}.service_id = {$this->quote_table}.service_id", 'left');
        $this->db->order_by("{$this->quote_table}.quote_date", "DESC");

        if ($limit > 0 && $paged > 0) {
            $this->db->limit($limit, $paged);
        } else if ($limit > 0) {
            $this->db->limit($limit);
        }

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }

        return false;
    }

    function count_total_quotes() {
        $this->db->select('id');
        $query = $this->db->get($this->quote_table);
        return $query->num_rows();
    }

    function update_quote($quote_id, $values) {
        $this->db->where('quote_id', $quote_id);
        $query = $this->db->get($this->quote_table);
        if ($query->num_rows() > 0) {
            $this->db->where('quote_id', $quote_id);
            $result = $this->db->update($this->quote_table, $values);
            if ($result) {
                return $query->row();
            }
            return false;
        }
        return false;
    }

    function load_quote($quote_id) {
        $this->db->from($this->quote_table);
        $this->db->join($this->service_table, "{$this->service_table}.service_id = {$this->quote_table}.service_id", 'left');
        $this->db->where("{$this->quote_table}.quote_id", $quote_id);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        }

        return false;
    }

    function update_service($service_id, $values) {
        $data = array(
            'unit_price' => $values['unit_price'],
            'total_value' => $values['total_value']
                // 'is_flat_rate' => $values['is_flat_rate'] //add new line
        );
        $this->db->where('service_id', $service_id);
        $query = $this->db->get($this->quote_table);
        if ($query->num_rows() > 0) {
            $this->db->where('service_id', $service_id);
            return $this->db->update($this->service_table, $data);
        }
        return false;
    }

    function count_message_threads($company_id = false) {
        if ($company_id) {
            $this->db->where('msg_company_id', $company_id);
        }
        $this->db->where('msg_parent_id', NULL);
        $query = $this->db->get($this->messages_table);
        return $query->num_rows();
    }

    function get_message_threads($paged, $limit, $company_id) {
        if ($company_id) {
            $this->db->where('msg_company_id', $company_id);
        }
        $this->db->where('msg_parent_id', NULL);
        $this->db->order_by('last_update', 'DESC');

        if ($limit > 0 && $paged > 0) {
            $this->db->limit($limit, $paged);
        } else if ($limit > 0) {
            $this->db->limit($limit);
        }

        $query = $this->db->get($this->messages_table);
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }

    function get_messages_by_id($id) {
        $this->db->or_where('msg_hashid', $id);
        $this->db->or_where('msg_parent_id', $id);
        // $this->db->order_by('last_update', 'DESC');
        $query = $this->db->get($this->messages_table);
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }

    function get_company_by_recent_message() {
        $this->db->select('*, COUNT(*) as total');
        $this->db->from($this->messages_table);
        $this->db->join($this->company_table, "{$this->company_table}.id = {$this->messages_table}.msg_company_id", 'left');
        $this->db->where($this->messages_table . '.msg_parent_id', NULL);
        $this->db->order_by($this->messages_table . '.last_update', 'DESC');
        $this->db->group_by($this->messages_table . '.msg_company_id');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }

    /*
     * usear status in order and order quote
     *
     */

    function count_paid_invoices($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->where('payment_status', 1);
        $query = $this->db->get($this->order_table);
        return $query->num_rows();
    }

    function count_unpaid_invoices($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->where('payment_status', 0);
        $query = $this->db->get($this->order_table);
        return $query->num_rows();
    }

    function count_total_due($user_id) {
        $query = $this->db->query("SELECT SUM(total_value) AS `total_due` FROM {$this->order_table} WHERE `user_id`='{$user_id}' AND `payment_status`=0");
        if ($query->num_rows() > 0) {
            return $query->row()->total_due;
        }
        return 0;
    }

    function count_total_orders_by_id($user_id) {
        $this->db->where('user_id', $user_id);
        $query = $this->db->get($this->order_table);
        return $query->num_rows();
    }

    function count_pending_orders($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->where('order_status', ORDER_PENDING);
        $query = $this->db->get($this->order_table);
        return $query->num_rows();
    }

    function count_completed_orders($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->where('order_status', ORDER_COMPLETED);
        $query = $this->db->get($this->order_table);
        return $query->num_rows();
    }

    function count_cancelled_orders($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->where('order_status', ORDER_CANCELLED);
        $query = $this->db->get($this->order_table);
        return $query->num_rows();
    }

    function count_reviewed_quote($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->where('quote_status', QUOTE_REVIEWED);
        $query = $this->db->get($this->quote_table);
        return $query->num_rows();
    }

    function count_waiting_review($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->where('quote_status', QUOTE_AWAITING);
        $query = $this->db->get($this->quote_table);
        return $query->num_rows();
    }

    function count_accepted_quotes($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->where('quote_status', QUOTE_ACCEPTED);
        $query = $this->db->get($this->quote_table);
        return $query->num_rows();
    }

    function count_rejected_quotes($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->where('quote_status', QUOTE_REJECTED);
        $query = $this->db->get($this->quote_table);
        return $query->num_rows();
    }

}
