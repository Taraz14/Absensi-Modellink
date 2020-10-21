<?php
$userdataTipe = $this->session->userdata('tipe');
if ($userdataTipe == 99) {
  $site = site_url('admin');
}
if ($userdataTipe == 88) {
  $site = site_url('guru');
}
if ($userdataTipe == 77) {
  $site = site_url('sekretaris');
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $title; ?> | SMK Modellink</title>
  <link rel="shortcut icon" href="<?= base_url() ?>assets/gambar/logo/fav/fav.png" type="image/x-icon">
  <link rel="icon" href="<?= base_url() ?>assets/gambar/logo/fav/fav.png" type="image/x-icon">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/backend/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/backend/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/backend/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/backend/dist/css/AdminLTE.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/backend/dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/backend/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/backend/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- <link href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="<?= base_url() ?>assets/backend/plugins/jQueryMonth/demo/MonthPicker.css"> -->
  <!-- <link rel="stylesheet" href="<?= base_url() ?>assets/backend/bower_components/jquery-ui/jquery-ui.css"> -->

  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/backend/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- Datatables -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/backend/bower_components/datatables/datatables.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition <?php if ($userdataTipe == 99) {
                                echo 'skin-yellow';
                              }
                              if ($userdataTipe == 88) {
                                echo 'skin-purple';
                              }
                              if ($userdataTipe == 77) {
                                echo 'skin-red-light';
                              } ?> sidebar-mini">
  <!-- jQuery 3 -->
  <script src="<?= base_url() ?>assets/backend/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <!-- <script src="<?= base_url() ?>assets/backend/bower_components/jquery-ui/jquery-1.12.1.min.js"></script> -->
  <script src="<?= base_url() ?>assets/backend/bower_components/jquery-ui/jquery-ui.min.js"></script>
  <!-- <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script> -->
  <!-- <script src="https://cdn.rawgit.com/digitalBush/jquery.maskedinput/1.4.1/dist/jquery.maskedinput.min.js"></script> -->

  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button);
  </script>
  <!-- datepicker -->
  <script src="<?= base_url() ?>assets/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <script src="<?= base_url() ?>assets/backend/own/inputFilter.js"></script>
  <script src="<?= base_url() ?>assets/backend/own/jquery.validation.js"></script>
  <script src="<?= base_url() ?>assets/backend/own/additional-methods.js"></script>
  <!-- <script src="<?= base_url() ?>assets/backend/plugins/jQueryMonth/src/MonthPicker.js"></script> -->
  <!-- Datatables -->
  <script src="<?= base_url(); ?>assets/backend/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="<?= base_url(); ?>assets/backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="<?= base_url(); ?>assets/backend/bower_components/datatables/datatables.js"></script>
  <script src="<?= base_url(); ?>assets/backend/bower_components/datatables/Buttons-1.6.1/js/buttons.print.min.js"></script>
  <div class="wrapper">