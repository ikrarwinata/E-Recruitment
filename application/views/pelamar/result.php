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

  <title><?php echo $PageAttribute['title'] ?></title>
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
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="card">
          <div class="row">
            <div class="col-lg-12 text-center">
              <h3>Hasil Ujian <?php echo $ujian->judul ?></h3>
              <br>
              <h5><strong><?php echo $this->session->userdata("nik") ?></strong></h5>
              <h6><?php echo $this->session->userdata("nama") ?></h6>
            </div>
          </div>
          <div>
            <div class="float-right"><small><?php echo date("d M Y") ?></small></div><br>
          </div>
        </div>
        <div class="card card-primary card-outline">
          <hr>
          Jumlah Soal : <?php echo $total_soal ?>
          <hr>
          Jawaban Benar : <?php echo $benar ?>
          <hr>
          <div class="row">
            <div class="col-lg-4 text-center">
              
            </div>
            <div class="col-lg-4 text-center center">
              <div align="center">
                Nilai Anda
                <br>
                <strong style=""><span style="font-size: 80px;color: blue;border: 5px solid blue; border-radius: 55px"><?php echo $score ?></span></strong>
              </div>
            </div>
            <div class="col-lg-4 text-center">
              
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
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
  <script type="text/javascript">
    
  </script>
</body>
</html>
