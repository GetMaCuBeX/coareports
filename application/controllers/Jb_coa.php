<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Jb_coa extends CI_Controller {

    private $_username = 304316;
    private $values;
    private $partials = 'jb/partials/';
    private $p_ppe = 'jb/coa/page/ppe';
    private $p_ppe_admin = 'jb/coa/page/ppe_admin';
    //    
    private $ftbl_annex_a = 'jb/coa/form/table/annex_a';
    private $mp_school_ppe_annex_a = 'jb/coa/mediaprint/annex/school_ppe_annex_a';
    //
    private $ftbl_annex_b = 'jb/coa/form/table/annex_b';
    private $mp_school_ppe_annex_b = 'jb/coa/mediaprint/annex/school_ppe_annex_b';
    //
    private $ftbl_annex_c = 'jb/coa/form/table/annex_c';
    private $mp_school_ppe_annex_c = 'jb/coa/mediaprint/annex/school_ppe_annex_c';
    //    
    private $ftbl_school_ppe_list = 'jb/coa/form/table/school_ppe_list';
    //
    private $mp_school_ppe_annex_a_division = 'jb/coa/mediaprint/annex/school_ppe_annex_a_division';
    private $mp_school_ppe_annex_b_division = 'jb/coa/mediaprint/annex/school_ppe_annex_b_division';
    private $mp_school_ppe_annex_c_division = 'jb/coa/mediaprint/annex/school_ppe_annex_c_division';
    //
    private $test_page = 'jb/coa/page/test';
    //
    private $crud_ppe_create = 'jb/coa/crud/ppe_create';
    private $crud_ppe_edit = 'jb/coa/crud/ppe_edit';
    private $crud_location_barangay = 'jb/coa/crud/location_barangay';

    public function __construct() {
        parent::__construct();
        $this->values = [
            "PAGE" => 'COA',
            "FOOTER" => '2024 - 2025 © Velonic theme by DAVOR',
            "EMAIL_ADDRESS" => 'davor.ict@deped.gov.ph',
            "WEB_PAGE" => 'https://depeddavor.com/home/',
            "REQUEST_COUNT_ISDONE_FALSE" => 0,
            "MAX_REQUEST_PER_USER" => 2,
            "DATE_FROM" => '',
            "DATE_TO" => ''
        ];
    }

    public function index() {
//        if ($this->_IS_IN_SESSION_schID()) { // CHECK IF SESSION LOGIN
//            $this->values["PAGE"] = "DASHBOARD";
//            $this->_set_values();
//            $this->load->view($this->partials . 'header', $this->values);
//            $this->load->view($this->partials . 'topbar', $this->values);
//            $this->load->view($this->partials . 'sidebar', $this->values);
//            if ($this->_IS_AN_ADMIN_schID()) { // ADMIN USER
//                $this->load->view($this->p_ppe_admin);
//            } else { // REGULAR USER
//                $this->load->view($this->p_ppe);
//            }
//            $this->load->view($this->partials . 'footer', $this->values);
//        } else {
//            
//        }
    }

// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
// SIDEBAR - ANNEX
// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------

    public function annex_a() {
        $rs['rs'] = $this->jb_ppe_school_M->ftbl_schools_annex_a();

        $this->_loadview($this->ftbl_annex_a, $rs);
    }

    public function annex_b() {
        $rs['rs'] = $this->jb_ppe_school_M->ftbl_schools_annex_b();

        $this->_loadview($this->ftbl_annex_b, $rs);
    }

    public function annex_c() {
        $rs['rs'] = $this->jb_ppe_school_M->ftbl_schools_annex_c();

        $this->_loadview($this->ftbl_annex_c, $rs);
    }

// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
// SIDEBAR - LIST
// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
    public function set_session() {
        $_SESSION['username'] = $this->_username;
        $_SESSION['position'] = 'ADMIN';
        redirect($this->index());
    }

    public function unset_session() {
        session_unset();
        session_destroy();
        echo 'SESSION UNSET';
        echo '<br>';
        echo 'SESSION DESTROY';
    }

    public function school_ppe() {
        
        unset($_SESSION['username']); // COMMENT THIS ON PRODUCTION
        unset($_SESSION['position']); // COMMENT THIS ON PRODUCTION
        $this->_set_session(); // set DEFAULT USER ACCOUNT LOGIN
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ppe_list_id = isset($_POST['ppe_list_id']) ? htmlspecialchars($_POST['ppe_list_id']) : null;
            $article_id = isset($_POST['article_id']) ? htmlspecialchars($_POST['article_id']) : null;

            // EDIT
            if ($ppe_list_id) {
                // Fetch the existing data for the given ID
                $data['existing_data'] = $this->jb_ppe_list_M->get_selection_by_id($article_id); // get the id, group_id, name of jb_coa_ppe_group_article
                // Fetch all groups for the dropdown
                $data['groups'] = $this->jb_ppe_list_M->get_all_groups(); // Implement this method in your model
                $data['articles'] = $this->jb_ppe_list_M->get_articles_by_group_id($data['existing_data']->group_id);
                $data['ppe_list_selected'] = $this->jb_ppe_list_M->get_ppe_list_data_by_id($ppe_list_id);

                $this->_loadview($this->crud_ppe_edit, $data);
            } else {

                // SAVE
                $action = $_POST['action'] ?? '';
                $action = isset($_POST['action']) ? $_POST['action'] : '';
                if ($action === 'save') {
//                    $this->values["PAGE"] = "134717";
//                    $groupId = $this->input->post('group', true);     // XSS Filtering
//                    $articleId = $this->input->post('article', true); // XSS Filtering 
//
//                    $rs['groups'] = $this->jb_ppe_list_M->get_groups(); // Get groups for the first dropdown 
//                    $rs['rs'] = $this->jb_ppe_school_M->get_all_records_by_school_id(134717);
//                    $rs['school_details'] = $this->jb_ppe_school_M->get_school_info_by_id(134717);
//
//                    $this->_loadview($this->ftbl_school_ppe_list, $rs) 
//                    // Load form validation library if needed
                    // Load form validation library if needed
                    // Load form validation library if needed
                    $this->load->library('form_validation');

                    echo "SAVE HERE";

//                    // Get form data
//                    $data = [
//                        'group' => $this->input->post('group'),
//                        'article' => $this->input->post('article'),
//                        '_des' => $this->input->post('_des'),
//                        '_con' => $this->input->post('_con'),
//                        '_opn' => $this->input->post('_opn'),
//                        '_npn' => $this->input->post('_npn'),
//                        '_uom' => $this->input->post('_uom'),
//                        '_uv' => $this->input->post('_uv'),
//                        '_qpproc' => $this->input->post('_qpproc'),
//                        '_qpphyc' => $this->input->post('_qpphyc'),
//                        '_tv' => $this->input->post('_tv'),
//                        '_dc' => $this->input->post('_dc'),
//                        '_lw' => $this->input->post('_lw'),
//                        '_rem' => $this->input->post('_rem'),
//                        '_pa' => $this->input->post('_pa'),
//                        '_ie' => $this->input->post('_ie') ? 1 : 0, // Checkbox handling: 1 if checked, 0 if unchecked
//                        '_iv' => $this->input->post('_iv') ? 1 : 0, // Checkbox handling: 1 if checked, 0 if uncheckedF
//                        '_sin' => $this->input->post('_sin'),
//                    ];

                    $groupId = $this->input->post('group', true);
                    $articleId = $this->input->post('article', true);

                    // Get the raw date input
                    $raw_date = $this->input->post('_dc');
                    // Convert to 'YYYY-MM-DD' format or leave empty if invalid
                    $date_acquired = !empty($raw_date) ? DateTime::createFromFormat('m/d/Y', $raw_date)->format('Y-m-d') : null;

                    // Get form data
                    $data = [
//            'group' => $this->input->post('group'),
                        'article_id' => $this->input->post('article'),
                        'description' => $this->input->post('_des'),
                        'condition_name' => $this->input->post('_con'),
                        'old_property_no_assigned' => $this->input->post('_opn'),
                        'new_property_no_assigned' => $this->input->post('_npn'),
                        'unit_of_measure' => $this->input->post('_uom'),
                        'unit_value' => $this->input->post('_uv'),
                        'quantity_per_property_card' => $this->input->post('_qpproc'),
                        'quantity_per_physical_count' => $this->input->post('_qpphyc'),
                        'total_value' => $this->input->post('_tv'),
                        'date_acquired' => $date_acquired,
                        'location_whereabouts' => $this->input->post('_lw'),
                        'remarks' => $this->input->post('_rem'),
                        'person_accountable' => $this->input->post('_pa'),
                        'is_existing' => $this->input->post('_ie') ? 1 : 0, // Checkbox handling: 1 if checked, 0 if unchecked
                        'is_verified' => $this->input->post('_iv') ? 1 : 0, // Checkbox handling: 1 if checked, 0 if unchecked
                        'school_idnumber' => $this->input->post('_sin'),
                    ];

                    // Display all values
                    echo "<h3>Form Values Received:</h3><ul>";
                    foreach ($data as $key => $value) {
                        echo "<li><strong>{$key}:</strong> " . ($value) . "</li>";
                    }
                    echo "</ul>";

                    $inserted = $this->db->insert('jb_coa_ppe_list', $data);

                    if ($inserted) { // INSERT WAS SUCCESSFUL
                        // return "RECORD INSERTED SUCCESSFULLY."; 
//                        echo "SUCCESS";
                        redirect('jb_coa/school_ppe');
                    } else { // INSERT FAILED, YOU CAN GET THE ERROR MESSAGE IF NEEDED 
                        // return "INSERT FAILED: " . $error['message']; 
//                        echo "FAILED";
                    }
                } elseif ($action === 'update') {

                    echo "UPDATING 1";
                } else {
                    // Handle unknown action
                    // Example: show an error or redirect
                }
            }
        } else {

            if ($this->_IS_IN_SESSION_schID()) {
                $rs['groups'] = $this->jb_ppe_list_M->get_groups(); // Get groups for the first dropdown 
                $rs['rs'] = $this->jb_ppe_school_M->get_all_records_by_school_id($_SESSION['username']);
                $rs['school_details'] = $this->jb_ppe_school_M->get_school_info_by_id($_SESSION['username']);

                $this->_loadview($this->ftbl_school_ppe_list, $rs);
            }  
        }
    }

    public function set_admin() {

        $_SESSION['username'] = $this->_username;
        $_SESSION['position'] = 'ADMIN';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ppe_list_id = isset($_POST['ppe_list_id']) ? htmlspecialchars($_POST['ppe_list_id']) : null;
            $article_id = isset($_POST['article_id']) ? htmlspecialchars($_POST['article_id']) : null;

            // EDIT
            if ($ppe_list_id) {
                // Fetch the existing data for the given ID
                $data['existing_data'] = $this->jb_ppe_list_M->get_selection_by_id($article_id); // get the id, group_id, name of jb_coa_ppe_group_article
                // Fetch all groups for the dropdown
                $data['groups'] = $this->jb_ppe_list_M->get_all_groups(); // Implement this method in your model
                $data['articles'] = $this->jb_ppe_list_M->get_articles_by_group_id($data['existing_data']->group_id);
                $data['ppe_list_selected'] = $this->jb_ppe_list_M->get_ppe_list_data_by_id($ppe_list_id);

                $this->_loadview($this->crud_ppe_edit, $data);
            } else {

                // SAVE
                $action = $_POST['action'] ?? '';
                $action = isset($_POST['action']) ? $_POST['action'] : '';
                if ($action === 'save') {
                    $this->values["PAGE"] = "134717";
                    $groupId = $this->input->post('group', true);     // XSS Filtering
                    $articleId = $this->input->post('article', true); // XSS Filtering 

                    $rs['groups'] = $this->jb_ppe_list_M->get_groups(); // Get groups for the first dropdown 
                    $rs['rs'] = $this->jb_ppe_school_M->get_all_records_by_school_id(134717);
                    $rs['school_details'] = $this->jb_ppe_school_M->get_school_info_by_id(134717);

                    $this->_loadview($this->ftbl_school_ppe_list, $rs);
                } elseif ($action === 'update') {
                    echo "UPDATING";
                } else {
                    // Handle unknown action
                    // Example: show an error or redirect
                }
            }
        } else {
            $rs['groups'] = $this->jb_ppe_list_M->get_groups(); // Get groups for the first dropdown 
            $rs['rs'] = $this->jb_ppe_school_M->get_all_records_by_school_id($_SESSION['username']);
            $rs['school_details'] = $this->jb_ppe_school_M->get_school_info_by_id($_SESSION['username']);

            $this->_loadview($this->ftbl_school_ppe_list, $rs);
        }
    }

    public function set_notadmin() {
        $_SESSION['username'] = $this->_username;
        $_SESSION['position'] = 'NORMAL';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ppe_list_id = isset($_POST['ppe_list_id']) ? htmlspecialchars($_POST['ppe_list_id']) : null;
            $article_id = isset($_POST['article_id']) ? htmlspecialchars($_POST['article_id']) : null;

            // EDIT
            if ($ppe_list_id) {
                // Fetch the existing data for the given ID
                $data['existing_data'] = $this->jb_ppe_list_M->get_selection_by_id($article_id); // get the id, group_id, name of jb_coa_ppe_group_article
                // Fetch all groups for the dropdown
                $data['groups'] = $this->jb_ppe_list_M->get_all_groups(); // Implement this method in your model
                $data['articles'] = $this->jb_ppe_list_M->get_articles_by_group_id($data['existing_data']->group_id);
                $data['ppe_list_selected'] = $this->jb_ppe_list_M->get_ppe_list_data_by_id($ppe_list_id);

                $this->_loadview($this->crud_ppe_edit, $data);
            } else {

                // SAVE
                $action = $_POST['action'] ?? '';
                $action = isset($_POST['action']) ? $_POST['action'] : '';
                if ($action === 'save') {
                    $this->values["PAGE"] = "134717";
                    $groupId = $this->input->post('group', true);     // XSS Filtering
                    $articleId = $this->input->post('article', true); // XSS Filtering 

                    $rs['groups'] = $this->jb_ppe_list_M->get_groups(); // Get groups for the first dropdown 
                    $rs['rs'] = $this->jb_ppe_school_M->get_all_records_by_school_id(134717);
                    $rs['school_details'] = $this->jb_ppe_school_M->get_school_info_by_id(134717);

                    $this->_loadview($this->ftbl_school_ppe_list, $rs);
                } elseif ($action === 'update') {
                    echo "UPDATING";
                } else {
                    // Handle unknown action
                    // Example: show an error or redirect
                }
            }
        } else {
            $rs['groups'] = $this->jb_ppe_list_M->get_groups(); // Get groups for the first dropdown 
            $rs['rs'] = $this->jb_ppe_school_M->get_all_records_by_school_id($_SESSION['username']);
            $rs['school_details'] = $this->jb_ppe_school_M->get_school_info_by_id($_SESSION['username']);

            $this->_loadview($this->ftbl_school_ppe_list, $rs);
        }
    }

    public function _set_session() {
        if (!isset($_SESSION['username'])) {
            $_SESSION['username'] = $this->_username; // Set a default value or a specific value as needed
        }

        if (!isset($_SESSION['position'])) {
            $_SESSION['position'] = 'default_position'; // Set a default value or a specific value as needed
        }
    }

    public function refer_barangay() {
        $rs['regions'] = $this->jb_location_M->get_jb_region();
        $this->_loadview($this->crud_location_barangay, $rs);
    }

    // Get Provinces based on selected Region ID
    public function get_provinces($region_id) {
        $provinces = $this->jb_location_M->get_jb_province($region_id);
        echo json_encode($provinces);
    }

    // Get Municipalities based on selected Province ID
    public function get_municipalities($province_id) {
        $municipalities = $this->jb_location_M->get_jb_city_municipality($province_id);
        echo json_encode($municipalities);
    }

    // Get Barangays based on selected Municipality ID
    public function get_barangays($city_municipality_id) {
        $barangays = $this->jb_location_M->get_jb_barangay($city_municipality_id);
        echo json_encode($barangays);
    }

    public function get_form_data_location() {
        // Get the selected values from the form
        $region_id = $this->input->post('region');
        $province_id = $this->input->post('province');
        $municipality_id = $this->input->post('municipality');
        $barangay_id = $this->input->post('barangay');

        // You can process the data here or pass it to the view
        echo "<h3>Selected Values:</h3>";
        echo "Region ID: " . $region_id . "<br>";
        echo "Province ID: " . $province_id . "<br>";
        echo "Municipality ID: " . $municipality_id . "<br>";
        echo "Barangay ID: " . $barangay_id . "<br>";
    }

// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
// MEDIA PRINT - NEW TAB
// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------

    public function school_ppe_annex_a() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $schoolId = isset($_POST['school_id']) ? trim($_POST['school_id']) : null;
            if ($schoolId && is_numeric($schoolId)) {

                $rs['rs'] = $this->jb_ppe_school_M->mp_annex_a_by_schoolid($schoolId);
                $this->load->view($this->mp_school_ppe_annex_a, $rs);
            } else {
                $this->handleError('Invalid school ID provided.');
            }
        } else {
            $this->handleError('Invalid request method.');
        }
    }

    public function school_ppe_annex_a_district() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $district_id = $this->input->post('district_id');
            if (!empty($district_id) && is_numeric($district_id)) {
                $rs['rs'] = $this->jb_ppe_school_M->mp_annex_a_by_districtid($district_id);
                $this->load->view($this->mp_school_ppe_annex_a, $rs);
            } else {
                echo "Invalid division ID.";
            }
        } else {
            echo "Invalid request method.";
        }
    }

    public function school_ppe_annex_b() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $schoolId = isset($_POST['school_id']) ? trim($_POST['school_id']) : null;

            if ($schoolId && is_numeric($schoolId)) {
                $rs['rs'] = $this->jb_ppe_school_M->mp_annex_b_by_schoolid($schoolId);
                $this->load->view($this->mp_school_ppe_annex_b, $rs);
            } else {
                $this->handleError('Invalid school ID provided.');
            }
        } else {
            $this->handleError('Invalid request method.');
        }
    }

    public function school_ppe_annex_b_district() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $district_id = $this->input->post('district_id');
            if (!empty($district_id) && is_numeric($district_id)) {
                $rs['rs'] = $this->jb_ppe_school_M->mp_annex_b_by_districtid($district_id);
                $this->load->view($this->mp_school_ppe_annex_b, $rs);
            } else {
                echo "Invalid division ID.";
            }
        } else {
            echo "Invalid request method.";
        }
    }

    public function school_ppe_annex_c() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitize and validate the input
            $schoolId = isset($_POST['school_id']) ? trim($_POST['school_id']) : null;

            if ($schoolId && is_numeric($schoolId)) {
                $rs['rs'] = $this->jb_ppe_school_M->mp_annex_c_by_schoolid($schoolId);
                $this->load->view($this->mp_school_ppe_annex_c, $rs);
            } else {
                $this->handleError('Invalid school ID provided.');
            }
        } else {
            $this->handleError('Invalid request method.');
        }
    }

    public function school_ppe_annex_c_district() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $district_id = $this->input->post('district_id');
            if (!empty($district_id) && is_numeric($district_id)) {
                $rs['rs'] = $this->jb_ppe_school_M->mp_annex_c_by_districtid($district_id);
                $this->load->view($this->mp_school_ppe_annex_c, $rs);
            } else {
                echo "Invalid division ID.";
            }
        } else {
            echo "Invalid request method.";
        }
    }

// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
// CHECK SESSION
// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
    public function _IS_IN_SESSION_schID() {
        if (isset($_SESSION['username']) && isset($_SESSION['position'])) {
            return true;
        } else {
            echo "MUST LOGIN TO MIS FIRST...";
            return false;
        }
    }

    public function _IS_AN_ADMIN_schID() {
        if (isset($_SESSION['username']) && isset($_SESSION['position'])) {
            if ($_SESSION['position'] == 'ADMIN') {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
// HANDLE ERROR
// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
    private function handleError($message) {
        // Log the error for debugging (not shown to the user)
        log_message('error', $message);

        // Optionally, redirect to an error page or show a generic error message
        // Redirect to an error page
        redirect('error_page');

        // Or show a generic error message
        // $this->load->view('error_view', ['message' => 'An error occurred.']);
    }

// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
// CREATE - DROPDOWN LIST
// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
    public function test() {
//        redirect($this->ppe_create());
    }

    public function ppe_create() {
        $data['groups'] = $this->jb_ppe_list_M->get_groups(); // Get groups for the first dropdown 
        $this->_loadview($this->crud_ppe_create, $data);
    }

    public function get_articles() {
        $groupId = $this->input->get('id'); // Get the selected group ID
        $articles = $this->jb_ppe_list_M->get_articles($groupId); // Get articles for the selected group
        echo json_encode($articles); // Return as JSON
    }

    public function get_items() {
        $articleId = $this->input->get('id'); // Get the selected article ID
        $items = $this->jb_ppe_list_M->get_items($articleId); // Get items for the selected article
        echo json_encode($items); // Return as JSON
    }

    public function save_ppe_list() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? '';

            $groupId = $this->input->post('group', true);     // XSS Filtering
            $articleId = $this->input->post('article', true); // XSS Filtering 
            if (!empty($groupId) && !empty($articleId)) {
                
            } else {
                
            }
        } else {
            // If not a POST request, redirect or show an error
            show_error('Invalid request method', 405); // 405 Method Not Allowed
        }
    }

// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
// EDIT
// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
    public function edit() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve the group_id from the POST data
            $ppe_list_id = isset($_POST['ppe_list_id']) ? htmlspecialchars($_POST['ppe_list_id']) : null;
            $article_id = isset($_POST['article_id']) ? htmlspecialchars($_POST['article_id']) : null;

            if ($ppe_list_id) {
                // Fetch the existing data for the given ID
                $data['existing_data'] = $this->jb_ppe_list_M->get_selection_by_id($article_id); // get the id, group_id, name of jb_coa_ppe_group_article
                // Fetch all groups for the dropdown
                $data['groups'] = $this->jb_ppe_list_M->get_all_groups(); // Implement this method in your model
                $data['articles'] = $this->jb_ppe_list_M->get_articles_by_group_id($data['existing_data']->group_id);
                // Pass the existing article ID for preselection 
                $this->_loadview($this->crud_ppe_edit, $data);
            } else {
                echo "No Group ID received.";
            }
        } else {
            echo "NO POST REQUEST";
        }
    }

    public function update_selection() {
        // Check if the request is a POST request
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $action = $this->input->post('action'); // Get the value of the clicked button
            if ($action === 'delete') {
                $this->delete_data();
            } elseif ($action === 'update') {
                $this->update_data();
            } else {
                echo "No action triggered.";
            }
        } else {
            // If not a POST request, redirect or show an error
            show_error('Invalid request method', 405); // 405 Method Not Allowed
        }
    }

    public function update_data() {
        ECHO 'UPDATING 2';
        echo "<br>";
        // Get the selected values from the form
        $ppe_list_id = $this->input->post('ppe_list_id');
        $groupId = $this->input->post('group', true);
        $articleId = $this->input->post('article', true);

        // Get the raw date input
        $raw_date = $this->input->post('_dc');
        // Convert to 'YYYY-MM-DD' format or leave empty if invalid
        $date_acquired = !empty($raw_date) ? DateTime::createFromFormat('m/d/Y', $raw_date)->format('Y-m-d') : null;

        // Get form data
        $data = [
//            'group' => $this->input->post('group'),
            'article_id' => $this->input->post('article'),
            'description' => $this->input->post('_des'),
            'condition_name' => $this->input->post('_con'),
            'old_property_no_assigned' => $this->input->post('_opn'),
            'new_property_no_assigned' => $this->input->post('_npn'),
            'unit_of_measure' => $this->input->post('_uom'),
            'unit_value' => $this->input->post('_uv'),
            'quantity_per_property_card' => $this->input->post('_qpproc'),
            'quantity_per_physical_count' => $this->input->post('_qpphyc'),
            'total_value' => $this->input->post('_tv'),
            'date_acquired' => $date_acquired,
            'location_whereabouts' => $this->input->post('_lw'),
            'remarks' => $this->input->post('_rem'),
            'person_accountable' => $this->input->post('_pa'),
            'is_existing' => $this->input->post('_ie') ? 1 : 0, // Checkbox handling: 1 if checked, 0 if unchecked
            'is_verified' => $this->input->post('_iv') ? 1 : 0, // Checkbox handling: 1 if checked, 0 if unchecked
//            '_sin' => $this->input->post('_sin'),
        ];

        // Display all values
        echo "id:" . $ppe_list_id;
        echo "<h3>Form Values Received:</h3><ul>";
        foreach ($data as $key => $value) {
            echo "<li><strong>{$key}:</strong> " . ($value) . "</li>";
        }
        echo "</ul>";

        $returned = $this->jb_ppe_list_M->update_jb_coa_ppe_list($ppe_list_id, $data);

        if ($returned) {
            // Redirect to the controller after successful update 
            redirect('jb_coa/school_ppe');
        } else {
            // Redirect back to the form page in case of failure
            // You can use `redirect()` with the URI of the form, or use `previous_url` if you need to go back to the previous page
            // Set flashdata for "no changes" message
            // $this->session->set_flashdata('error', 'No changes were made.');
            redirect($this->agent->referrer());  // Redirect back to the form
        }
//        echo "RETURNED" . $returned;
//        redirect($this->school_ppe); // UPDATE WAS SUCCESSFUL
//            $rs['groups'] = $this->jb_ppe_list_M->get_groups(); // Get groups for the first dropdown 
//            $rs['rs'] = $this->jb_ppe_school_M->get_all_records_by_school_id($_SESSION['username']);
//            $rs['school_details'] = $this->jb_ppe_school_M->get_school_info_by_id($_SESSION['username']);
//
//            $this->_loadview($this->ftbl_school_ppe_list, $rs);
    }

    public function delete_data() {
        $ppe_list_id = $this->input->post('ppe_list_id');
        echo "Delete action triggered for ID: " . $ppe_list_id;
        $rs = $this->jb_ppe_list_M->_delete_where($ppe_list_id); // CALL MODEL FUNCTION
        if ($rs) {
            redirect('jb_coa/school_ppe');
        } else {
            echo "FAILED TO DELETE THE ROW.";  // Deletion failed
        }
    }

// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
// DELETE
// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
// LOAD VIEW PAGE
// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
    public function _loadview($page, $rs) {
        $this->load->view($this->partials . 'header');
        $this->load->view($this->partials . 'topbar');
        $this->load->view($this->partials . 'sidebar');
        $this->load->view($page, $rs);
        $this->load->view($this->partials . 'footer');
    }

// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
// UPDATE
// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
    public function update_verification_status() {
        // Get the data from the AJAX request
        $is_verified = $this->input->post('is_verified'); // Get the checkbox state
        $id = $this->input->post('id'); // Get the ID of the row
        // Call the model method to update the verification status
        if ($this->jb_ppe_list_M->update_is_verified_by_id($id, $is_verified)) {
            // Return a success response
            echo json_encode(['status' => 'success']);
        } else {
            // Return an error response
            echo json_encode(['status' => 'error']);
        }
    }
}
