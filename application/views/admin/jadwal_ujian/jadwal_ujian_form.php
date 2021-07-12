        <h2 style="margin-top:0px"><?php echo $PageAttribute['title'] ?></h2>
        <form action="<?php echo $action; ?>" method="post">
            <div class="form-group">
                <label for="varchar">Kode Ujian <?php echo form_error('kode_ujian') ?></label>
                <input type="text" class="form-control" name="kode_ujian" id="kode_ujian" placeholder="Kode Ujian" value="<?php echo $kode_ujian; ?>" maxlength="25" />
            </div>
            <div class="form-group">
                <label for="varchar">Kode Soal <?php echo form_error('kode_soal') ?></label>
                <input type="text" class="form-control" name="kode_soal" id="kode_soal" placeholder="Kode Soal" value="<?php echo $kode_soal; ?>" maxlength="25" />
            </div>
            <div class="form-group">
                <label for="varchar">Judul <?php echo form_error('judul') ?></label>
                <input type="text" class="form-control" name="judul" id="judul" placeholder="Judul" value="<?php echo $judul; ?>" maxlength="200" />
            </div>
            <div class="form-group">
                <label for="varchar">Mulai <?php echo form_error('mulai') ?></label>
                <input type="text" class="form-control" name="mulai" id="mulai" placeholder="Mulai" value="<?php echo $mulai; ?>" maxlength="25" />
            </div>
            <div class="form-group">
                <label for="varchar">Akhir <?php echo form_error('akhir') ?></label>
                <input type="text" class="form-control" name="akhir" id="akhir" placeholder="Akhir" value="<?php echo $akhir; ?>" maxlength="25" />
            </div>
           <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
           <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
           <button type="button" class="btn btn-seccondary" onclick="window.history.go(-1)">Batalkan</button>
        </form>