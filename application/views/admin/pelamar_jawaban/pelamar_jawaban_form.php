        <h2 style="margin-top:0px"><?php echo $PageAttribute['title'] ?></h2>
        <form action="<?php echo $action; ?>" method="post">
            <div class="form-group">
                <label for="varchar">Nik <?php echo form_error('nik') ?></label>
                <input type="text" class="form-control" name="nik" id="nik" placeholder="Nik" value="<?php echo $nik; ?>" maxlength="25" />
            </div>
            <div class="form-group">
                <label for="varchar">Kode Ujian <?php echo form_error('kode_ujian') ?></label>
                <input type="text" class="form-control" name="kode_ujian" id="kode_ujian" placeholder="Kode Ujian" value="<?php echo $kode_ujian; ?>" maxlength="25" />
            </div>
            <div class="form-group">
                <label for="varchar">Kode Soal <?php echo form_error('kode_soal') ?></label>
                <input type="text" class="form-control" name="kode_soal" id="kode_soal" placeholder="Kode Soal" value="<?php echo $kode_soal; ?>" maxlength="25" />
            </div>
            <div class="form-group">
                <label for="varchar">Id Soal <?php echo form_error('id_soal') ?></label>
                <input type="text" class="form-control" name="id_soal" id="id_soal" placeholder="Id Soal" value="<?php echo $id_soal; ?>" maxlength="25" />
            </div>
            <div class="form-group">
                <label for="char">Jawaban <?php echo form_error('jawaban') ?></label>
                <input type="text" class="form-control" name="jawaban" id="jawaban" placeholder="Jawaban" value="<?php echo $jawaban; ?>" maxlength="1" />
            </div>
            <div class="form-group">
                <label for="varchar">Timestamps <?php echo form_error('timestamps') ?></label>
                <input type="text" class="form-control" name="timestamps" id="timestamps" placeholder="Timestamps" value="<?php echo $timestamps; ?>" maxlength="25" required="true" />
            </div>
           <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
           <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
           <button type="button" class="btn btn-seccondary" onclick="window.history.go(-1)">Batalkan</button>
        </form>