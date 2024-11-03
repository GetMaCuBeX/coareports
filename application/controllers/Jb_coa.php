<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Jb_coa extends CI_Controller {

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
    private $mp_school_ppe_annex_a_division = 'jb/coa/mediaprint/annex/school_ppe_annex_a_division';
    private $mp_school_ppe_annex_b_division = 'jb/coa/mediaprint/annex/school_ppe_annex_b_division';
    private $mp_school_ppe_annex_c_division = 'jb/coa/mediaprint/annex/school_ppe_annex_c_division';
    //
    private $fcreate_ppe_list = 'jb/coa/form/create/ppe_list';
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
        $this->values["PAGE"] = "ANNEX A";
        $this->_set_values();

        $rs['rs'] = $this->jb_ppe_school_M->ftbl_schools_annex_a();

        $this->load->view($this->partials . 'header', $this->values);
        $this->load->view($this->partials . 'topbar', $this->values);
        $this->load->view($this->partials . 'sidebar', $this->values);
        $this->load->view($this->ftbl_annex_a, $rs);
        $this->load->view($this->partials . 'footer', $this->values);
    }

    public function annex_b() {
        $this->values["PAGE"] = "ANNEX B";
        $this->_set_values();

        $rs['rs'] = $this->jb_ppe_school_M->ftbl_schools_annex_b();

        $this->load->view($this->partials . 'header', $this->values);
        $this->load->view($this->partials . 'topbar', $this->values);
        $this->load->view($this->partials . 'sidebar', $this->values);
        $this->load->view($this->ftbl_annex_b, $rs);
        $this->load->view($this->partials . 'footer', $this->values);
    }

    public function annex_c() {

        $this->values["PAGE"] = "ANNEX C";
        $this->_set_values();

        $rs['rs'] = $this->jb_ppe_school_M->ftbl_schools_annex_c();

        $this->load->view($this->partials . 'header', $this->values);
        $this->load->view($this->partials . 'topbar', $this->values);
        $this->load->view($this->partials . 'sidebar', $this->values);
        $this->load->view($this->ftbl_annex_c, $rs);
        $this->load->view($this->partials . 'footer', $this->values);
    }

// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
// SIDEBAR - LIST
// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
    public function set_session() {
        $_SESSION['username'] = 109430;
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

// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
// FORMS - DISPLAY
// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------

    public function school_ppe_annex_a() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// Sanitize and validate the input
            $schoolId = isset($_POST['school_id']) ? trim($_POST['school_id']) : null;

// Check if schoolId is valid (you can customize the validation logic)
            if ($schoolId && is_numeric($schoolId)) {
                $this->values["PAGE"] = "&nbsp;";
                $this->_set_values();

                $rs['rs'] = $this->jb_ppe_school_M->mp_annex_a_by_schoolid($schoolId);

                $this->load->view($this->mp_school_ppe_annex_a, $rs);
            } else {
// Handle invalid schoolId
                $this->handleError('Invalid school ID provided.');
            }
        } else {
// Handle the case where the request method is not POST
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
// Sanitize and validate the input
            $schoolId = isset($_POST['school_id']) ? trim($_POST['school_id']) : null;

// Check if schoolId is valid (you can customize the validation logic)
            if ($schoolId && is_numeric($schoolId)) {
// Retrieve the data securely
                $rs['rs'] = $this->jb_ppe_school_M->mp_annex_b_by_schoolid($schoolId);

// Load the view
                $this->load->view($this->mp_school_ppe_annex_b, $rs);
            } else {
// Handle invalid schoolId
                $this->handleError('Invalid school ID provided.');
            }
        } else {
// Handle the case where the request method is not POST
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

// Check if schoolId is valid (you can customize the validation logic)
            if ($schoolId && is_numeric($schoolId)) {
// Retrieve the data securely
                $rs['rs'] = $this->jb_ppe_school_M->mp_annex_c_by_schoolid($schoolId);

// Load the view
                $this->load->view($this->mp_school_ppe_annex_c, $rs);
            } else {
// Handle invalid schoolId
                $this->handleError('Invalid school ID provided.');
            }
        } else {
// Handle the case where the request method is not POST
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
// FORMS - CREATE
// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------

    public function create_school_ppe_list() {
        if ($this->_IS_IN_SESSION_schID()) { // CHECK IF SESSION LOGIN
            $this->values["PAGE"] = "DASHBOARD";
            $this->_set_values();
            $this->load->view($this->partials . 'header', $this->values);
            $this->load->view($this->partials . 'topbar', $this->values);
            $this->load->view($this->partials . 'sidebar', $this->values);
            $this->load->view($this->fcreate_ppe_list);
            $this->load->view($this->partials . 'footer', $this->values);
        } else {
            
        }
    }

// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
// SET VALUES
// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
    public function _SET_VALUES() {
        if (isset($_SESSION['username']) && isset($_SESSION['position'])) {
// ADMIN
            if ($_SESSION['position'] == 'ADMIN') {
// REGULAR USER
            } else {
                
            }
        } else {
            return false;
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
// CREATE
// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
    public function test() {
//        redirect($this->ppe_create());
    }

    public function ppe_create() {
        $data['groups'] = $this->jb_ppe_list_M->get_groups(); // Get groups for the first dropdown 
        $this->load->view($this->partials . 'header', $this->values);
        $this->load->view($this->partials . 'topbar', $this->values);
        $this->load->view($this->partials . 'sidebar', $this->values);
        $this->load->view($this->crud_ppe_create, $data); // Load the view
        $this->load->view($this->partials . 'footer', $this->values);
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
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            // Get the selected values from the form
            $groupId = $this->input->post('group', true);     // XSS Filtering
            $articleId = $this->input->post('article', true); // XSS Filtering
            echo $groupId;
            echo '<br>';
            echo $articleId;

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
// EDIT
// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
    public function edit() {
        $article_id = 26;
        // Fetch the existing data for the given ID
        $data['existing_data'] = $this->jb_ppe_list_M->get_selection_by_id($article_id); // get the id, group_id, name of jb_coa_ppe_group_article
        // Fetch all groups for the dropdown
        $data['groups'] = $this->jb_ppe_list_M->get_all_groups(); // Implement this method in your model
        $data['articles'] = $this->jb_ppe_list_M->get_articles_by_group_id($data['existing_data']->group_id);
        // Pass the existing article ID for preselection 
        $this->load->view($this->partials . 'header', $this->values);
        $this->load->view($this->partials . 'topbar', $this->values);
        $this->load->view($this->partials . 'sidebar', $this->values);
        $this->load->view($this->crud_ppe_edit, $data);
        $this->load->view($this->partials . 'footer', $this->values);
    }

    public function update_selection($id) {

        ECHO 'UPDATING';
        echo "<br>";

        // Check if the request is a POST request
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            // Get the selected values from the form
            $groupId = $this->input->post('group', true);
            $articleId = $this->input->post('article', true);

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
}
