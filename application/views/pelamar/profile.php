
        <form action="<?php echo $action; ?>" method="post">
            <div class="form-group">
                <label for="int">NIK <?php echo form_error('nik') ?></label>
                <input type="text" class="form-control" name="nnik" id="nik" placeholder="NIK anda" value="<?php echo $nik; ?>" />
            </div>
            <div class="form-group">
                <label for="int">Formasi <?php echo form_error('id_posisi') ?></label>
                <select class="form-control" name="id_posisi" id="id_posisi" disabled="true">
                    <?php foreach ($formasi as $key => $value): ?>
                        <option value="<?php echo $value->id ?>" <?php echo($id_posisi==$value->id?'selected="true"':NULL); ?>><?php echo $value->posisi_jabatan ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group">
                <label for="varchar">Nama Lengkap <?php echo form_error('nama') ?></label>
                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" maxlength="100" />
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="enum">Jenis Kelamin <?php echo form_error('jenis_kelamin') ?></label>                
                        <select class="form-control" name="jenis_kelamin" id="jenis_kelamin" >
                            <option value="Pria" <?php echo($jenis_kelamin=="Pria"?'selected="true"':NULL) ?>>Pria</option>
                            <option value="Wanita" <?php echo($jenis_kelamin=="Wanita"?'selected="true"':NULL) ?>>Wanita</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="form-group">
                        <label for="int">Tinggi Badan (cm) <?php echo form_error('tinggi_badan') ?></label>
                        <input type="number" min="120" max="1000" class="form-control" name="tinggi_badan" id="tinggi_badan" placeholder="Tinggi Badan" value="<?php echo $tinggi_badan; ?>" />
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="form-group">
                        <label for="int">Berat Badan (cm) <?php echo form_error('berat_badan') ?></label>
                        <input type="number" min="20" max="200" class="form-control" name="berat_badan" id="berat_badan" placeholder="Berat Badan" value="<?php echo $berat_badan; ?>" />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="varchar">Status <?php echo form_error('status') ?></label>
                <select class="form-control" name="status" id="status">
                    <option value="Belum Menikah" <?php echo($status=="Belum Menikah"?'selected="true"':NULL) ?>>Belum Menikah</option>
                    <option value="Sudah Menikah" <?php echo($status=="Sudah Menikah"?'selected="true"':NULL) ?>>Sudah Menikah</option>
                </select>
            </div>
            <div class="form-group">
                <label for="varchar">Pekerjaan <?php echo form_error('pekerjaan') ?></label>
                <input type="text" class="form-control" name="pekerjaan" id="pekerjaan" placeholder="Pekerjaan" value="<?php echo $pekerjaan; ?>" maxlength="100" required="true" />
            </div>

            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group">
                        <label for="varchar">Email <?php echo form_error('email') ?></label>
                        <input type="mail" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" maxlength="100" required="true" />
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group">
                        <label for="varchar">Hp <?php echo form_error('hp') ?></label>
                        <input type="tel" class="form-control" name="hp" id="hp" placeholder="Hp" value="<?php echo $hp; ?>" maxlength="21" required="true" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat <?php echo form_error('alamat') ?></label>
                <textarea class="form-control" rows="3" name="alamat" id="alamat" placeholder="Alamat" ><?php echo $alamat; ?></textarea>
            </div>
            <div class="form-group">
                <label for="varchar">Username <small class="text-danger"><?php echo $this->session->userdata("msgusername") ?></small></label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" maxlength="35" required="true" />
            </div>
            <div class="form-group">
                <label for="varchar">Password Saat Ini <small class="text-danger"><?php echo $this->session->userdata("msgpassword") ?></small></label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="" maxlength="100" required="true" />
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group">
                        <label for="varchar">Password Baru <small class="text-danger"><?php echo $this->session->userdata("msgpasswordb") ?></small></label>
                        <input type="password" class="form-control" name="passwordb" id="passwordb" placeholder="Kosongkan jika tidak ingin merubah password" value="" maxlength="100" />
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group">
                        <label for="varchar">Konfirmasi Password Baru <small class="text-danger"><?php echo $this->session->userdata("msgpasswordb") ?></small></label>
                        <input type="password" class="form-control" name="passwordbb" id="passwordbb" placeholder="Kosongkan jika tidak ingin merubah password" value="" maxlength="100" />
                    </div>
                </div>
            </div>
            
           <input type="hidden" name="nik" value="<?php echo $nik; ?>" /> 
           <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
           <button type="button" class="btn btn-default" onclick="window.history.go(-1)">Batalkan</button>
        </form>