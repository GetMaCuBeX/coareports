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
}
