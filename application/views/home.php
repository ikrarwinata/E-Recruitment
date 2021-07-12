      <?php
      $slider1 = $this->db->where("lokasi", "slider 1")->get("perusahaan")->row();
      $slider2 = $this->db->where("lokasi", "slider 2")->get("perusahaan")->row();
      $slider3 = $this->db->where("lokasi", "slider 3")->get("perusahaan")->row();
      ?>
      <div class="slider">
         <div class="callbacks_container">
            <ul class="rslides" id="slider4">
               <li>
                  <div class="slider-img one-img">
                     <div class="container">
                        <div class="slider-info ">
                           <div class="slider-sub">
                              <h6><?php echo ($slider1->judul) ?></h6>
                           </div>
                           <div class="bottom-info">
                              <p>
                                 <?php echo ($slider1->deskripsi) ?>
                              </p>
                           </div>
                        </div>
                     </div>
                  </div>
               </li>
               <li>
                  <div class="slider-img two-img">
                     <div class="container">
                        <div class="slider-info ">
                           <div class="slider-sub">
                              <h6><?php echo ($slider2->judul) ?></h6>
                           </div>
                           <div class="bottom-info">
                              <p>
                                 <?php echo ($slider2->deskripsi) ?>
                              </p>
                           </div>
                        </div>
                     </div>
                  </div>
               </li>
               <li>
                  <div class="slider-img three-img">
                     <div class="container">
                        <div class="slider-info">
                           <div class="slider-sub">
                              <h6><?php echo ($slider3->judul) ?></h6>
                           </div>
                           <div class="bottom-info">
                              <p>
                                 <?php echo ($slider3->deskripsi) ?>
                              </p>
                           </div>
                        </div>
                     </div>
                  </div>
               </li>
            </ul>
         </div>
         <!-- This is here just to demonstrate the callbacks -->
         <!-- <ul class="events">
            <li>Example 4 callback events</li>
            </ul>-->
         <div class="clearfix"></div>
      </div>
      <!-- //banner -->

      <!--service  -->
      <?php if (count($data_loker) >= 1) : ?>
         <section class="py-lg-4 py-md-3 py-sm-3 py-3" id="service">
            <div class="container py-lg-5 py-md-5 py-sm-4 py-3">
               <?php
               $no = 1;
               $defaultimg = "assets/images/gallery/ser3.png";
               $img = $defaultimg;
               foreach ($data_loker as $key => $value) : ?>
                  <?php
                  $img = $defaultimg;
                  if (isset($value->banner)) {
                     if ($value->banner != NULL) {
                        $img = $value->banner;
                     }
                  } ?>
                  <?php if (is_odd($no)) : ?>
                     <div class="row top-service pb-lg-4 pb-md-3 pb-2">
                        <div class="col-lg-8 col-md-8 service-wthree-info-left">
                           <a href="Welcome/berita/<?php echo $value->id ?>">
                              <h4 class="mb-lg-4 mb-3"><?php echo $value->judul ?></h4>
                           </a>
                           <small style="color: #b0b0b0"><?php echo date("d M Y", $value->timestamps) ?></small><br>
                           <?php echo str_shortened($value->deskripsi, 80, "...") ?>
                        </div>
                        <div class="col-lg-4 col-md-4 ser-service gap-service text-center">
                           <div class="service-icon-one">
                              <img src="<?php echo $img ?>" alt="" class="img-fluid">
                           </div>
                        </div>
                     </div>
                  <?php else : ?>
                     <div class=" my-lg-5 my-md-4 my-sm-4 my-3 row mid-service">
                        <div class="col-lg-4 col-md-4 ser-service  text-center">
                           <div class="service-icon-two move-right">
                              <img src="<?php echo $img ?>" alt="" class="img-fluid">
                           </div>
                        </div>
                        <div class="col-lg-8 col-md-8 service-wthree-info-left">
                           <a href="Welcome/berita/<?php echo $value->id ?>">
                              <h4 class="mb-lg-4 mb-3"><?php echo $value->judul ?></h4>
                           </a>
                           <small style="color: #b0b0b0"><?php echo date("d M Y", $value->timestamps) ?></small><br>
                           <?php echo str_shortened($value->deskripsi, 80, "...") ?>
                        </div>
                     </div>
                  <?php endif ?>
                  <hr>
                  <?php $no++; ?>
               <?php endforeach ?>

            </div>
         </section>
      <?php endif ?>
      <!--//service  -->