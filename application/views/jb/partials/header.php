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
    <head>

        <meta charset="utf-8" />

        <title></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Responsive bootstrap 4 admin template" name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />    
        <!-- App favicon -->
        <link href="<?= base_url(); ?>assets/images/favicon.ico" rel="shortcut icon" >


        <!-- third party css -->
        <link href="<?= base_url(); ?>assets/libs/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>assets/libs/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>assets/libs/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>assets/libs/datatables/select.bootstrap4.min.css" rel="stylesheet" type="text/css" /> 


        <!-- Plugins css --> 
        <link href="<?= base_url(); ?>assets/libs/switchery/switchery.min.css" rel="stylesheet" type="text/css" />

        <!-- App css -->
        <link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
        <link href="<?= base_url(); ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?= base_url(); ?>assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-stylesheet" />



        <!--DON'T REMOVE THIS DOWN & BELOW SCRIPT-->
        <script src="<?= base_url(); ?>assets/js/jb/jquery-3.6.0.min.js"></script> <!--FOR DROPDOWN SELECTION QUERY DATA-->
        <script src="<?= base_url(); ?>assets/js/jb/sweetalert2@11.js"></script> <!--USED BY DEPED EMAIL REQUEST, FOR POPUP DIALOG-->
       


    </head>
    <body>

        <!-- Begin page -->
        <div id="wrapper">