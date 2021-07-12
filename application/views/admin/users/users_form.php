
        <form action="<?php echo $action; ?>" method="post">
            <div class="form-group">
                <label for="varchar">NIK <?php echo form_error('nik') ?></label>
                <input type="text" class="form-control" name="nnik" id="nik" placeholder="NIK" value="<?php echo $nik; ?>" maxlength="35" />
            </div>
            <div class="form-group">
                <label for="varchar">Username <?php echo form_error('username') ?></label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" maxlength="35" />
            </div>
            <div class="form-group">
                <label for="varchar">Password <?php echo form_error('password') ?></label>
                <input type="text" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $password; ?>" maxlength="100" required="true" />
            </div>
            <div class="form-group">
                <label for="varchar">Nama <?php echo form_error('nama') ?></label>
                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" maxlength="100" />
            </div>
            <div class="form-group">
                <label for="enum">Jenis Kelamin <?php echo form_error('jenis_kelamin') ?></label>
                <input type="text" class="form-control" name="jenis_kelamin" id="jenis_kelamin" placeholder="Jenis Kelamin" value="<?php echo $jenis_kelamin; ?>" />
            </div>
            <div class="form-group">
                <label for="varchar">Jabatan <?php echo form_error('jabatan') ?></label>
                <input type="text" class="form-control" name="jabatan" id="jabatan" placeholder="Jabatan" value="<?php echo $jabatan; ?>" maxlength="100" />
            </div>
           <input type="hidden" name="nik" value="<?php echo $nik; ?>" /> 
           <button type="button" class="btn btn-default" onclick="window.history.go(-1)">Batalkan</button>
           <button type="submit" class="btn btn-primary float-right"><?php echo $button ?></button>
        </form>