<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link navbar-lightblue">
    <?php $l = (base_url($this->db->where("lokasi", "logo")->get("perusahaan")->row()->deskripsi)) ?>
    <img src="<?php echo ($l) ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: 1;background-color: white;">
    <span class="brand-text font-weight-light">PT. KAS Jambi</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <?php if ($this->session->userdata("level") != "Admin") : ?>
          <img src="assets/images/avatars/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        <?php endif ?>
      </div>
      <div class="info">
        <a href="#" class="d-block"><?php echo str_sentence(str_shortened($this->session->userdata("nama"), 15, "")) ?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="Admin/Dashboard" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="admin/Pengumuman" class="nav-link">
            <i class="nav-icon fas fa-bullhorn"></i>
            <p>
              Berita
            </p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-clipboard-list"></i>
            <p>
              Formasi Pekerjaan
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="admin/Pekerjaan" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Formasi</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="admin/Berkas_pekerjaan" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Berkas</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="admin/Jadwal_ujian" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Jadwal Ujian</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Pelamar
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="admin/Pelamar" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Pelamar</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="admin/Pelamar_bahan" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Berkas Pelamar</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="admin/Pelamar_jawaban" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Hasil Ujian</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="admin/Users" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>
              Akun Pengguna
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="admin/Dashboard/data_perusahaan" class="nav-link">
            <i class="nav-icon fas fa-list-alt"></i>
            <p>
              Info Perusahaan
            </p>
          </a>
        </li>

        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-id-card-alt"></i>
            <p>
              Profile
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="admin/Users/update/<?php echo $this->session->userdata('nik') ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Ubah Profile</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="logout" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Logout</p>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>