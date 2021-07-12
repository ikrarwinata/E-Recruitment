        <h2 style="margin-top:0px"><?php echo $PageAttribute['title'] ?></h2>
        <form action="<?php echo $action; ?>" method="post">
            <div class="form-group">
                <label for="int">Id Posisi <?php echo form_error('id_posisi') ?></label>
                <input type="number" class="form-control" name="id_posisi" id="id_posisi" placeholder="Id Posisi" value="<?php echo $id_posisi; ?>" />
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
                <label for="varchar">Status <?php echo form_error('status') ?></label>
                <input type="text" class="form-control" name="status" id="status" placeholder="Status" value="<?php echo $status; ?>" maxlength="100" />
            </div>
            <div class="form-group">
                <label for="varchar">Pekerjaan <?php echo form_error('pekerjaan') ?></label>
                <input type="text" class="form-control" name="pekerjaan" id="pekerjaan" placeholder="Pekerjaan" value="<?php echo $pekerjaan; ?>" maxlength="100" />
            </div>
            <div class="form-group">
                <label for="int">Tinggi Badan <?php echo form_error('tinggi_badan') ?></label>
                <input type="number" class="form-control" name="tinggi_badan" id="tinggi_badan" placeholder="Tinggi Badan" value="<?php echo $tinggi_badan; ?>" />
            </div>
            <div class="form-group">
                <label for="int">Berat Badan <?php echo form_error('berat_badan') ?></label>
                <input type="number" class="form-control" name="berat_badan" id="berat_badan" placeholder="Berat Badan" value="<?php echo $berat_badan; ?>" />
            </div>
            <div class="form-group">
                <label for="varchar">Email <?php echo form_error('email') ?></label>
                <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" maxlength="100" />
            </div>
            <div class="form-group">
                <label for="varchar">Hp <?php echo form_error('hp') ?></label>
                <input type="text" class="form-control" name="hp" id="hp" placeholder="Hp" value="<?php echo $hp; ?>" maxlength="21" />
            </div>
            <div class="form-group">
                <label for="alamat">Alamat <?php echo form_error('alamat') ?></label>
                <textarea class="form-control" rows="3" name="alamat" id="alamat" placeholder="Alamat" ><?php echo $alamat; ?></textarea>
            </div>
            <div class="form-group">
                <label for="varchar">Username <?php echo form_error('username') ?></label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" maxlength="35" />
            </div>
            <div class="form-group">
                <label for="varchar">Password <?php echo form_error('password') ?></label>
                <input type="text" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $password; ?>" maxlength="100" />
            </div>
           <input type="hidden" name="nik" value="<?php echo $nik; ?>" /> 
           <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
           <button type="button" class="btn btn-seccondary" onclick="window.history.go(-1)">Batalkan</button>
        </form>