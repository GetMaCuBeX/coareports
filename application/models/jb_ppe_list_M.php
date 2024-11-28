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
// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
// DROPDOWN MENU - RELATIONSHIPS
// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------ 
    // FOR CREATE    
    // Get groups from jb_coa_ppe_group
    public function get_groups() {
        return $this->db->get('jb_coa_ppe_group')->result(); // Fetch all groups
    }

    // Get articles based on selected group from jb_coa_ppe_group_article
    public function get_articles($groupId) {
        $this->db->where('group_id', $groupId); // Assuming 'group_id' is the foreign key in jb_coa_ppe_group_article
        return $this->db->get('jb_coa_ppe_group_article')->result(); // Fetch articles
    }

    // QUERY
    public function get_group_name_by_group_id($group_id) {
        $sql = "
SELECT
	jb_coa_ppe_group.`name`
FROM
	jb_coa_ppe_group
	INNER JOIN
	jb_coa_ppe_group_article
	ON 
		jb_coa_ppe_group.id = jb_coa_ppe_group_article.group_id
WHERE
	jb_coa_ppe_group_article.group_id = " . $group_id . "
    ";

        $query = $this->db->query($sql);
        $rs = $query->result();

        return $rs;
    }

    public function get_ppe_list_data_by_id($ppe_list_id) {
        $sql = "
SELECT
	jb_coa_ppe_list.id, 
	jb_coa_ppe_list.article_id, 
	jb_coa_ppe_list.description, 
	jb_coa_ppe_list.old_property_no_assigned, 
	jb_coa_ppe_list.new_property_no_assigned, 
	jb_coa_ppe_list.unit_of_measure, 
	jb_coa_ppe_list.unit_value, 
	jb_coa_ppe_list.quantity_per_property_card, 
	jb_coa_ppe_list.quantity_per_physical_count, 
	jb_coa_ppe_list.total_value, 
	jb_coa_ppe_list.date_acquired, 
	jb_coa_ppe_list.location_whereabouts, 
	jb_coa_ppe_list.condition_name, 
	jb_coa_ppe_list.remarks, 
	jb_coa_ppe_list.school_idnumber, 
	jb_coa_ppe_list.created_at, 
	jb_coa_ppe_list.updated_at, 
	jb_coa_ppe_list.is_existing, 
	jb_coa_ppe_list.person_accountable, 
	jb_coa_ppe_list.is_verified, 
	jb_coa_ppe_list.is_removed, 
	jb_school.school_idnumber as `SCHOOL_ID`, 
	jb_school.`name` as `SCHOOL_NAME`
FROM
	jb_coa_ppe_list
	INNER JOIN
	jb_school
	ON 
		jb_coa_ppe_list.school_idnumber = jb_school.school_idnumber
WHERE
	jb_coa_ppe_list.id = " . $ppe_list_id . "
    ";

        $query = $this->db->query($sql);
        $rs = $query->result();

        return $rs;
    }

    // FOR EDIT
    public function get_selection_by_id($id) {
        return $this->db->get_where('jb_coa_ppe_group_article', ['id' => $id])->row(); // Fetch the row with the specified ID
    }

    public function get_all_groups() {
        return $this->db->get('jb_coa_ppe_group')->result(); // Fetch all groups
    }

    public function get_articles_by_group_id($group_id) { // Fetch all article name base on group_id
        return $this->db->get_where('jb_coa_ppe_group_article', ['group_id' => $group_id])->result();
    }

    public function get_article_by_id($article_id) {
        return $this->db->get_where('jb_coa_ppe_group_article', ['id' => $article_id])->row(); // Fetch the article row
    }

    // FOR UPDATE
    public function update_selection($id, $groupId, $articleId) {
        $data = array(
            'group_id' => $groupId,
            'article_id' => $articleId
        );

        $this->db->where('id', $id);
        return $this->db->update('jb_coa_ppe_list', $data);
    }

    // UPDATE is_verified
    public function update_is_verified_by_id($id, $is_verified) {
        // Prepare the data to update
        $data = [
            'is_verified' => $is_verified
        ];

        // Update the record in the database where the ID matches
        $this->db->where('id', $id); // Replace 'id' with your actual primary key column if different
        return $this->db->update('jb_coa_ppe_list', $data);
    }

    // DELETE 
    public function delete_by_id($id) {
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
