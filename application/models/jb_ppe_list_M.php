<?php

defined('BASEPATH') or exit('No direct script access allowed');

class jb_ppe_list_M extends CI_Model {

    public function __construct() {
        parent::__construct(); // DEFAULT CONSTRUCTOR
        // $this->db_1 = $this->load->database($this->db_1, TRUE); // INITIALIZE NEW DATABASE, LOAD DATABASE
        // $this->db_2 = $this->load->database($this->db_2, TRUE); // INITIALIZE NEW DATABASE, LOAD DATABASE
    }

// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
// SIDEBAR - jb_coa_ppe_group
// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------ 
    public function get_id_by_group_name($name) {
        $sql = "
    SELECT
        jb_coa_ppe_group.id
    FROM
        jb_coa_ppe_group
    WHERE
        jb_coa_ppe_group.`name` LIKE ?
    ";

        $query = $this->db->query($sql, array($name));
        $rs = $query->result();
        return $rs;
    }

    public function get_object_list_of_group() {
        $sql = " 
SELECT
	jb_coa_ppe_group.id, 
	jb_coa_ppe_group.`name`
FROM
	jb_coa_ppe_group
    ";

        $query = $this->db->query($sql);
        $rs = $query->result();
        return $rs;
    }

// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
// TABLE - jb_coa_ppe_group_article
// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------ 
    public function get_id_by_group_article_name() {
        
    }
}
