<?php echo (form_open_multipart("admin/Dashboard/data_perusahaan_action")) ?>
<div class="row">
    <div class="col-lg-12">
        <h4>Slider 1</h4>
    </div>
    <div class="col-lg-4">
        <textarea name="judulslider1" id="" cols="30" rows="2" class="form-control" placeholder="Judul Slider 1" required><?php echo ($slider1->judul) ?></textarea>
    </div>
    <div class="col-lg-8">
        <textarea name="deskripsislider1" id="" cols="30" rows="2" class="form-control" placeholder="Deskripsi Slider 1" required><?php echo ($slider1->deskripsi) ?></textarea>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-lg-12">
        <h4>Slider 2</h4>
    </div>
    <div class="col-lg-4">
        <textarea name="judulslider2" id="" cols="30" rows="2" class="form-control" placeholder="Judul Slider 2" required><?php echo ($slider2->judul) ?></textarea>
    </div>
    <div class="col-lg-8">
        <textarea name="deskripsislider2" id="" cols="30" rows="2" class="form-control" placeholder="Deskripsi Slider 2" required><?php echo ($slider2->deskripsi) ?></textarea>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-lg-12">
        <h4>Slider 3</h4>
    </div>
    <div class="col-lg-4">
        <textarea name="judulslider3" id="" cols="30" rows="2" class="form-control" placeholder="Judul Slider 3" required><?php echo ($slider3->judul) ?></textarea>
    </div>
    <div class="col-lg-8">
        <textarea name="deskripsislider3" id="" cols="30" rows="2" class="form-control" placeholder="Deskripsi Slider 3" required><?php echo ($slider3->deskripsi) ?></textarea>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-lg-12">
        <h4>Logo</h4>
    </div>
    <div class="col-lg-4 text-center">
        <img src="<?php echo (base_url($logo->deskripsi)) ?>" alt="" style="max-width: 100%;">
    </div>
    <div class="col-lg-8">
        <input type="file" accept="image/*" name="logo">
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <button type="submit" class="btn btn-md btn-success pull-right float-right">Simpan</button>
    </div>
</div>
</form>