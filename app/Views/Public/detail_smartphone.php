<?= $this->extend('Public/tamplate'); ?>
<?= $this->section('content_public'); ?>
<?php
function rupiah($angka)
{

    $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}
function titik($angka)
{

    $hasil_rupiah = number_format($angka, 0, '', '.');
    return $hasil_rupiah;
}
?>
<!-- =============================== -->

<section id="standart" class="align-items-center">

    <div class="container" data-aos="fade-up">
        <div class="row mb-3 align-items-center justify-content-center">
            <p></p>
            <p></p>
            <h1 class="text-center"><?= $phone['nama_smartphone']; ?></h1>
            <h4 class="text-center"><a class="text-dark" href="/detail_seller/<?= $seller['slug']; ?>"><img src="/assets/icon/store.png" class="rounded" width="23px"> <?= $seller['full_name']; ?></a></h4>
            <h6 class="text-center">(<?= $seller['telp']; ?>)</h6>
            <?php //d($seller); 
            ?>
        </div>
        <div class="row">
            <div class="col-xs-3 col-md-3 mb-2">
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="/assets/image/smartphone/<?= ($phone['image1'] != null) ? $phone['image1'] : 'default.jpg'; ?>" class="d-block w-100" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img src="/assets/image/smartphone/<?= ($phone['image2'] != null) ? $phone['image2'] : 'default.jpg'; ?>" class="d-block w-100" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img src="/assets/image/smartphone/<?= ($phone['image3'] != null) ? $phone['image3'] : 'default.jpg'; ?>" class="d-block w-100" alt="Third slide">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-xs-9 col-md-9 mb-3">
                <div class="row mb-2">
                    <div class="col-xs-9 col-md-9">
                        <label for="nama_smartphone" class="form-label small">Nama Smartphone</label>
                        <div type="text" class="form-control" id="nama_smartphone">
                            <?= $phone['nama_smartphone']; ?>
                        </div>
                    </div>
                    <div class="col-xs-3 col-md-3">
                        <label for="tahun" class="form-label small">Tahun Rilis</label>
                        <div type="text" class="form-control" id="tahun">
                            <?= $phone['tahun']; ?>
                        </div>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-xs-12 col-md-12 mb-2">
                        <label for="harga" class="form-label small">Harga</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="/assets/icon/rupiah.png" class="rounded" width="20px">
                            </span>
                            <div type="text" class="form-control" id="harga">
                                <?= rupiah($phone['harga']); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-md-6 mb-2">
                        <label for="ram" class="form-label small">RAM</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="/assets/icon/ram.png" class="rounded" width="20px">
                            </span>
                            <div type="text" class="form-control form-control-sm" id="ram">
                                <?= $phone['ram'] . ' GB'; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-6 mb-2">
                        <label for="internal" class="form-label small">Internal</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="/assets/icon/floppy-disk.png" class="rounded" width="20px">
                            </span>
                            <div type="text" class="form-control form-control-sm" id="internal">
                                <?= ($phone['internal_storage'] . ' GB'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-md-6 mb-2">
                        <label for="jaringan" class="form-label small">Signal Support</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="/assets/icon/rss.png" class="rounded" width="20px">
                            </span>
                            <div type="text" class="form-control form-control-sm" id="jaringan">
                                <?= ($phone['network']); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-6 mb-2">
                        <label for="sim" class="form-label small">SIM Support</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="/assets/icon/sim.png" class="rounded" width="20px">
                            </span>
                            <div type="text" class="form-control form-control-sm" id="sim">
                                <?= ($phone['sim']) . '-' . $phone['tipe_sim'] . ' (' . $phone['sim_stand'] . ')'; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-3 col-md-3 mb-2">
                <div class="card mb-2">
                    <div class="card-header">
                        <h5 class="text-center"><img src="/assets/icon/mobile-phone.png" class="rounded" width="20px"> Body</h5>
                    </div>
                    <div class="card-body">
                        <label for="bahan_body" class="form-label small">Bahan Body</label>
                        <div type="text" class="form-control form-control-sm text-center mb-2" id="bahan_body">
                            <?= ($phone['bahan_body']); ?>
                        </div>
                        <label for="tebal" class="form-label small">Tebal</label>
                        <div class="input-group input-group-sm mb-2">
                            <div type="text" class="form-control form-control-sm text-center" id="tebal">
                                <?= ($phone['tebal']); ?>
                            </div>
                            <span class="input-group-text" id="basic-addon1">
                                mm
                            </span>
                        </div>
                        <label for="berat" class="form-label small">Berat</label>
                        <div class="input-group input-group-sm mb-2">
                            <div type="text" class="form-control form-control-sm text-center" id="berat">
                                <?= ($phone['berat']); ?>
                            </div>
                            <span class="input-group-text" id="basic-addon1">
                                g
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-3 col-md-3 mb-2">
                <div class="card mb-2">
                    <div class="card-header">
                        <h5 class="text-center"><img src="/assets/icon/resolusi_layar.png" class="rounded" width="20px"> Layar</h5>
                    </div>
                    <div class="card-body">
                        <label for="resolusi_layar" class="form-label small">Resolusi Layar</label>
                        <div class="input-group input-group-sm mb-2">
                            <div type="text" class="form-control form-control-sm text-center" id="resolusi_layar">
                                <?= ($phone['resolution_layar']); ?>
                            </div>
                            <span class="input-group-text" id="basic-addon1">
                                inch
                            </span>
                        </div>
                        <label for="jenis_layar" class="form-label small">Jenis Layar</label>
                        <div type="text" class="form-control form-control-sm text-center mb-2" id="jenis_layar">
                            <?= ($phone['jenis_layar']); ?>
                        </div>
                        <label for="protection_layar" class="form-label small">Proteksi Layar</label>
                        <div type="text" class="form-control form-control-sm text-center mb-2" id="protection_layar">
                            <?= ($phone['jenis_protect_layar']); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-3 col-md-3 mb-2">
                <div class="card mb-2">
                    <div class="card-header">
                        <h5 class="text-center"><img src="/assets/icon/cpu-tower.png" class="rounded" width="20px"> Chipset</h5>
                    </div>
                    <div class="card-body">
                        <label for="chipset" class="form-label small">Processor</label>
                        <div type="text" class="form-control form-control-sm text-center mb-2" id="chipset">
                            <?= ($phone['nama_chipset']) . ' - ' . $phone['jumlah_core'] . ' ' . $phone['clock_speed_cpu'] . 'GHz'; ?>
                        </div>
                        <label for="GPU" class="form-label small">GPU</label>
                        <div type="text" class="form-control form-control-sm text-center mb-2" id="GPU">
                            <?= $phone['jenis_gpu'] . ' - ' . ($phone['nama_lengkap_gpu']); ?>
                        </div>
                        <label for="OS" class="form-label small">Tipe UI OS</label>
                        <div type="text" class="form-control form-control-sm text-center mb-2" id="OS">
                            <?= $phone['tipe_ui_os']; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-3 col-md-3 mb-2">
                <div class="card mb-2">
                    <div class="card-header">
                        <h5 class="text-center"><img src="/assets/icon/camera.png" class="rounded" width="20px"> Kamera</h5>
                    </div>
                    <div class="card-body">
                        <label for="main_kamera" class="form-label small">Kamera Utama</label>
                        <div class="input-group input-group-sm mb-2">
                            <div type="text" class="form-control form-control-sm text-center" id="main_kamera">
                                <?= ($phone['tipe_main_camera'] . ' kamera - ' . $phone['resolusi_main_camera']); ?>
                            </div>
                            <span class="input-group-text" id="basic-addon1">
                                MP
                            </span>
                        </div>
                        <label for="selfie_camera" class="form-label small">Kamera Selfi</label>
                        <div class="input-group input-group-sm mb-2">
                            <div type="text" class="form-control form-control-sm text-center" id="selfie_camera">
                                <?= ($phone['selfie_camera'] . ' kamera - ' . $phone['resolusi_selfie_camera']); ?>
                            </div>
                            <span class="input-group-text" id="basic-addon1">
                                MP
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-3 col-md-3 mb-2">
                <div class="card mb-2">
                    <div class="card-header">
                        <h5 class="text-center"><img src="/assets/icon/bio-sensor.png" class="rounded" width="20px"> Jaringan Nirkabel</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-6">
                                <p class="text-center">WLAN</p>
                            </div>
                            <div class="col-6">
                                <div type="text" class="form-control form-control-sm text-center mb-2" id="wlan">
                                    <?= $phone['WLAN'] != "Yes" ? 'No <span class="text-danger" data-feather="x-circle"></span>' : 'Yes <span class="text-success" data-feather="check-circle"></span>' ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6">
                                <p class="text-center">Bluetooth</p>
                            </div>
                            <div class="col-6">
                                <div type="text" class="form-control form-control-sm text-center mb-2" id="wlan">
                                    <?= $phone['bluetooth'] != "Yes" ? 'No <span class="text-danger" data-feather="x-circle"></span>' : 'Yes <span class="text-success" data-feather="check-circle"></span>' ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6">
                                <p class="text-center">Radio</p>
                            </div>
                            <div class="col-6">
                                <div type="text" class="form-control form-control-sm text-center mb-2" id="wlan">
                                    <?= $phone['radio'] != "Yes" ? 'No <span class="text-danger" data-feather="x-circle"></span>' : 'Yes <span class="text-success" data-feather="check-circle"></span>' ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6">
                                <p class="text-center">Infrared</p>
                            </div>
                            <div class="col-6">
                                <div type="text" class="form-control form-control-sm text-center mb-2" id="wlan">
                                    <?= $phone['infrared'] != "Yes" ? 'No <span class="text-danger" data-feather="x-circle"></span>' : 'Yes <span class="text-success" data-feather="check-circle"></span>' ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-3 col-md-3 mb-2">
                <div class="card mb-2">
                    <div class="card-header">
                        <h5 class="text-center"><img src="/assets/icon/sensor.png" class="rounded" width="20px"> Sensor</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-6">
                                <p class="text-center">Fingerprint</p>
                            </div>
                            <div class="col-6">
                                <div type="text" class="form-control form-control-sm text-center mb-2" id="wlan">
                                    <?= $phone['fingerprint'] != "Yes" ? 'No <span class="text-danger" data-feather="x-circle"></span>' : 'Yes <span class="text-success" data-feather="check-circle"></span>' ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6">
                                <p class="text-center">Face Unlock</p>
                            </div>
                            <div class="col-6">
                                <div type="text" class="form-control form-control-sm text-center mb-2" id="wlan">
                                    <?= $phone['face_sensor'] != "Yes" ? 'No <span class="text-danger" data-feather="x-circle"></span>' : 'Yes <span class="text-success" data-feather="check-circle"></span>' ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-3 col-md-3 mb-2">
                <div class="card mb-2">
                    <div class="card-header">
                        <h5 class="text-center"><img src="/assets/icon/lighting.png" class="rounded" width="20px"> Batrai</h5>
                    </div>
                    <div class="card-body">
                        <label for="tipe_batrai" class="form-label small">Tipe Batrai</label>
                        <div type="text" class="form-control form-control-sm text-center mb-2" id="tipe_batrai">
                            <?= $phone['tipe_batrai']; ?>
                        </div>
                        <label for="batrai_kapasitas" class="form-label small">Kapasitas Batrai</label>
                        <div class="input-group input-group-sm mb-3">
                            <div type="text" class="form-control form-control-sm text-center" id="batrai_kapasitas">
                                <?= titik($phone['kapasitas_batrai']); ?>
                            </div>
                            <span class="input-group-text" id="basic-addon1">
                                mAh
                            </span>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6">
                                <p class="text-center">Fast carging</p>
                            </div>
                            <div class="col-6">
                                <div type="text" class="form-control form-control-sm text-center" id="wlan">
                                    <?= $phone['tipe_charger'] != "Fast carging" ? 'No <span class="text-danger" data-feather="x-circle"></span>' : 'Yes <span class="text-success" data-feather="check-circle"></span>' ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-3 col-md-3 mb-2">
                <div class="card mb-2">
                    <div class="card-header">
                        <h5 class="text-center"><span data-feather="trello"></span> Lainya</h5>
                    </div>
                    <div class="card-body">
                        <label for="tipe_usb" class="form-label small">Tipe USB</label>
                        <div type="text" class="form-control form-control-sm text-center mb-2" id="tipe_usb">
                            <?= $phone['usb_tipe']; ?>
                        </div>
                        <label for="antutu" class="form-label small">Antutu Score</label>
                        <div type="text" class="form-control form-control-sm text-center mb-2" id="antutu">
                            <?= titik($phone['test_antutu']); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

        </div>
    </div>

</section>
<!-- =============================== -->
<?= $this->endSection(); ?>