  <?php echo(form_open_multipart("pelamar/Berkas/action", "class='form-horizontal' role='form' id='form-user-profile'")) ?>
    <?php foreach ($berkas_data as $key => $berkas): ?>
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
          <strong><?php echo $berkas->nama ?></strong>
          <ul style="list-style: none; color: red;font-size: 10px">
            <li><?php echo $berkas->tipe ?></li>
            <li>Max Size 2MB</li>
            <?php if ($berkas->tipe=="Gambar"): ?>
              <li>Max Width 2500px (12CM)</li>
              <li>Max Height 4000px (16CM)</li>
              <?php $tipe = "image/*" ?>
              <?php elseif($berkas->tipe=="Dokumen PDF"): ?>
              <?php $tipe = "application/pdf" ?>
              <?php elseif($berkas->tipe=="Gambar & PDF"): ?>
              <?php $tipe = "application/pdf, image/*" ?>
              <?php else: ?>
              <?php $tipe = ".*" ?>
            <?php endif ?>
          </ul>
          <input type="file" name="<?php echo $berkas->id ?>" accept="<?php echo $tipe ?>" style="display: none;">
          <label class="btn btn-md btn-primary upload-clicker form-control" style="cursor: pointer;"><i class="fa fa-file"></i>&nbsp;Upload File</label>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 text-center">
          <?php 
          $imgsrc = NULL;
          foreach ($berkas_uploaded_data as $key => $uploaded) {
            if ($uploaded->id_berkas==$berkas->id) {
              $imgsrc = $uploaded->file_path;
            }
          }
           ?>
          <?php if ($berkas->tipe=="Gambar"): ?>
            <img src="<?php echo $imgsrc ?>" class="img-placeholder" style="max-height: 250px; max-width: 100%">
          <?php elseif($berkas->tipe=="Gambar & Dokumen"): ?>
            <label class="doc-placeholder">
              <?php if ($imgsrc!=NULL): ?>
                <a href="<?php echo $imgsrc ?>"><i class="fa fa-file"></i>&nbsp;File</a>
              <?php endif ?>
              </label>
            <img src="<?php echo $imgsrc ?>" class="img-placeholder" style="max-height: 250px; max-width: 100%">
          <?php else: ?>
            <label class="doc-placeholder">
              <?php if ($imgsrc!=NULL): ?>
                <a href="<?php echo $imgsrc ?>"><i class="fa fa-file"></i>&nbsp;File</a>
              <?php endif ?>
            </label>
          <?php endif ?>
        </div>
      </div>
      <hr>
    <?php endforeach ?>
    <div class="row">
      <div class="col-lg-12">
        <button class="btn btn-md btn-primary float-right">Simpan</button>
      </div>
    </div>
      <hr>

  </form>