<?php

defined('BASEPATH') or exit('No direct script access allowed');

class jb_ppe_school_M extends CI_Model {

    // DEFAULT CONSTRUCTOR
    public function __construct() {
        parent::__construct(); // DEFAULT CONSTRUCTOR
// $this->db_1 = $this->load->database($this->db_1, TRUE); // INITIALIZE NEW DATABASE, LOAD DATABASE
// $this->db_2 = $this->load->database($this->db_2, TRUE); // INITIALIZE NEW DATABASE, LOAD DATABASE
    }

    // NOT USED
    public function mp_school_ppe_annex_b_by_division($division_id) {
        $sql = " 
SELECT
jb_coa_ppe_list.id,
	jb_district.`name` as `DISTRICT`,    
	jb_school.school_idnumber as `SCHOOLID`, 
	jb_school.`name` as `SCHOOLNAME`, 
  #ROW_NUMBER() OVER (PARTITION BY jb_school.school_idnumber) AS `_R2`,
	IF(ROW_NUMBER() OVER (PARTITION BY jb_district.`name`,jb_school.`name`)=1,
	CONCAT(jb_school.`name`,' - ',
	FORMAT(SUM(jb_coa_ppe_list.total_value) OVER (PARTITION BY jb_district.`name`,jb_school.`name`),2)
	),
	NULL) as `SCH NAME`, 
	
	COUNT(*) OVER (PARTITION BY jb_district.`name`, jb_school.name ) AS `_R4`,
  ROW_NUMBER() OVER (PARTITION BY 	jb_district.`name`,jb_school.`name`) AS `_R1`,
	
	
	FORMAT(SUM(jb_coa_ppe_list.total_value) OVER (PARTITION BY jb_district.`name`,jb_school.`name`),2) AS `GRAND_TOTAL`,
	FORMAT(SUM(jb_coa_ppe_list.total_value) OVER (PARTITION BY jb_district.`name`,jb_school.`name`,jb_coa_ppe_group.id),2) as `SUM_PER_GROUP`,
	
  ROW_NUMBER() OVER (PARTITION BY 	jb_district.`name`,jb_school.name,	jb_coa_ppe_group.id) AS `_R2`,
	COUNT(*) OVER (PARTITION BY jb_district.`name`, jb_school.name, jb_coa_ppe_group.id) AS `_R3`,
	
	IF(ROW_NUMBER() OVER (PARTITION BY jb_district.`name`,jb_school.`name`,jb_coa_ppe_group.id)=1,
	CONCAT(jb_coa_ppe_group.`name`,' [',
	COUNT(*) OVER (PARTITION BY jb_district.`name`, jb_school.name, jb_coa_ppe_group.id),'] - ',
	FORMAT(SUM(jb_coa_ppe_list.total_value) OVER (PARTITION BY jb_district.`name`,jb_school.`name`,jb_coa_ppe_group.id),2)
	),
	null) as `_GROUPCONCAT`, 
	jb_coa_ppe_group.`name` AS GROUP_NAME,
  #ROW_NUMBER() OVER (PARTITION BY jb_coa_ppe_group.`name`) AS `_R3`,
	jb_coa_ppe_group_article.`name` AS ARTICLE, 
	jb_coa_ppe_list.description AS DESCRIPTION, 
	jb_coa_ppe_list.person_accountable AS PERSON_ACCOUNTABLE, 
	jb_coa_ppe_list.old_property_no_assigned, 
	jb_coa_ppe_list.new_property_no_assigned, 
	jb_coa_ppe_list.unit_of_measure, 
	FORMAT(jb_coa_ppe_list.unit_value,2) AS unit_value, 
	jb_coa_ppe_list.quantity_per_property_card, 
	jb_coa_ppe_list.quantity_per_physical_count, 
	FORMAT(jb_coa_ppe_list.total_value,2) AS total_value, 
	jb_coa_ppe_list.date_acquired, 
	jb_coa_ppe_list.localtion_whereabouts, 
	jb_coa_ppe_list.condition_name, 
	jb_coa_ppe_list.remarks, 
	jb_coa_ppe_list.is_existing
FROM
	jb_coa_ppe_list
	INNER JOIN
	jb_coa_ppe_group_article
	ON 
		jb_coa_ppe_list.article_id = jb_coa_ppe_group_article.id
	INNER JOIN
	jb_coa_ppe_group
	ON 
		jb_coa_ppe_group_article.group_id = jb_coa_ppe_group.id
	INNER JOIN
	jb_district
	INNER JOIN
	jb_school
	ON 
		jb_district.district_id = jb_school.district_id AND
		jb_coa_ppe_list.school_idnumber = jb_school.school_idnumber
	INNER JOIN
	jb_division
	ON 
		jb_district.division_id = jb_division.division_id
WHERE
	jb_division.division_id =  " . $division_id . "
        AND
	jb_coa_ppe_list.is_existing = TRUE";

        $query = $this->db->query($sql);
        $rs = $query->result();

        return $rs;
    }

    // 
    public function ftbl_schools_annex_a() {

        $sql = "  
WITH SchoolTotals AS (
    SELECT
        ROW_NUMBER() OVER (PARTITION BY jb_division.division_id ) AS `_R1`,
        ROW_NUMBER() OVER (PARTITION BY jb_division.division_id, jb_district.district_id ) AS `_R5`, -- New row number for division and district
        ROW_NUMBER() OVER (PARTITION BY jb_division.division_id, jb_district.district_id, jb_school.school_idnumber ) AS `_R6`, -- New row number for division and district
        FORMAT(SUM(jb_coa_ppe_list.total_value) OVER (PARTITION BY jb_division.division_id), 2) AS `_R2`, -- Total for division, formatted to 2 decimals
        FORMAT(SUM(jb_coa_ppe_list.total_value) OVER (PARTITION BY jb_district.district_id), 2) AS `_R3`, -- Total for district, formatted to 2 decimals
        FORMAT(SUM(jb_coa_ppe_list.total_value) OVER (PARTITION BY jb_school.school_idnumber), 2) AS `_R4`, -- Total for school, formatted to 2 decimals
        jb_division.division_id AS DIVISION,
        jb_division.`name` AS DIVISION_NAME,
        jb_district.district_id AS DISTRICT_ID, 
        jb_district.`name` AS DISTRICT, 
        jb_school.school_idnumber AS SCHOOLID, 
        jb_school.congressional_district as CONG_DISTRICT,
        jb_school.`name` AS SCHOOLNAME, 
        jb_school_administrator.administrator_name AS ADMINISTRATOR, 
        jb_school_administrator.contact_number AS CN, 
        jb_school_administrator.email_deped AS DEMAIL
    FROM
        jb_school
    INNER JOIN
        jb_district ON jb_school.district_id = jb_district.district_id
    INNER JOIN
        jb_division ON jb_district.division_id = jb_division.division_id
    INNER JOIN
        jb_school_administrator ON jb_school.school_idnumber = jb_school_administrator.school_idnumber
    INNER JOIN
        jb_coa_ppe_list ON jb_school.school_idnumber = jb_coa_ppe_list.school_idnumber 
),
DistrictSchoolCounts AS (
    SELECT
        jb_district.district_id,
        COUNT(DISTINCT jb_school.school_idnumber) AS district_school_count
    FROM
        jb_coa_ppe_list
    INNER JOIN
        jb_school ON jb_coa_ppe_list.school_idnumber = jb_school.school_idnumber
    INNER JOIN
        jb_district ON jb_school.district_id = jb_district.district_id
    GROUP BY
        jb_district.district_id
)

SELECT
    st._R1,
    st._R5, -- New row number for each division and district
    st._R6, -- New row number for each school
    MAX(st._R2) AS `_R2`, -- Total for division
    MAX(st._R3) AS `_R3`, -- Total for district
    MAX(st._R4) AS `_R4`, -- Total for school
    dsc.district_school_count AS `_DISTRICT_SCHOOLCOUNT`, -- Count of unique schools per district in jb_coa_ppe_list
    st.DIVISION,
    st.DIVISION_NAME,
    st.CONG_DISTRICT,
    st.DISTRICT_ID,
    st.DISTRICT,
    st.SCHOOLID,
    st.SCHOOLNAME,
    st.ADMINISTRATOR,
    st.CN,
    st.DEMAIL
FROM
    SchoolTotals AS st
LEFT JOIN
    DistrictSchoolCounts AS dsc ON st.DISTRICT_ID = dsc.district_id
GROUP BY
    st.DIVISION, st.DISTRICT_ID, st.SCHOOLID 
ORDER BY
    st._R5 ASC, st.DISTRICT ASC, st.SCHOOLNAME ASC;


        ";

        $query = $this->db->query($sql);
        $rs = $query->result();

        return $rs;
    }

    public function mp_annex_a_by_schoolid($school_idnumber) {
        $sql = " 
SELECT
	jb_coa_ppe_list.id,
	jb_district.`name` as `DISTRICT`,    
	jb_school.school_idnumber as `SCHOOLID`, 
	jb_school.`name` as `SCHOOLNAME`, 
  #ROW_NUMBER() OVER (PARTITION BY jb_school.school_idnumber) AS `_R2`,
	IF(ROW_NUMBER() OVER (PARTITION BY jb_district.`name`,jb_school.`name`)=1,
	CONCAT(jb_school.`name`,' - ',
	FORMAT(SUM(jb_coa_ppe_list.total_value) OVER (PARTITION BY jb_district.`name`,jb_school.`name`),2)
	),
	NULL) as `SCH NAME`, 
	
	COUNT(*) OVER (PARTITION BY jb_district.`name`, jb_school.name ) AS `_R4`,
  ROW_NUMBER() OVER (PARTITION BY 	jb_district.`name`,jb_school.`name`) AS `_R1`,
	
	
	FORMAT(SUM(jb_coa_ppe_list.total_value) OVER (PARTITION BY jb_district.`name`,jb_school.`name`),2) AS `GRAND_TOTAL`,
	FORMAT(SUM(jb_coa_ppe_list.total_value) OVER (PARTITION BY jb_district.`name`,jb_school.`name`,jb_coa_ppe_group.id),2) as `SUM_PER_GROUP`,
	
  ROW_NUMBER() OVER (PARTITION BY 	jb_district.`name`,jb_school.name,	jb_coa_ppe_group.id) AS `_R2`,
	COUNT(*) OVER (PARTITION BY jb_district.`name`, jb_school.name, jb_coa_ppe_group.id) AS `_R3`,
	
	IF(ROW_NUMBER() OVER (PARTITION BY jb_district.`name`,jb_school.`name`,jb_coa_ppe_group.id)=1,
	CONCAT(jb_coa_ppe_group.`name`,' [',
	COUNT(*) OVER (PARTITION BY jb_district.`name`, jb_school.name, jb_coa_ppe_group.id),'] - ',
	FORMAT(SUM(jb_coa_ppe_list.total_value) OVER (PARTITION BY jb_district.`name`,jb_school.`name`,jb_coa_ppe_group.id),2)
	),
	null) as `_GROUPCONCAT`, 
	jb_coa_ppe_group.`name` AS GROUP_NAME,
  #ROW_NUMBER() OVER (PARTITION BY jb_coa_ppe_group.`name`) AS `_R3`,
	jb_coa_ppe_group_article.`name` as `ARTICLE`, 
	jb_coa_ppe_list.description as `DESCRIPTION`, 
	jb_coa_ppe_list.person_accountable as `PERSON_ACCOUNTABLE`,
	jb_coa_ppe_list.old_property_no_assigned, 
	jb_coa_ppe_list.new_property_no_assigned, 
	jb_coa_ppe_list.unit_of_measure, 
	FORMAT(jb_coa_ppe_list.unit_value,2) as unit_value, 
	jb_coa_ppe_list.quantity_per_property_card, 
	jb_coa_ppe_list.quantity_per_physical_count, 
	FORMAT(jb_coa_ppe_list.total_value,2) as total_value, 
	jb_coa_ppe_list.date_acquired, 
	jb_coa_ppe_list.localtion_whereabouts, 
	jb_coa_ppe_list.condition_name, 
	jb_coa_ppe_list.remarks, 
	jb_coa_ppe_list.is_existing
FROM
	jb_coa_ppe_list
	INNER JOIN
	jb_coa_ppe_group_article
	ON 
		jb_coa_ppe_list.article_id = jb_coa_ppe_group_article.id
	INNER JOIN
	jb_coa_ppe_group
	ON 
		jb_coa_ppe_group_article.group_id = jb_coa_ppe_group.id
	INNER JOIN
	jb_district
	INNER JOIN
	jb_school
	ON 
		jb_district.district_id = jb_school.district_id AND
		jb_coa_ppe_list.school_idnumber = jb_school.school_idnumber
WHERE
	jb_school.school_idnumber = " . $school_idnumber . "
        ";

        $query = $this->db->query($sql);
        $rs = $query->result();

        return $rs;
    }

    public function mp_annex_a_by_districtid($district_id) {
        $sql = " 
SELECT
	jb_coa_ppe_list.id,
	jb_district.`name` as `DISTRICT`,    
	jb_school.school_idnumber as `SCHOOLID`, 
	jb_school.`name` as `SCHOOLNAME`, 
  #ROW_NUMBER() OVER (PARTITION BY jb_school.school_idnumber) AS `_R2`,
	IF(ROW_NUMBER() OVER (PARTITION BY jb_district.`name`,jb_school.`name`)=1,
	CONCAT(jb_school.`name`,' - ',
	FORMAT(SUM(jb_coa_ppe_list.total_value) OVER (PARTITION BY jb_district.`name`,jb_school.`name`),2)
	),
	NULL) as `SCH NAME`, 
	
	COUNT(*) OVER (PARTITION BY jb_district.`name`, jb_school.name ) AS `_R4`,
  ROW_NUMBER() OVER (PARTITION BY 	jb_district.`name`,jb_school.`name`) AS `_R1`,
	
	
	FORMAT(SUM(jb_coa_ppe_list.total_value) OVER (PARTITION BY jb_district.`name`,jb_school.`name`),2) AS `GRAND_TOTAL`,
	FORMAT(SUM(jb_coa_ppe_list.total_value) OVER (PARTITION BY jb_district.`name`,jb_school.`name`,jb_coa_ppe_group.id),2) as `SUM_PER_GROUP`,
	
  ROW_NUMBER() OVER (PARTITION BY 	jb_district.`name`,jb_school.name,	jb_coa_ppe_group.id) AS `_R2`,
	COUNT(*) OVER (PARTITION BY jb_district.`name`, jb_school.name, jb_coa_ppe_group.id) AS `_R3`,
	
	IF(ROW_NUMBER() OVER (PARTITION BY jb_district.`name`,jb_school.`name`,jb_coa_ppe_group.id)=1,
	CONCAT(jb_coa_ppe_group.`name`,' [',
	COUNT(*) OVER (PARTITION BY jb_district.`name`, jb_school.name, jb_coa_ppe_group.id),'] - ',
	FORMAT(SUM(jb_coa_ppe_list.total_value) OVER (PARTITION BY jb_district.`name`,jb_school.`name`,jb_coa_ppe_group.id),2)
	),
	null) as `_GROUPCONCAT`, 
	jb_coa_ppe_group.`name` AS GROUP_NAME,
  #ROW_NUMBER() OVER (PARTITION BY jb_coa_ppe_group.`name`) AS `_R3`,
	jb_coa_ppe_group_article.`name` as `ARTICLE`, 
	jb_coa_ppe_list.description as `DESCRIPTION`, 
	jb_coa_ppe_list.person_accountable as `PERSON_ACCOUNTABLE`,
	jb_coa_ppe_list.old_property_no_assigned, 
	jb_coa_ppe_list.new_property_no_assigned, 
	jb_coa_ppe_list.unit_of_measure, 
	FORMAT(jb_coa_ppe_list.unit_value,2) as unit_value, 
	jb_coa_ppe_list.quantity_per_property_card, 
	jb_coa_ppe_list.quantity_per_physical_count, 
	FORMAT(jb_coa_ppe_list.total_value,2) as total_value, 
	jb_coa_ppe_list.date_acquired, 
	jb_coa_ppe_list.localtion_whereabouts, 
	jb_coa_ppe_list.condition_name, 
	jb_coa_ppe_list.remarks, 
	jb_coa_ppe_list.is_existing
FROM
	jb_coa_ppe_list
	INNER JOIN
	jb_coa_ppe_group_article
	ON 
		jb_coa_ppe_list.article_id = jb_coa_ppe_group_article.id
	INNER JOIN
	jb_coa_ppe_group
	ON 
		jb_coa_ppe_group_article.group_id = jb_coa_ppe_group.id
	INNER JOIN
	jb_district
	INNER JOIN
	jb_school
	ON 
		jb_district.district_id = jb_school.district_id AND
		jb_coa_ppe_list.school_idnumber = jb_school.school_idnumber
WHERE
	jb_district.district_id = " . $district_id . "
        ";

        $query = $this->db->query($sql);
        $rs = $query->result();

        return $rs;
    }

    //
    public function ftbl_schools_annex_b() {
        $sql = "
WITH SchoolTotals AS (
    SELECT
        ROW_NUMBER() OVER (PARTITION BY jb_division.division_id ) AS `_R1`,
        ROW_NUMBER() OVER (PARTITION BY jb_division.division_id, jb_district.district_id ) AS `_R5`, -- New row number for division and district
        ROW_NUMBER() OVER (PARTITION BY jb_division.division_id, jb_district.district_id, jb_school.school_idnumber ) AS `_R6`, -- New row number for division and district
        FORMAT(SUM(jb_coa_ppe_list.total_value) OVER (PARTITION BY jb_division.division_id), 2) AS `_R2`, -- Total for division, formatted to 2 decimals
        FORMAT(SUM(jb_coa_ppe_list.total_value) OVER (PARTITION BY jb_district.district_id), 2) AS `_R3`, -- Total for district, formatted to 2 decimals
        FORMAT(SUM(jb_coa_ppe_list.total_value) OVER (PARTITION BY jb_school.school_idnumber), 2) AS `_R4`, -- Total for school, formatted to 2 decimals
        jb_division.division_id AS DIVISION,
        jb_division.`name` AS DIVISION_NAME,
        jb_district.district_id AS DISTRICT_ID, 
        jb_district.`name` AS DISTRICT, 
        jb_school.school_idnumber AS SCHOOLID, 
        jb_school.congressional_district as CONG_DISTRICT,
        jb_school.`name` AS SCHOOLNAME, 
        jb_school_administrator.administrator_name AS ADMINISTRATOR, 
        jb_school_administrator.contact_number AS CN, 
        jb_school_administrator.email_deped AS DEMAIL
    FROM
        jb_school
    INNER JOIN
        jb_district ON jb_school.district_id = jb_district.district_id
    INNER JOIN
        jb_division ON jb_district.division_id = jb_division.division_id
    INNER JOIN
        jb_school_administrator ON jb_school.school_idnumber = jb_school_administrator.school_idnumber
    INNER JOIN
        jb_coa_ppe_list ON jb_school.school_idnumber = jb_coa_ppe_list.school_idnumber 
    WHERE
        jb_coa_ppe_list.is_existing = TRUE
),
DistrictSchoolCounts AS (
    SELECT
        jb_district.district_id,
        COUNT(DISTINCT jb_school.school_idnumber) AS district_school_count
    FROM
        jb_coa_ppe_list
    INNER JOIN
        jb_school ON jb_coa_ppe_list.school_idnumber = jb_school.school_idnumber
    INNER JOIN
        jb_district ON jb_school.district_id = jb_district.district_id
    WHERE
        jb_coa_ppe_list.is_existing = TRUE
    GROUP BY
        jb_district.district_id
)

SELECT
    st._R1,
    st._R5, -- New row number for each division and district
    st._R6, -- New row number for each school
    MAX(st._R2) AS `_R2`, -- Total for division
    MAX(st._R3) AS `_R3`, -- Total for district
    MAX(st._R4) AS `_R4`, -- Total for school
    dsc.district_school_count AS `_DISTRICT_SCHOOLCOUNT`, -- Count of unique schools per district in jb_coa_ppe_list
    st.DIVISION,
    st.DIVISION_NAME,
    st.CONG_DISTRICT,
    st.DISTRICT_ID,
    st.DISTRICT,
    st.SCHOOLID,
    st.SCHOOLNAME,
    st.ADMINISTRATOR,
    st.CN,
    st.DEMAIL
FROM
    SchoolTotals AS st
LEFT JOIN
    DistrictSchoolCounts AS dsc ON st.DISTRICT_ID = dsc.district_id
GROUP BY
    st.DIVISION, st.DISTRICT_ID, st.SCHOOLID 
ORDER BY
    st._R5 ASC, st.DISTRICT ASC, st.SCHOOLNAME ASC;
        ";

        $query = $this->db->query($sql);
        $rs = $query->result();

        return $rs;
    }

    public function mp_annex_b_by_schoolid($school_idnumber) {
        $sql = " 
SELECT
	jb_coa_ppe_list.id,
	jb_district.`name` as `DISTRICT`,    
	jb_school.school_idnumber as `SCHOOLID`, 
	jb_school.`name` as `SCHOOLNAME`, 
  #ROW_NUMBER() OVER (PARTITION BY jb_school.school_idnumber) AS `_R2`,
	IF(ROW_NUMBER() OVER (PARTITION BY jb_district.`name`,jb_school.`name`)=1,
	CONCAT(jb_school.`name`,' - ',
	FORMAT(SUM(jb_coa_ppe_list.total_value) OVER (PARTITION BY jb_district.`name`,jb_school.`name`),2)
	),
	NULL) as `SCH NAME`, 
	
	COUNT(*) OVER (PARTITION BY jb_district.`name`, jb_school.name ) AS `_R4`,
  ROW_NUMBER() OVER (PARTITION BY 	jb_district.`name`,jb_school.`name`) AS `_R1`,
	
	
	FORMAT(SUM(jb_coa_ppe_list.total_value) OVER (PARTITION BY jb_district.`name`,jb_school.`name`),2) AS `GRAND_TOTAL`,
	FORMAT(SUM(jb_coa_ppe_list.total_value) OVER (PARTITION BY jb_district.`name`,jb_school.`name`,jb_coa_ppe_group.id),2) as `SUM_PER_GROUP`,
	
  ROW_NUMBER() OVER (PARTITION BY 	jb_district.`name`,jb_school.name,	jb_coa_ppe_group.id) AS `_R2`,
	COUNT(*) OVER (PARTITION BY jb_district.`name`, jb_school.name, jb_coa_ppe_group.id) AS `_R3`,
	
	IF(ROW_NUMBER() OVER (PARTITION BY jb_district.`name`,jb_school.`name`,jb_coa_ppe_group.id)=1,
	CONCAT(jb_coa_ppe_group.`name`,' [',
	COUNT(*) OVER (PARTITION BY jb_district.`name`, jb_school.name, jb_coa_ppe_group.id),'] - ',
	FORMAT(SUM(jb_coa_ppe_list.total_value) OVER (PARTITION BY jb_district.`name`,jb_school.`name`,jb_coa_ppe_group.id),2)
	),
	null) as `_GROUPCONCAT`, 
	jb_coa_ppe_group.`name` AS GROUP_NAME,
  #ROW_NUMBER() OVER (PARTITION BY jb_coa_ppe_group.`name`) AS `_R3`,
	jb_coa_ppe_group_article.`name` as `ARTICLE`, 
	jb_coa_ppe_list.description as `DESCRIPTION`, 
	jb_coa_ppe_list.person_accountable as `PERSON_ACCOUNTABLE`,
	jb_coa_ppe_list.old_property_no_assigned, 
	jb_coa_ppe_list.new_property_no_assigned, 
	jb_coa_ppe_list.unit_of_measure, 
	FORMAT(jb_coa_ppe_list.unit_value,2) as unit_value, 
	jb_coa_ppe_list.quantity_per_property_card, 
	jb_coa_ppe_list.quantity_per_physical_count, 
	FORMAT(jb_coa_ppe_list.total_value,2) as total_value, 
	jb_coa_ppe_list.date_acquired, 
	jb_coa_ppe_list.localtion_whereabouts, 
	jb_coa_ppe_list.condition_name, 
	jb_coa_ppe_list.remarks, 
	jb_coa_ppe_list.is_existing
FROM
	jb_coa_ppe_list
	INNER JOIN
	jb_coa_ppe_group_article
	ON 
		jb_coa_ppe_list.article_id = jb_coa_ppe_group_article.id
	INNER JOIN
	jb_coa_ppe_group
	ON 
		jb_coa_ppe_group_article.group_id = jb_coa_ppe_group.id
	INNER JOIN
	jb_district
	INNER JOIN
	jb_school
	ON 
		jb_district.district_id = jb_school.district_id AND
		jb_coa_ppe_list.school_idnumber = jb_school.school_idnumber
WHERE
	jb_school.school_idnumber = " . $school_idnumber . "  AND jb_coa_ppe_list.is_existing = true
        ";

        $query = $this->db->query($sql);
        $rs = $query->result();

        return $rs;
    }

    public function mp_annex_b_by_districtid($district_id) {
        $sql = " 
SELECT
	jb_coa_ppe_list.id,
	jb_district.`name` as `DISTRICT`,    
	jb_school.school_idnumber as `SCHOOLID`, 
	jb_school.`name` as `SCHOOLNAME`, 
  #ROW_NUMBER() OVER (PARTITION BY jb_school.school_idnumber) AS `_R2`,
	IF(ROW_NUMBER() OVER (PARTITION BY jb_district.`name`,jb_school.`name`)=1,
	CONCAT(jb_school.`name`,' - ',
	FORMAT(SUM(jb_coa_ppe_list.total_value) OVER (PARTITION BY jb_district.`name`,jb_school.`name`),2)
	),
	NULL) as `SCH NAME`, 
	
	COUNT(*) OVER (PARTITION BY jb_district.`name`, jb_school.name ) AS `_R4`,
  ROW_NUMBER() OVER (PARTITION BY 	jb_district.`name`,jb_school.`name`) AS `_R1`,
	
	
	FORMAT(SUM(jb_coa_ppe_list.total_value) OVER (PARTITION BY jb_district.`name`,jb_school.`name`),2) AS `GRAND_TOTAL`,
	FORMAT(SUM(jb_coa_ppe_list.total_value) OVER (PARTITION BY jb_district.`name`,jb_school.`name`,jb_coa_ppe_group.id),2) as `SUM_PER_GROUP`,
	
  ROW_NUMBER() OVER (PARTITION BY 	jb_district.`name`,jb_school.name,	jb_coa_ppe_group.id) AS `_R2`,
	COUNT(*) OVER (PARTITION BY jb_district.`name`, jb_school.name, jb_coa_ppe_group.id) AS `_R3`,
	
	IF(ROW_NUMBER() OVER (PARTITION BY jb_district.`name`,jb_school.`name`,jb_coa_ppe_group.id)=1,
	CONCAT(jb_coa_ppe_group.`name`,' [',
	COUNT(*) OVER (PARTITION BY jb_district.`name`, jb_school.name, jb_coa_ppe_group.id),'] - ',
	FORMAT(SUM(jb_coa_ppe_list.total_value) OVER (PARTITION BY jb_district.`name`,jb_school.`name`,jb_coa_ppe_group.id),2)
	),
	null) as `_GROUPCONCAT`, 
	jb_coa_ppe_group.`name` AS GROUP_NAME,
  #ROW_NUMBER() OVER (PARTITION BY jb_coa_ppe_group.`name`) AS `_R3`,
	jb_coa_ppe_group_article.`name` as `ARTICLE`, 
	jb_coa_ppe_list.description as `DESCRIPTION`, 
	jb_coa_ppe_list.person_accountable as `PERSON_ACCOUNTABLE`,
	jb_coa_ppe_list.old_property_no_assigned, 
	jb_coa_ppe_list.new_property_no_assigned, 
	jb_coa_ppe_list.unit_of_measure, 
	FORMAT(jb_coa_ppe_list.unit_value,2) as unit_value, 
	jb_coa_ppe_list.quantity_per_property_card, 
	jb_coa_ppe_list.quantity_per_physical_count, 
	FORMAT(jb_coa_ppe_list.total_value,2) as total_value, 
	jb_coa_ppe_list.date_acquired, 
	jb_coa_ppe_list.localtion_whereabouts, 
	jb_coa_ppe_list.condition_name, 
	jb_coa_ppe_list.remarks, 
	jb_coa_ppe_list.is_existing
FROM
	jb_coa_ppe_list
	INNER JOIN
	jb_coa_ppe_group_article
	ON 
		jb_coa_ppe_list.article_id = jb_coa_ppe_group_article.id
	INNER JOIN
	jb_coa_ppe_group
	ON 
		jb_coa_ppe_group_article.group_id = jb_coa_ppe_group.id
	INNER JOIN
	jb_district
	INNER JOIN
	jb_school
	ON 
		jb_district.district_id = jb_school.district_id AND
		jb_coa_ppe_list.school_idnumber = jb_school.school_idnumber
WHERE
	jb_district.district_id = " . $district_id . "  AND jb_coa_ppe_list.is_existing = true
        ";

        $query = $this->db->query($sql);
        $rs = $query->result();

        return $rs;
    }

    // NOT USED
    public function ftbl_schools_annex_cold_not_countschools_per_district() {
        $sql = "
WITH SchoolTotals AS (
    SELECT
        ROW_NUMBER() OVER (PARTITION BY jb_division.division_id ) AS `_R1`,
        ROW_NUMBER() OVER (PARTITION BY jb_division.division_id, jb_district.district_id ) AS `_R5`, -- New row number for division and district
        ROW_NUMBER() OVER (PARTITION BY jb_division.division_id, jb_district.district_id, jb_school.school_idnumber ) AS `_R6`, -- New row number for division and district
        FORMAT(SUM(jb_coa_ppe_list.total_value) OVER (PARTITION BY jb_division.`division_id`), 2) AS `_R2`, -- Total for division, formatted to 2 decimals
        FORMAT(SUM(jb_coa_ppe_list.total_value) OVER (PARTITION BY jb_district.`district_id`), 2) AS `_R3`, -- Total for district, formatted to 2 decimals
        FORMAT(SUM(jb_coa_ppe_list.total_value) OVER (PARTITION BY jb_school.school_idnumber), 2) AS `_R4`, -- Total for school, formatted to 2 decimals
        jb_division.division_id AS DIVISION,
        jb_division.`name` AS DIVISION_NAME,
        jb_district.`district_id` AS DISTRICT_ID, 
        jb_district.`name` AS DISTRICT, 
        jb_school.school_idnumber AS SCHOOLID, 
        jb_school.congressional_district as CONG_DISTRICT,
        jb_school.`name` AS SCHOOLNAME, 
        jb_school_administrator.administrator_name AS ADMINISTRATOR, 
        jb_school_administrator.contact_number AS CN, 
        jb_school_administrator.email_deped AS DEMAIL
    FROM
        jb_school
    INNER JOIN
        jb_district ON jb_school.district_id = jb_district.district_id
    INNER JOIN
        jb_division ON jb_district.division_id = jb_division.division_id
    INNER JOIN
        jb_school_administrator ON jb_school.school_idnumber = jb_school_administrator.school_idnumber
    INNER JOIN
        jb_coa_ppe_list ON jb_school.school_idnumber = jb_coa_ppe_list.school_idnumber 
    WHERE
        jb_coa_ppe_list.is_existing = FALSE
)

SELECT
    _R1,
    _R5, -- New row number for each division and district
    _R6, -- New row number for each school
    MAX(_R2) AS `_R2`, -- Total for division
    MAX(_R3) AS `_R3`, -- Total for district
    MAX(_R4) AS `_R4`, -- Total for school
    DIVISION,
    DIVISION_NAME,
    CONG_DISTRICT,
    DISTRICT_ID,
    DISTRICT,
    SCHOOLID,
    SCHOOLNAME,
    ADMINISTRATOR,
    CN,
    DEMAIL
FROM
    SchoolTotals
GROUP BY
    DIVISION, DISTRICT_ID, SCHOOLID 
ORDER BY
    _R5 ASC, DISTRICT ASC,  SCHOOLNAME ASC ;
        ";

        $query = $this->db->query($sql);
        $rs = $query->result();

        return $rs;
    }

    public function ftbl_schools_annex_c() {
        $sql = "
WITH SchoolTotals AS (
    SELECT
        ROW_NUMBER() OVER (PARTITION BY jb_division.division_id ) AS `_R1`,
        ROW_NUMBER() OVER (PARTITION BY jb_division.division_id, jb_district.district_id ) AS `_R5`, -- New row number for division and district
        ROW_NUMBER() OVER (PARTITION BY jb_division.division_id, jb_district.district_id, jb_school.school_idnumber ) AS `_R6`, -- New row number for division and district
        FORMAT(SUM(jb_coa_ppe_list.total_value) OVER (PARTITION BY jb_division.division_id), 2) AS `_R2`, -- Total for division, formatted to 2 decimals
        FORMAT(SUM(jb_coa_ppe_list.total_value) OVER (PARTITION BY jb_district.district_id), 2) AS `_R3`, -- Total for district, formatted to 2 decimals
        FORMAT(SUM(jb_coa_ppe_list.total_value) OVER (PARTITION BY jb_school.school_idnumber), 2) AS `_R4`, -- Total for school, formatted to 2 decimals
        jb_division.division_id AS DIVISION,
        jb_division.`name` AS DIVISION_NAME,
        jb_district.district_id AS DISTRICT_ID, 
        jb_district.`name` AS DISTRICT, 
        jb_school.school_idnumber AS SCHOOLID, 
        jb_school.congressional_district as CONG_DISTRICT,
        jb_school.`name` AS SCHOOLNAME, 
        jb_school_administrator.administrator_name AS ADMINISTRATOR, 
        jb_school_administrator.contact_number AS CN, 
        jb_school_administrator.email_deped AS DEMAIL
    FROM
        jb_school
    INNER JOIN
        jb_district ON jb_school.district_id = jb_district.district_id
    INNER JOIN
        jb_division ON jb_district.division_id = jb_division.division_id
    INNER JOIN
        jb_school_administrator ON jb_school.school_idnumber = jb_school_administrator.school_idnumber
    INNER JOIN
        jb_coa_ppe_list ON jb_school.school_idnumber = jb_coa_ppe_list.school_idnumber 
    WHERE
        jb_coa_ppe_list.is_existing = FALSE
),
DistrictSchoolCounts AS (
    SELECT
        jb_district.district_id,
        COUNT(DISTINCT jb_school.school_idnumber) AS district_school_count
    FROM
        jb_coa_ppe_list
    INNER JOIN
        jb_school ON jb_coa_ppe_list.school_idnumber = jb_school.school_idnumber
    INNER JOIN
        jb_district ON jb_school.district_id = jb_district.district_id
    WHERE
        jb_coa_ppe_list.is_existing = FALSE
    GROUP BY
        jb_district.district_id
)

SELECT
    st._R1,
    st._R5, -- New row number for each division and district
    st._R6, -- New row number for each school
    MAX(st._R2) AS `_R2`, -- Total for division
    MAX(st._R3) AS `_R3`, -- Total for district
    MAX(st._R4) AS `_R4`, -- Total for school
    dsc.district_school_count AS `_DISTRICT_SCHOOLCOUNT`, -- Count of unique schools per district in jb_coa_ppe_list
    st.DIVISION,
    st.DIVISION_NAME,
    st.CONG_DISTRICT,
    st.DISTRICT_ID,
    st.DISTRICT,
    st.SCHOOLID,
    st.SCHOOLNAME,
    st.ADMINISTRATOR,
    st.CN,
    st.DEMAIL
FROM
    SchoolTotals AS st
LEFT JOIN
    DistrictSchoolCounts AS dsc ON st.DISTRICT_ID = dsc.district_id
GROUP BY
    st.DIVISION, st.DISTRICT_ID, st.SCHOOLID 
ORDER BY
    st._R5 ASC, st.DISTRICT ASC, st.SCHOOLNAME ASC;
        ";

        $query = $this->db->query($sql);
        $rs = $query->result();

        return $rs;
    }

    public function mp_annex_c_by_schoolid($school_idnumber) {
        $sql = " 
SELECT
	jb_coa_ppe_list.id,
	jb_district.`name` as `DISTRICT`,    
	jb_school.school_idnumber as `SCHOOLID`, 
	jb_school.`name` as `SCHOOLNAME`, 
  #ROW_NUMBER() OVER (PARTITION BY jb_school.school_idnumber) AS `_R2`,
	IF(ROW_NUMBER() OVER (PARTITION BY jb_district.`name`,jb_school.`name`)=1,
	CONCAT(jb_school.`name`,' - ',
	FORMAT(SUM(jb_coa_ppe_list.total_value) OVER (PARTITION BY jb_district.`name`,jb_school.`name`),2)
	),
	NULL) as `SCH NAME`, 
	
	COUNT(*) OVER (PARTITION BY jb_district.`name`, jb_school.name ) AS `_R4`,
  ROW_NUMBER() OVER (PARTITION BY 	jb_district.`name`,jb_school.`name`) AS `_R1`,
	
	
	FORMAT(SUM(jb_coa_ppe_list.total_value) OVER (PARTITION BY jb_district.`name`,jb_school.`name`),2) AS `GRAND_TOTAL`,
	FORMAT(SUM(jb_coa_ppe_list.total_value) OVER (PARTITION BY jb_district.`name`,jb_school.`name`,jb_coa_ppe_group.id),2) as `SUM_PER_GROUP`,
	
  ROW_NUMBER() OVER (PARTITION BY 	jb_district.`name`,jb_school.name,	jb_coa_ppe_group.id) AS `_R2`,
	COUNT(*) OVER (PARTITION BY jb_district.`name`, jb_school.name, jb_coa_ppe_group.id) AS `_R3`,
	
	IF(ROW_NUMBER() OVER (PARTITION BY jb_district.`name`,jb_school.`name`,jb_coa_ppe_group.id)=1,
	CONCAT(jb_coa_ppe_group.`name`,' [',
	COUNT(*) OVER (PARTITION BY jb_district.`name`, jb_school.name, jb_coa_ppe_group.id),'] - ',
	FORMAT(SUM(jb_coa_ppe_list.total_value) OVER (PARTITION BY jb_district.`name`,jb_school.`name`,jb_coa_ppe_group.id),2)
	),
	null) as `_GROUPCONCAT`, 
	jb_coa_ppe_group.`name` AS GROUP_NAME,
  #ROW_NUMBER() OVER (PARTITION BY jb_coa_ppe_group.`name`) AS `_R3`,
	jb_coa_ppe_group_article.`name` as `ARTICLE`, 
	jb_coa_ppe_list.description as `DESCRIPTION`, 
	jb_coa_ppe_list.person_accountable as `PERSON_ACCOUNTABLE`,
	jb_coa_ppe_list.old_property_no_assigned, 
	jb_coa_ppe_list.new_property_no_assigned, 
	jb_coa_ppe_list.unit_of_measure, 
	FORMAT(jb_coa_ppe_list.unit_value,2) as unit_value, 
	jb_coa_ppe_list.quantity_per_property_card, 
	jb_coa_ppe_list.quantity_per_physical_count, 
	FORMAT(jb_coa_ppe_list.total_value,2) as total_value, 
	jb_coa_ppe_list.date_acquired, 
	jb_coa_ppe_list.localtion_whereabouts, 
	jb_coa_ppe_list.condition_name, 
	jb_coa_ppe_list.remarks, 
	jb_coa_ppe_list.is_existing
FROM
	jb_coa_ppe_list
	INNER JOIN
	jb_coa_ppe_group_article
	ON 
		jb_coa_ppe_list.article_id = jb_coa_ppe_group_article.id
	INNER JOIN
	jb_coa_ppe_group
	ON 
		jb_coa_ppe_group_article.group_id = jb_coa_ppe_group.id
	INNER JOIN
	jb_district
	INNER JOIN
	jb_school
	ON 
		jb_district.district_id = jb_school.district_id AND
		jb_coa_ppe_list.school_idnumber = jb_school.school_idnumber
WHERE
	jb_school.school_idnumber = " . $school_idnumber . "  AND jb_coa_ppe_list.is_existing = FALSE
        ";

        $query = $this->db->query($sql);
        $rs = $query->result();

        return $rs;
    }

    public function mp_annex_c_by_districtid($district_id) {
        $sql = " 
SELECT
	jb_coa_ppe_list.id,
	jb_district.`name` as `DISTRICT`,    
	jb_school.school_idnumber as `SCHOOLID`, 
	jb_school.`name` as `SCHOOLNAME`, 
  #ROW_NUMBER() OVER (PARTITION BY jb_school.school_idnumber) AS `_R2`,
	IF(ROW_NUMBER() OVER (PARTITION BY jb_district.`name`,jb_school.`name`)=1,
	CONCAT(jb_school.`name`,' - ',
	FORMAT(SUM(jb_coa_ppe_list.total_value) OVER (PARTITION BY jb_district.`name`,jb_school.`name`),2)
	),
	NULL) as `SCH NAME`, 
	
	COUNT(*) OVER (PARTITION BY jb_district.`name`, jb_school.name ) AS `_R4`,
  ROW_NUMBER() OVER (PARTITION BY 	jb_district.`name`,jb_school.`name`) AS `_R1`,
	
	
	FORMAT(SUM(jb_coa_ppe_list.total_value) OVER (PARTITION BY jb_district.`name`,jb_school.`name`),2) AS `GRAND_TOTAL`,
	FORMAT(SUM(jb_coa_ppe_list.total_value) OVER (PARTITION BY jb_district.`name`,jb_school.`name`,jb_coa_ppe_group.id),2) as `SUM_PER_GROUP`,
	
  ROW_NUMBER() OVER (PARTITION BY 	jb_district.`name`,jb_school.name,	jb_coa_ppe_group.id) AS `_R2`,
	COUNT(*) OVER (PARTITION BY jb_district.`name`, jb_school.name, jb_coa_ppe_group.id) AS `_R3`,
	
	IF(ROW_NUMBER() OVER (PARTITION BY jb_district.`name`,jb_school.`name`,jb_coa_ppe_group.id)=1,
	CONCAT(jb_coa_ppe_group.`name`,' [',
	COUNT(*) OVER (PARTITION BY jb_district.`name`, jb_school.name, jb_coa_ppe_group.id),'] - ',
	FORMAT(SUM(jb_coa_ppe_list.total_value) OVER (PARTITION BY jb_district.`name`,jb_school.`name`,jb_coa_ppe_group.id),2)
	),
	null) as `_GROUPCONCAT`, 
	jb_coa_ppe_group.`name` AS GROUP_NAME,
  #ROW_NUMBER() OVER (PARTITION BY jb_coa_ppe_group.`name`) AS `_R3`,
	jb_coa_ppe_group_article.`name` as `ARTICLE`, 
	jb_coa_ppe_list.description as `DESCRIPTION`, 
	jb_coa_ppe_list.person_accountable as `PERSON_ACCOUNTABLE`,
	jb_coa_ppe_list.old_property_no_assigned, 
	jb_coa_ppe_list.new_property_no_assigned, 
	jb_coa_ppe_list.unit_of_measure, 
	FORMAT(jb_coa_ppe_list.unit_value,2) as unit_value, 
	jb_coa_ppe_list.quantity_per_property_card, 
	jb_coa_ppe_list.quantity_per_physical_count, 
	FORMAT(jb_coa_ppe_list.total_value,2) as total_value, 
	jb_coa_ppe_list.date_acquired, 
	jb_coa_ppe_list.localtion_whereabouts, 
	jb_coa_ppe_list.condition_name, 
	jb_coa_ppe_list.remarks, 
	jb_coa_ppe_list.is_existing
FROM
	jb_coa_ppe_list
	INNER JOIN
	jb_coa_ppe_group_article
	ON 
		jb_coa_ppe_list.article_id = jb_coa_ppe_group_article.id
	INNER JOIN
	jb_coa_ppe_group
	ON 
		jb_coa_ppe_group_article.group_id = jb_coa_ppe_group.id
	INNER JOIN
	jb_district
	INNER JOIN
	jb_school
	ON 
		jb_district.district_id = jb_school.district_id AND
		jb_coa_ppe_list.school_idnumber = jb_school.school_idnumber
WHERE
	jb_district.district_id = " . $district_id . "  AND jb_coa_ppe_list.is_existing = FALSE
        ";

        $query = $this->db->query($sql);
        $rs = $query->result();

        return $rs;
    }

    // FOR DISPLAY
    public function get_all_records_by_school_id($school_idnumber) {
        $sql = " 
SELECT
	jb_coa_ppe_list.id,
	jb_district.`name` as `DISTRICT`,    
	jb_school.school_idnumber as `SCHOOLID`, 
	jb_school.`name` as `SCHOOLNAME`, 
  #ROW_NUMBER() OVER (PARTITION BY jb_school.school_idnumber) AS `_R2`,
	IF(ROW_NUMBER() OVER (PARTITION BY jb_district.`name`,jb_school.`name`)=1,
	CONCAT(jb_school.`name`,' - ',
	FORMAT(SUM(jb_coa_ppe_list.total_value) OVER (PARTITION BY jb_district.`name`,jb_school.`name`),2)
	),
	NULL) as `SCH NAME`, 
	
	COUNT(*) OVER (PARTITION BY jb_district.`name`, jb_school.name ) AS `_R4`,
  ROW_NUMBER() OVER (PARTITION BY 	jb_district.`name`,jb_school.`name`) AS `_R1`,
	
	
	FORMAT(SUM(jb_coa_ppe_list.total_value) OVER (PARTITION BY jb_district.`name`,jb_school.`name`),2) AS `GRAND_TOTAL`,
	FORMAT(SUM(jb_coa_ppe_list.total_value) OVER (PARTITION BY jb_district.`name`,jb_school.`name`,jb_coa_ppe_group.id),2) as `SUM_PER_GROUP`,
	
  ROW_NUMBER() OVER (PARTITION BY 	jb_district.`name`,jb_school.name,	jb_coa_ppe_group.id) AS `_R2`,
	COUNT(*) OVER (PARTITION BY jb_district.`name`, jb_school.name, jb_coa_ppe_group.id) AS `_R3`,
	
	IF(ROW_NUMBER() OVER (PARTITION BY jb_district.`name`,jb_school.`name`,jb_coa_ppe_group.id)=1,
	CONCAT(jb_coa_ppe_group.`name`,' [',
	COUNT(*) OVER (PARTITION BY jb_district.`name`, jb_school.name, jb_coa_ppe_group.id),'] - ',
	FORMAT(SUM(jb_coa_ppe_list.total_value) OVER (PARTITION BY jb_district.`name`,jb_school.`name`,jb_coa_ppe_group.id),2)
	),
	null) as `_GROUPCONCAT`, 
	jb_coa_ppe_group.`name` AS GROUP_NAME,
  #ROW_NUMBER() OVER (PARTITION BY jb_coa_ppe_group.`name`) AS `_R3`,
	jb_coa_ppe_group_article.`name` as `ARTICLE`, 
	jb_coa_ppe_list.description as `DESCRIPTION`, 
	jb_coa_ppe_list.person_accountable as `PERSON_ACCOUNTABLE`,
	jb_coa_ppe_list.old_property_no_assigned, 
	jb_coa_ppe_list.new_property_no_assigned, 
	jb_coa_ppe_list.article_id as `ARTICLE_ID`, 
	jb_coa_ppe_list.unit_of_measure, 
	FORMAT(jb_coa_ppe_list.unit_value,2) as unit_value, 
	jb_coa_ppe_list.quantity_per_property_card, 
	jb_coa_ppe_list.quantity_per_physical_count, 
	FORMAT(jb_coa_ppe_list.total_value,2) as total_value, 
	jb_coa_ppe_list.date_acquired, 
	jb_coa_ppe_list.localtion_whereabouts, 
	jb_coa_ppe_list.condition_name, 
	jb_coa_ppe_list.remarks, 
	jb_coa_ppe_list.is_existing
FROM
	jb_coa_ppe_list
	INNER JOIN
	jb_coa_ppe_group_article
	ON 
		jb_coa_ppe_list.article_id = jb_coa_ppe_group_article.id
	INNER JOIN
	jb_coa_ppe_group
	ON 
		jb_coa_ppe_group_article.group_id = jb_coa_ppe_group.id
	INNER JOIN
	jb_district
	INNER JOIN
	jb_school
	ON 
		jb_district.district_id = jb_school.district_id AND
		jb_coa_ppe_list.school_idnumber = jb_school.school_idnumber
WHERE
	jb_school.school_idnumber = " . $school_idnumber . "
        ";

        $query = $this->db->query($sql);
        $rs = $query->result();

        return $rs;
    }

    // GET SCHOOL DETAILS
    public function get_school_info_by_id($school_idnumber) {
        $sql = " 
SELECT
	jb_district.`name` AS distname, 
	jb_school.`name` AS schname, 
	jb_school.school_idnumber AS schidnumber
FROM
	jb_school
	INNER JOIN
	jb_district
	ON 
		jb_school.district_id = jb_district.district_id
	INNER JOIN
	jb_division
	ON 
		jb_district.division_id = jb_division.division_id
	INNER JOIN
	jb_school_administrator
	ON 
		jb_school.school_idnumber = jb_school_administrator.school_idnumber
WHERE
	jb_school.school_idnumber = " . $school_idnumber . "
        ";

        $query = $this->db->query($sql);
        $rs = $query->result();

        return $rs;
    }
}
