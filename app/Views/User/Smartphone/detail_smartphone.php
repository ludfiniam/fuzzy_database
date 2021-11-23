<?= $this->extend('User/tamplate'); ?>
<?= $this->section('content_user'); ?>


<?php

function rupiah($angka)
{

    $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}
?>

<main role="main" class="container">
    <p></p>
    <div class="row mb-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row mb-2">
                        <div class="col-md-10">
                            <h3 class="card-title"><?= $smartphone['nama_smartphone']; ?></h3>
                        </div>
                        <div class="col row justify-content-end">
                            <a href="/user/data_smartphone" type="button" class="btn"><span data-feather="arrow-left-circle"></span></a>
                        </div>
                    </div>
                </div>
                <div class="card-body mt-2">
                    <div class="row mb-2">
                        <div class="col">
                            <div class="row mb-3">
                                <div class="col-md-3 d-flex align-items-center">
                                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <img class="d-block w-100" src="/assets/image/smartphone/<?= ($smartphone['image1'] != null) ? $smartphone['image1'] : 'default.jpg'; ?>?auto=yes&bg=777&fg=555&text=First slide" alt="First slide">
                                            </div>
                                            <div class="carousel-item">
                                                <img class="d-block w-100" src="/assets/image/smartphone/<?= ($smartphone['image2'] != null) ? $smartphone['image2'] : 'default.jpg'; ?>?auto=yes&bg=777&fg=555&text=First slide" alt="Second slide">
                                            </div>
                                            <div class="carousel-item">
                                                <img class="d-block w-100" src="/assets/image/smartphone/<?= ($smartphone['image3'] != null) ? $smartphone['image3'] : 'default.jpg'; ?>?auto=yes&bg=777&fg=555&text=First slide" alt="Third slide">
                                            </div>
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="short-div-mb2">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="nama_smartphone">Nama smartphone</label>
                                                    <input type="text" class="form-control" name="nama_smartphone" placeholder="Masukan nama smartphone..." value="<?= $smartphone['nama_smartphone']; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="merek">Merek smartphone</label>
                                                    <input class="form-control" type="text" name="merek" value="<?= $smartphone['merek']; ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="short-div-mb2">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="tahun">Tahun Smartphone</label>
                                                    <input class="form-control" type="text" name="tahun" value="<?= $smartphone['tahun']; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="ram">RAM</label>
                                                    <input class="form-control" type="text" name="ram" value="<?= ($smartphone['ram'] != 0.5) ? $smartphone['ram'] . ' GB' : '512 MB'; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="internal">Penyimpanan Internal</label>
                                                    <input class="form-control" type="text" name="internal" value="<?= $smartphone['internal_storage'] . ' GB'; ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="short-div-mb2">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="harga">Harga smartphone</label>
                                                    <input class="form-control" type="text" name="harga" value="<?= rupiah($smartphone['harga']); ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="network">Jaringan Smartphone</label>
                                        <input class="form-control" type="text" name="network" value="<?= $smartphone['network']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ui_os">UI OS smartphone</label>
                                        <input class="form-control" type="text" name="ui_os" value="<?= $smartphone['tipe_ui_os']; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="tebal">Tebal Smartphone</label>
                                    <div class="input-group mb-3">
                                        <input type="text" name="tebal" class="form-control" value="<?= $smartphone['tebal']; ?>" readonly>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">mm</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="berat">Berat Smartphone</label>
                                    <div class="input-group mb-3">
                                        <input type="text" name="berat" class="form-control" value="<?= $smartphone['berat']; ?>" readonly>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">grm</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="body">Bahan Body</label>
                                    <input class="form-control" type="text" name="body" value="<?= $smartphone['bahan_body']; ?>" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="resolusi_layar">Resolusi Layar</label>
                                    <div class="input-group mb-3">
                                        <input type="text" name="resolusi_layar" class="form-control" value="<?= $smartphone['resolution_layar']; ?>" readonly>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon3">inch</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="jenis_layar">Jenis Layar</label>
                                        <input class="form-control" type="text" name="jenis_layar" value="<?= $smartphone['jenis_layar']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="jenis_protect_layar">Jenis Proteksi Layar</label>
                                        <input class="form-control" type="text" name="jenis_protect_layar" value="<?= $smartphone['jenis_protect_layar']; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="main_camera_tipe">Jumlah kamera belakang</label>
                                        <input class="form-control" type="text" name="main_camera_tipe" value="<?= $smartphone['tipe_main_camera']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="resolusi_main_camera">Resolusi kamera belakang</label>
                                        <div class="input-group mb-3">
                                            <input type="text" name="resolusi_main_camera" class="form-control" value="<?= $smartphone['resolusi_main_camera']; ?>" readonly>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">MP</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="front_camera_tipe">Jumlah kamera depan</label>
                                        <input class="form-control" type="text" name="front_camera_tipe" value="<?= $smartphone['selfie_camera']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="resolusi_front_camera">Resolusi kamera depan</label>
                                        <div class="input-group mb-3">
                                            <input type="text" name="resolusi_front_camera" class="form-control" value="<?= $smartphone['resolusi_selfie_camera']; ?>" readonly>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">MP</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="jenis_chipset">Tipe Chipset Processor</label>
                                        <input class="form-control" type="text" name="jenis_chipset" value="<?= $smartphone['jenis_chipset']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nama_chipset">Seri Processor Lengkap</label>
                                        <input class="form-control" type="text" name="nama_chipset" value="<?= $smartphone['nama_chipset']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="clock_speed_cpu">Clock Speed CPU</label>
                                        <div class="input-group mb-3">
                                            <input type="text" name="clock_speed_cpu" class="form-control" value="<?= $smartphone['clock_speed_cpu']; ?>" readonly>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon3">GHz</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="core_cpu">jumlah core CPU</label>
                                        <input class="form-control" type="text" name="core_cpu" value="<?= $smartphone['jumlah_core'] . ' Core'; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="jenis_gpu">Tipe GPU</label>
                                        <input class="form-control" type="text" name="jenis_gpu" value="<?= $smartphone['jenis_gpu']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nama_gpu">Seri GPU</label>
                                        <input class="form-control" type="text" name="nama_gpu" value="<?= $smartphone['nama_lengkap_gpu']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="jml_sim">Jumlah SIM</label>
                                        <input class="form-control" type="text" name="jml_sim" value="<?= $smartphone['sim'] . ' SIM'; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="tipe_sim">Tipe SIM</label>
                                        <input class="form-control" type="text" name="tipe_sim" value="<?= $smartphone['tipe_sim']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="sim_stand">Sim stand-by all or One-hybrit</label>
                                        <input class="form-control" type="text" name="sim_stand" value="<?= $smartphone['sim_stand']; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="WLAN">WLAN</label>
                                        <input class="form-control" type="text" name="WLAN" value="<?= $smartphone['WLAN']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="bluetooth">Bluetooth</label>
                                        <input class="form-control" type="text" name="bluetooth" value="<?= $smartphone['bluetooth']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="infraret">Infrared</label>
                                        <input class="form-control" type="text" name="infraret" value="<?= $smartphone['infrared']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="radio">Radio</label>
                                        <input class="form-control" type="text" name="radio" value="<?= $smartphone['radio']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="fingerprint">Fingerprint sensor</label>
                                        <input class="form-control" type="text" name="fingerprint" value="<?= $smartphone['fingerprint']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="faceunlock">Face un lock sensor</label>
                                        <input class="form-control" type="text" name="faceunlock
                                            " value="<?= $smartphone['face_sensor']; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="tipe_usb">Tipe USB</label>
                                        <input class="form-control" type="text" name="tipe_usb" value="<?= $smartphone['usb_tipe']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="tipe_batrai">Jenis Batrai</label>
                                        <input class="form-control" type="text" name="tipe_batrai" value="<?= $smartphone['tipe_batrai']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="kapasitas_batrai">Kapasitas Batrai</label>
                                        <div class="input-group mb-3">
                                            <input type="text" name="kapasitas_batrai" class="form-control" value="<?= $smartphone['kapasitas_batrai']; ?>" readonly>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon3">mAh</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="tipe_carging">Dukungan Carging Batrai</label>
                                        <input class="form-control" type="text" name="tipe_carging" value="<?= $smartphone['tipe_charger']; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nfc">NFC Sensor</label>
                                        <input class="form-control" type="text" name="nfc" value="<?= $smartphone['nfc']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="antutu_score">Score Antutu</label>
                                        <input class="form-control" type="text" name="antutu_score" value="<?= $smartphone['test_antutu']; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3 justify-content-center">
                                <div class="col-5 text-center">
                                    <a href="/user/update_smartphone/<?= $smartphone['slug']; ?>" class="btn btn-primary">Update</a>
                                    <form action="/user/data_smartphone/<?= $smartphone['id']; ?>" method="POST" class="d-inline">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="id" value="<?= $smartphone['id']; ?>">
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin menghapus data smartphone <?= $smartphone['nama_smartphone']; ?>?')">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
    </div>
</main>


<?= $this->endSection(); ?>