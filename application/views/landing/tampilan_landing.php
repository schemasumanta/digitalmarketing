<!DOCTYPE html>
<html lang="en">
<?php foreach ($landing['profil'] as $key) { ?>
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?php echo $key->nama_website; ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?php echo base_url().$key->logo_profile ?>" rel="icon">
    <link href="<?php echo base_url().$key->logo_profile ?>" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?php echo base_url() ?>assets_landing/vendor/aos/aos.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets_landing/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets_landing/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets_landing/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets_landing/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets_landing/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?php echo base_url() ?>assets_landing/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: BizLand - v3.7.0
  * Template URL: https://bootstrapmade.com/bizland-bootstrap-business-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center flashdatart" data-title="<?php echo $this->session->flashdata('title'); ?>" data-text="<?php echo $this->session->flashdata('text'); ?>" data-icon="<?php echo $this->session->flashdata('icon'); ?>">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="<?php echo base_url('landing') ?>"><img src="<?php echo base_url().$key->logo_profile ?>" style="margin-right: 20px"><?php echo $key->nama_website; ?></a></h1>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">About</a></li>
          <li><a class="nav-link scrollto" href="#services">Simulasi</a></li>
          <li><a class="nav-link scrollto " href="#portfolio">Galeri</a></li>
          <li><a class="nav-link scrollto" href="#team">Marketing</a></li>
          <li><a class="nav-link scrollto" href="#pricing">Produk</a></li>
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>

          <?php if ($this->session->login) {?>
            <li><button class="btn btn-primary btn-sm btn_member_area" style="width: 100%!important">Member Area</button></li>
            
          <?php  }else{ ?>
            <li><button class="btn btn-primary btn-sm btn_login_member" style="width: 100%!important">Login</button></li>
          <?php  } ?>

        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>

      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container" data-aos="zoom-out" data-aos-delay="100">
      <h1>Welcome to <span>BizLand</span></h1>
      <h2>We are team of talented designers making websites with Bootstrap</h2>
      <div class="d-flex">
        <a href="#about" class="btn-get-started scrollto">Get Started</a>
        <a href="https://www.youtube.com/watch?v=jDDaplaOz7Q" class="glightbox btn-watch-video"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
      </div>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Featured Services Section ======= -->
    <section id="featured-services" class="featured-services">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
              <div class="icon"><i class="bx bxl-dribbble"></i></div>
              <h4 class="title"><a href="">Lorem Ipsum</a></h4>
              <p class="description">Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
              <div class="icon"><i class="bx bx-file"></i></div>
              <h4 class="title"><a href="">Sed ut perspiciatis</a></h4>
              <p class="description">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
              <div class="icon"><i class="bx bx-tachometer"></i></div>
              <h4 class="title"><a href="">Magni Dolores</a></h4>
              <p class="description">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
              <div class="icon"><i class="bx bx-world"></i></div>
              <h4 class="title"><a href="">Nemo Enim</a></h4>
              <p class="description">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Featured Services Section -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>About</h2>
          <h3>Find Out More <span>About Us</span></h3>
          <p>Ut possimus qui ut temporibus culpa velit eveniet modi omnis est adipisci expedita at voluptas atque vitae autem.</p>
        </div>

        <div class="row">
          <div class="col-lg-6" data-aos="fade-right" data-aos-delay="100">
            <img src="<?php echo base_url() ?>assets_landing/img/about.jpg" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 content d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="100">
            <h3>Voluptatem dignissimos provident quasi corporis voluptates sit assumenda.</h3>
            <p class="fst-italic">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
              magna aliqua.
            </p>
            <ul>
              <li>
                <i class="bx bx-store-alt"></i>
                <div>
                  <h5>Ullamco laboris nisi ut aliquip consequat</h5>
                  <p>Magni facilis facilis repellendus cum excepturi quaerat praesentium libre trade</p>
                </div>
              </li>
              <li>
                <i class="bx bx-images"></i>
                <div>
                  <h5>Magnam soluta odio exercitationem reprehenderi</h5>
                  <p>Quo totam dolorum at pariatur aut distinctio dolorum laudantium illo direna pasata redi</p>
                </div>
              </li>
            </ul>
            <p>
              Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
              velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
              culpa qui officia deserunt mollit anim id est laborum
            </p>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->


    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
      <div class="container" data-aos="fade-up">

        <div class="row">

          <div class="col-lg-3 col-md-6">
            <div class="count-box">
              <i class="bi bi-emoji-smile"></i>
              <span data-purecounter-start="0" data-purecounter-end="<?php echo $landing['happy_client'] ?>" data-purecounter-duration="1" class="purecounter"></span>
              <p>Happy Clients</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
            <div class="count-box">
              <i class="bi bi-journal-richtext"></i>
              <span data-purecounter-start="0" data-purecounter-end="<?php echo $landing['projects'] ?>" data-purecounter-duration="1" class="purecounter"></span>
              <p>Projects</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
            <div class="count-box">
              <i class="bi bi-headset"></i>
              <span data-purecounter-start="0" data-purecounter-end="<?php echo $landing['visitor'] ?>" data-purecounter-duration="1" class="purecounter"></span>
              <p>Visitor</p>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
            <div class="count-box">
              <i class="bi bi-people"></i>
              <span data-purecounter-start="0" data-purecounter-end="<?php echo $landing['subscriber'] ?>" data-purecounter-duration="1" class="purecounter"></span>
              <p>Subscriber</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Counts Section -->

    <section id="clients" class="clients section-bg">
      <div class="container" data-aos="zoom-in">
        <div class="row">
          <?php foreach ($landing['clients'] as $cl): ?>
            
          <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
            <img src="<?php echo base_url().$cl->clients_logo ?>" class="img-fluid" alt="">
          </div>
          <?php endforeach ?>

        </div>

      </div>
    </section><!-- End Clients Section -->

   
    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials">
      <div class="container" data-aos="zoom-in">

        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">
            <?php foreach ($landing['testimoni'] as $tm): ?>
              
            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="<?php echo base_url().$tm->testimoni_foto ?>" class="testimonial-img" alt="">
                <h3><?php echo $tm->testimoni_nama; ?></h3>
                <h4><?php echo $tm->testimoni_jabatan; ?></h4>
                <p>
                  <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                <?php echo $tm->testimoni_isi; ?>
                  <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
              </div>

            <?php endforeach ?>

            </div>
          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section><!-- End Testimonials Section -->

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Galeri</h2>
          <h3>Check our <span>Gallery</span></h3>
        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul id="portfolio-flters">

              <li data-filter="*" class="filter-active">All</li>
              <?php foreach ($landing['kategori'] as $ktg): ?>
                <li data-filter=".filter-<?php echo $ktg->id_kategori  ?>"><?php echo $ktg->nama_kategori; ?></li>
              <?php endforeach ?>
            </ul>
          </div>
        </div>
        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
         <?php foreach ($landing['galeri'] as $gl): ?>
          <div class="col-lg-4 col-md-6 portfolio-item filter-<?php echo $gl->id_kategori  ?>">
            <img src="<?php echo base_url().$gl->gambar_foto ?>" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4><?php echo $gl->judul_foto; ?></h4>
              <p><?php echo $gl->deskripsi_foto; ?></p>
              <a href="<?php echo base_url().$gl->gambar_foto ?>" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="App 1"><i class="bx bx-plus"></i></a>

            </div>
          </div>
        <?php endforeach ?>



      </div>

    </div>
  </section><!-- End Portfolio Section -->
  <!-- ======= Team Section ======= -->
  <section id="team" class="team section-bg">
    <div class="container" data-aos="fade-up">
      <div class="section-title">
        <h2>MARKETING</h2>
        <h3>Tim Marketing <span>Kami</span></h3>
        <p>Marketing PT. BPR BKK Karangmalang (Perseroda) selalu melayani nasabah dengan segenap hati.</p>
      </div>
      <div class="row">
        <?php foreach ($landing['marketing'] as $mkt): ?>
          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="member" style="cursor: pointer;" onclick="buka_portofolio(<?php echo $mkt->id_user; ?>)">
              <div class="member-img">
                <img src="<?php echo base_url().$mkt->foto ?>" class="img-fluid" alt="">
                <div class="social">
                  <a href="<?php echo $mkt->twitter_portofolio ?>" target="_blank"><i class="bi bi-twitter"></i></a>
                  <a href="<?php echo $mkt->facebook_portofolio ?>" target="_blank"><i class="bi bi-facebook"></i></a>
                  <a href="<?php echo $mkt->instagram_portofolio ?>" target="_blank"><i class="bi bi-instagram"></i></a>
                  <a href="<?php echo $mkt->linkedin_portofolio ?>" target="_blank"><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4><?php echo $mkt->nama; ?></h4>
                <span>Kantor Cabang <?php echo $mkt->nama_cabang; ?> <?php if ($mkt->telepon_portofolio!="") {?>
                  | <?php echo $mkt->telepon_portofolio; } ?>
                </span>
              </div>
            </div>
          </div>
        <?php endforeach ?>
      </div>
    </div>
  </section><!-- End Team Section -->

  <!-- ======= Pricing Section ======= -->
  <section id="pricing" class="pricing">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>Produk</h2>
        <h3>Check our <span>Produk</span></h3>

      </div>

      <div class="row">
       <?php foreach ($landing['kategori'] as $ktg): ?>
        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
          <?php if (strtolower($ktg->nama_kategori)=="simpanan") { ?>
            <div class="box featured">

            <?php }else{ ?>
              <div class="box">
              <?php } ?>
              <h3><?php echo $ktg->nama_kategori; ?></h3>
              <ul>
                <li>Aida dere</li>
                <li>Nec feugiat nisl</li>
                <li>Nulla at volutpat dola</li>
                <li class="na">Pharetra massa</li>
                <li class="na">Massa ultricies mi</li>
              </ul>
              <div class="btn-wrap">
                <a href="#" class="btn-buy">Buy Now</a>
              </div>
            </div>
          </div>
        <?php endforeach ?>
      </div>

    </div>
  </section><!-- End Pricing Section -->

  <!-- ======= Contact Section ======= -->
  <section id="contact" class="contact">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>Contact</h2>
        <h3><span>Contact Us</span></h3>
      </div>

      <div class="row" data-aos="fade-up" data-aos-delay="100">
        <div class="col-lg-6">
          <div class="info-box mb-4">
            <i class="bx bx-map"></i>
            <h3>Our Address</h3>
            <p><?php echo $key->alamat_profile; ?></p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <div class="info-box  mb-4">
            <i class="bx bx-envelope"></i>
            <h3>Email Us</h3>
            <p><?php echo $key->email_profile; ?></p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <div class="info-box  mb-4">
            <i class="bx bx-phone-call"></i>
            <h3>Call Us</h3>
            <p><?php echo $key->telp_profile; ?></p>
          </div>
        </div>

      </div>

      <div class="row" data-aos="fade-up" data-aos-delay="100">

        <div class="col-lg-6 ">
          <iframe class="mb-4 mb-lg-0" src="<?php echo $key->map_profile ?>" frameborder="0" style="border:0; width: 100%; height: 384px;" allowfullscreen></iframe>
        </div>

        <div class="col-lg-6">
          <form action="forms/contact.php" method="post" role="form" class="php-email-form">
            <div class="row">
              <div class="col form-group">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
              </div>
              <div class="col form-group">
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
              </div>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
            </div>
            <div class="form-group">
              <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
            </div>
            <div class="my-3">
              <div class="loading">Loading</div>
              <div class="error-message"></div>
              <div class="sent-message">Your message has been sent. Thank you!</div>
            </div>
            <div class="text-center"><button type="submit">Send Message</button></div>
          </form>
        </div>

      </div>

    </div>
  </section>

</main>
<footer id="footer">

  <div class="footer-newsletter">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <h4>Join Our Newsletter</h4>
          <p>Berlangganan Untuk Mendapatkan Penawaran Terbaik</p>
          <form action="" method="post" id="form_langganan">
            <input type="email" name="email_langganan" id="email_langganan"><input type="submit" value="Subscribe" id="btn_langganan" class="btn-primary">
          </form>
        </div>

      </div>
      <small class="text-danger error-email text-left"></small>

    </div>
  </div>

  <div class="footer-top">
    <div class="container">
      <div class="row">

        <div class="col-lg-6 col-md-6 footer-contact">
          <h3><img src="<?php echo base_url().$key->logo_profile ?>" style="margin-right: 20px"><span><?php echo $key->nama_website; ?></span></h3>
          <p>
            <?php echo $key->alamat_profile; ?><br>
            <strong>Phone:</strong> <?php echo $key->telp_profile; ?><br>
            <strong>Email:</strong><?php echo $key->email_profile; ?><br>
          </p>
        </div>


        <div class="col-lg-6 col-md-6 footer-links">
          <h4>Our Social Networks</h4>
          <div class="social-links mt-3">
            <a href="<?php echo $key->twitter ?>" class="twitter"><i class="bx bxl-twitter"></i></a>
            <a href="<?php echo $key->facebook ?>" class="facebook"><i class="bx bxl-facebook"></i></a>
            <a href="<?php echo $key->instagram ?>" class="instagram"><i class="bx bxl-instagram"></i></a>
            <a href="<?php echo $key->youtube ?>" class="youtube"><i class="bx bxl-youtube"></i></a>
          </div>
        </div>

      </div>
    </div>
  </div>

  <div class="container py-4">
    <div class="copyright">
      &copy; Copyright <strong><span><?php echo $key->nama_website; ?></span></strong>. All Rights Reserved
    </div>

  </div>
</footer><!-- End Footer -->

<div id="preloader"></div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="<?php echo base_url() ?>assets_landing/js/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets_landing/vendor/purecounter/purecounter.js"></script>
<script src="<?php echo base_url() ?>assets_landing/vendor/aos/aos.js"></script>
<script src="<?php echo base_url() ?>assets_landing/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url() ?>assets_landing/vendor/glightbox/js/glightbox.min.js"></script>
<script src="<?php echo base_url() ?>assets_landing/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="<?php echo base_url() ?>assets_landing/vendor/swiper/swiper-bundle.min.js"></script>
<script src="<?php echo base_url() ?>assets_landing/vendor/waypoints/noframework.waypoints.js"></script>
<script src="<?php echo base_url() ?>assets_landing/vendor/php-email-form/validate.js"></script>
<script src="<?php echo base_url() ?>assets/js/sweetalert2.all.js"></script>

<!-- Template Main JS File -->
<script src="<?php echo base_url() ?>assets_landing/js/main.js"></script>
<script type="text/javascript">
  $(document).ready(function(){


   const notif = $('.flashdatart').data('title');
   if (notif) {
    Swal.fire({
      title:notif,
      text:$('.flashdatart').data('text'),
      icon:$('.flashdatart').data('icon'),
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.close(); 

      }
    });
  }


  $('.btn_member_area').on('click',function(){
    window.location.href='<?php echo base_url('dashboard') ?>';
  });
  $('.btn_login_member').on('click',function(){
    window.location.href='<?php echo base_url('login') ?>';
  });

  $('#btn_langganan').on('click',function(e){
    e.preventDefault();
    let email_langganan = $('#email_langganan').val();
    if (email_langganan=="") {
      $('#email_langganan').focus();
      $('.error-email').html('Email Kosong');
      return false;

    }else{
      let testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
      if (!testEmail.test(email_langganan))
      {
       $('#email_langganan').focus();
       $('.error-email').html('Silahkan Masukkan Email yang Valid');
       return false;

     }else{
      $.ajax({
        type : "POST",
        url  : "<?php echo base_url('landing/simpan')?>",
        dataType : "JSON",
        data : {'email_langganan':email_langganan},
        success: function(data){
          if (data==0) {
            $('.error-email').html('Subscribe Gagal');
          }else{
            $('#btn_langganan').val('Subscribed');
            $('#email_langganan').attr('disabled','disabled');
          }
        },
      });


    }

  }

});
})

  function buka_portofolio(id)
  {
    window.location.href="<?php echo base_url() ?>portofolio/portofolio_marketing/"+id
  }
</script>
</body>

<?php } ?>



</html>