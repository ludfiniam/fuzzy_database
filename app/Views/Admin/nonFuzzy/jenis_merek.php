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
                    <form action="/admin/add_merek" enctype="multipart/form-data" method="post">
                        <div class="row mb-3">
                            <div class="col-xs-2 col-md-2 mb-3">
                                <img src="/assets/image/merek/default.png" class="img-thumbnail img-preview-merek-insert">
                            </div>
                            <div class="col-xs-10 col-md-10">
                                <div class="short-div">
                                    <div class="row">
                                        <div class="col-xs-12 col-md-12 mb-3">
                                            <label for="tambahahkan">Tambahkan jenis merek</label>
                                            <input type="text" class="form-control" name="tambahkan" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-md-12 mb-3">
                                            <label for="image_merek_insert">Logo merek</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input <?= ($validation->hasError('image_merek_insert')) ? 'is-invalid' : ''; ?>" id="image_merek_insert" name="image_merek_insert" onchange="img_insert()">
                                                <div class="invalid-feedback">
                                                    <?= $validation->getError('image_merek_insert'); ?>
                                                </div>
                                                <label class="custom-file-label  label-merek_insert" for="customFile">Pilih photo</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center">
                                <button class="btn btn-primary">tambahkan</button>
                            </div>
                        </div>
                    </form>
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
                    <h3>Jenis Merek</h3>
                </div>
                <div class="col-12 card-body mt-2">
                    <form action="" method="POST">
                        <?= csrf_field(); ?>
                        <div class="row mt-2 justify-content-between">
                            <div class="col-5">
                                <?php if (session()->get('key_merek') == null) { ?>
                                    <!-- sebelum input search -->
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="key_merek" placeholder="Masukan pencarian...">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="submit" name="submit">Cari</button>
                                        </div>
                                    </div>
                                    <!--  -->
                                <?php } else { ?>
                                    <!-- sesudah search -->
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="key_merek" placeholder="<?= session()->get('key_merek'); ?>" disabled>
                                        <div class="input-group-append">
                                            <a href="/admin/d_merek" class="btn btn-outline-danger" type="button"><span data-feather="delete"></span></a>
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
                                <table class="table table-striped" id="table" data-toggle="table" data-height="460" data-pagination="true" width="600px">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="align-center" width="50px"></th>
                                            <th scope="col" class="align-center" width="225px"></th>
                                            <th scope="col" class="text-center align-center" width="150px">Jenis Merek</th>
                                            <th scope="col" class="text-center align-center text-center" width="175px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $a = 1 + ($data_inpage * ($CURRENT - 1));
                                        foreach ($data_non_fuzzy as $dm) { ?>
                                            <tr>
                                                <th scope="row" class="align-center text-center"><?= $a; ?></th>
                                                <form enctype="multipart/form-data" action="/admin/update_merek" method="post">
                                                    <?= csrf_field(); ?>
                                                    <td class="">
                                                        <div class="row">
                                                            <div class="col-xs-3 col-md-3 mb-3">
                                                                <img src="/assets/image/merek/<?= $dm['logo_img'] != null ? $dm['logo_img'] : 'default.png'; ?>" class="img-thumbnail img-preview-merek-update-<?= $a; ?>">
                                                            </div>
                                                            <div class="col-xs-9 col-md-9 mb-3">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input <?= ($validation->hasError('image_merek_update_' . $a)) ? 'is-invalid' : ''; ?>" id="image_merek_update_<?= $a; ?>" name="image_merek_update_<?= $a; ?>" onchange="img_update(<?= $a; ?>)" disabled>
                                                                    <div class="invalid-feedback">
                                                                        <?= $validation->getError('image_merek_update_' . $a); ?>
                                                                    </div>
                                                                    <label class="custom-file-label  label-merek_update_<?= $a; ?>" for="customFile">Pilih photo</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-center align-center">
                                                        <input type="hidden" name="id" value="<?= $dm['id']; ?>">
                                                        <input type="hidden" name="col" value="<?= $a; ?>">
                                                        <input type="hidden" name="laman" value="<?= $CURRENT; ?>">
                                                        <input type="hidden" name="img_lawas" value="<?= $dm['logo_img']; ?>">
                                                        <input class="form-control form-control-sm text-center" type="text" name="nama_merek" id="nama_merek_<?= $a; ?>" value="<?= $dm['nama_merek']; ?>" disabled required>
                                                        <input type="hidden" name="nama_merek_lama" value="<?= $dm['nama_merek']; ?>">
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
                                                <form action="/admin/jenis_merek/<?= $dm['id']; ?>" method="POST" class="d-inline">
                                                    <?= csrf_field(); ?>
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="nama_merek_lama" value="<?= $dm['nama_merek']; ?>">
                                                    <input type="hidden" name="img_lawas" value="<?= $dm['logo_img']; ?>">
                                                    <input type="hidden" name="id" value="<?= $dm['id']; ?>">
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin menghapus merek <?= $dm['nama_merek']; ?>')">Delete</button>
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
                            <?= $pager->links('t_jenis_merek', 'smartphone') ?>
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
        document.getElementById('image_merek_update_' + a).disabled = true;
        document.getElementById('nama_merek_' + a).disabled = true;
        document.getElementById('submit_' + a).disabled = true;
    }

    function undisable(a) {
        document.getElementById('image_merek_update_' + a).disabled = false;
        document.getElementById('nama_merek_' + a).disabled = false;
        document.getElementById('submit_' + a).disabled = false;
    }
</script>

<script>
    //------> Skirip Rubah tampilan image <-------//
    function img_insert() {
        const img = document.querySelector('#image_merek_insert');
        const labelimg = document.querySelector('.label-merek_insert');
        const img_preview = document.querySelector('.img-preview-merek-insert')
        labelimg.textContent = img.files[0].name;
        const imgfile = new FileReader();
        imgfile.readAsDataURL(img.files[0]);
        imgfile.onload = function(e) {
            img_preview.src = e.target.result;
        }
    }

    function img_update(a) {
        const img = document.querySelector('#image_merek_update_' + a);
        const labelimg = document.querySelector('.label-merek_update_' + a);
        const img_preview = document.querySelector('.img-preview-merek-update-' + a)
        labelimg.textContent = img.files[0].name;
        const imgfile = new FileReader();
        imgfile.readAsDataURL(img.files[0]);
        imgfile.onload = function(e) {
            img_preview.src = e.target.result;
        }
    }
</script>

<?= $this->endSection(); ?>