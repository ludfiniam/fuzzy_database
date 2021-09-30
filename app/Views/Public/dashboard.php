<?= $this->extend('Public/tamplate'); ?>
<?= $this->section('content_public'); ?>
<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">

  <div class="container d-flex flex-column align-items-center justify-content-center" data-aos="fade-up">
    <p></p>
    <p></p>
    <p></p>
    <p></p>
    <p></p>
    <p></p>
    <h1>Temukan Smartphonemu</h1>
    <h2>Semua tentang yang kau butuhkan bukan tentang yang kau inginkan</h2>
    <a href="/search" class="btn-get-started scrollto">Get Started</a>
    <img src="/assets/dashboard/assets/img/phone_1.png" class="img-fluid hero-img" alt="" data-aos="zoom-in" data-aos-delay="150">
  </div>

</section><!-- End Hero -->

<main id="main">

  <!-- ======= About Section ======= -->
  <section id="about" class="about">
    <div class="container">

      <div class="row no-gutters">
        <div class="content col-xl-5 d-flex align-items-stretch" data-aos="fade-right">
          <div class="content">
            <h3>Sistem Pendukung Keputusan Pembelian Smartphone Dengan Menggunakan Fuzzy Database Tahani</h3>
            <p>
              Merupakan sistem pengolahan data yang dibuat dengan tujuan untuk menyajikan rekomendasi
              Smartphone yang sesuai dengan kriteria-kriteria yang diberikan oleh user dengan
              pemprosesan data menggunakan Fuzzy Database Tahani.
            </p>
          </div>
        </div>
        <div class="col-xl-7 d-flex align-items-stretch" data-aos="fade-left">
          <div class="icon-boxes d-flex flex-column justify-content-center">
            <div class="row">
              <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="100">
                <i class="bx bx-receipt"></i>
                <h4>Sistem Pendukung Keputusan</h4>
                <p>
                  Sistem pendukung keputusan(Decision Support Support) adalah sistem yang digunakan untuk dapat mengambil keputusan pada situasi semi terstruktur dan tidak terstruktur, dimana seseorang tidak mengetahui secara pasti bagaimana seharusnya sebuah keputusan dibuat. -Turban (2001)
                </p>
              </div>
              <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="200">
                <i class="bx bx-cube-alt"></i>
                <h4>Fuzzy Database Tahani</h4>
                <p>
                  Fuzzy database model Tahani merupakan salah satu metode yang dapat digunakan pada
                  proses pengambilan keputusan yang sebagian besar basis data standar diklasifikasikan
                  berdasarkan bagaimana data tersebut dipandang oleh user.
                </p>
              </div>
            </div>
          </div><!-- End .content-->
        </div>
      </div>

    </div>
  </section><!-- End About Section -->

  <!-- ======= Merek Section ======= -->
  <section id="mrk" class="clients">
    <div class="container" data-aos="zoom-in">

      <div class="section-title">
        <h2>Merek</h2>
        <p>Dalam perkembangannya, smartphone memiliki perkembangan yang sangat pesat yang bukan tanpa sebab
          yaitu dengan adanya brand-brand besar yang bersaing menciptakan trobosan-trobosan yang inovatif, adapun
          diantara merek besar yang smartphonenya kami sajikan pada sistem antara lain.</p>
      </div>

      <div class="row">
        <?php
        $a = 1;
        foreach ($merek as $brand) {
          if ($a == 7) {
            $a = 0;
        ?>
      </div>
      <div class="row d-flex align-items-center justify-content-center">
      <?php
          }
      ?>
      <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
        <a href="/search?merek=<?= $brand['slug']; ?>">
          <img src="/assets/image/merek/<?= $brand['logo_img']; ?>" class="img-fluid" alt="">
        </a>
      </div>
    <?php
          $a++;
        }
    ?>
      </div>

    </div>
  </section><!-- End Merek Section -->


  <!-- ======= Partner Section ======= -->
  <section id="partner" class="steps">
    <div class="container">
      <div class="section-title">
        <h2>Seller</h2>
        <p>Untuk memperkaya database kami membuka peluang bagi konter-konter untuk menawarkan produk jualanya untuk di tampilkan di website kami.</p>
      </div>
      <div class="row mb-3 d-flex align-items-center justify-content-center">
        <?php
        $a = 1;
        foreach ($seller as $toko) {
          if ($a == 5) {
            $a = 0;
        ?>
      </div>
      <div class="row mb-3 d-flex align-items-center justify-content-center">
      <?php
          }
      ?>
      <div class="col-lg-3 col-md-4 col-6 mb-3 d-flex align-items-center justify-content-center">
        <a href="/detail_seller/<?= $toko['slug']; ?>">
          <div class="card">
            <img src="/assets/image/profile/<?= $toko['image_profile']; ?>" class="card-img-top" alt="">
            <div class="card-body">
              <p class="card-text text-center text-dark"><?= $toko['full_name']; ?></p>
            </div>
          </div>
        </a>
      </div>
    <?php
          $a++;
        }
    ?>
      </div>
    </div>
  </section><!-- End Partner Section -->

  <!-- ======= Services Section ======= -->
  <section id="services" class="services">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>Services</h2>
        <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
      </div>

      <div class="row">
        <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="100">
          <div class="icon-box">
            <div class="icon"><i class="bx bxl-dribbble"></i></div>
            <h4 class="title"><a href="">Lorem Ipsum</a></h4>
            <p class="description">Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi</p>
          </div>
        </div>

        <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="200">
          <div class="icon-box">
            <div class="icon"><i class="bx bx-file"></i></div>
            <h4 class="title"><a href="">Sed ut perspiciatis</a></h4>
            <p class="description">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>
          </div>
        </div>

        <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="300">
          <div class="icon-box">
            <div class="icon"><i class="bx bx-tachometer"></i></div>
            <h4 class="title"><a href="">Magni Dolores</a></h4>
            <p class="description">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</p>
          </div>
        </div>

        <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="400">
          <div class="icon-box">
            <div class="icon"><i class="bx bx-layer"></i></div>
            <h4 class="title"><a href="">Nemo Enim</a></h4>
            <p class="description">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis</p>
          </div>
        </div>

      </div>

    </div>
  </section><!-- End Services Section -->

  <!-- ======= Portfolio Section ======= -->
  <section id="portfolio" class="portfolio">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>Portfolio</h2>
        <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
      </div>

      <div class="row">
        <div class="col-lg-12 d-flex justify-content-center">
          <ul id="portfolio-flters">
            <li data-filter="*" class="filter-active">All</li>
            <li data-filter=".filter-app">App</li>
            <li data-filter=".filter-card">Card</li>
            <li data-filter=".filter-web">Web</li>
          </ul>
        </div>
      </div>

      <div class="row portfolio-container">

        <div class="col-lg-4 col-md-6 portfolio-item filter-app">
          <div class="portfolio-wrap">
            <img src="/assets/dashboard/assets/img/portfolio/portfolio-1.jpg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>App 1</h4>
              <p>App</p>
              <div class="portfolio-links">
                <a href="/assets/dashboard/assets/img/portfolio/portfolio-1.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="App 1"><i class="bx bx-plus"></i></a>
                <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-web">
          <div class="portfolio-wrap">
            <img src="/assets/dashboard/assets/img/portfolio/portfolio-2.jpg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Web 3</h4>
              <p>Web</p>
              <div class="portfolio-links">
                <a href="/assets/dashboard/assets/img/portfolio/portfolio-2.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Web 3"><i class="bx bx-plus"></i></a>
                <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-app">
          <div class="portfolio-wrap">
            <img src="/assets/dashboard/assets/img/portfolio/portfolio-3.jpg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>App 2</h4>
              <p>App</p>
              <div class="portfolio-links">
                <a href="/assets/dashboard/assets/img/portfolio/portfolio-3.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="App 2"><i class="bx bx-plus"></i></a>
                <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-card">
          <div class="portfolio-wrap">
            <img src="/assets/dashboard/assets/img/portfolio/portfolio-4.jpg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Card 2</h4>
              <p>Card</p>
              <div class="portfolio-links">
                <a href="/assets/dashboard/assets/img/portfolio/portfolio-4.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Card 2"><i class="bx bx-plus"></i></a>
                <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-web">
          <div class="portfolio-wrap">
            <img src="/assets/dashboard/assets/img/portfolio/portfolio-5.jpg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Web 2</h4>
              <p>Web</p>
              <div class="portfolio-links">
                <a href="/assets/dashboard/assets/img/portfolio/portfolio-5.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Web 2"><i class="bx bx-plus"></i></a>
                <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-app">
          <div class="portfolio-wrap">
            <img src="/assets/dashboard/assets/img/portfolio/portfolio-6.jpg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>App 3</h4>
              <p>App</p>
              <div class="portfolio-links">
                <a href="/assets/dashboard/assets/img/portfolio/portfolio-6.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="App 3"><i class="bx bx-plus"></i></a>
                <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-card">
          <div class="portfolio-wrap">
            <img src="/assets/dashboard/assets/img/portfolio/portfolio-7.jpg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Card 1</h4>
              <p>Card</p>
              <div class="portfolio-links">
                <a href="/assets/dashboard/assets/img/portfolio/portfolio-7.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Card 1"><i class="bx bx-plus"></i></a>
                <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-card">
          <div class="portfolio-wrap">
            <img src="/assets/dashboard/assets/img/portfolio/portfolio-8.jpg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Card 3</h4>
              <p>Card</p>
              <div class="portfolio-links">
                <a href="/assets/dashboard/assets/img/portfolio/portfolio-8.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Card 3"><i class="bx bx-plus"></i></a>
                <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-web">
          <div class="portfolio-wrap">
            <img src="/assets/dashboard/assets/img/portfolio/portfolio-9.jpg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Web 3</h4>
              <p>Web</p>
              <div class="portfolio-links">
                <a href="/assets/dashboard/assets/img/portfolio/portfolio-9.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Web 3"><i class="bx bx-plus"></i></a>
                <a href="portfolio-details.html" title="More Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </section><!-- End Portfolio Section -->

  <!-- ======= Team Section ======= -->
  <section id="team" class="team">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>Team</h2>
        <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
      </div>

      <div class="row">

        <div class="col-xl-3 col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
          <div class="member">
            <img src="/assets/dashboard/assets/img/team/team-1.jpg" class="img-fluid" alt="">
            <div class="member-info">
              <div class="member-info-content">
                <h4>Walter White</h4>
                <span>Chief Executive Officer</span>
              </div>
              <div class="social">
                <a href=""><i class="bi bi-twitter"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
          <div class="member">
            <img src="/assets/dashboard/assets/img/team/team-2.jpg" class="img-fluid" alt="">
            <div class="member-info">
              <div class="member-info-content">
                <h4>Sarah Jhonson</h4>
                <span>Product Manager</span>
              </div>
              <div class="social">
                <a href=""><i class="bi bi-twitter"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
          <div class="member">
            <img src="/assets/dashboard/assets/img/team/team-3.jpg" class="img-fluid" alt="">
            <div class="member-info">
              <div class="member-info-content">
                <h4>William Anderson</h4>
                <span>CTO</span>
              </div>
              <div class="social">
                <a href=""><i class="bi bi-twitter"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-3 col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
          <div class="member">
            <img src="/assets/dashboard/assets/img/team/team-4.jpg" class="img-fluid" alt="">
            <div class="member-info">
              <div class="member-info-content">
                <h4>Amanda Jepson</h4>
                <span>Accountant</span>
              </div>
              <div class="social">
                <a href=""><i class="bi bi-twitter"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </section><!-- End Team Section -->

</main><!-- End #main -->

<?= $this->endSection(); ?>