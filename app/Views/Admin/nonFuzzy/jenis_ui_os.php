<?= $this->extend('Admin/tamplate'); ?>
<?= $this->section('content_admin'); ?>

<div class="container">
    <p></p>
    <div class="row md-2">
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
    <div class="row mb-3">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Tambahkan kriteria</h3>
                </div>
                <div class="card-body table-responsive">
                    <div class="row mb-3">
                        <div class="col-12">
                            <form action="/admin/add_ui_os" method="post">
                                <label for="tambahahkan">tambahkan jenis UI OS</label>
                                <input type="text" class="form-control" name="tambahkan" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <button class="btn btn-primary">tambahkan</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Jenis UI OS</h3>
                </div>
                <div class="col-12 card-body mt-2">
                    <form action="" method="POST">
                        <?= csrf_field(); ?>
                        <div class="row mt-2 justify-content-between">
                            <div class="col-5">
                                <?php if (session()->get('key_ui_os') == null) { ?>
                                    <!-- sebelum input search -->
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="key_ui_os" placeholder="Masukan pencarian...">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="submit" name="submit">Cari</button>
                                        </div>
                                    </div>
                                    <!--  -->
                                <?php } else { ?>
                                    <!-- sesudah search -->
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="key_ui_os" placeholder="<?= session()->get('key_ui_os'); ?>" disabled required>
                                        <div class="input-group-append">
                                            <a href="/admin/d_ui_os" class="btn btn-outline-danger" type="button"><span data-feather="delete"></span></a>
                                        </div>
                                    </div>
                                    <!--  -->
                                <?php } ?>
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
                                            <th scope="col" class="text-center align-center">Jenis UI OS</th>
                                            <th scope="col" class="text-center align-center text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $a = 1 + ($data_inpage * ($CURRENT - 1));
                                        foreach ($data_non_fuzzy as $dm) { ?>
                                            <tr>
                                                <th scope="row" class="align-center text-center"><?= $a; ?></th>
                                                <td class="text-center align-center">
                                                    <form action="/admin/update_ui_os" method="post">
                                                        <?= csrf_field(); ?>
                                                        <input type="hidden" name="id" value="<?= $dm['id']; ?>">
                                                        <input class="form-control form-control-sm text-center" type="text" name="nama_ui_os" id="nama_ui_os_<?= $a; ?>" value="<?= $dm['nama_ui_os']; ?>" disabled>
                                                        <input type="hidden" name="nama_ui_os_lama" value="<?= $dm['nama_ui_os']; ?>">
                                                </td>
                                                <td class="text-center align-center">
                                                    <div class="btn-group btn-group-toggle btn-grouo-sm" data-toggle="buttons" id="radio">
                                                        <label class="btn btn-outline-success btn-sm">
                                                            <input onclick="undisable(<?= $a; ?>)" type="radio" name="<?= 'ket_aktif' . $a; ?>" id="<?= 'ket_aktif' . $a; ?>" value="True">Edit
                                                        </label>
                                                        <label class="btn btn-outline-danger btn-sm">
                                                            <input onclick="disable(<?= $a; ?>)" type="radio" name="<?= 'ket_aktif' . $a; ?>" id="<?= 'ket_aktif' . $a; ?>" value="False" checked>Off
                                                        </label>
                                                    </div>
                                                    <button type="submit" name="submit" value="submit" id="submit_<?= $a; ?>" class="btn btn-primary btn-sm" disabled>update</button>
                                                    </form>
                                                    <form action="/admin/jenis_ui_os/<?= $dm['id']; ?>" method="POST" class="d-inline">
                                                        <?= csrf_field(); ?>
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="nama_ui_os_lama" value="<?= $dm['nama_ui_os']; ?>">
                                                        <input type="hidden" name="id" value="<?= $dm['id']; ?>">
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin menghapus UI OS <?= $dm['nama_ui_os']; ?>')">Delete</button>
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
                            <?= $pager->links('t_jenis_ui_os', 'smartphone') ?>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function disable(a) {
        document.getElementById('nama_ui_os_' + a).disabled = true;
        document.getElementById('submit_' + a).disabled = true;
    }

    function undisable(a) {
        document.getElementById('nama_ui_os_' + a).disabled = false;
        document.getElementById('submit_' + a).disabled = false;
    }
</script>

<?= $this->endSection(); ?>