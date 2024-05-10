<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $title ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Favicon -->
  <link rel="icon" type="image/png" sizes="16x16"
    href="<?= base_url('assets/template')?>/dist/img/favicons/favicon.png">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="theme-color" content="#ffffff">


  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets/template')?>/plugins/fontawesome-free/css/all.min.css">

  <!-- overlayScrollbars -->
  <link rel="stylesheet"
    href="<?= base_url('assets/template')?>/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!--<link rel="stylesheet" href="<?= base_url('assets/template')?>/plugins/bootstrap/css/bootstrap.min.css">-->


  <!-- jsGrid -->
  <link rel="stylesheet" href="<?= base_url('assets/template')?>/plugins/jsgrid/jsgrid.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/template')?>/plugins/jsgrid/jsgrid-theme.min.css">

  <!-- DataTables -->
  <link rel="stylesheet"
    href="<?= base_url('assets/template') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet"
    href="<?= base_url('assets/template') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

  <!-- AdminLTE Theme Style -->
  <link rel="stylesheet" href="<?= base_url('assets/template')  ?>/dist/css/adminlte.min.css">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.min.css">

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.7/dist/sweetalert2.all.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



  <!-- Tambahan Jquery (jika ada) -->
  <style>
  @keyframes moveCheckmark {

    0%,
    100% {
      transform: translateY(0);
    }

    50% {
      transform: translateY(10px);
    }
  }

  .moving-icon {
    animation: moveCheckmark 2s ease-in-out infinite;
    /* 2 detik per putaran, animasi berulang */
  }
  </style>

</head>

<body class="hold-transition skin-blue sidebar-mini text-sm layout-fixed layout-navbar-fixed layout-footer-fixed">