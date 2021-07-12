        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-12">
                    <h4>Selamat datang <strong><?php echo str_sentence($this->session->userdata("nama")) ?></strong></h4>
                    <small><?php echo date("d M Y") ?></small>
                  </div>
                </div> 
              </div>
              <!-- ./card-body -->
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-6">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-clipboard-list"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pekerjaan</span>
                <span class="info-box-number">
                  <?php echo format_number($totalpekerjaan) ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <div class="col-12 col-sm-6 col-md-6">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-bullhorn"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Berita</span>
                <span class="info-box-number">
                  <?php echo format_number($totalpengumuan) ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- /.col -->
        </div>
        <!-- /.row -->

        <?php if (count($data_pengumuan)>=1): ?>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Berita</h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php foreach ($data_pengumuan as $key => $value): ?>
                <div class="row">
                  <div class="col-12">
                    <h4><strong><?php echo $value->judul ?></strong></h4>
                    <small><?php echo date("d M Y", $value->timestamps) ?></small>
                    <?php echo str_shortened($value->deskripsi,30, "...") ?>
                  </div>
                </div> 
                <hr class="clearfix">
                <!-- /.row -->
                <?php endforeach ?>
              </div>
              <!-- ./card-body -->
              <div class="card-footer">
                <div class="row">
                  
                  <!-- /.col -->
                  <div class="col-4">
                    <div class="description-block">

                    </div>
                    <!-- /.description-block -->
                  </div>                  
                  <!-- /.col -->

                  <div class="col-4">
                    <div class="description-block">
                      <a href="admin/Pengumuman" class="btn btn-primary btn-sm">Lihat semua...</a>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->

                  <div class="col-4">
                    <div class="description-block">

                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->

                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <?php endif ?>
