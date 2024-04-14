<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= AdminURL?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= AdminURL?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= AdminURL?>assets/css/adminlte.min.css">
  <!-- Font Awesome -->
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?= AdminURL?>assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= AdminURL?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?= AdminURL?>assets/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= AdminURL?>assets/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= AdminURL?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= AdminURL?>assets/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= AdminURL?>assets/plugins/summernote/summernote-bs4.min.css">
  
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= AdminURL?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= AdminURL?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= AdminURL?>assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <!-- Select2 -->
  <link rel="stylesheet" href="<?= AdminURL?>assets/plugins/select2/css/select2.min.css">

  <link rel="stylesheet" href="<?= AdminURL?>assets/css/custom.css">


  
  <!--  -->
</head>
<?php
$current_page = basename($_SERVER['PHP_SELF']);
if($current_page == "Login.php"){
    echo '<body class="hold-transition login-page">';
}else{
    echo '<body class="hold-transition sidebar-mini layout-fixed ';
    echo (@$_SESSION['loggedin'])?"session-set":"session-not-set";
    echo '">';
}
//print_r($_SESSION);
//die;
?>