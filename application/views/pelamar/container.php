<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Halaman Peserta</title>
  <base href="<?php echo base_url() ?>">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="assets/css/font-awesome.css">
  <link rel="stylesheet" href="assets/css/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="assets/css//overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/css//adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="assets/css/font3.css" rel="stylesheet">
  <?php foreach ($PageAttribute['bootstraps'] as $key => $value): ?>
  <link rel="stylesheet" href="<?php echo $value ?>"/>
  <?php endforeach ?>
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">
  <?php $this->load->view("pelamar/_partials/navbar") ?>  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?php echo $PageAttribute['title'] ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo $this->session->userdata('level') ?>">Home</a></li>
              <?php for($i=1; $i<count($PageAttribute['subtitle']); $i++){ ?>
              <li class="breadcrumb-item active"><?php echo $PageAttribute['subtitle'][$i] ?></li>
              <?php } ?>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <?php $this->load->view($PageAttribute['content']) ?>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5></h5>
      <p></p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->  
  <?php $this->load->view("pelamar/_partials/footer") ?>  
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
  <script src="assets/js/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 4 -->
  <script src="assets/js/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/adminlte.min.js"></script>
  <?php foreach ($PageAttribute['scripts'] as $key => $value): ?>
  <script type="text/javascript" src="<?php echo $value ?>"></script>
  <?php endforeach ?>
</body>
</html>
