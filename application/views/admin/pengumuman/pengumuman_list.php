        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <a href="admin/Pengumuman/create" class="btn btn-primary">Tambah Data</a>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <small><?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?></small>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('admin/Pengumuman/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('admin/Pengumuman'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Cari</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-6 text-center">
                                <strong>Berita</strong>
                            </div>
                            <div class="col-sm-12 col-md-3 col-lg-3 text-center">
                                <strong>Banner</strong>
                            </div>
                            <div class="col-sm-6 col-md-2 col-lg-2 text-center">
                                <strong>Tampilkan</strong>
                            </div>
                            <div class="col-sm-6 col-md-1 col-lg-1 text-center">
                                
                            </div>
                        </div>
                        <hr>
                        <?php foreach ($pengumuman_data as $key => $pengumuman): ?>
                            <div class="row">
                                <div class="col-sm-12 col-md-7 col-lg-7">
                                    <h5><strong><?php echo $pengumuman->judul ?></strong></h5>                                    
                                </div>
                                <div class="col-6">
                                    <small><?php echo date("d M Y", $pengumuman->timestamps) ?></small><br>
                                    <?php echo str_shortened($pengumuman->deskripsi,100,"...") ?>
                                </div>
                                <div class="col-sm-12 col-md-3 col-lg-3">
                                    <img src="<?php echo $pengumuman->banner ?>" style="max-width: 100%;max-height: 250px;">
                                </div>
                                <div class="col-sm-6 col-md-2 col-lg-2 top-checkbox">
                                    <input type="hidden" value="<?php echo $pengumuman->id ?>" class="id-placeholder">
                                    <input type="checkbox" class="form-control shownewscheckbox" <?php echo $pengumuman->tampilkan==1?'checked="true"':NULL; ?>>
                                </div>
                                <div class="col-sm-6 col-md-1 col-lg-1 text-center">
                                    <button type="button" class="btn btn-tool dropdown-toggle btn-lg text-success" data-toggle="dropdown">
                                      <i class="fa fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                                      <a href="admin/Pengumuman/update/<?php echo $pengumuman->id ?>" class="dropdown-item text-primary">Ubah</a>
                                      <a href="admin/Pengumuman/delete/<?php echo $pengumuman->id ?>" class="dropdown-item text-danger" onclick="return confirm('Anda yakin ingin menghapus data ini ?')">Hapus</a>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        <?php endforeach ?>
                    </div>
                    <!-- /.card-body -->
                </div>
            <!-- /.card -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="well well-sm well-primary">Total Data : <?php echo $total_rows ?></div>
            </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>