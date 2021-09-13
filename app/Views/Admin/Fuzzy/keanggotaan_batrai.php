<?= $this->extend('Admin/tamplate'); ?>
<?= $this->section('content_admin'); ?>
<div class="container">
    <p></p>
    <div class="card">
        <div class="card-header">
            <h3>Nilai Fungsi Keanggotaan ( Batrai )</h3>
        </div>
        <div class="card-body">
            <?php
            if (session()->get('validate') != null) {
            ?>
                <div class="mb-3">
                    <div class="alert alert-success alert-dismissible fade show"><?= session()->getFlashdata('validate') ?>
                        <button type="button btn-sm" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            <?php
            }
            ?>
            <form action="/admin/update_fk_batrai" method="post">
                <?php
                $key = 1;
                foreach ($fk_batrai as $batrai) {
                ?>
                    <div class="row">
                        <div class="col-sm-3 mb-3">
                            <input type="hidden" name="id<?= $key; ?>" value="<?= $batrai['id']; ?>">
                            <label for="<?= 'himpunan' . $key; ?>">Himpunan</label>
                            <input id="<?= 'himpunan' . $key; ?>" type="text" name="<?= 'himpunan' . $key; ?>" class="form-control" value="<?= (old('himpunan' . $key) == null) ? $batrai['ket_status'] : old('himpunan' . $key); ?>" <?= ($batrai['ket_aktif'] != 'true') ? 'disabled' : ''; ?> required>
                        </div>
                        <div class="col-sm-2 mb-3">
                            <label for="fungsi_keanggotaan<?= $key; ?>">Fungsi Keanggotaan</label>
                            <select class="custom-select" onchange="leaveChange(<?= $key; ?>)" name="<?= 'fungsi_keanggotaan' . $key; ?>" id="fungsi_keanggotaan<?= $key; ?>" <?= ($batrai['ket_aktif'] != 'true') ? 'disabled' : ''; ?>>
                                <?php
                                foreach ($fungsi_keanggotaan as $data) {
                                ?>
                                    <option value="<?= $data['id']; ?>" <?= ($batrai['kd_rules'] == $data['id']) ? "selected" : ""; ?>><?= $data['nama_rules']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-2 mb-3">
                            <label for="bb">Batas Bawah</label>
                            <div class="input-group mb-3">
                                <input id="<?= 'batas_bawah' . $key; ?>" type="number" name="<?= 'batas_bawah' . $key; ?>" class="form-control <?= (session()->getFlashdata('warning' . $key) != null || session()->getFlashdata('1warning' . $key) != null) ? 'is-invalid' : ''; ?>" value="<?= (old('batas_bawah' . $key) == null) ? $batrai['batas_bawah'] : old('batas_bawah' . $key); ?>" <?= ($batrai['ket_aktif'] != 'true') ? 'disabled' : ''; ?> min="0" max="99999">
                                <div class="invalid-feedback">
                                    <?= session()->getFlashdata('warning' . $key); ?>
                                    <?= session()->getFlashdata('1warning' . $key); ?>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">mAh</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2 mb-3">
                            <label for="bt">Batas Tengah</label>
                            <div class="input-group mb-3">
                                <input id="<?= 'batas_tengah' . $key; ?>" type="number" name="<?= 'batas_tengah' . $key; ?>" class="form-control <?= (session()->getFlashdata('1warning' . $key) != null) ? 'is-invalid' : ''; ?>" value="<?= (old('batas_tengah' . $key) == null) ? $batrai['batas_tengah'] : old('batas_tengah' . $key); ?>" <?= ($batrai['ket_aktif'] != 'true') ? 'disabled' : ''; ?> min="0" max="99999" <?= ($batrai['kd_rules'] == 6 || $batrai['kd_rules'] == 3) ?  '' : 'disabled'; ?>>
                                <div class="invalid-feedback">
                                    <?= session()->getFlashdata('1warning' . $key); ?>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">mAh</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2 mb-3">
                            <label for="ba">Batas Atas</label>
                            <div class="input-group mb-3">
                                <input id="<?= 'batas_atas' . $key; ?>" type="number" name="<?= 'batas_atas' . $key; ?>" class="form-control <?= (session()->getFlashdata('warning' . $key) != null || session()->getFlashdata('1warning' . $key) != null) ? 'is-invalid' : ''; ?>" value="<?= (old('batas_atas' . $key) == null) ? $batrai['batas_atas'] : old('batas_atas' . $key); ?>" <?= ($batrai['ket_aktif'] != 'true') ? 'disabled' : ''; ?> min="0" max="99999">
                                <div class="invalid-feedback">
                                    <?= session()->getFlashdata('warning' . $key); ?>
                                    <?= session()->getFlashdata('1warning' . $key); ?>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">mAh</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-1 mb-3">
                            <div class="row">
                                <div class="col">
                                    <label for="">status</label>
                                    <div class="btn-group btn-group-toggle btn-grouo-sm" data-toggle="buttons" id="radio">
                                        <label class="btn btn-outline-success btn-sm">
                                            <input onclick="undisable(<?= $key; ?>)" type="radio" name="<?= 'ket_aktif' . $key; ?>" id="<?= 'ket_aktif' . $key; ?>" value="true" <?= ($batrai['ket_aktif'] == 'true') ? 'checked' : ''; ?>>On
                                        </label>
                                        <label class="btn btn-outline-danger btn-sm">
                                            <input onclick="disable(<?= $key; ?>)" type="radio" name="<?= 'ket_aktif' . $key; ?>" id="<?= 'ket_aktif' . $key; ?>" value="false" <?= ($batrai['ket_aktif'] != 'true') ? 'checked' : ''; ?>>Off
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                    $key++;
                }
                ?>
                <div class="row mb-4">
                    <input type="hidden" name="row" value="<?= $key - 1; ?>">
                </div>
                <div class="row mb-3 justify-content-center">
                    <div class="col-4">
                        <button type="submit" name="submit" value="submit" class="btn btn-primary" onclick="return confirm('Apakah anda yakin mengupdate fungsi keanggotaan batrai smartphone?')">Perbarui fungsi keanggotaan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    function disable(a) {
        document.getElementById('himpunan' + a).disabled = true;
        document.getElementById('fungsi_keanggotaan' + a).disabled = true;
        document.getElementById('batas_bawah' + a).disabled = true;
        document.getElementById('batas_tengah' + a).disabled = true;
        document.getElementById('batas_atas' + a).disabled = true;
    }

    function undisable(a) {
        document.getElementById('himpunan' + a).disabled = false;
        document.getElementById('fungsi_keanggotaan' + a).disabled = false;
        document.getElementById('batas_bawah' + a).disabled = false;
        if (document.getElementById("fungsi_keanggotaan" + a).value == "3" || document.getElementById("fungsi_keanggotaan" + a).value == "6") {
            $('#batas_tengah' + a).prop("disabled", false);
        } else {
            $('#batas_tengah' + a).prop("disabled", true);
        }
        document.getElementById('batas_atas' + a).disabled = false;
    }

    function leaveChange(a) {
        if (document.getElementById("fungsi_keanggotaan" + a).value == "3" || document.getElementById("fungsi_keanggotaan" + a).value == "6") {
            $('#batas_tengah' + a).prop("disabled", false);
        } else {
            $('#batas_tengah' + a).prop("disabled", true);
        }
    }
</script>


<?= $this->endSection(); ?>