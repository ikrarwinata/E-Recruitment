        <h2 style="margin-top:0px"><?php echo $PageAttribute['title'] ?></h2>
        <form action="<?php echo $action; ?>" method="post">
            <div class="form-group">
                <label for="varchar">Nik <?php echo form_error('nik') ?></label>
                <input type="text" class="form-control" name="nik" id="nik" placeholder="Nik" value="<?php echo $nik; ?>" maxlength="26" />
            </div>
            <div class="form-group">
                <label for="int">Id Berkas <?php echo form_error('id_berkas') ?></label>
                <input type="number" class="form-control" name="id_berkas" id="id_berkas" placeholder="Id Berkas" value="<?php echo $id_berkas; ?>" />
            </div>
            <div class="form-group">
                <label for="file_path">File Path <?php echo form_error('file_path') ?></label>
                <textarea class="form-control" rows="3" name="file_path" id="file_path" placeholder="File Path" required="true" ><?php echo $file_path; ?></textarea>
            </div>
           <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
           <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
           <button type="button" class="btn btn-seccondary" onclick="window.history.go(-1)">Batalkan</button>
        </form>