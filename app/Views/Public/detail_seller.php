<?= $this->extend('Public/tamplate'); ?>
<?= $this->section('content_public'); ?>

<?php
function rupiah($angka)
{

    $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}
?>

<section id="standart" class="align-items-center">
    <div class="container" data-aos="fade-up">
        <div class="row mb-2 align-items-center justify-content-center">
            <p></p>
            <p></p>
            <h1 class="text-center">
                <img src="/assets/icon/store.png" class="rounded" width="23px"> Detail Toko
            </h1>
        </div>

        <div class="row">
            <div class="col-xs-3 col-md-3 mb-3 align-items-center justify-content-center text-center">
                <img src="/assets/image/profile/<?= $seller['image_profile'] != null ? $seller['image_profile'] : 'default.jpg'; ?>" class="img-fluid img-thumbnail" width="225">
            </div>
            <div class="col-xs-9 col-md-9 mb-3 align-items-center justify-content-center">
                <form class="form-floating mb-4">
                    <div type="text" class="form-control form-control-sm" id="nama_seller">
                        <h5>
                            <?= $seller['full_name']; ?>
                        </h5>
                    </div>
                    <label class="small" for="nama_seller">Nama Toko</label>
                </form>
                <form class="form-floating mb-4">
                    <div type="text" class="form-control form-control-sm" id="nama_seller">
                        <h6>
                            <?= $seller['address']; ?>
                        </h6>
                    </div>
                    <label class="small" for="nama_seller">Alamat</label>
                </form>
                <form class="form-floating mb-4">
                    <div type="text" class="form-control form-control-sm" id="nama_seller">
                        <h6>
                            <?= $seller['telp']; ?>
                        </h6>
                    </div>
                    <label class="small" for="nama_seller">Phone</label>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>List Smartphone</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3 d-flex justify-content-around">
                            <?php
                            $a = 0;
                            foreach ($smartphone as $phone) {
                                if ($a == 4) {
                            ?>
                        </div>
                        <div class="row mb-3 d-flex justify-content-around">
                        <?php
                                }
                        ?>
                        <div class="col-xs-3 col-md-3 mb-2">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col">
                                            <h5 class="text-center">
                                                <?= $phone['nama_smartphone']; ?>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="row mb-2 ">
                                        <div class="col">
                                            <div id="carouselExampleControls<?= $a; ?>" class="carousel slide text-center" data-bs-ride="carousel">
                                                <div class="carousel-inner">
                                                    <div class="carousel-item active">
                                                        <img src="/assets/image/smartphone/<?= ($phone['image1'] != null) ? $phone['image1'] : 'default.jpg'; ?>" class="img-thumbnail" alt="First slide">
                                                    </div>
                                                    <div class="carousel-item">
                                                        <img src="/assets/image/smartphone/<?= ($phone['image2'] != null) ? $phone['image2'] : 'default.jpg'; ?>" class="img-thumbnail" alt="Second slide">
                                                    </div>
                                                    <div class="carousel-item">
                                                        <img src="/assets/image/smartphone/<?= ($phone['image3'] != null) ? $phone['image3'] : 'default.jpg'; ?>" class="img-thumbnail" alt="Third slide">
                                                    </div>
                                                </div>
                                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls<?= $a; ?>" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls<?= $a; ?>" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Next</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col">
                                            <form class="form-floating">
                                                <div type="text" class="form-control form-control-sm" id="nama_seller">
                                                    <p class="text-center fs-6">
                                                        <?= rupiah($phone['harga']); ?>
                                                    </p>
                                                </div>
                                                <label class="small" for="nama_seller">Harga</label>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col">
                                            <form class="form-floating">
                                                <div type="text" class="form-control form-control-sm" id="nama_seller">
                                                    <p class="text-center fs-6">
                                                        <?= ($phone['ram']) . 'GB'; ?>
                                                    </p>
                                                </div>
                                                <label class="small" for="nama_seller">RAM</label>
                                            </form>
                                        </div>
                                        <div class="col">
                                            <form class="form-floating">
                                                <div type="text" class="form-control form-control-sm" id="nama_seller">
                                                    <p class="text-center fs-6">
                                                        <?= ($phone['internal_storage']) . 'GB'; ?>
                                                    </p>
                                                </div>
                                                <label class="small" for="nama_seller">Internal</label>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col text-center">
                                            <a href="/detail_smartphone/<?= $phone['slug']; ?>">
                                                <button type="button" class="btn btn-primary">Detail</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                                $a++;
                            }
                    ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

<?= $this->endSection(); ?>