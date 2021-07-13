    <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="User" class="navbar-brand">
        <img src="assets/images/avatars/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
      </a>
      
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="User" class="nav-link"><i class="fa fa-home"></i>&nbsp;Home</a>
          </li>
          <li class="nav-item">
            <a href="pelamar/Dashboard/profile" class="nav-link"><i class="fa fa-user"></i>&nbsp;Profile</a>
          </li>
          <li class="nav-item">
            <a href="pelamar/Berkas" class="nav-link"><i class="fa fa-file"></i>&nbsp;Berkas</a>
          </li>
          <li class="nav-item">
            <a href="pelamar/Ujian" class="nav-link"><i class="fa fa-tasks"></i>&nbsp;Ujian</a>
          </li>
          <li class="nav-item">
            <a href="logout" class="nav-link"><i class="fa fa-sign-out-alt"></i>&nbsp;Logout</a>
          </li>
        </ul>
      </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <!-- Notifications Dropdown Menu -->
        <?php 
        $separator = 1800;
        $ujian_dimulai = $this->db->where("kode_ujian", $this->session->userdata("kode_ujian"))->where("mulai<".strtotime("now"))->where("akhir>".strtotime("now"))->get("jadwal_ujian")->result();
        $ujian_akan_dimulai = $this->db->where("kode_ujian", $this->session->userdata("kode_ujian"))->where("mulai>".(strtotime("now")))->where("mulai<".(strtotime("now") + $separator))->get("jadwal_ujian")->result();
         ?>
         <?php if ((count($ujian_dimulai)+count($ujian_akan_dimulai)) >= 1): ?>
           <li class="nav-item dropdown">
              <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-danger navbar-badge"><?php echo count($ujian_dimulai)+count($ujian_akan_dimulai) ?></span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-header"><?php echo count($ujian_dimulai)+count($ujian_akan_dimulai) ?> Pemberitahuan</span>
                <div class="dropdown-divider"></div>
                <?php foreach ($ujian_dimulai as $key => $value): ?>
                <a href="pelamar/Ujian/prep/<?php echo $value->id ?>" class="dropdown-item">
                  <i class="fas fa-clock mr-2"></i> Tes <strong><?php echo $value->judul ?></strong> sedang berlangsung
                  <span class="float-right text-muted text-sm"><small>Saat ini</small></span>
                </a>
                <div class="dropdown-divider"></div>
                <?php endforeach ?>
                <?php foreach ($ujian_akan_dimulai as $key => $value): ?>
                <a href="" class="dropdown-item">
                  <i class="fas fa-clock mr-2"></i> Tes <strong><?php echo $value->judul ?></strong> akan dimulai
                </a>
                <div class="dropdown-divider"></div>
                <?php endforeach ?>
              </div>
            </li>
         <?php endif ?>
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->