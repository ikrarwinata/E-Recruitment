      
      <!-- banner -->
      <div class="inner_page-banner one-img">
      </div>
      <!--//banner -->
      <!-- short -->
      <div class="using-border py-3">
         <div class="inner_breadcrumb  ml-4">
            <ul class="short_ls">
               <li>
                  <a href="Welcome">Beranda</a>
                  <span>/ /</span>
               </li>
               <li>Pengumuman</li>
            </ul>
         </div>
      </div>
      <!-- //short-->
      <!--service  -->
      <section class="py-lg-4 py-md-3 py-sm-3 py-3" id="service">
         <div class="container py-lg-5 py-md-5 py-sm-4 py-3">
            <div class="row top-service pb-lg-4 pb-md-3 pb-2">
               <div class="col-lg-12 col-md-12 ser-service gap-service text-center">
                  <div class="service-icon-one">
                     <?php 
                     $defaultimg = "assets/images/gallery/ser3.png";
                     $img = $defaultimg;
                     if (isset($berita->banner)) {
                         if ($berita->banner!=NULL) {
                            $img = $berita->banner;
                         }
                      } ?>
                     <img src="<?php echo $img ?>" alt="" class="img-fluid">
                  </div>
               </div>
            </div>

            <div class=" my-lg-5 my-md-4 my-sm-4 my-3 row mid-service">
               <div class="col-lg-12 col-md-12 ser-service  text-center">
                  <div class="service-wthree-info-left">
                     <h4><?php echo $berita->judul ?></h4>
                  </div>
                  <div class="service-icon-two move-right">
                     <small style="color: #757575"><?php echo date("l, d M Y", $berita->timestamps) ?></small>
                  </div>
               </div>
            </div>

            <div class=" my-lg-5 my-md-4 my-sm-4 my-3 row mid-service">
               <div class="col-lg-12 col-md-12 ser-service text-center">
                  <div class="service-icon-two">
                     <?php echo $berita->deskripsi ?>
                  </div>
               </div>
            </div>

            <?php if ($berita->file_lampiran!=NULL): ?>
               <div class=" my-lg-5 my-md-4 my-sm-4 my-3 row mid-service">
                  <div class="col-lg-12 col-md-12 ser-service text-center">
                     <div class="service-icon-two">
                        <a href="<?php echo $berita->file_lampiran ?>" target="_blank" class="btn btn-md form-control"><i class="fa fa-file"></i>&nbsp;File Lampiran</a>
                     </div>
                  </div>
               </div>
            <?php endif ?>
            
         </div>
      </section>