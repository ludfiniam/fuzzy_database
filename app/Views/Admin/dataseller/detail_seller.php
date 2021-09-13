<?= $this->extend('Admin/tamplate'); ?>
<?= $this->section('content_admin'); ?>

<div class="conrtainer">
    <p></p>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header card-header-warning">
                    <div class="row">
                        <div class="col-10">
                            <h3 class="card-title">Detail data seller</h3>
                        </div>
                        <div class="col row justify-content-end">
                            <a href="/admin/data_seller" type="button" class="btn"><span data-feather="arrow-left-circle"></span></a>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <img src="/assets/image/profile/<?= ($data_account['image_profile'] != null) ? $data_account['image_profile'] : 'default.jpg'; ?>" class="img-thumbnail">
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                            <div class="short-div">
                                <label for="name">Nama Seller</label>
                                <input type="text" class="form-control" id="name" value="<?= $data_account['full_name']; ?>" disabled>
                            </div>
                            <div class="short-div">
                                <label for="name">Username</label>
                                <input type="text" class="form-control" id="name" value="<?= $data_account['username']; ?>" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-sm-4 mb-3">
                            <label for="telp">Nomer Telpon</label>
                            <input type="text" class="form-control" id="telp" name="telp" value="<?= $data_account['telp']; ?>" disabled>
                        </div>
                        <div class="col-sm-4 mb-3">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" value="<?= $data_account['email']; ?>" disabled>
                        </div>
                        <div class="col-sm-4 mb-3">
                            <label for="password">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" value="<?= $data_account['password']; ?>" id="password" name="password" disabled>
                                <div class="input-group-append">
                                    <button onclick="showpassword()" class="btn btn-outline-secondary" type="button" id="buton_eye"><span data-feather="eye" id="show"></span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="alamat">Alamat Seller</label>
                        <textarea type="text" class="form-control" name="alamat" id="alamat" rows="7" disabled><?= $data_account['address']; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <a type="button" data-toggle="tooltip" data-placement="left" title="<?= ($data_account['active_account'] == 'active') ? 'Non-aktifkan' : 'Aktifkan'; ?>" <?= ($data_account['active_account'] == 'active') ? 'class="btn btn-warning btn-sm"' : 'class="btn btn-success btn-sm"'; ?> class="btn btn-primary btn-sm" href="/admin/update_active_seller/<?= $data_account['username'] ?>" onclick="return confirm('Apakah anda yakin <?= ($data_account['active_account'] == 'active') ? 'menonaktifkan' : 'mengaktifkan'; ?> seller <?= $data_account['full_name']; ?> beserta data smartphonenya?')"><?= ($data_account['active_account'] == 'active') ? '<span data-feather="user-minus">' : '<span data-feather="user-check">'; ?></a>
                        <a type="button" class="btn btn-primary btn-sm" href="/admin/update_seller/<?= $data_account['username'] ?>">Update</a>
                        <form action="/admin/data_seller/<?= $data_account['id']; ?>" method="POST" class="d-inline">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="id" value="<?= $data_account['id']; ?>">
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin menghapus data seller <?= $data_account['full_name']; ?> beserta data smartphonenya?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">
    function showpassword() {
        var data = document.getElementById('password');
        if (data.type == 'password') {
            data.type = 'text';
        } else if (data.type == 'text') {
            data.type = 'password';
        }
    }
</script>

<?= $this->endSection(); ?>