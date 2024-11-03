<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Jb_emailrequest extends CI_Controller {

    private $values;
    private $partials = 'jb/partials/';
    private $p_dashboard_a = 'jb/emailrequest/page/dashboard_a'; // ADMIN PAGE
    private $p_dashboard_u = 'jb/emailrequest/page/dashboard_u'; // USER PAGE
    private $p_userrequest_u = 'jb/emailrequest/page/userrequest_u';
    private $p_create_u = 'jb/emailrequest/page/create_u';
    private $p_update_a = 'jb/emailrequest/page/update_a';
    private $p_update_u = 'jb/emailrequest/page/update_u';
    private $p_update_c = 'jb/emailrequest/page/update_c';
    private $p_userrequest_a = 'jb/emailrequest/page/userrequest_a';
    private $p_complete_a = 'jb/emailrequest/page/complete_a';
//
    private $form_daterange = 'jb/emailrequest/form/daterange';
//
    private $c_method_user = 'jb_emailrequest/requ';
    private $c_method_request = 'jb_emailrequest/request';
    private $c_method_complete = 'jb_emailrequest/complete';

    public function __construct() {
        parent::__construct();
        $this->values = [
            "PAGE" => 'REQUEST',
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
//        $_SESSION['username'] = 7315740;
//        $_SESSION['position'] = 'ADMIN';
        //    session_unset(); // Unset session variables
        //    session_destroy(); // Destroy the session
        if ($this->_IS_IN_SESSION_empID()) { // CHECK IF SESSION LOGIN
            $this->values["PAGE"] = "DASHBOARD";
            $this->_set_values();

            $this->load->view($this->partials . 'header', $this->values);
            $this->load->view($this->partials . 'topbar', $this->values);
            $this->load->view($this->partials . 'sidebar', $this->values);
            if ($this->_IS_AN_ADMIN_empID()) { // ADMIN USER
                $rs['data'] = $this->jb_dashboard_M->_dashboard_query_admin();
                $this->load->view($this->p_dashboard_a, $rs);
            } else { // REGULAR USER
                $rs['data'] = $this->jb_dashboard_M->_dashboard_query_user();
                $this->load->view($this->p_dashboard_u, $rs);
            }
            $this->load->view($this->partials . 'footer', $this->values);
        } else {
            
        }
    }

// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
// FORMS - POST
// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
    private function _validate_dates($date_from, $date_to) {
        return (bool) strtotime($date_from) && (bool) strtotime($date_to);
    }

// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
// DASHBOARD - MAIN PAGE
// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
 

// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
// SIDEBAR - USER REQUEST
// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
    public function requ() {
        // CHECK IF SESSION LOGIN
        if ($this->_IS_IN_SESSION_empID()) {
            $this->values["PAGE"] = "EMAIL REQUEST";
            $this->_set_values();

            $this->load->view($this->partials . 'header', $this->values);
            $this->load->view($this->partials . 'topbar', $this->values);
            $this->load->view($this->partials . 'sidebar', $this->values);
            // ADMIN USER
            if ($this->_IS_AN_ADMIN_empID()) {
                $rs['data'] = $this->jb_emailrequest_M->_read_where_empID_u($_SESSION['username']);
                $this->load->view($this->p_userrequest_u, $rs);
                // REGULAR USER
            } else {
                $rs['data'] = $this->jb_emailrequest_M->_read_where_empID_u($_SESSION['username']);
                $this->load->view($this->p_userrequest_u, $rs);
            }
            $this->load->view($this->partials . 'footer', $this->values);
        }
    }

    public function viewreq() {
        if ($this->_IS_IN_SESSION_empID()) { // CHECK IF SESSION LOGIN
            $this->_set_values();
            $this->values["PAGE"] = "REQUEST";

            if (isset($_POST['update_id'])) {
                $id = $this->input->post('update_id');
                $rs['data'] = $this->jb_emailrequest_M->_read_where_id($id);

                $this->load->view($this->partials . 'header', $this->values);
                $this->load->view($this->partials . 'topbar', $this->values);
                $this->load->view($this->partials . 'sidebar', $this->values);
                $this->load->view($this->p_update_u, $rs);
                $this->load->view($this->partials . 'footer', $this->values);
            } else {
// HANDLE CASES WHERE FORM IS NOT SUBMITTED VIA POST
// redirect($this->cntrl_email_home1);
            }
        }
    }

// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
// SIDEBAR - REQUEST
// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
    public function request() {
        // CHECK IF SESSION LOGIN
        if ($this->_IS_IN_SESSION_empID()) {
            if ($this->input->server('REQUEST_METHOD') === 'POST' && isset($_POST['date_range'])) { // IF FORM SUBMIT
                $this->search_by_daterange();
            } else {
                $this->_set_values();
                $rs['data'] = $this->jb_emailrequest_M->_read_where_isdone_false();

                $this->load->view($this->partials . 'header', $this->values);
                $this->load->view($this->partials . 'topbar', $this->values);
                $this->load->view($this->partials . 'sidebar', $this->values);
                $this->load->view($this->form_daterange, $this->values);
                $this->load->view($this->p_userrequest_a, $rs);
                $this->load->view($this->partials . 'footer', $this->values);
            }
        }
    }

    public function search_by_daterange() {
        $date_from = $this->input->post('date_from');
        $date_to = $this->input->post('date_to');
// Validate the date inputs
        if (!$this->_validate_dates($date_from, $date_to)) {
// Handle invalid dates
// $response = ['status' => 'error', 'message' => 'Invalid date format.'];
// echo json_encode($response);
// return;
        }

// Call the model method to get the data
        $rs['data'] = $this->jb_emailrequest_M->_read_where_isdone_false_daterange($date_from, $date_to);
        $this->values = [
            "DATE_FROM" => $date_from,
            "DATE_TO" => $date_to
        ];

// Return the response
// echo json_encode(['status' => 'success', 'data' => $rs]);
        $this->_set_values();
        $this->load->view($this->partials . 'header', $this->values);
        $this->load->view($this->partials . 'topbar', $this->values);
        $this->load->view($this->partials . 'sidebar', $this->values);
        $this->load->view($this->form_daterange, $this->values);
        $this->load->view($this->p_userrequest_a, $rs);
        $this->load->view($this->partials . 'footer', $this->values);
    }

// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
// SIDEBAR - COMPLETE
// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
    public function complete() {
        // CHECK IF SESSION LOGIN
        if ($this->_IS_IN_SESSION_empID()) {
            $this->_set_values();

            $rs['data'] = $this->jb_emailrequest_M->_read_where_isdone_true();

            $this->load->view($this->partials . 'header', $this->values);
            $this->load->view($this->partials . 'topbar', $this->values);
            $this->load->view($this->partials . 'sidebar', $this->values);
            $this->load->view($this->p_complete_a, $rs);
            $this->load->view($this->partials . 'footer', $this->values);
        }
    }

// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
// BUTTON
// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
    public function create() {
        if ($this->_IS_IN_SESSION_empID()) { // CHECK IF SESSION LOGIN
            $this->_set_values();
            $this->values["PAGE"] = "CREATE";
            // SAVE
            if (isset($_POST['save'])) {
                $this->_validate_request();
                // CANCEL
            } elseif (isset($_POST['cancel'])) {
                redirect($this->c_method_requ);
                // DISPLAY CREATE FORM
            } else {
                $this->load->view($this->partials . 'header', $this->values);
                $this->load->view($this->partials . 'topbar', $this->values);
                $this->load->view($this->partials . 'sidebar', $this->values);
                $rs['data'] = $this->jb_emailrequest_M->_read_data_from_employee($_SESSION['username']);
                $this->load->view($this->p_create_u, $rs);
                $this->load->view($this->partials . 'footer', $this->values);
            }
        } else {
            redirect($this->index);
        }
    }

    public function _validate_request() {
        // FORM_VALIDATION 
        // $this->form_validation->set_rules("personal_email", "Personal Email", "required");
        $this->form_validation->set_rules("concern_message", "Personal Message", "required");
        if ($this->input->post('concern') != 'CREATE' && $this->input->post('concern') != 'OTHER') {
            $this->form_validation->set_rules("deped_email", "Deped Email", "required");
        }
        if ($this->form_validation->run() == FALSE) {
            // WE HAVE SOME ERRORS
            // echo validation_errors();
            // RELOAD THE PAGE
            $this->load->view($this->partials . 'header', $this->values);
            $this->load->view($this->partials . 'topbar', $this->values);
            $this->load->view($this->partials . 'sidebar', $this->values);
            $rs['data'] = $this->jb_emailrequest_M->_read_data_from_employee($_SESSION['username']);
            $this->load->view($this->p_create_u, $rs);
            $this->load->view($this->partials . 'footer', $this->values);
        } else {
            // SUBMITTED FORM
            $this->_save_request_to_database();
        }
    }

    public function _save_request_to_database() {
        $data = [
            'mis_emp_table_id' => $this->input->post('mis_emp_table_id'),
            'school_id' => $this->input->post('school_id'),
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'concern' => $this->input->post('concern'),
            'concern_message' => $this->input->post('concern_message'),
            'plantilla' => $this->input->post('plantilla'),
            'personal_email' => $this->input->post('personal_email'),
            'contact_number' => $this->input->post('contact_number'),
            'deped_email' => $this->input->post('deped_email')
        ];

        $rs = $this->jb_emailrequest_M->_create($data);
        redirect($this->c_method_user);
    }

// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
// CHECK
// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
    public function _IS_IN_SESSION_empID() {
        if (isset($_SESSION['username']) && isset($_SESSION['position'])) {
            return true;
        } else {
            echo "MUST LOGIN TO MIS FIRST...";
            return false;
        }
    }

    public function _IS_AN_ADMIN_empID() {
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
// SET VALUES
// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
    public function _SET_VALUES() {
        if (isset($_SESSION['username']) && isset($_SESSION['position'])) {
            // ADMIN
            if ($_SESSION['position'] == 'ADMIN') {
                $count = $this->jb_emailrequest_M->_count_all_request_isdone_false();
                $this->values["REQUEST_COUNT_ISDONE_FALSE"] = $count;
                // REGULAR USER
            } else {
                $count = $this->jb_emailrequest_M->_count_request_isdone_false($_SESSION['username']);
                $this->values["REQUEST_COUNT_ISDONE_FALSE"] = $count;
            }
        } else {
            return false;
        }
    }

// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
// 𝐑𝐄𝐀𝐃
// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------

    public function updaterequest() {
        // CHECK IF SESSION LOGIN
        if ($this->_IS_IN_SESSION_empID()) {
            $this->_set_values();
            $this->values["PAGE"] = "UPDATE";
            if (isset($_POST['update_id'])) {
                $id = $this->input->post('update_id');
                $rs['data'] = $this->jb_emailrequest_M->_read_where_id($id);

                $this->load->view($this->partials . 'header', $this->values);
                $this->load->view($this->partials . 'topbar', $this->values);
                $this->load->view($this->partials . 'sidebar', $this->values);
                $this->load->view($this->p_update_a, $rs);
                $this->load->view($this->partials . 'footer', $this->values);
            } else {
// HANDLE CASES WHERE FORM IS NOT SUBMITTED VIA POST
// redirect($this->cntrl_email_home1);
            }
        }
    }

    public function updaterequest_emp() {
        // CHECK IF SESSION LOGIN
        if ($this->_IS_IN_SESSION_empID()) {
            $this->_set_values();
            $this->values["PAGE"] = "UPDATE";
            if (isset($_POST['update_id'])) {
                $id = $this->input->post('update_id');
                $rs['data'] = $this->jb_emailrequest_M->_read_where_id($id);

                $this->load->view($this->partials . 'header', $this->values);
                $this->load->view($this->partials . 'topbar', $this->values);
                $this->load->view($this->partials . 'sidebar', $this->values);
                $this->load->view($this->page_update_emp, $rs);
                $this->load->view($this->partials . 'footer', $this->values);
            } else {
// HANDLE CASES WHERE FORM IS NOT SUBMITTED VIA POST
// redirect($this->cntrl_email_home1);
            }
        }
    }

    public function updaterequest_c() {
        // CHECK IF SESSION LOGIN
        if ($this->_IS_IN_SESSION_empID()) {
            $this->_set_values();
            $this->values["PAGE"] = "UPDATE";
            if (isset($_POST['update_id'])) {
                $id = $this->input->post('update_id');
                $rs['data'] = $this->jb_emailrequest_M->_read_where_id($id);

                $this->load->view($this->partials . 'header', $this->values);
                $this->load->view($this->partials . 'topbar', $this->values);
                $this->load->view($this->partials . 'sidebar', $this->values);
                $this->load->view($this->p_update_c, $rs);
                $this->load->view($this->partials . 'footer', $this->values);
            } else {
// HANDLE CASES WHERE FORM IS NOT SUBMITTED VIA POST
// redirect($this->cntrl_email_home1);
            }
        }
    }

// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
// UPDATE
// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
    public function update() {
// $id = $this->input->get('id');
// $response_date =  $this->input->post('response_date');
// $status = $this->input->post('status');
// $processed_by = $this->input->post('processed_by');
// $response_message = $this->input->post('response_message');
// $data = array(
// 	'response_date' => $response_date,
// 	'status'   => $status,
// 	'processed_by' => $processed_by,
// 	'response_message' => $response_message
// );
// $r = $this->M_emailrequest->_update($id, $data);
// echo $r;
// $rs['data'] = $this->M_emailrequest->_read_where_isdone_false(); // CALL MODEL FUNCTION
// echo "<pre>";
// print_r($rs);
    }

    public function setisdonetrue() {
        // CHECK IF SESSION LOGIN
        if ($this->_IS_IN_SESSION_empID()) {
            if (isset($_POST['update_id'])) {
                $id = $this->input->post('update_id');

                $data = array(
                    'is_done' => 1
                );
                $r = $this->jb_emailrequest_M->_update_isdone($id, $data);
                if ($r) {
                    redirect($this->c_method_request); // UPDATE WAS SUCCESSFUL
                }
            }
        }
    }

    public function setisdonefalse() {
        // CHECK IF SESSION LOGIN
        if ($this->_IS_IN_SESSION_empID()) {
            if (isset($_POST['update_id'])) {
                $id = $this->input->post('update_id');

                $data = array(
                    'is_done' => 0
                );
                $r = $this->jb_emailrequest_M->_update_isdone($id, $data);
                if ($r) {
                    redirect($this->c_method_complete); // UPDATE WAS SUCCESSFUL
                }
            }
        }
    }

    public function setisdeletetrue() {
        // CHECK IF SESSION LOGIN
        if ($this->_IS_IN_SESSION_empID()) {
            if (isset($_POST['update_id'])) {
                $id = $this->input->post('update_id');

                $data = array(
                    'is_delete' => 1
                );
                $r = $this->jb_emailrequest_M->_update_isdelete($id, $data);
                if ($r) {
                    echo "UPDATE WAS SUCCESSFUL";
// redirect($this->cntrl_email_home1); // UPDATE WAS SUCCESSFUL
                }
            }
        }
    }

//    public function save_updaterequest_emp() {
//        // CHECK IF SESSION LOGIN
//        if ($this->_IS_IN_SESSION_empID()) {
//            if (isset($_POST['save_updaterequest'])) {
//                $this->_save_updaterequest_emp_to_database();
//            }
//
//            if (isset($_POST['cancel_updaterequest'])) {
//                redirect($this->cntrl_email_home1);
//            }
//        }
//    }
//    public function _save_updaterequest_emp_to_database() {
//        $id = $this->input->post('id'); // RETRIEVE THE ID FROM THE POST DATA 
//
//        if ($id) {
//            $response_date = $this->input->post('response_date');
//            $status = $this->input->post('status');
//            $processed_by = $this->input->post('processed_by');
//            $response_message = $this->input->post('response_message');
//
//            $data = array(
//                'response_date' => $response_date,
//                'status' => $status,
//                'processed_by' => $processed_by,
//                'response_message' => $response_message
//            );
//            $r = $this->M_emailrequest->_update_where($id, $data);
//
//            redirect($this->cntrl_email_home1); // UPDATE WAS SUCCESSFUL
//        }
//    }

    public function save_updaterequest() {
        // CHECK IF SESSION LOGIN
        if ($this->_IS_IN_SESSION_empID()) {
            if (isset($_POST['save_updaterequest'])) {
                $this->_save_updaterequest_to_database();
            }
            if (isset($_POST['cancel_updaterequest'])) {
                redirect($this->c_method_request);
            }
        }
    }

    public function _save_updaterequest_to_database() {
        $id = $this->input->post('id');
        if ($id) {
            $response_date = $this->input->post('response_date');
            $status = $this->input->post('status');
            $processed_by = $this->input->post('processed_by');
            $response_message = $this->input->post('response_message');
            $data = array(
                'response_date' => $response_date,
                'status' => $status,
                'processed_by' => $processed_by,
                'response_message' => $response_message
            );
            $this->jb_emailrequest_M->_update_where($id, $data);
            redirect($this->c_method_request); // UPDATE WAS SUCCESSFUL
        }
    }

    public function save_updaterequest_c() {
// CHECK IF SESSION LOGIN
        if ($this->_IS_IN_SESSION_empID()) {
            if (isset($_POST['save_updaterequest'])) {
                $this->_save_updaterequest_c_to_database();
            }

            if (isset($_POST['cancel_updaterequest'])) {
                redirect($this->c_method_complete);
            }
        }
    }

    public function _save_updaterequest_c_to_database() {
        $id = $this->input->post('id'); // RETRIEVE THE ID FROM THE POST DATA 
        if ($id) {
            $response_date = $this->input->post('response_date');
            $status = $this->input->post('status');
            $processed_by = $this->input->post('processed_by');
            $response_message = $this->input->post('response_message');

            $data = array(
                'response_date' => $response_date,
                'status' => $status,
                'processed_by' => $processed_by,
                'response_message' => $response_message
            );
            $r = $this->jb_emailrequest_M->_update_where($id, $data);
            redirect($this->c_method_complete);
// UPDATE WAS SUCCESSFUL
        } else {
// Handle the case where no ID was passed
            show_error('ID not provided.');
        }
    }

// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
// DELETE
// ------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------------------------------
//    public function delete() {
//// $rs = $this->M_emailrequest->_delete_where(140); // CALL MODEL FUNCTION
//// echo "<pre>";
//// print_r($rs);
//    }

    public function deleterequest() {
        // CHECK IF SESSION LOGIN
        if ($this->_IS_IN_SESSION_empID()) {
            if (isset($_POST['delete_id'])) {
                $id = $this->input->post('delete_id');
                $rs = $this->jb_emailrequest_M->_delete_where($id); // CALL MODEL FUNCTION
                if ($rs) {
                    redirect($this->c_method_request); // DELETION WAS SUCCESSFUL
                } else {
                    echo "FAILED TO DELETE THE ROW.";  // Deletion failed
                }
            }
        }
    }

    public function deleterequest_c() {
        if (isset($_POST['delete_id'])) {
            $id = $this->input->post('delete_id');
            $rs = $this->jb_emailrequest_M->_delete_where($id); // CALL MODEL FUNCTION

            if ($rs) {
                redirect($this->c_method_complete); // DELETION WAS SUCCESSFUL
            } else {
                echo "FAILED TO DELETE THE ROW.";  // Deletion failed
            }
        }
    }
}
