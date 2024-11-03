<?php

defined('BASEPATH') or exit('No direct script access allowed');

class jb_emailrequest_M extends CI_Model {

    // MY DATABASE
    // private $db_1 = "deped"; // ANOTHER DATABASE DEFINE IN database.php
    private $tb_1 = "jb_depedemailrequest"; // DATABASE TABLE, WITH PREFIX DEFINE IN database.php
    private $select_1 = "id, mis_emp_table_id, concern, concern_message, status, created_at, updated_at, response_message, response_date, is_delete, is_seen, is_cancel, is_done"; // SELECTED COLUMNS OF THE TABLE
    //
    // private $db_2 = "mis"; // ANOTHER DATABASE DEFINE IN database.php
    private $tb_2 = "hris_staff"; // DATABASE TABLE, WITH PREFIX DEFINE IN database.php
    private $select_2 = "IDNumber, FirstName, MiddleName, LastName, NameExtn, prefix, jobTitle, empPosition, Department, schoolID, Sex, empEmail, empMobile"; // SELECTED COLUMNS OF THE TABLE

    public function __construct() {
        parent::__construct(); // DEFAULT CONSTRUCTOR
        // $this->db_1 = $this->load->database($this->db_1, TRUE); // INITIALIZE NEW DATABASE, LOAD DATABASE
        // $this->db_2 = $this->load->database($this->db_2, TRUE); // INITIALIZE NEW DATABASE, LOAD DATABASE
    }

    // MIS FETCH DATA
    public function _read_data_from_employee($empid) {
        $this->db->select($this->select_2);
        $this->db->from($this->tb_2);
        $this->db->where('IDNumber', $empid);
        $qry = $this->db->get();
        return $rs = $qry->row();
    }

// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
// 𝐂𝐑𝐄𝐀𝐓𝐄
// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
    public function _create($data) {
        $inserted = $this->db->insert($this->tb_1, $data);

        if ($inserted) { // INSERT WAS SUCCESSFUL
            // return "RECORD INSERTED SUCCESSFULLY.";
            return 1;
        } else { // INSERT FAILED, YOU CAN GET THE ERROR MESSAGE IF NEEDED
            // $error = $this->db->error(); // GET ERROR DETAILS
            // return "INSERT FAILED: " . $error['message'];
            return 0;
        }
    }

    // ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
// 𝐑𝐄𝐀𝐃, 𝐂𝐎𝐔𝐍𝐓, 𝐃𝐀𝐒𝐇𝐁𝐎𝐀𝐑𝐃
// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
    public function _read_all() {
        // $this->db->select("*");
        // $qry = $this->db->get($this->tb_1);
        // return $rs =  $qry->result();
        // OR 

        $this->db->select("*");
        $this->db->from($this->tb_1);
        $qry = $this->db->get();
        return $rs = $qry->result(); // RETURN VALUE
    }

    public function _read_where_id($id) {
        $this->db->select("*");
        $this->db->from($this->tb_1);
        $this->db->where(array(
            "id" => $id // WHERE id IS EQUAL TO THE PARAMETER
        ));
        $qry = $this->db->get();
        return $rs = $qry->row();
    }

    public function _read_where_employeeid($empid) {
        $this->db->select($this->select_1);
        $this->db->from($this->tb_1);
        $this->db->where(array(
            "mis_emp_table_id" => $empid // WHERE COLUMN IS EQUAL TO THE PARAMETER
        ));
        $qry = $this->db->get();
        return $rs = $qry->result();
    }

    public function _read_where_isdone_true() {
        $this->db->select($this->select_1);
        $this->db->from($this->tb_1);
        $this->db->where("is_done", 1); // CHECK IF is_done IS 1 
        $this->db->order_by('updated_at', 'DESC');
        $qry = $this->db->get();
        return $rs = $qry->result();
    }

    public function _read_where_isdone_false() {
        $this->db->select($this->select_1);
        $this->db->from($this->tb_1);
        $this->db->where("is_done !=", 1); // CHECK IF is_done IS NOT 1
        $this->db->or_where("is_done IS NULL"); // CHECK IF is_done IS NULL 
        $this->db->order_by('id', 'DESC');
        $qry = $this->db->get();
        return $rs = $qry->result();
    }

    public function _read_where_isdone_false_empID($mis_emp_table_id) {
        $this->db->select($this->select_1);
        $this->db->from($this->tb_1);
        $this->db->where("mis_emp_table_id", $mis_emp_table_id); // Add the parameter condition
        $this->db->group_start(); // Start a grouping for the 'is_done' conditions
        $this->db->where("is_done !=", 1); // CHECK IF is_done IS NOT 1
        $this->db->or_where("is_done IS NULL"); // CHECK IF is_done IS NULL
        $this->db->group_end(); // End the grouping
        $this->db->order_by('id', 'DESC');
        $qry = $this->db->get();
        return $rs = $qry->result();
    }
    
    public function _read_where_empID_u($mis_emp_table_id) {
        $this->db->select($this->select_1);
        $this->db->from($this->tb_1);
        $this->db->where("mis_emp_table_id", $mis_emp_table_id); // Add the parameter condition 
        $this->db->order_by('id', 'DESC');
        $qry = $this->db->get();
        return $rs = $qry->result();
    }
 
    public function _read_where_isdone_false_daterange($date_from, $date_to) {
        date_default_timezone_set('Asia/Hong_Kong');
        $this->db->select($this->select_1);
        $this->db->from($this->tb_1);
        $this->db->group_start();
        $this->db->where("is_done !=", 1); // CHECK IF is_done IS NOT 1
        $this->db->or_where("is_done IS NULL"); // CHECK IF is_done IS NULL 
        $this->db->group_end();
        $this->db->where("created_at BETWEEN '$date_from' AND DATE_ADD('$date_to', INTERVAL 1 DAY)");
        $this->db->order_by('id', 'DESC');
        $qry = $this->db->get();
        return $qry->result();
    }

    public function _count_request_isdone_false($employeeid) {
        $this->db->from($this->tb_1);
        $this->db->where("mis_emp_table_id", $employeeid); // WHERE mis_emp_table_id IS EQUAL TO THE PARAMETER
        $this->db->group_start(); // START A GROUP FOR THE OR CONDITION
        $this->db->where("is_done", 0); // is_done IS EQUAL TO 0
        $this->db->or_where("is_done IS NULL"); // OR is_done IS NULL
        $this->db->group_end(); // END THE GROUP

        $count = $this->db->count_all_results(); // THIS WILL RETURN THE COUNT OF MATCHING ROWS
        return $count;
    }

    public function _count_all_request_isdone_false() {
        $this->db->from($this->tb_1);
        $this->db->group_start(); // START A GROUP FOR THE OR CONDITION
        $this->db->where("is_done", 0); // is_done IS EQUAL TO 0
        $this->db->or_where("is_done IS NULL"); // OR is_done IS NULL
        $this->db->group_end(); // END THE GROUP

        $count = $this->db->count_all_results(); // THIS WILL RETURN THE COUNT OF MATCHING ROWS
        return $count;
    }

// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
// 𝐔𝐏𝐃𝐀𝐓𝐄
// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
    public function _update_where($id, $data) {
        $this->db->where('id', $id);
        $updated = $this->db->update($this->tb_1, $data);

        if ($updated) {
            $affectedRows = $this->db->affected_rows(); // CHECK THE NUMBER OF AFFECTED ROWS
            if ($affectedRows > 0) {
                // UPDATE WAS SUCCESSFUL AND AT LEAST ONE ROW WAS AFFECTED
                // return "RECORD UPDATED SUCCESSFULLY.";
                return 1;
            } else {
                // UPDATE WAS SUCCESSFUL, BUT NO ROWS WERE AFFECTED (E.G., ID NOT FOUND)
                // return "NO CHANGES WERE MADE (RECORD NOT FOUND).";
                return 0;
            }
        } else {
            return 0;
            // UPDATE FAILED
            // return "UPDATE FAILED.";
        }
    }

    public function _update_isdone($id, $data) {
        $this->db->where('id', $id);
        $updated = $this->db->update($this->tb_1, $data);

        if ($updated) {
            $affectedRows = $this->db->affected_rows(); // CHECK THE NUMBER OF AFFECTED ROWS
            if ($affectedRows > 0) {
                // UPDATE WAS SUCCESSFUL AND AT LEAST ONE ROW WAS AFFECTED
                // return "RECORD UPDATED SUCCESSFULLY.";
                return 1;
            } else {
                // UPDATE WAS SUCCESSFUL, BUT NO ROWS WERE AFFECTED (E.G., ID NOT FOUND)
                // return "NO CHANGES WERE MADE (RECORD NOT FOUND).";
                return 0;
            }
        } else {
            return 0;
            // UPDATE FAILED
            // return "UPDATE FAILED.";
        }
    }

    public function _update_isdelete($id, $data) {
        $this->db->where('id', $id);
        $updated = $this->db->update($this->tb_1, $data);

        if ($updated) {
            $affectedRows = $this->db->affected_rows(); // CHECK THE NUMBER OF AFFECTED ROWS
            if ($affectedRows > 0) {
                // UPDATE WAS SUCCESSFUL AND AT LEAST ONE ROW WAS AFFECTED
                // return "RECORD UPDATED SUCCESSFULLY.";
                return 1;
            } else {
                // UPDATE WAS SUCCESSFUL, BUT NO ROWS WERE AFFECTED (E.G., ID NOT FOUND)
                // return "NO CHANGES WERE MADE (RECORD NOT FOUND).";
                return 0;
            }
        } else {
            return 0;
            // UPDATE FAILED
            // return "UPDATE FAILED.";
        }
    }

// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
// 𝐃𝐄𝐋𝐄𝐓𝐄
// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
    public function _delete_where($id) {
        $this->db->where('id', $id);
        $deleted = $this->db->delete($this->tb_1);

        if ($deleted) {
            $affectedRows = $this->db->affected_rows(); // CHECK THE NUMBER OF AFFECTED ROWS
            if ($affectedRows > 0) {
                return 1;
                // return "RECORD DELETED SUCCESSFULLY.";
            } else {
                return 0;
                // return "NO RECORD FOUND TO DELETE.";
            }
        } else {
            return 0;
            // return "DELETION FAILED.";
        }
    }
}
