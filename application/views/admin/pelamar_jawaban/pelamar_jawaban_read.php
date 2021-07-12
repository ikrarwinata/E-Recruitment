    
    <?php
    $no=0;
    $checked = '<i class="far fa-circle nav-icon text-primary"></i>&nbsp;';
    $default = 'style="border: 1px green solid; border-radius: 25px"';
    $true = '<i class="fa fa-check-circle"></i>';
     foreach ($data_soal as $key => $soal): ?>
      <div class="row mt-5 mb-5" style="border: 1px solid black;border-radius: 8px">
        <div class="col-lg-1 col-md-1 col-sm-12 mt-2">
          <span class="badge badge-primary"><h3><?php echo ++$no ?></h3></span>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-12 mt-2 mt-2">
          <div class="row">
            <div class="col-lg-12">
              <?php echo $soal->soal ?>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-lg-4 col-md-4 col-sm-6 mt-2 btn-sm" <?php echo ($soal->jawaban=="a"?$default:NULL) ?>>
              <?php echo ($soal->terjawab=="a"?$checked:NULL) ?><?php echo $soal->a ?>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 mt-2 btn-sm" <?php echo ($soal->jawaban=="c"?$default:NULL) ?>>
              <?php echo ($soal->terjawab=="c"?$checked:NULL) ?><?php echo $soal->c ?>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 mt-2 btn-sm" <?php echo ($soal->jawaban=="e"?$default:NULL) ?>>
              <?php echo ($soal->terjawab=="e"?$checked:NULL) ?><?php echo $soal->e ?>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 mt-2 btn-sm" <?php echo ($soal->jawaban=="b"?$default:NULL) ?>>
              <?php echo ($soal->terjawab=="b"?$checked:NULL) ?><?php echo $soal->b ?>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 mt-2 btn-sm" <?php echo ($soal->jawaban=="d"?$default:NULL) ?>>
              <?php echo ($soal->terjawab=="d"?$checked:NULL) ?><?php echo $soal->d ?>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 mt-2">
              
            </div>
          </div>
        </div>
        <div class="col-lg-1 col-md-1 col-sm-12 mt-2 mb-2">
          <?php if ($soal->terjawab==$soal->jawaban): ?>
            <span class="badge badge-default">
              <h3>
                <i class="fa fa-check-circle text-success"></i>
              </h3>
            </span>
          <?php elseif($soal->terjawab!=NULL): ?>
            <span class="badge badge-default">
              <h3>
                <i class="fa fa-times-circle text-danger"></i>
              </h3>
            </span>
          <?php endif ?>
        </div>
      </div>
      <hr>
    <?php endforeach ?>