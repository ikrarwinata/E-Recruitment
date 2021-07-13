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

  <title>UJIAN - <?php echo $PageAttribute['title'] ?></title>
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
  <?php foreach ($PageAttribute['bootstraps'] as $key => $value) : ?>
    <link rel="stylesheet" href="<?php echo $value ?>" />
  <?php endforeach ?>
  <script type="text/javascript">
    var hook = true;
    var isValid = true;
    window.onbeforeunload = function() {
      if (hook) {
        return "Anda yakin ingin meninggalkan halaman ini ?"
      }
    }

    function unhook() {
      hook = false;
      return true;
    }
  </script>
</head>

<body class="hold-transition layout-top-nav">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
      <div class="container">
        <span class="badge badge-primary">
          <h3><?php echo $current ?></h3>
        </span>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
          <!-- Left navbar links -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <div class="nav-link">&nbsp;<?php echo $PageAttribute['title'] ?></din>
            </li>
          </ul>
        </div>

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
          <?php
          $tl = $ujian_prop->akhir - strtotime(date("d-m-Y H:i:s"));
          ?>
          <li class="nav-item">
            <div class="nav-link" role="button"><i class="fas fa-clock"></i>&nbsp;<span id="time-left"><?php echo round($tl / 60, 0) ?></span> Menit
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i class="fas fa-th-large"></i></a>
          </li>
        </ul>
      </div>
    </nav>
    <!-- /.navbar -->
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
          <form action="pelamar/Ujian/next/<?php echo $current ?>" method="post">
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                <img src="<?php echo $soal_data->gambar ?>" style="max-width: 80%; max-height: 300px;">
              </div>
            </div>
            <div class="row mt-5 mb-5">
              <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                <?php echo $soal_data->soal ?>
              </div>
            </div>
            <hr>
            <div class="row mt-5">
              <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="input-group">
                  <div class="row" style="vertical-align: center; align-items: center;">
                    <div class="col-lg-2 col-md-2 col-sm-2">
                      <input type="radio" name="jawaban" value="a" <?php echo ($jawaban == "a" ? $checked : NULL) ?>>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-10 data-text-soal" style="cursor: pointer;">
                      <?php echo $soal_data->a ?>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="input-group">
                  <div class="row" style="vertical-align: center; align-items: center;">
                    <div class="col-lg-2 col-md-2 col-sm-2">
                      <input type="radio" name="jawaban" value="c" <?php echo ($jawaban == "c" ? $checked : NULL) ?>>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-10 data-text-soal" style="cursor: pointer;">
                      <?php echo $soal_data->c ?>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="input-group">
                  <div class="row" style="vertical-align: center; align-items: center;">
                    <div class="col-lg-2 col-md-2 col-sm-2">
                      <input type="radio" name="jawaban" value="e" <?php echo ($jawaban == "e" ? $checked : NULL) ?>>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-10 data-text-soal" style="cursor: pointer;">
                      <?php echo $soal_data->e ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row mt-5 mb-5">
              <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="input-group">
                  <div class="row" style="vertical-align: center; align-items: center;">
                    <div class="col-lg-2 col-md-2 col-sm-2">
                      <input type="radio" name="jawaban" value="b" <?php echo ($jawaban == "b" ? $checked : NULL) ?>>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-10 data-text-soal" style="cursor: pointer;">
                      <?php echo $soal_data->b ?>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-4 col-md-4 col-sm-4">
                <div class="input-group">
                  <div class="row" style="vertical-align: center; align-items: center;">
                    <div class="col-lg-2 col-md-2 col-sm-2">
                      <input type="radio" name="jawaban" value="d" <?php echo ($jawaban == "d" ? $checked : NULL) ?>>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-10 data-text-soal" style="cursor: pointer;">
                      <?php echo $soal_data->d ?>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-4 col-md-4 col-sm-4">

              </div>
            </div>

            <hr>

            <div class="row mt-5">
              <div class="col-lg-6 col-md-6 col-sm-6">
                <input type="hidden" name="id" value="<?php echo $soal_data->id ?>">
                <?php
                $enable = NULL;
                if ($current == 1) {
                  $enable = 'disabled="true"';
                } ?>
                <button type="button" class="btn btn-md btn-warning form-control" <?php echo $enable ?> onclick="unhook();window.location='pelamar/Ujian/prev/<?php echo $current ?>'"><i class="fa fa-chevron-left"></i>&nbsp;Sebelumnya</button>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6">
                <?php
                $enable = NULL;
                if ($current >= $total) {
                  $enable = 'disabled="true"';
                } ?>
                <button type="submit" class="btn btn-md btn-primary form-control" <?php echo $enable ?> onclick="return unhook()">Selanjutnya&nbsp;<i class="fa fa-chevron-right"></i></button>
              </div>
            </div>
          </form>

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
        <div class="row">
          <?php
          $no = 0;
          $done = TRUE;
          foreach ($terjawab as $key => $value) : ?>
            <?php
            $badge = "badge-warning";
            $class = NULL;
            $cursor = "cursor:  pointer;";
            if (($no + 1) == $current) {
              $badge = "badge-primary";
              $class = "disable";
              $cursor = NULL;
            } elseif (isset($value->jawaban)) {
              if ($value->jawaban != NULL) {
                $badge = "badge-success";
              } else {
                $done = FALSE;
              };
            } else {
              $done = FALSE;
            };
            ?>
            <div class="col-lg-2 col-md-2 col-sm-2 <?php echo $badge ?> text-center <?php echo $class ?>" style="border-radius: 25px;margin: 3px;<?php echo $cursor ?>" onclick="unhook();window.location='pelamar/Ujian/next/<?php echo $no ?>'">
              <?php echo ++$no; ?>
            </div>

          <?php endforeach ?>
        </div>
        <hr>
        <div class="row">
          <ul style="list-style: none;">
            <li style="font-size: 11px;"><strong class="text-warning">Kuning</strong> tanda soal belum terjawab</li>
            <li style="font-size: 11px;"><strong class="text-primary">Biru</strong> tanda soal saat ini</li>
            <li style="font-size: 11px;"><strong class="text-success">Hijau</strong> tanda soal terjawab</li>
          </ul>
        </div>
      </div>
    </aside>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="assets/js/jquery-2.2.3.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="assets/js/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/adminlte.min.js"></script>
  <?php foreach ($PageAttribute['scripts'] as $key => $value) : ?>
    <script type="text/javascript" src="<?php echo $value ?>"></script>
  <?php endforeach ?>
  <script type="text/javascript">
    $(function() {
      var timeleft = parseInt($("#time-left").text()),
        sec = <?php echo (min(59, $tl)); ?>;
      var x = setInterval(function() {
        if (isValid) {
          if (timeleft <= 0 && sec <= 0) {
            ForceClose();
          } else {
            if (sec <= 0) {
              timeleft--;
              sec = 59;
            } else {
              sec--;
            }
            $("#time-left").text(timeleft);
          };
        }
      }, 1000);

      function ForceClose(timeout = true) {
        if (timeout) {
          alert("Waktu Ujian Telah Berakhir");
        };
        unhook();
        isValid = false;
        $("button").attr("disabled", "true");
        $("a").attr("href", "");
        window.location = "pelamar/Ujian/done"
      }

      $("input").on("click", function() {
        if (isValid) {
          var ids = <?php echo $soal_data->id ?>,
            v = $(this).val();
          $.post("pelamar/Ujian/ajaxReq", {
              id: ids,
              jawaban: v
            })
            .done(function(data) {
              if (data == "success") {

              } else {
                console.log(data);
              }
            });
        }
      });

      <?php if ($done) : ?>
        unhook();
      <?php endif ?>

      $(".data-text-soal").on("click", function() {
        $(this).closest(".input-group").find("input").click();
      })

      var warn = false;
      // $(window).blur(function() {
      //   if (!warn) {
      //     warn = !warn;
      //     alert("Dilarang menggunakan alat bantu (Mesin pencari Google, Yahoo, Bing, Dll) ataupun bertanya pada orang lain.");
      //   }
      //   ForceClose(false);
      // });
      // $(window).focus(function() {
      //   if (!warn) {
      //     warn = !warn;
      //     alert("Dilarang menggunakan alat bantu (Mesin pencari Google, Yahoo, Bing, Dll) ataupun bertanya pada orang lain.");
      //   }
      //   ForceClose(false);
      // });
    })
  </script>
</body>

</html>