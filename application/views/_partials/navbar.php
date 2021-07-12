<div class="header-outs" id="header">
   <!--banner -->
   <div class="header-w3layouts" style="background-color: rgba(146, 148, 147, 0.64) !important;">
      <!--//navigation section -->
      <nav class="navbar navbar-expand-lg navbar-light">
         <div class="hedder-up">
            <?php $l = (base_url($this->db->where("lokasi", "logo")->get("perusahaan")->row()->deskripsi)) ?>
            <h1><a class="navbar-brand" href="index"><img src="<?php echo ($l) ?>" alt="" style="max-width: 90px;"></a></h1>
         </div>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav ">
               <li class="nav-item">
                  <a class="nav-link" href="Welcome">Beranda</a>
               </li>
               <li class="nav-item">
                  <a href="Welcome/help" class="nav-link ">Bantuan</a>
               </li>
               <li class="nav-item">
                  <a href="Welcome/contact" class="nav-link">Kontak</a>
               </li>
            </ul>
            <div class="both-butns">
               <ul>
                  <li>
                     <button type="button" class="register-hedder" data-toggle="modal" data-target="#exampleModalCenter2">
                        Daftar
                     </button>
                  </li>
                  <li>
                     <div class="contact-hedder">
                        <button type="button" class="btn login-hedder" data-toggle="modal" data-target="#exampleModalCenter">
                           Login
                        </button>
                     </div>
                  </li>
               </ul>
            </div>
         </div>
      </nav>
      <!--//navigation section -->
      <div class="clearfix"> </div>
   </div>
</div>