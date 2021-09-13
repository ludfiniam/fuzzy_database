<?= $this->extend('User/tamplate'); ?>
<?= $this->section('content_user'); ?>

<?php function rupiah($angka)
{

    $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}
?>
<main role="main" class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h4>Profile</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-lg-12 col-md-12">
                            <img src="/assets/image/profile/<?= ($p_profile == null) ? 'default.jpg' : $p_profile; ?>" class="img-thumbnail">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-12 col-md-12">
                            <label>Nama</label>
                            <input type="text" class="form-control" value="<?= $full_name; ?>" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-12 col-md-12">
                            <label>Email</label>
                            <input type="text" class="form-control" value="<?= $email; ?>" disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-12 col-md-12">
                            <label for="username">Telepon</label>
                            <input type="text" class="form-control" value="+62<?= $phone; ?>" disabled>

                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-12 col-md-12">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" name="alamat" id="" rows="9" disabled><?= $address; ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-dark text-white"></div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="div-short mb-3">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <h4>Jumlah smartphone</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <ul class="list-group" id="mnr_keadaan">
                                    <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-secondary">
                                        <b class="text-black font-weight-bold">Menurut Merek</b>
                                    </li>
                                    <?php
                                    foreach ($merek as $key) {
                                    ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <?= $key['nama_merek']; ?>
                                            <span class="badge badge-primary badge-pill">
                                                <?php
                                                $i = 0;
                                                foreach ($count as $yek) {
                                                    if ($key['nama_merek'] == $yek['merek']) {
                                                        echo $yek['jumlah_smartphone'];
                                                        $i = 1;
                                                    }
                                                }
                                                if ($i == 0) {
                                                    echo "0";
                                                }
                                                ?>
                                            </span>
                                        </li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                            <div class="col-md-6 mb-3">
                                <ul class="list-group" id="mnr_keadaan">
                                    <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-secondary">
                                        <b class="text-black font-weight-bold">Menurut Signal</b>
                                    </li>
                                    <?php
                                    foreach ($network as $key) {
                                    ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <?= $key; ?>
                                            <span class="badge badge-primary badge-pill">
                                                <?php
                                                $i = 0;
                                                foreach ($count_network as $yek) {
                                                    if ($key == $yek['network']) {
                                                        echo $yek['jumlah_smartphone'];
                                                        $i = 1;
                                                    }
                                                }
                                                if ($i == 0) {
                                                    echo "0";
                                                }
                                                ?>
                                            </span>
                                        </li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="list-group" id="mnr_keadaan">
                                    <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-secondary">
                                        <b class="text-black font-weight-bold">Menurut Merek</b>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        Jumlah semua smartphone
                                        <span class="badge badge-primary badge-pill">
                                            <?= ($count_smartphon) ? $count_smartphon[0]['jumlah_smartphone'] : '0'; ?>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-info"></div>
                </div>
            </div>
            <div class="div-short">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Smartphone</h3>
                    </div>
                    <div class="card-body table-responsive">
                        <div class="container">
                            <div class="row">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table" data-toggle="table" data-height="460" data-pagination="true">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="align-center text-center"></th>
                                                <th scope="col" class="align-center text-center">Nama Smartphone</th>
                                                <th scope="col" class="align-center text-center">Merek</th>
                                                <th scope="col" class="align-center text-center">Tahun</th>
                                                <th scope="col" class="align-center text-center">Harga</th>
                                                <th scope="col" class="align-center text-center">Nama Saller</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $a = 1 + ($data_inpage * ($CURRENT - 1));
                                            foreach ($data_smartphone as $dm) { ?>
                                                <tr>
                                                    <th scope="row" class="text-center"><?= $a; ?></th>
                                                    <td class="align-center"><a class="font-weight-bold" href="/admin/detail_smartphone/<?= $dm['slug'] ?>"><?= $dm['nama_smartphone']; ?></a></td>
                                                    <td class="align-center text-center"><?= $dm['merek']; ?></td>
                                                    <td class="align-center text-center"><?= $dm['tahun']; ?></td>
                                                    <td class="align-center text-center"><?= rupiah($dm['harga']); ?></td>
                                                    <td class="align-center text-center"><?= $dm['nama_seller'] ?></td>
                                                </tr>
                                            <?php
                                                $a++;
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <?= $pager->links('t_smartphone', 'smartphone') ?>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
        </div>
    </div>
</main>

<?= $this->endSection(); ?>