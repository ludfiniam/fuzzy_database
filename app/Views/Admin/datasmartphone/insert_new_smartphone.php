<?= $this->extend('Admin/tamplate'); ?>
<?= $this->section('content_admin'); ?>


<div class="container">
    <div class="row mb-3">
        <div class="col-md-12">
            <p></p>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-10">
                            <h3 class="card-title">Update data smartphone</h3>
                        </div>
                        <div class="col row justify-content-end">
                            <a href="/admin/datasmartphone" type="button" class="btn"><span data-feather="arrow-left-circle"></span></a>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <div class="row mb-2">
                        <div class="col">
                            <form action="/admin/tambah_smartphone" method="POST" enctype="multipart/form-data">
                                <?= csrf_field(); ?>
                                <?php if (session()->getFlashdata('validate')) : ?>
                                    <div class="alert alert-danger alert-dismissible fade show"><?= session()->getFlashdata('validate') ?>
                                        <button type="button btn-sm" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php endif; ?>
                                <div class="row mb-3">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="nama_smartphone">Nama smartphone</label>
                                            <input type="text" class="form-control" name="nama_smartphone" placeholder="Masukan nama smartphone..." value="<?= old('nama_smartphone'); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="harga">Harga smartphone</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp.</span>
                                                </div>
                                                <input type="number" name="harga" class="form-control" placeholder="ex: 1250000" aria-describedby="basic-addon2" min="100000" max="100000000" required value="<?= old('harga') ?>">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon2">.00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="merek">Merek smartphone</label>
                                            <select class="form-control" name="merek">
                                                <?php foreach ($v_merek as $merek) { ?>
                                                    <option <?= (old('merek') == $merek['nama_merek']) ? 'selected' : '' ?> value="<?= $merek['nama_merek'] ?>"><?= $merek['nama_merek']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="ui_os">UI OS smartphone</label>
                                            <select class="form-control" name="ui_os">
                                                <?php foreach ($v_ui_os as $ui_os) { ?>
                                                    <option <?= (old('ui_os') == $ui_os['nama_ui_os']) ? 'selected' : '' ?> value="<?= $ui_os['nama_ui_os'] ?>"><?= $ui_os['nama_ui_os']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="ram">RAM</label>
                                            <select class="form-control" name="ram">
                                                <?php foreach ($v_ram as $ram) { ?>
                                                    <option <?= (old('ram') == $ram) ? 'selected' : '' ?> value="<?= $ram; ?>"><?= ($ram == 0.5) ? '512 MB' : $ram . ' GB'; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="internal">Penyimpanan Internal</label>
                                            <select class="form-control" name="internal">
                                                <?php foreach ($v_internal as $internal) { ?>
                                                    <option <?= (old('internal') == $internal) ? 'selected' : '' ?> value="<?= $internal ?>"><?= $internal . ' GB'; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="tahun">Tahun Smartphone</label>
                                            <select class="form-control" name="tahun">
                                                <?php for ($i = 2021; $i >= 2015; $i--) { ?>
                                                    <option <?= (old('tahun') == $i) ? 'selected' : '' ?> value="<?php echo $i ?>"><?php echo $i; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="network">Jaringan Smartphone</label>
                                            <select class="form-control" name="network">
                                                <?php foreach ($v_network as $network) { ?>
                                                    <option <?= (old('network') == $network) ? 'selected' : '' ?> value="<?= $network; ?>"><?= $network; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="tebal">Tebal Smartphone</label>
                                        <div class="input-group mb-3">
                                            <input type="number" step="0.01" name="tebal" class="form-control" placeholder="ex: 12.49" aria-describedby="basic-addon2" min="0.01" max="100.00" required value="<?= old('tebal'); ?>">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">mm</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="berat">Berat Smartphone</label>
                                        <div class="input-group mb-3">
                                            <input type="number" step="0.1" name="berat" class="form-control" placeholder="ex: 12.9" aria-describedby="basic-addon2" min="0.1" max="1000.0" required value="<?= old('berat'); ?>">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">grm</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="body">Bahan Body</label>
                                        <select class="form-control" name="body">
                                            <?php foreach ($v_body as $body) { ?>
                                                <option <?= (old('body') == $body['nama_bahan_body']) ? 'selected' : '' ?> value="<?= $body['nama_bahan_body']; ?>"><?= $body['nama_bahan_body']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="resolusi_layar">Resolusi Layar</label>
                                        <div class="input-group mb-3">
                                            <input type="number" step="0.01" name="resolusi_layar" class="form-control" placeholder="ex: 6.29" aria-describedby="basic-addon3" min="0.01" max="100.00" value="<?= old('resolusi_layar'); ?>" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon3">inch</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="jenis_layar">Jenis Layar</label>
                                            <select class="form-control" name="jenis_layar">
                                                <?php foreach ($v_jenis_layar as $jenis_layar) { ?>
                                                    <option <?= (old('jenis_layar') == $jenis_layar['nama_jenis_layar']) ? 'selected' : '' ?> value="<?= $jenis_layar['nama_jenis_layar']; ?>"><?= $jenis_layar['nama_jenis_layar']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="jenis_protect_layar">Jenis Proteksi Layar</label>
                                            <select class="form-control" name="jenis_protect_layar">
                                                <?php foreach ($v_protect_layar as $protect_layar) { ?>
                                                    <option <?= (old('jenis_protect_layar') == $protect_layar['nama_protect_layar']) ? 'selected' : '' ?> value="<?= $protect_layar['nama_protect_layar']; ?>"><?= $protect_layar['nama_protect_layar']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="main_camera_tipe">Jumlah kamera belakang</label>
                                            <select class="form-control" name="main_camera_tipe">
                                                <?php foreach ($v_main_camera_tipe as $main_camera_tipe) { ?>
                                                    <option <?= (old('main_camera_tipe') == $main_camera_tipe) ? 'selected' : '' ?> value="<?= $main_camera_tipe; ?>"><?= $main_camera_tipe; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="resolusi_main_camera">Resolusi kamera belakang</label>
                                            <div class="input-group mb-3">
                                                <input type="number" step="0.1" name="resolusi_main_camera" class="form-control" placeholder="VGA = 0.5" aria-describedby="basic-addon2" min="0.0" max="1000.0" value="<?= old('resolusi_main_camera'); ?>" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon2">MP</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="front_camera_tipe">Jumlah kamera depan</label>
                                            <select class="form-control" name="front_camera_tipe">
                                                <?php foreach ($v_front_camera_tipe as $front_camera_tipe) { ?>
                                                    <option <?= (old('front_camera_tipe') == $front_camera_tipe) ? 'selected' : '' ?> value="<?= $front_camera_tipe; ?>"><?= $front_camera_tipe; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="resolusi_front_camera">Resolusi kamera depan</label>
                                            <div class="input-group mb-3">
                                                <input type="number" step="0.1" name="resolusi_front_camera" class="form-control" placeholder="VGA = 0.5" aria-describedby="basic-addon2" min="0.0" max="1000.0" value="<?= old('resolusi_front_camera'); ?>" required>
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
                                            <select class="form-control" name="jenis_chipset">
                                                <?php foreach ($v_jenis_chipset as $jenis_chipset) { ?>
                                                    <option <?= (old('jenis_chipset') == $jenis_chipset['nama_chipset']) ? 'selected' : '' ?> value="<?= $jenis_chipset['nama_chipset']; ?>"><?= $jenis_chipset['nama_chipset']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nama_chipset">Seri Processor Lengkap</label>
                                            <input class="form-control" type="text" name="nama_chipset" placeholder="ex: Mediatek MT6580" value="<?= old('nama_chipset'); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="clock_speed_cpu">Clock Speed CPU</label>
                                            <div class="input-group mb-3">
                                                <input type="number" step="0.1" name="clock_speed_cpu" class="form-control" placeholder="ex: 1.2" aria-describedby="basic-addon3" min="0.1" max="100.00" value="<?= old('clock_speed_cpu'); ?>" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon3">GHz</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="core_cpu">jumlah core CPU</label>
                                            <select class="form-control" name="core_cpu">
                                                <?php foreach ($v_core_cpu as $core_cpu) { ?>
                                                    <option <?= (old('core_cpu') == $core_cpu) ? 'selected' : '' ?> value="<?= $core_cpu; ?>"><?= $core_cpu; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="jenis_gpu">Tipe GPU</label>
                                            <select class="form-control" name="jenis_gpu">
                                                <?php foreach ($v_jenis_gpu as $jenis_gpu) { ?>
                                                    <option <?= (old('jenis_gpu') == $jenis_gpu['nama_gpu']) ? 'selected' : '' ?> value="<?= $jenis_gpu['nama_gpu']; ?>"><?= $jenis_gpu['nama_gpu']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="nama_gpu">Seri GPU</label>
                                            <input class="form-control" type="text" name="nama_gpu" placeholder="ex : Adreno 660" value="<?= old('nama_gpu'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="jml_sim">Jumlah SIM</label>
                                            <select class="form-control" name="jml_sim">
                                                <?php foreach ($v_jml_sim as $jml_sim) { ?>
                                                    <option <?= (old('jml_sim') == $jml_sim) ? 'selected' : '' ?> value="<?= $jml_sim; ?>"><?= $jml_sim; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="tipe_sim">Tipe SIM</label>
                                            <select class="form-control" name="tipe_sim">
                                                <?php foreach ($v_tipe_sim as $tipe_sim) { ?>
                                                    <option <?= (old('tipe_sim') == $tipe_sim) ? 'selected' : '' ?> value="<?= $tipe_sim; ?>"><?= $tipe_sim; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="sim_stand">Sim stand-by all or Hybrit</label>
                                            <select class="form-control" name="sim_stand">
                                                <?php foreach ($v_sim_stand as $sim_stand) { ?>
                                                    <option <?= (old('sim_stand') == $sim_stand) ? 'selected' : '' ?> value="<?= $sim_stand; ?>"><?= $sim_stand; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="WLAN">WLAN</label>
                                            <select class="form-control" name="WLAN">
                                                <?php foreach ($v_WLAN as $WLAN) { ?>
                                                    <option <?= (old('WLAN') == $WLAN) ? 'selected' : '' ?> value="<?= $WLAN; ?>"><?= $WLAN; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="bluetooth">Bluetooth</label>
                                            <select class="form-control" name="bluetooth">
                                                <?php foreach ($v_bluetooth as $bluetooth) { ?>
                                                    <option <?= (old('bluetooth') == $bluetooth) ? 'selected' : '' ?> value="<?= $bluetooth; ?>"><?= $bluetooth; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="infraret">Infrared</label>
                                            <select class="form-control" name="infrared">
                                                <?php foreach ($v_infrared as $infrared) { ?>
                                                    <option <?= (old('infrared') == $infrared) ? 'selected' : '' ?> value="<?= $infrared; ?>"><?= $infrared; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="radio">Radio</label>
                                            <select class="form-control" name="radio">
                                                <?php foreach ($v_radio as $radio) { ?>
                                                    <option <?= (old('radio') == $radio) ? 'selected' : '' ?> value="<?= $radio; ?>"><?= $radio; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="fingerprint">Fingerprint sensor</label>
                                            <select class="form-control" name="fingerprint">
                                                <?php foreach ($v_fingerprint as $fingerprint) { ?>
                                                    <option <?= (old('fingerprint') == $fingerprint) ? 'selected' : '' ?> value="<?= $fingerprint; ?>"><?= $fingerprint; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="faceunlock">Face un lock sensor</label>
                                            <select class="form-control" name="faceunlock">
                                                <?php foreach ($v_faceunlock as $faceunlock) { ?>
                                                    <option <?= (old('faceunlock') == $faceunlock) ? 'selected' : '' ?> value="<?= $faceunlock; ?>"><?= $faceunlock; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="tipe_usb">Tipe USB</label>
                                            <select class="form-control" name="tipe_usb">
                                                <?php foreach ($v_tipe_usb as $tipe_usb) { ?>
                                                    <option <?= (old('tipe_usb') == $tipe_usb['nama_usb']) ? 'selected' : '' ?> value="<?= $tipe_usb['nama_usb']; ?>"><?= $tipe_usb['nama_usb']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="tipe_batrai">Jenis Batrai</label>
                                            <select class="form-control" name="tipe_batrai">
                                                <?php foreach ($v_tipe_batrai as $tipe_batrai) { ?>
                                                    <option <?= (old('tipe_batrai') == $tipe_batrai) ? 'selected' : '' ?> value="<?= $tipe_batrai; ?>"><?= $tipe_batrai; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="kapasitas_batrai">Kapasitas Batrai</label>
                                            <div class="input-group mb-3">
                                                <input type="number" step="1" name="kapasitas_batrai" class="form-control" placeholder="ex: 6000" aria-describedby="basic-addon3" min="1" max="99999" value="<?= old('kapasitas_batrai'); ?>" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon3">mAh</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="tipe_carging">Dukungan Carging Batrai</label>
                                            <select class="form-control" name="tipe_carging">
                                                <?php foreach ($v_tipe_carging as $tipe_carging) { ?>
                                                    <option <?= (old('tipe_carging') == $tipe_carging) ? 'selected' : '' ?> value="<?= $tipe_carging; ?>"><?= $tipe_carging; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nfc">NFC Sensor</label>
                                            <select class="form-control" name="nfc">
                                                <option <?= (old('nfc') == 'No') ? 'selected' : '' ?> value="No">No</option>
                                                <option <?= (old('nfc') == 'Yes') ? 'selected' : '' ?> value="Yes">Yes</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="antutu_score">Score Antutu</label>
                                            <input class="form-control" type="number" name="antutu_score" min="1" max="9999999" placeholder="ex: 167623" value="<?= old('antutu_score'); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-xs-2 col-md-2">
                                        <img src="/assets/image/smartphone/default.jpg" class="img-thumbnail img-preview-1">
                                    </div>
                                    <div class="col-xs-10 col-md-10">
                                        <label for="image_smartphone1">Foto utama smartphone</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input <?= ($validation->hasError('image_smartphone1')) ? 'is-invalid' : ''; ?>" id="image_smartphone1" name="image_smartphone1" onchange="img1()">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('image_smartphone1'); ?>
                                            </div>
                                            <label class="custom-file-label  label-1" for="customFile">Pilih photo</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-xs-2 col-md-1">
                                        <img src="/assets/image/smartphone/default.jpg" class="img-thumbnail img-preview-2">
                                    </div>
                                    <div class="col-xs-10 col-md-5">
                                        <label for="image_smartphone2">Image smartphone secondari</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input <?= ($validation->hasError('image_smartphone2')) ? 'is-invalid' : ''; ?>" id="image_smartphone2" name="image_smartphone2" onchange="img2()">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('image_smartphone2'); ?>
                                            </div>
                                            <label class="custom-file-label label-2" for="customFile">Pilih photo</label>
                                        </div>
                                    </div>
                                    <div class="col-xs-2 col-md-1">
                                        <img src="/assets/image/smartphone/default.jpg" class="img-thumbnail img-preview-3">
                                    </div>
                                    <div class="col-xs-10 col-md-5">
                                        <label for="image_smartphone3">Image smartphone secondari</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input <?= ($validation->hasError('image_smartphone3')) ? 'is-invalid' : ''; ?>" id="image_smartphone3" name="image_smartphone3" onchange="img3()">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('image_smartphone3'); ?>
                                            </div>
                                            <label class="custom-file-label label-3" for="customFile">Pilih photo</label>
                                            <input type="hidden" name="seller" value="<?= session()->get('name') ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3 d-flex justify-content-center">
                                    <div class="col d-flex justify-content-center">
                                        <button type="submit" name="submit" value="submit" class="btn btn-primary">Tambahkan data</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>
</div>



<!-- img 1 -->
<script>
    function img1() {
        const img = document.querySelector('#image_smartphone1');
        const labelimg = document.querySelector('.label-1');
        const img_preview = document.querySelector('.img-preview-1')
        labelimg.textContent = img.files[0].name;
        const imgfile = new FileReader();
        imgfile.readAsDataURL(img.files[0]);
        imgfile.onload = function(e) {
            img_preview.src = e.target.result;
        }
    }
</script>
<!-- img 2 -->
<script>
    function img2() {
        const img = document.querySelector('#image_smartphone2');
        const labelimg = document.querySelector('.label-2');
        const img_preview = document.querySelector('.img-preview-2')
        labelimg.textContent = img.files[0].name;
        const imgfile = new FileReader();
        imgfile.readAsDataURL(img.files[0]);
        imgfile.onload = function(e) {
            img_preview.src = e.target.result;
        }
    }
</script>
<!-- img 3 -->
<script>
    function img3() {
        const img = document.querySelector('#image_smartphone3');
        const labelimg = document.querySelector('.label-3');
        const img_preview = document.querySelector('.img-preview-3')
        labelimg.textContent = img.files[0].name;
        const imgfile = new FileReader();
        imgfile.readAsDataURL(img.files[0]);
        imgfile.onload = function(e) {
            img_preview.src = e.target.result;
        }
    }
</script>
<?= $this->endSection(); ?>