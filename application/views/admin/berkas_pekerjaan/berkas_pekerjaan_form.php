        <h2 style="margin-top:0px"><?php echo $PageAttribute['title'] ?></h2>
        <form action="<?php echo $action; ?>" method="post">
            <div class="form-group">
                <label for="varchar">Kode Bahan <?php echo form_error('kode_bahan') ?></label>
                <input type="text" class="form-control" name="kode_bahan" id="kode_bahan" placeholder="Kode Bahan" value="<?php echo $kode_bahan; ?>" maxlength="25" />
            </div>
            <div class="form-group">
                <label for="varchar">Nama <?php echo form_error('nama') ?></label>
                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" maxlength="200" />
            </div>
            <div class="form-group">
                <label for="enum">Tipe <?php echo form_error('tipe') ?></label>
                <input type="text" class="form-control" name="tipe" id="tipe" placeholder="Tipe" value="<?php echo $tipe; ?>" />
            </div>
           <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
           <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
           <button type="button" class="btn btn-seccondary" onclick="window.history.go(-1)">Batalkan</button>
        </form>