        
        <form action="<?php echo $action; ?>" method="post">
            <div class="form-group">
                <label for="varchar">Posisi Jabatan <?php echo form_error('posisi_jabatan') ?></label>
                <input type="text" class="form-control" name="posisi_jabatan" id="posisi_jabatan" placeholder="Posisi Jabatan" value="<?php echo $posisi_jabatan; ?>" maxlength="200" required="true" />
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-5">
                        <label for="varchar">Pendaftaran Dibuka <?php echo form_error('pendaftaran_mulai') ?></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                              </span>
                            </div>
                            <input type="text" class="form-control float-right" id="pendaftaran_tanggal" name="pendaftaran_tanggal" required="true" value="<?php echo $pendaftaran_tanggal; ?>">
                        </div>
                    </div>
                    <div class="col-1">
                        <label for="varchar">&nbsp;</label><br>
                        <label id="pendaftaran_lama"></label>                        
                    </div>
                    <div class="col-6">
                        <label for="int">Kuota <?php echo form_error('kuota') ?></label>
                        <input type="number" class="form-control" name="kuota" id="kuota" min="0" placeholder="Kuota" value="<?php echo $kuota; ?>" required="true" />
                    </div>
                </div>
            </div>
            <hr>
            <fieldset>
                <legend>Berkas lampiran</legend>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6"><label for="varchar">Nama Berkas</label></div>
                    <div class="col-lg-5 col-md-5 col-sm-5"><label for="varchar">Tipe Berkas</label></div>
                    <div class="col-lg-1 col-md-1 col-sm-1"><button type="button" id="add-berkas-pekerjaan" class="btn btn-primary btn-md"><i class="fa fa-plus"></i></button></div>
                </div>
                <div id="berkas-container">
                    <?php if (count($data_berkas)<=0): ?>
                        <div class="form-group berkas-fieldset">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <input type="text" class="form-control" name="nama_berkas[]" placeholder="Bahan" value="" maxlength="200" required="true" />
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-5">
                                    <select name="tipe_berkas[]" class="form-control">
                                        <option value="Gambar" >Gambar</option>
                                        <option value="Dokumen PDF" >Dokumen PDF</option>
                                        <option value="Gambar & PDF" >Gambar & PDF</option>
                                        <option value="Lainnya" >Lainnya</option>
                                    </select>
                                </div>
                                <div class="col-lg-1 col-md-1 col-sm-1"><button type="button" onclick="return subberkas(this)" class="btn btn-danger btn-md sub-berkas-pekerjaan"><i class="fa fa-minus"></i></button></div>
                            </div>
                        </div>                        
                    <?php endif ?>
                    <?php foreach ($data_berkas as $key => $berkas): ?>
                        <div class="form-group berkas-fieldset">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <input type="text" class="form-control" name="nama_berkas[]" placeholder="Bahan" value="<?php echo $berkas->nama ?>" maxlength="200" required="true" />
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-5">
                                    <select name="tipe_berkas[]" class="form-control">
                                        <option value="Gambar" <?php echo ($berkas->tipe=="Gambar"?'selected="true"':NULL); ?> >Gambar</option>
                                        <option value="Dokumen PDF" <?php echo ($berkas->tipe=="Dokumen PDF"?'selected="true"':NULL); ?> >Dokumen PDF</option>
                                        <option value="Gambar & PDF" <?php echo ($berkas->tipe=="Gambar & PDF"?'selected="true"':NULL); ?> >Gambar & PDF</option>
                                        <option value="Lainnya" <?php echo ($berkas->tipe=="Lainnya"?'selected="true"':NULL); ?> >Lainnya</option>
                                    </select>
                                </div>
                                <div class="col-lg-1 col-md-1 col-sm-1"><button type="button" onclick="return subberkas(this)" class="btn btn-danger btn-md sub-berkas-pekerjaan"><i class="fa fa-minus"></i></button></div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>                    
            </fieldset>
            <hr>
            <fieldset>
                <legend>jadwal Ujian</legend>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6"><label for="varchar">Ujian</label></div>
                    <div class="col-lg-5 col-md-5 col-sm-5"><label for="varchar">Jadwal</label></div>
                    <div class="col-lg-1 col-md-1 col-sm-1"><button type="button" id="add-jadwal-ujian" class="btn btn-primary btn-md"><i class="fa fa-plus"></i></button></div>
                </div>
                <div id="ujian-container">
                    <?php if (count($data_ujian)<=0): ?>
                        <div class="form-group ujian-fieldset">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <input type="text" class="form-control" name="judul_ujian[]" placeholder="Nama Tes" value="" maxlength="200" required="true" />
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-5">
                                    <input type="text" class="form-control text-time" name="jadwal_ujian[]" value="">
                                </div>
                                <div class="col-lg-1 col-md-1 col-sm-1"><button type="button" onclick="return subjadwal(this)" class="btn btn-danger btn-md sub-jadwal-ujian"><i class="fa fa-minus"></i></button></div>
                            </div>
                        </div>
                    <?php endif ?>
                    <?php foreach ($data_ujian as $key => $ujian): ?>
                        <div class="form-group ujian-fieldset">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <input type="text" class="form-control" name="judul_ujian[]" placeholder="Nama Tes" value="<?php echo $ujian->judul ?>" maxlength="200" required="true" />
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-5">
                                    <?php 
                                    $d1 = date("d/m/Y HH:mm", $ujian->mulai)." - ".date("d/m/Y HH:mm", $ujian->akhir)
                                     ?>
                                    <input type="text" class="form-control text-time" name="jadwal_ujian[]" value="<?php echo $d1 ?>">
                                </div>
                                <div class="col-lg-1 col-md-1 col-sm-1"><button type="button" onclick="return subjadwal(this)" class="btn btn-danger btn-md sub-jadwal-ujian"><i class="fa fa-minus"></i></button></div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>                    
            </fieldset>
            <hr>
           <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
           <input type="hidden" name="kode_bahan" value="<?php echo $kode_bahan; ?>" /> 
           <input type="hidden" name="kode_ujian" value="<?php echo $kode_ujian; ?>" /> 
           <button type="button" class="btn btn-default" onclick="window.history.go(-1)">Batalkan</button>
           <?php if ($id!=NULL): ?>
               <button type="submit" class="btn btn-primary float-right" onclick="return confirm('Anda yakin ?\r\nTindakan ini akan menghapus data soal & berkas lamaran peserta')"><?php echo $button ?></button>
            <?php else: ?>
               <button type="submit" class="btn btn-primary float-right"><?php echo $button ?></button>
           <?php endif ?>
           
        </form>