        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Berita</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->

            <?php echo(form_open_multipart($action, "class='form-horizontal' role='form' id='form-user-profile'")) ?>
            <div class="card-body">

              <div class="form-group row">
                <label for="judul" class="col-sm-2 col-form-label">JudulJudul <?php echo form_error('judul') ?></label>
                <div class="col-sm-10">
                <input type="text" class="form-control" name="judul" id="judul" placeholder="Judul" value="<?php echo $judul; ?>" maxlength="250" />
                </div>
              </div>

              <div class="form-group row">
                <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi <?php echo form_error('deskripsi') ?></label>
                <div class="col-sm-10">
                  <textarea class="form-control" rows="3" name="deskripsi" id="deskripsi" placeholder="Deskripsi" ><?php echo $deskripsi; ?></textarea>
                </div>
              </div>

              <div class="form-group row">
                <label for="deskripsi" class="col-sm-2 col-form-label">Lampiran <?php echo form_error('file_lampiran') ?></label>
                <div class="col-sm-4">
                  <?php 
                  $t = explode("/", $file_lampiran);
                   ?>
                   <?php if (count($t)>=2): ?>
                     <?php echo end($t) ?>
                   <?php else: ?>
                     <small class="disabled">Tidak ada lampiran</small>
                   <?php endif ?>
                </div>
                <div class="col-sm-6">
                  <input type="file" name="file_lampiran" id="file_lampiran" multiple="false">
                </div>
              </div>

              <div class="form-group row">
                <label for="deskripsi" class="col-sm-2 col-form-label">Banner <?php echo form_error('banner') ?></label>
                <div class="col-sm-4">
                  <img src="<?php echo $banner; ?>" style="max-width: 100%;max-height: 250px;">
                </div>
                <div class="col-sm-6">
                  <input type="file" name="banner" id="banner" multiple="false" accept="image/*">
                </div>
              </div>

            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
               <button type="button" class="btn btn-default" onclick="window.history.go(-1)">Batalkan</button>
               <button type="submit" class="btn btn-info float-right"><?php echo $button ?></button>
            </div>
            <!-- /.card-footer -->
          </form>
        </div>
        <!-- /.card -->