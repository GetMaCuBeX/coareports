<?php
// Start the session
//session_start();
// Create a session ID
//$_SESSION['username'] = 7315740;
//$_SESSION['position'] = 'ADMIN';
// Check if a user is logged in or session is set
//if (isset($_SESSION['session_empid'])) {
//    echo "Welcome, " . $_SESSION['session_empid'] . "!<br>";
//    echo 'Employee ID: ' . $_SESSION['session_empid'];
//} else {
//    echo "No user is logged in.";
//}
// Example of logging out
//if (isset($_POST['logout'])) {
//    session_unset(); // Unset session variables
//    session_destroy(); // Destroy the session
//    echo "You have logged out.";
//}
?>

<!DOCTYPE html>
<html lang="en">


    <meta charset="utf-8" />

    <title><?php echo isset($PAGE) ? $PAGE : ''; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Responsive bootstrap 4 admin template" name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/favicon.ico">
    <link href="<?= base_url(); ?>assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <!-- third party css -->
    <!-- App css -->
    <link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"
          id="bootstrap-stylesheet" />
    <link href="<?= base_url(); ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-stylesheet" />
    <!-- Datatables css -->
    <link href="<?= base_url(); ?>assets/libs/datatables/dataTables.bootstrap4.min.css" rel="stylesheet"
          type="text/css" />
    <link href="<?= base_url(); ?>assets/libs/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>assets/libs/datatables/responsive.bootstrap4.min.css" rel="stylesheet"
          type="text/css" />
    <link href="<?= base_url(); ?>assets/libs/datatables/select.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <script src="<?= base_url(); ?>assets/js/jb/jquery-3.6.0.min.js"></script>
    <body>

        <!-- Begin page -->
        <div id="wrapper">