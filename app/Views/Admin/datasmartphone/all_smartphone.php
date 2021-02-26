<?= $this->extend('Admin/tamplate'); ?>
<?= $this->section('content_admin'); ?>


<?php

function rupiah($angka)
{

    $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}
?>

<div class="conrtainer">
    <p></p>
    <div class="row mb-2">
        <?php if (session()->getFlashdata('msg')) : ?>
            <div class="col-12">
                <div class="alert alert-danger alert-dismissible fade show"><?= session()->getFlashdata('msg') ?>
                    <button type="button btn-sm" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('true')) : ?>
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show"><?= session()->getFlashdata('true') ?>
                    <button type="button btn-sm" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <div class="row mb-2">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Mobil</h3>
                </div>
                <div class="col-12 card-body mt-2">
                    <form action="" method="POST">
                        <div class="row mt-2 justify-content-between">
                            <div class="col-5">
                                <?php if (session()->get('key_smartphone') == null) { ?>
                                    <!-- sebelum input search -->
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="key_smartphone" placeholder="Masukan pencarian...">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="submit" name="submit">Cari</button>
                                        </div>
                                    </div>
                                    <!--  -->
                                <?php } else { ?>
                                    <!-- sesudah search -->
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="key_smartphone" placeholder="<?= session()->get('key_smartphone'); ?>" disabled>
                                        <div class="input-group-append">
                                            <a href="/admin/d_m" class="btn btn-outline-danger" type="button"><span data-feather="delete"></span></a>
                                        </div>
                                    </div>
                                    <!--  -->
                                <?php } ?>
                            </div>
                            <div class="col-2 offset-md-5 text-center">
                                <a href="/admin/insert_new_smartphone" class="btn btn-primary btn-sm"><span data-feather="plus-square"></span> Smartphone</a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body table-responsive">
                    <div class="container">
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table" data-toggle="table" data-height="460" data-pagination="true">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="align-center"></th>
                                            <th scope="col" class="align-center">Nama Smartphone</th>
                                            <th scope="col" class="align-center">Merek</th>
                                            <th scope="col" class="align-center">Tahun</th>
                                            <th scope="col" class="align-center">Harga</th>
                                            <th scope="col" class="align-center">Nama Saller</th>
                                            <th scope="col" class="align-center text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $a = 1 + ($data_inpage * ($CURRENT - 1));
                                        foreach ($data_smartphone as $dm) { ?>
                                            <tr>
                                                <th scope="row" class="text-center"><?= $a; ?></th>
                                                <td><a class="font-weight-bold" href="/admin/detail_smartphone/<?= $dm['slug'] ?>"><?= $dm['nama_smartphone']; ?></a></td>
                                                <td><?= $dm['merek']; ?></td>
                                                <td><?= $dm['tahun']; ?></td>
                                                <td><?= rupiah($dm['harga']); ?></td>
                                                <td><?= $dm['nama_seller'] ?></td>
                                                <td class="text-center">
                                                    <a type="button" class="btn btn-primary btn-sm" href="/admin/update_smartphone/<?= $dm['slug'] ?>">Update</a>
                                                    <form action="/admin/datasmartphone/<?= $dm['id']; ?>" method="POST" class="d-inline">
                                                        <?= csrf_field(); ?>
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="id" value="<?= $dm['id']; ?>">
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin menghapus data smartphone <?= $dm['nama_smartphone']; ?>?')">Delete</button>
                                                    </form>
                                                </td>
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
            </div>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>