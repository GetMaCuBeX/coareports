<?php

defined('BASEPATH') or exit('No direct script access allowed');

class jb_dashboard_M extends CI_Model { 
    // MY DATABASE
    // private $db_1 = "deped"; // ANOTHER DATABASE DEFINE IN database.php
    private $tb_1 = "jb_depedemailrequest"; // DATABASE TABLE, WITH PREFIX DEFINE IN database.php
    private $select_1 = "id, mis_emp_table_id, concern, concern_message, status, created_at, updated_at, response_message, response_date"; // SELECTED COLUMNS OF THE TABLE
    //
    // private $db_2 = "mis"; // ANOTHER DATABASE DEFINE IN database.php
    private $tb_2 = "hris_staff"; // DATABASE TABLE, WITH PREFIX DEFINE IN database.php
    private $select_2 = "IDNumber, FirstName, MiddleName, LastName, NameExtn, prefix, jobTitle, empPosition, Department, schoolID, Sex, empEmail, empMobile"; // SELECTED COLUMNS OF THE TABLE

    public function __construct() {
        parent::__construct(); // DEFAULT CONSTRUCTOR
        // $this->db_1 = $this->load->database($this->db_1, TRUE); // INITIALIZE NEW DATABASE, LOAD DATABASE
        // $this->db_2 = $this->load->database($this->db_2, TRUE); // INITIALIZE NEW DATABASE, LOAD DATABASE
    }

    // ADMIN
    public function _dashboard_query_admin() {
        $rs = [
            "DAILY_REQUEST" => $this->_dashboard_daily_request_admin(),
            "MONTHLY_REQUEST" => $this->_dashboard_monthly_request_admin(),
            "YEARLY_REQUEST" => $this->_dashboard_yearly_request_admin(),
            "TOTAL_REQUEST" => $this->_dashboard_total_request_admin()
        ];
        return $rs;
    }

    public function _dashboard_daily_request_admin() {
        date_default_timezone_set('Asia/Hong_Kong'); // Set your desired timezone 
        $this->db->from($this->tb_1);
        $this->db->group_start(); // START A GROUP FOR THE OR CONDITION
        $this->db->where('created_at >=', date('Y-m-d 00:00:00'));
        $this->db->where('created_at <=', date('Y-m-d 23:59:59'));
        $this->db->group_end(); // END THE GROUP
        $count = $this->db->count_all_results();
        return $count;
    }

    public function _dashboard_monthly_request_admin() {
        $this->db->from($this->tb_1);
        $this->db->where('YEAR(created_at)', date('Y')); // Current year
        $this->db->where('MONTH(created_at)', date('m')); // Current month
        $count = $this->db->count_all_results(); // Get the count of matching rows
        return $count;
    }

    public function _dashboard_yearly_request_admin() {
        $this->db->from($this->tb_1);
        $this->db->where('YEAR(created_at)', date('Y')); // Current year
        $count = $this->db->count_all_results(); // Get the count of matching rows
        return $count;
    }

    public function _dashboard_total_request_admin() {
        $this->db->from($this->tb_1);
        $count = $this->db->count_all_results(); // Get the total count of rows
        return $count;
    }

    // USER
    public function _dashboard_query_user() {
        $rs = [
            "DAILY_REQUEST" => $this->_dashboard_daily_request_user(),
            "MONTHLY_REQUEST" => $this->_dashboard_monthly_request_user(),
            "YEARLY_REQUEST" => $this->_dashboard_yearly_request_user(),
            "TOTAL_REQUEST" => $this->_dashboard_total_request_user()
        ];
        return $rs;
    }

    public function _dashboard_daily_request_user() {
        date_default_timezone_set('Asia/Hong_Kong'); // Set your desired timezone 
        $this->db->from($this->tb_1);
        $this->db->group_start(); // START A GROUP FOR THE OR CONDITION
        $this->db->where('created_at >=', date('Y-m-d 00:00:00'));
        $this->db->where('created_at <=', date('Y-m-d 23:59:59'));
        $this->db->group_end(); // END THE GROUP
        // Add the additional WHERE condition
        $this->db->where('mis_emp_table_id', $_SESSION['username']);
        $count = $this->db->count_all_results();
        return $count;
    }

    public function _dashboard_monthly_request_user() {
        $this->db->from($this->tb_1);
        $this->db->where('YEAR(created_at)', date('Y')); // Current year
        $this->db->where('MONTH(created_at)', date('m')); // Current month
        // Add the additional WHERE condition
        $this->db->where('mis_emp_table_id', $_SESSION['username']);
        $count = $this->db->count_all_results(); // Get the count of matching rows
        return $count;
    }

    public function _dashboard_yearly_request_user() {
        $this->db->from($this->tb_1);
        $this->db->where('YEAR(created_at)', date('Y')); // Current year
        // Add the additional WHERE condition
        $this->db->where('mis_emp_table_id', $_SESSION['username']);
        $count = $this->db->count_all_results(); // Get the count of matching rows
        return $count;
    }

    public function _dashboard_total_request_user() {
        $this->db->from($this->tb_1);
        // Add the additional WHERE condition
        $this->db->where('mis_emp_table_id', $_SESSION['username']);
        $count = $this->db->count_all_results(); // Get the total count of rows
        return $count;
    }
}
