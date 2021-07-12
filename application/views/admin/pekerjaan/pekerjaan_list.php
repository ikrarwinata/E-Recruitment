        
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Formasi Pekerjaan</h3>
                <div class="d-none">
                    <span id="placeholder-alert"><?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?></span>
                    <span id="placeholder-alert-tipe"><?php echo $this->session->userdata('messagetype') <> '' ? $this->session->userdata('messagetype') : 'success'; ?></span>
                </div>
                <div class="card-tools">
                    <div class="input-group input-group-sm">
                        <form action="" class="form-inline" method="get">
                            <div class="input-group-append">
                                <a href="admin/Pekerjaan/create" class="btn btn-tool btn-sm" title="Tambah data">
                                    <i class="fa fa-plus-square fa-3x"></i>
                                </a>
                            </div>
                        </form>
                            
                        <form action="<?php echo site_url('admin/Pekerjaan/index'); ?>" class="form-inline" method="get">
                            <input type="text" class="form-control float-right" name="q" value="<?php echo $q; ?>">
                            <div class="input-group-append">
                                <?php 
                                    if ($q <> '')
                                    {
                                        ?>
                                        <a href="<?php echo site_url('admin/Pekerjaan'); ?>" class="btn btn-sm btn-default">Reset</a>
                                        <?php
                                    }
                                ?>
                              <button class="btn btn-sm btn-primary" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Formasi</th>
                      <th class="text-center">Tanggal</th>
                      <th class="text-center">Bahan</th>
                      <th class="text-center">Kuota</th>
                      <th class="text-center">Ujian</th>
                      <th class="text-center">Dibuka</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($pekerjaan_data as $key => $pekerjaan): ?>
                    <tr>                        
                        <td width="80px"><?php echo ++$start ?></td>
                        <td><?php echo $pekerjaan->posisi_jabatan ?></td>
                        <td class="text-center"><?php echo date("d M Y", $pekerjaan->pendaftaran_mulai)." s/d ".date("d M Y", $pekerjaan->pendaftaran_akhir) ?></td>
                        <td class="text-center"><a href="admin/Berkas_pekerjaan/formasi/<?php echo $pekerjaan->id ?>" class="badge bg-primary"><?php echo $pekerjaan->total_berkas." Berkas" ?></a></td>
                        <td class="text-center"><?php echo $pekerjaan->kuota ?></td>
                        <td class="text-center"><a href="admin/Jadwal_ujian/formasi/<?php echo $pekerjaan->id ?>" class="badge bg-primary"><?php echo $pekerjaan->total_ujian." Ujian" ?></a></td>
                        <td class="text-center top-checkbox">
                          <?php
                           $state = NULL;
                           if(isset($pekerjaan->tersedia)){
                            if($pekerjaan->tersedia!=NULL){
                              if ($pekerjaan->tersedia==1) {
                                $state = 'checked="true"';
                              }                              
                            }
                           }
                           ?>
                          <input type="hidden" class="id-placeholder" value="<?php echo $pekerjaan->id ?>">
                          <input type="checkbox" class="form-control pekerjaan-states" <?php echo  $state ?>>
                        </td>
                        <td class="text-center">
                          <a href="admin/Pekerjaan/update/<?php echo $pekerjaan->id ?>" class="btn btn-md" title="Ubah"><i class="fa fa-edit text-primary"></i></a>&nbsp;
                          <a href="admin/Pekerjaan/delete/<?php echo $pekerjaan->id ?>" class="btn btn-md" title="Hapus" onclick="return confirm('Anda yakin ingin mengahpus formasi ini ?')"><i class="fa fa-trash text-danger"></i></a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="well well-sm well-primary">Total Formasi Pekerjaan : <?php echo $total_rows ?></div>
            </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>