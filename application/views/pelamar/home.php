
        <div class="row">
          <div class="col-lg-12">
            <div class="card card-primary card-outline">
              <div class="card-body">
                <h5 class="card-title">Selamat Datang</h5>

                <?php if ($pekerjaan): ?>
                  <p class="card-text">
                    Anda telah berhasil mendaftar untuk formasi <strong><?php echo $pekerjaan->posisi_jabatan ?></strong>
                  </p>
                  <hr>
                  <p class="card-text">Username : <?php echo $this->session->userdata("username") ?></p>
                  <p class="card-text">Username dan password tersebut diperlukan untuk mengikuti ujian pada waktu yang telah ditetapkan</p>
                  <p class="card-text">Anda dapat merubah Username beserta data diri anda di <a href="pelamar/Dashboard/profile" class="card-link">Halaman Profile</a></p>
                <?php endif ?>
                <?php if ($bahan_pelamar != $bahan_pekerjaan): ?>
                  <hr>
                  <p class="card-text">Anda belum melengkapi <a href="pelamar/Berkas" class="card-link">Berkas Persyaratan</a></p>
                <?php else: ?>
                  <hr>
                  <p class="card-text">Anda dapat melihat jadwal tes di <a href="pelamar/Ujian" class="card-link">Halaman Jadwal</a></p>
                <?php endif ?>
              </div>
            </div><!-- /.card -->
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
