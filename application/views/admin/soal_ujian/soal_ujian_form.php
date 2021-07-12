        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <button type="button" class="btn btn-md btn-primary" id="add-soal"><i class="fa fa-plus"></i>&nbsp;Tambah Soal</button>
            </div>
        </div>

        <?php echo(form_open_multipart($action, "class='form-horizontal' role='form'")) ?>
            <div id="soal-container">
                <?php if (count($soal_ujian_data)<=0): ?>
                    <div class="form-group group-soal">
                        <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <label for="soal">Soal <span class="soal-counter" data-count="1">1</span></label>
                                            <button type="button" class="btn btn-sm btn-danger float-right" onclick="return subsoal(this)"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                                            <img src="" style="max-width: 80%; max-height: 300px;">
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                                            <input type="file" name="file1" class="d-none" accept="image/*" onchange="return uploadeChanged(this)">
                                            <label class="btn btn-sm btn-primary form-control" style="cursor: pointer;" onclick="return openfilediaolog(this)"><i class="fa fa-image"></i>&nbsp;Upload Gambar</label>
                                        </div>
                                    </div>
                                    <textarea class="form-control soal-text" rows="3" name="soal[]" placeholder="Soal" required="true" ></textarea>
                                </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 mt-2">
                                <div class="row" style="vertical-align: middle; align-items: center;text-align: right;">
                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                        <input type="radio" name="jawaban1" value="a"> <strong>A</strong>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-10">
                                        <input type="text" name="a[]" class="form-control" value="" required="true">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 mt-2">
                                <div class="row" style="vertical-align: middle; align-items: center;text-align: right;">
                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                        <input type="radio" name="jawaban1" value="c"> <strong>C</strong>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-10">
                                        <input type="text" name="c[]" class="form-control" value="" required="true">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 mt-2">
                                <div class="row" style="vertical-align: middle; align-items: center;text-align: right;">
                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                        <input type="radio" name="jawaban1" value="e"> <strong>E</strong>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-10">
                                        <input type="text" name="e[]" class="form-control" value="" required="true">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-4 mt-2">
                                <div class="row" style="vertical-align: middle; align-items: center;text-align: right;">
                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                        <input type="radio" name="jawaban1" value="b"> <strong>B</strong>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-10">
                                        <input type="text" name="b[]" class="form-control" value="" required="true">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 mt-2">
                                <div class="row" style="vertical-align: middle; align-items: center;text-align: right;">
                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                        <input type="radio" name="jawaban1" value="d"> <strong>D</strong>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-10">
                                        <input type="text" name="d[]" class="form-control" value="" required="true">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 mt-2">
                                <div class="row" style="vertical-align: middle; align-items: center;">
                                    
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                <?php else: ?>
                    <?php $no = 0; $checked = 'checked="true"' ?>
                    <?php foreach ($soal_ujian_data as $key => $soal_ujian): ?>
                        <div class="form-group group-soal">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <label for="soal">Soal <span class="soal-counter" data-count="1"><?php echo ++$no ?></span></label>
                                            <button type="button" class="btn btn-sm btn-danger float-right" onclick="return subsoal(this)"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                                            <?php
                                            $img = NULL;
                                            $text = "Upload Gambar";
                                             if ($soal_ujian->gambar!=NULL) {
                                                $img = $soal_ujian->gambar;
                                                $text = "Ubah Gambar";
                                            } ?>
                                            <img src="<?php echo $soal_ujian->gambar ?>" style="max-width: 80%; max-height: 300px;">
                                            <input type="hidden" name="<?php echo 'filegambar'.$no ?>" value="<?php echo $soal_ujian->gambar ?>">
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                                            <input type="file" name="<?php echo 'file'.$no ?>" class="d-none" accept="image/*">
                                            <label class="btn btn-sm btn-primary form-control upload-clicker" style="cursor: pointer;"><i class="fa fa-image"></i>&nbsp;<?php echo $text ?></label>
                                        </div>
                                    </div>
                                    <textarea class="form-control soal-text" rows="3" name="soal[]" placeholder="Soal" required="true" ><?php echo $soal_ujian->soal ?></textarea>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 mt-2">
                                    <div class="row" style="vertical-align: middle; align-items: center;text-align: right;">
                                        <div class="col-lg-2 col-md-2 col-sm-2">
                                            <input type="radio" name="jawaban<?php echo $no ?>" value="a" <?php echo ($soal_ujian->jawaban=="a"?$checked:NULL) ?> > <strong>A</strong>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-10">
                                            <input type="text" name="a[]" class="form-control" value="<?php echo $soal_ujian->a ?>" required="true" placeholder="Pilihan A">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 mt-2">
                                    <div class="row" style="vertical-align: middle; align-items: center;text-align: right;">
                                        <div class="col-lg-2 col-md-2 col-sm-2">
                                            <input type="radio" name="jawaban<?php echo $no ?>" value="c" <?php echo ($soal_ujian->jawaban=="c"?$checked:NULL) ?> > <strong>C</strong>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-10">
                                            <input type="text" name="c[]" class="form-control" value="<?php echo $soal_ujian->c ?>" required="true" placeholder="Pilihan C">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 mt-2">
                                    <div class="row" style="vertical-align: middle; align-items: center;text-align: right;">
                                        <div class="col-lg-2 col-md-2 col-sm-2">
                                            <input type="radio" name="jawaban<?php echo $no ?>" value="e" <?php echo ($soal_ujian->jawaban=="e"?$checked:NULL) ?> > <strong>E</strong>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-10">
                                            <input type="text" name="e[]" class="form-control" value="<?php echo $soal_ujian->e ?>" required="true" placeholder="Pilihan E">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-4 mt-2">
                                    <div class="row" style="vertical-align: middle; align-items: center;text-align: right;">
                                        <div class="col-lg-2 col-md-2 col-sm-2">
                                            <input type="radio" name="jawaban<?php echo $no ?>" value="b" <?php echo ($soal_ujian->jawaban=="b"?$checked:NULL) ?> > <strong>B</strong>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-10">
                                            <input type="text" name="b[]" class="form-control" value="<?php echo $soal_ujian->b ?>" required="true" placeholder="Pilihan B">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 mt-2">
                                    <div class="row" style="vertical-align: middle; align-items: center;text-align: right;">
                                        <div class="col-lg-2 col-md-2 col-sm-2">
                                            <input type="radio" name="jawaban<?php echo $no ?>" value="d" <?php echo ($soal_ujian->jawaban=="d"?$checked:NULL) ?> > <strong>D</strong>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-10">
                                            <input type="text" name="d[]" class="form-control" value="<?php echo $soal_ujian->d ?>" required="true" placeholder="Pilihan D">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 mt-2">
                                    <div class="row" style="vertical-align: middle; align-items: center;">
                                        
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                    <?php endforeach ?>
                <?php endif ?>
            </div>                
           <input type="hidden" name="kode_soal" value="<?php echo $kode_soal; ?>" /> 
           <button type="button" class="btn btn-seccondary" onclick="window.history.go(-1)">Batalkan</button>
           <button type="submit" class="btn btn-primary float-right">Simpan</button>
        </form>