<!--A Design by W3layouts
   Author: W3layout
   Author URL: http://w3layouts.com
   License: Creative Commons Attribution 3.0 Unported
   License URL: http://creativecommons.org/licenses/by/3.0/
   -->
<!DOCTYPE html>
<html lang="zxx">

<head>
   <title>PT Karunia Adi Sentosa Jambi</title>
   <base href="<?php echo base_url() ?>">
   <!--meta tags -->
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="keywords" content="PT Karunia Adi Sentosa Jambi, Penerimaan Karyawan" />
   <script>
      addEventListener("load", function() {
         setTimeout(hideURLbar, 0);
      }, false);

      function hideURLbar() {
         window.scrollTo(0, 1);
      }
   </script>
   <!--//meta tags ends here-->
   <!--booststrap-->
   <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">
   <!--//booststrap end-->
   <!-- font-awesome icons -->
   <link href="assets/css/font-awesome.css" rel="stylesheet">
   <!-- //font-awesome icons -->
   <!--stylesheets-->
   <link href="assets/css/style.css" rel='stylesheet' type='text/css' media="all">
   <!--//stylesheets-->
   <link href="assets/css/font1.css" rel="stylesheet">
   <link href="assets/css/font2.css" rel="stylesheet">
</head>

<body>
   <?php $this->load->view("_partials/navbar") ?>
   <!-- //Navigation -->
   <!-- Slideshow 4 -->
   <?php $this->load->view($content) ?>
   <!--//stats-->
   <!--footer-->
   <?php $this->load->view("_partials/footer") ?>
   <!--//footer-->
   <!--/Login-->
   <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
            <div class="modal-header text-center">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div class="login px-4 py-4 mx-auto mw-100">
                  <h5 class="text-center mb-4">Login</h5>
                  <div class="card text-center mb-4 d-none" id="logininfocard">
                     <div class="card-body">
                        <small class="text-primary" id="logininfoattr"><em><span id="logininfo"></span></em></small>
                     </div>
                  </div>
                  <div class="form-group">
                     <p class="mb-2">Username</p>
                     <input type="text" class="form-control" id="usernamefield" name="username" placeholder="" required="">
                  </div>
                  <div class="form-group">
                     <p class="mb-2">Password</p>
                     <input type="password" class="form-control" id="passwordfield" name="password" placeholder="" required="">
                  </div>
                  <div class="form-check mb-3">
                     <input type="checkbox" class="form-check-input" id="exampleCheck1">
                     <p class="form-check-p">Ingat saya</p>
                  </div>
                  <button type="button" class="btn submit" id="loginsubmit">Login</button>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!--//Login-->

   <!--/Register-->
   <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
            <div class="modal-header text-center">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <div class="login px-4 py-4 mx-auto mw-100">
                  <h5 class="text-center mb-4">Daftar</h5>
                  <?php if ($this->session->userdata("registerfailed") <> '') : ?>
                     <div class="card text-center mb-4" id="registerinfocard">
                        <div class="card-body">
                           <small class="text-danger" id="registerinfoattr"><em><span id="registerinfo"><?php echo $this->session->userdata("registerfailed") ?></span></em></small>
                        </div>
                     </div>
                  <?php endif ?>
                  <form action="Welcome/register" method="post">
                     <div class="form-group ">
                        <p class="mb-2">NIK</p>
                        <input type="text" class="form-control" name="nik" placeholder="NIK Anda" required="true">
                     </div>
                     <div class="form-group ">
                        <p class="mb-2">Password</p>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Buat password Anda" required="true" minlength="6" maxlength="22">
                     </div>
                     <div class="form-group">
                        <p class="mb-2">Nama Lengkap</p>
                        <input type="text" class="form-control" name="nama" placeholder="Nama Anda" required="true">
                     </div>
                     <div class="form-group">
                        <p class="mb-2">Formasi</p>
                        <?php $formasi_datas = $this->Pekerjaan_model->get_pekerjaan(); ?>
                        <select class="form-control" name="id_posisi">
                           <option value="">------------</option>
                           <?php foreach ($formasi_datas as $key => $formasi) : ?>
                              <option value="<?php echo $formasi->id ?>"><?php echo $formasi->posisi_jabatan ?></option>
                           <?php endforeach ?>
                        </select>
                     </div>
                     <div class="form-group">
                        <p class="mb-2">Status</p>
                        <select class="form-control" name="status">
                           <option value="Belum Menikah">Belum Menikah</option>
                           <option value="Sudah Menikah">Sudah Menikah</option>
                        </select>
                     </div>
                     <div class="form-group">
                        <p class="mb-2">Pekerjaan</p>
                        <input type="text" class="form-control" name="pekerjaan" placeholder="Pekerjaan anda saat ini" required="true">
                     </div>
                     <div class="form-group">
                        <div class="row">
                           <div class="col-lg-6 col-md-6 col-sm-6">
                              <p class="mb-2">Jenis Kelamin</p>
                              <div class="row">
                                 <div class="col-lg-6 col-md-6 col-sm-6">
                                    <input type="radio" name="jk" value="Pria">&nbsp;Pria
                                 </div>
                                 <div class="col-lg-6 col-md-6 col-sm-6">
                                    <input type="radio" name="jk" value="Wanita">&nbsp;Wanita
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-3 col-md-3 col-sm-3">
                              <p class="mb-2">Tinggi</p>
                              <input type="number" class="form-control" min="120" max="1000" name="tinggi_badan">
                           </div>
                           <div class="col-lg-3 col-md-3 col-sm-3">
                              <p class="mb-2">Berat</p>
                              <input type="number" class="form-control" min="20" max="120" name="berat_badan">
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <p class="mb-2">Email</p>
                        <input type="mail" class="form-control" name="email" placeholder="..........@gmail.com" required="true">
                     </div>
                     <div class="form-group">
                        <p class="mb-2">Telepon</p>
                        <input type="tel" class="form-control" name="hp" placeholder="08.........." required="true">
                     </div>
                     <div class="form-group">
                        <p class="mb-2">Alamat</p>
                        <textarea class="form-control" name="alamat" placeholder="Alamat anda saat ini"></textarea>
                     </div>
                     <button type="submit" class="btn submit float-right">Register</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!--//Register-->
   <!--js working-->
   <script src='assets/js/jquery-2.2.3.min.js'></script>
   <!--//js working-->
   <!--responsiveslides banner-->
   <script src="assets/js/responsiveslides.min.js"></script>
   <script>
      // You can also use "$(window).load(function() {"
      $(function() {
         // Slideshow 4
         $("#slider4").responsiveSlides({
            auto: true,
            pager: false,
            nav: true,
            speed: 900,
            namespace: "callbacks",
            before: function() {
               $('.events').append("<li>before event fired.</li>");
            },
            after: function() {
               $('.events').append("<li>after event fired.</li>");
            }
         });

         $("#loginsubmit").on("click", function() {
            var u = $("#usernamefield").val(),
               p = $("#passwordfield").val();
            $.post("Welcome/login_action", {
                  username: u,
                  password: p
               })
               .done(function(data) {
                  $("#logininfocard").removeClass("d-none");
                  $("#logininfo").text(data.text);
                  $("#logininfoattr").removeClass();
                  $("#logininfoattr").addClass(data.textattr);
                  if (data.state == "success") {
                     window.location = data.url
                  }
               });
         });
      });
   </script>
   <!--// responsiveslides banner-->
   <!--About OnScroll-Number-Increase-JavaScript -->
   <script src="assets/js/jquery.waypoints.min.js"></script>
   <script src="assets/js/jquery.countup.js"></script>
   <script>
      $('.counter').countUp();
   </script>
   <!-- //OnScroll-Number-Increase-JavaScript -->
   <!-- start-smoth-scrolling -->
   <script src="assets/js/move-top.js"></script>
   <script src="assets/js/easing.js"></script>
   <script>
      jQuery(document).ready(function($) {
         $(".scroll").click(function(event) {
            event.preventDefault();
            $('html,body').animate({
               scrollTop: $(this.hash).offset().top
            }, 900);
         });
      });
   </script>
   <!-- start-smoth-scrolling -->
   <!-- here stars scrolling icon -->
   <script>
      $(document).ready(function() {

         var defaults = {
            containerID: 'toTop', // fading element id
            containerHoverID: 'toTopHover', // fading element hover id
            scrollSpeed: 1100,
            easingType: 'linear'
         };


         $().UItoTop({
            easingType: 'easeOutQuart'
         });

      });
   </script>
   <!-- //here ends scrolling icon -->
   <!--bootstrap working-->
   <script src="assets/js/bootstrap.min.js"></script>
   <!-- //bootstrap working-->
</body>

</html>