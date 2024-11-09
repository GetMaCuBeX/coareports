<?php

defined('BASEPATH') or exit('No direct script access allowed');

class jb_school_M extends CI_Model {

    public function __construct() {
        parent::__construct();
    }


// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
// DROPDOWN MENU - RELATIONSHIPS
// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------ 
    // 1
    public function get_jb_region() { 
    $this->db->order_by('name', 'ASC');   
    return $this->db->get('jb_region')->result();
    }
    // 2
    public function get_jb_division($region_id) {
        $this->db->where('region_id', $region_id);
        $this->db->order_by('name', 'ASC');
        return $this->db->get('jb_division')->result();
    }
    // 3
    public function get_jb_district($division_id) {
        $this->db->where('division_id', $division_id);
        $this->db->order_by('name', 'ASC');
        return $this->db->get('jb_district')->result();
    }
    
}