<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Administrator</title>
  <base href="<?php echo base_url() ?>">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="assets/css/font-awesome.css">
  <link rel="stylesheet" href="assets/css/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="assets/css//overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/css//adminlte.min.css">
  <link rel="stylesheet" href="assets/css//bootstrap.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="assets/css/font3.css" rel="stylesheet">
  <style>
fieldset {
  background-color: #eeeeee;
  border-radius: 25px
}

legend {
  background-color: gray;
  color: white;
  padding: 5px 10px;
  font-size: 12px;
  border-radius: 25px
}

</style>
  <?php foreach ($PageAttribute['bootstraps'] as $key => $value): ?>
  <link rel="stylesheet" href="<?php echo $value ?>"/>
  <?php endforeach ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  <?php $this->load->view("admin/_partials/navbar") ?>

  <?php $this->load->view("admin/_partials/sidebar") ?>  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
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
    <section class="content">
      <div class="container-fluid">
        <?php $this->load->view($PageAttribute['content']) ?>
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php $this->load->view("admin/_partials/footer") ?>
</div>
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
  <script src="assets/js/jquery-2.2.3.min.js"></script>
  <!-- Bootstrap -->
  <script src="assets/js/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="assets/js/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="assets/js/adminlte.js"></script>

  <!-- OPTIONAL SCRIPTS -->
  <script src="assets/js/demo.js"></script>

  <!-- PAGE assets -->
  <!-- jQuery Mapael -->
  <script src="assets/js/jquery-mousewheel/jquery.mousewheel.js"></script>
  <script src="assets/js/raphael/raphael.min.js"></script>
  <script src="assets/js/jquery-mapael/jquery.mapael.min.js"></script>
  <script src="assets/js/jquery-mapael/maps/usa_states.min.js"></script>

  <?php foreach ($PageAttribute['scripts'] as $key => $value): ?>
  <script type="text/javascript" src="<?php echo $value ?>"></script>
  <?php endforeach ?>
</body>
</html>
