<?= $this->extend('Admin/tamplate'); ?>
<?= $this->section('content_admin'); ?>


<div class="container-fluid">
    <p></p>
    <div class="row"></div>
    <?php
    // d($count_phoneSeller);
    // d($data_seller);
    ?>
    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="card text-black ">
                <div class="card-header bg-info text-white">
                    <h4 class="card-title font-weight-bolder">Jumlah Sales</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col">
                            <label for="jsa">Sales aktive</label>
                            <input type="text" class="form-control" value="<?= $activeSeller == null ? '0' : $AllSeller['jml']; ?> Seller" disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="jsa">Sales non-aktive</label>
                            <input type="text" class="form-control" value="<?= $NonactiveSeller == null ? '0' : $AllSeller['jml']; ?> Seller" disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="jsa">Semua Sales</label>
                            <input type="text" class="form-control" value="<?= $AllSeller == null ? '0' : $AllSeller['jml']; ?> Seller" disabled>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-info">
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card  ">
                <div class="card-header bg-secondary text-white">
                    <h4 class="card-title font-weight-bolder">Jumlah data Smartphone</h4>
                </div>
                <div class="card-body">
                    <?php
                    $col = 1;
                    $jmlPhone = 0;
                    ?>
                    <div class="row mb-3 d-flex justify-content-center">
                        <?php
                        foreach ($count_merek as $merek) {
                        ?>
                            <div class="col">
                                <label for="<?= $merek['merek']; ?>">
                                    <?= $merek['merek']; ?>
                                </label>
                                <input type="text" value="<?= $merek['jumlah_phone']; ?> Pcs" class="form-control" disabled>
                            </div>
                            <?php
                            $jmlPhone = $merek['jumlah_phone'] + $jmlPhone;
                            if ($col == 3) {
                            ?>
                    </div>
                    <div class="row mb-3 d-flex justify-content-center">
                <?php
                                $col = 0;
                            }
                            $col++;
                        }
                ?>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="">
                                Semua Smartphone
                            </label>
                            <input type="text" value="<?= $jmlPhone; ?> Pcs" class="form-control" disabled>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-secondary">
                </div>
            </div>
        </div>
    </div>
    <p></p>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-tittle">Data Sales</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="table-responsive">
                                <table class="table table-striped" data-toggle="table" data-pagination="true">
                                    <thead>
                                        <th></th>
                                        <th>Nama Lengkap</th>
                                        <th class="text-center">Status</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th class="text-center">Jumlah Smartphone</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $a = 1 + ($data_inpage * ($CURRENT - 1));
                                        foreach ($data_seller as $seller) {
                                        ?>
                                            <tr>
                                                <th scope="row" class="text-center"><?= $a; ?></th>
                                                <td><?= $seller['name_seller']; ?></td>
                                                <td class="text-center">
                                                    <?= $seller['active_account'] == 'active' ? '
                                                    <span class="badge bg-success text-light">' . $seller['active_account'] . '</span>
                                                    ' : '
                                                    <span class="badge bg-secondary text-light">' . $seller['active_account'] . '</span>
                                                    '; ?>
                                                </td>
                                                <td><?= $seller['username']; ?></td>
                                                <td><?= $seller['email']; ?></td>
                                                <td class="text-center">
                                                    <h5>
                                                        <span class="badge rounded-pill bg-info text-light"><?= $seller['jumlah_phone']; ?> <span data-feather="smartphone"></span></span>
                                                    </h5>
                                                </td>
                                            </tr>
                                        <?php
                                            $a++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <?= $pager->links('t_account', 'smartphone') ?>
                        </div>
                    </div>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>