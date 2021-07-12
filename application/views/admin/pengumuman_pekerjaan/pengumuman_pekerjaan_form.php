        <h2 style="margin-top:0px"><?php echo $PageAttribute['title'] ?></h2>
        <form action="<?php echo $action; ?>" method="post">
            <div class="form-group">
                <label for="int">Id Pengumuman <?php echo form_error('id_pengumuman') ?></label>
                <input type="number" class="form-control" name="id_pengumuman" id="id_pengumuman" placeholder="Id Pengumuman" value="<?php echo $id_pengumuman; ?>" />
            </div>
            <div class="form-group">
                <label for="varchar">Judul <?php echo form_error('judul') ?></label>
                <input type="text" class="form-control" name="judul" id="judul" placeholder="Judul" value="<?php echo $judul; ?>" maxlength="250" />
            </div>
            <div class="form-group">
                <label for="banner">Banner <?php echo form_error('banner') ?></label>
                <textarea class="form-control" rows="3" name="banner" id="banner" placeholder="Banner" required="true" ><?php echo $banner; ?></textarea>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi <?php echo form_error('deskripsi') ?></label>
                <textarea class="form-control" rows="3" name="deskripsi" id="deskripsi" placeholder="Deskripsi" ><?php echo $deskripsi; ?></textarea>
            </div>
            <div class="form-group">
                <label for="varchar">Timestamps <?php echo form_error('timestamps') ?></label>
                <input type="text" class="form-control" name="timestamps" id="timestamps" placeholder="Timestamps" value="<?php echo $timestamps; ?>" maxlength="21" />
            </div>
            <div class="form-group">
                <label for="int">Id <?php echo form_error('id') ?></label>
                <input type="number" class="form-control" name="id" id="id" placeholder="Id" value="<?php echo $id; ?>" required="true" />
            </div>
            <div class="form-group">
                <label for="varchar">Posisi Jabatan <?php echo form_error('posisi_jabatan') ?></label>
                <input type="text" class="form-control" name="posisi_jabatan" id="posisi_jabatan" placeholder="Posisi Jabatan" value="<?php echo $posisi_jabatan; ?>" maxlength="200" required="true" />
            </div>
            <div class="form-group">
                <label for="varchar">Pendaftaran Mulai <?php echo form_error('pendaftaran_mulai') ?></label>
                <input type="text" class="form-control" name="pendaftaran_mulai" id="pendaftaran_mulai" placeholder="Pendaftaran Mulai" value="<?php echo $pendaftaran_mulai; ?>" maxlength="25" required="true" />
            </div>
            <div class="form-group">
                <label for="varchar">Pendaftaran Akhir <?php echo form_error('pendaftaran_akhir') ?></label>
                <input type="text" class="form-control" name="pendaftaran_akhir" id="pendaftaran_akhir" placeholder="Pendaftaran Akhir" value="<?php echo $pendaftaran_akhir; ?>" maxlength="25" required="true" />
            </div>
            <div class="form-group">
                <label for="varchar">Kode Bahan <?php echo form_error('kode_bahan') ?></label>
                <input type="text" class="form-control" name="kode_bahan" id="kode_bahan" placeholder="Kode Bahan" value="<?php echo $kode_bahan; ?>" maxlength="25" required="true" />
            </div>
            <div class="form-group">
                <label for="int">Kuota <?php echo form_error('kuota') ?></label>
                <input type="number" class="form-control" name="kuota" id="kuota" placeholder="Kuota" value="<?php echo $kuota; ?>" required="true" />
            </div>
            <div class="form-group">
                <label for="varchar">Kode Ujian <?php echo form_error('kode_ujian') ?></label>
                <input type="text" class="form-control" name="kode_ujian" id="kode_ujian" placeholder="Kode Ujian" value="<?php echo $kode_ujian; ?>" maxlength="25" required="true" />
            </div>
           <input type="hidden" name="" value="<?php echo $; ?>" /> 
           <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
           <button type="button" class="btn btn-seccondary" onclick="window.history.go(-1)">Batalkan</button>
        </form>