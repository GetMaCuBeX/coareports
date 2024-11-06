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
        $this->_set_session();
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

    public function set_admin() {

        $_SESSION['username'] =  $this->_username;
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
        $_SESSION['username'] =  $this->_username;
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
            $_SESSION['username'] =  $this->_username; // Set a default value or a specific value as needed
        }

        if (!isset($_SESSION['position'])) {
            $_SESSION['position'] = 'default_position'; // Set a default value or a specific value as needed
        }
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

    public function update_selection($id) {

        ECHO 'UPDATING';
        echo "<br>";

        // Check if the request is a POST request
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            // Get the selected values from the form
            $ppe_list_id = $this->input->post('ppe_list_id');
            $groupId = $this->input->post('group', true);
            $articleId = $this->input->post('article', true);

            echo "PPE ID: " . $ppe_list_id;

            echo "<br>";
            echo "article id: " . $articleId;
            echo "<br>";
            echo "group id: " . $groupId;

            // Validate the inputs
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
