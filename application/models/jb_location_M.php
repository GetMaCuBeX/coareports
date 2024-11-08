<?php

defined('BASEPATH') or exit('No direct script access allowed');

class jb_location_M extends CI_Model {

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
    public function get_jb_province($region_id) {
        $this->db->where('region_id', $region_id);
        $this->db->order_by('name', 'ASC');
        return $this->db->get('jb_province')->result();
    }
    // 3
    public function get_jb_city_municipality($province_id) {
        $this->db->where('province_id', $province_id);
        $this->db->order_by('name', 'ASC');
        return $this->db->get('jb_city_municipality')->result();
    }
    // 4
    public function get_jb_barangay($city_municipality_id) {
        $this->db->where('city_municipality_id', $city_municipality_id);
        $this->db->order_by('name', 'ASC');
        return $this->db->get('jb_barangay')->result();
    }
}
