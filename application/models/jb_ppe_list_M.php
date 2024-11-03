<?php

defined('BASEPATH') or exit('No direct script access allowed');

class jb_ppe_list_M extends CI_Model {

    public function __construct() {
        parent::__construct(); // DEFAULT CONSTRUCTOR
        // $this->db_1 = $this->load->database($this->db_1, TRUE); // INITIALIZE NEW DATABASE, LOAD DATABASE
        // $this->db_2 = $this->load->database($this->db_2, TRUE); // INITIALIZE NEW DATABASE, LOAD DATABASE
    }

    public function _ppe_list_by_schoolid($school_idnumber) {
        $this->db->select([
            'jb_district.name as DISTRICT',
            'jb_school.school_idnumber as SCHOOLID',
            'jb_school.name as SCH_NAME',
            'jb_coa_ppe_group.name as _GROUP',
            'jb_coa_ppe_group_article.name as ARTICLE',
            'jb_coa_ppe_list.description as DESCRIPTION',
            'jb_coa_ppe_list.old_property_no_assigned',
            'jb_coa_ppe_list.new_property_no_assigned',
            'jb_coa_ppe_list.unit_of_measure',
            'jb_coa_ppe_list.unit_value',
            'jb_coa_ppe_list.quantity_per_property_card',
            'jb_coa_ppe_list.quantity_per_physical_count',
            'jb_coa_ppe_list.total_value',
            'jb_coa_ppe_list.date_acquired',
            'jb_coa_ppe_list.localtion_whereabouts',
            'jb_coa_ppe_list.condition_name',
            'jb_coa_ppe_list.remarks',
            'jb_coa_ppe_list.is_existing',
            'ROW_NUMBER() OVER (PARTITION BY 		jb_district.name,		jb_school.name) AS _R4',
            'ROW_NUMBER() OVER (PARTITION BY 		jb_district.name,		jb_school.name,		jb_coa_ppe_group.id) AS _R3',
            'IF(ROW_NUMBER() OVER (PARTITION BY 	jb_district.name,		jb_school.name, 	jb_coa_ppe_group.id ORDER BY jb_district.name ASC, jb_school.name ASC) = 1, CONCAT(jb_coa_ppe_group.name, \'-\', 1111), NULL) as _GROUPCONCAT'
        ]);

        $this->db->from('jb_coa_ppe_list');
        $this->db->join('jb_coa_ppe_group_article', 'jb_coa_ppe_list.article_id = jb_coa_ppe_group_article.id', 'inner');
        $this->db->join('jb_coa_ppe_group', 'jb_coa_ppe_group_article.group_id = jb_coa_ppe_group.id', 'inner');
        $this->db->join('jb_school', 'jb_coa_ppe_list.school_idnumber = jb_school.school_idnumber', 'inner');
        $this->db->join('jb_district', 'jb_school.district_id = jb_district.district_id', 'inner');

        // Uncomment to filter by specific school ID numbers
        // $this->db->where_in('jb_school.school_idnumber', [129327, 129211]);

        $query = $this->db->get();
        return $query->result(); // CONVERT TO ARRAY
    }
    
    public function _ppe_list_by_schoolid_isExisting($school_idnumber, $bol){
        
    }

    public function _ppe_list() {

        $this->db->select([
            "jb_coa_ppe_list.id as LIST_ID",
            'jb_district.name AS DISTRICT',
            'jb_school.school_idnumber AS SCHOOLID',
            "jb_school.`name` as SCHOOLNAME",
            "IF(ROW_NUMBER() OVER (PARTITION BY jb_district.name, jb_school.name) = 1,
				CONCAT(jb_school.name, ' - ', FORMAT(SUM(jb_coa_ppe_list.total_value) OVER (PARTITION BY jb_district.name, jb_school.name), 2)),
				NULL) AS `SCH_NAME`",
            "COUNT(*) OVER (PARTITION BY jb_district.`name`, jb_school.name ) AS _R4",
            "ROW_NUMBER() OVER (PARTITION BY jb_district.name, jb_school.name) AS _R1",
            "FORMAT(SUM(jb_coa_ppe_list.total_value) OVER (PARTITION BY jb_district.`name`,jb_school.`name`),2) AS `GRAND_TOTAL`",
            "FORMAT(SUM(jb_coa_ppe_list.total_value) OVER (PARTITION BY jb_district.`name`,jb_school.`name`,jb_coa_ppe_group.id),2) as SUM_PER_GROUP",
            "ROW_NUMBER() OVER (PARTITION BY 	jb_district.`name`,jb_school.name,	jb_coa_ppe_group.id) AS _R2",
            "COUNT(*) OVER (PARTITION BY jb_district.`name`, jb_school.name, jb_coa_ppe_group.id) AS _R3",
            "IF(ROW_NUMBER() OVER (PARTITION BY jb_district.name, jb_school.name, jb_coa_ppe_group.id) = 1,
				CONCAT(jb_coa_ppe_group.name, ' [', COUNT(*) OVER (PARTITION BY jb_district.name, jb_school.name, jb_coa_ppe_group.id), '] - ',
				FORMAT(SUM(jb_coa_ppe_list.total_value) OVER (PARTITION BY jb_district.name, jb_school.name, jb_coa_ppe_group.id), 2)),
				NULL) AS `_GROUPCONCAT`",
            "jb_coa_ppe_group.`name` as `GROUP_NAME`",
            'jb_coa_ppe_group_article.name AS ARTICLE',
            'jb_coa_ppe_list.description AS DESCRIPTION',
            'jb_coa_ppe_list.old_property_no_assigned',
            'jb_coa_ppe_list.new_property_no_assigned',
            'jb_coa_ppe_list.unit_of_measure',
            'jb_coa_ppe_list.unit_value',
            'jb_coa_ppe_list.quantity_per_property_card',
            'jb_coa_ppe_list.quantity_per_physical_count',
            'jb_coa_ppe_list.total_value',
            'jb_coa_ppe_list.date_acquired',
            'jb_coa_ppe_list.localtion_whereabouts',
            'jb_coa_ppe_list.condition_name',
            'jb_coa_ppe_list.remarks',
            'jb_coa_ppe_list.is_existing',
            "jb_coa_ppe_list.person_accountable as `PERSON_ACCOUNTABLE`",
        ]);

        $this->db->from('jb_coa_ppe_list');
        $this->db->join('jb_coa_ppe_group_article', 'jb_coa_ppe_list.article_id = jb_coa_ppe_group_article.id', 'inner');
        $this->db->join('jb_coa_ppe_group', 'jb_coa_ppe_group_article.group_id = jb_coa_ppe_group.id', 'inner');
        $this->db->join('jb_school', 'jb_coa_ppe_list.school_idnumber = jb_school.school_idnumber', 'inner');
        $this->db->join('jb_district', 'jb_district.district_id = jb_school.district_id', 'inner');

        // Optional: Uncomment and modify WHERE clause as needed
        // $this->db->where('jb_school.school_idnumber', 129327);
        // $this->db->or_where('jb_school.school_idnumber', 129211);

        $query = $this->db->get();
        $rs = $query->result();
        return $rs;
    }
}
