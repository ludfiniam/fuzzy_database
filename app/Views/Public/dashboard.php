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
          if ($a == 5) {
            $a = 1;
        ?>
      </div>
      <div class="row d-flex align-items-center justify-content-center">
      <?php
          }
      ?>
      <div class="col-lg-3 col-md-4 col-6 d-flex align-items-center justify-content-center">
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
            $a = 1;
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

  <!-- ======= Portfolio Section ======= -->
  <section id="portfolio" class="portfolio">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>Sample</h2>
        <p>Adapun beberapa sample data smartphone yang berada dalam database kita sebagai berikut : </p>
      </div>

      <div class="row">
        <div class="col-lg-12 d-flex justify-content-center">
          <ul id="portfolio-flters">
            <li data-filter="*" class="filter-active">All</li>
            <?php
            foreach ($merek as $brand) {
            ?>
              <li data-filter=".filter-<?= $brand['slug']; ?>"><?= $brand['nama_merek']; ?></li>
            <?php
            }
            ?>
          </ul>
        </div>
      </div>

      <div class="row portfolio-container">

        <?php
        foreach ($merek as $brand) {
          $a = 1;
          foreach ($sample as $ex) {
            if ($ex['merek'] == $brand['nama_merek']) {
        ?>
              <div class="col-lg-4 col-md-6 portfolio-item filter-<?= $brand['slug']; ?>">
                <div class="portfolio-wrap">
                  <img src="/assets/image/smartphone/<?= ($ex['image1'] != null) ? $ex['image1'] : 'default.jpg'; ?>" class="img-fluid" alt="">
                  <div class="portfolio-info">
                    <h4><?= $ex['nama_smartphone']; ?></h4>
                    <p><?= $ex['merek']; ?></p>
                    <div class="portfolio-links">
                      <a href="/assets/image/smartphone/<?= ($ex['image1'] != null) ? $ex['image1'] : 'default.jpg'; ?>" class="portfolio-lightbox" title="<?= $ex['slug'] . ' ' . $a; ?>"><i class="bx bx-plus"></i></a>
                      <a href="/detail_smartphone/<?= $ex['slug']; ?>" title="More Details"><i class="bx bx-link"></i></a>
                    </div>
                  </div>
                </div>
              </div>

        <?php
              $a++;
            }
            if ($a == 4) {
              break;
            }
          }
        }
        ?>

      </div>

    </div>
  </section><!-- End Portfolio Section -->

</main><!-- End #main -->

<?= $this->endSection(); ?>