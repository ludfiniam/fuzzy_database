<?= $this->extend('Admin/tamplate'); ?>
<?= $this->section('content_admin'); ?>

<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <p></p>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Profile</h3>
                </div>
                <div class="card-body table-responsive">
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <img src="/assets/image/profile/<?= ($profile['image_profile'] != null) ? $profile['image_profile'] : 'default.jpg'; ?>" class="img-thumbnail">
                        </div>
                        <div class="col-md-10">
                            <div class="short-div">
                                <div class="row">
                                    <div class="col">
                                        <label for="full_name">Nama Seller</label>
                                        <input type="text" class="form-control" id="full_name" name="full_name" value="<?= $profile['full_name']; ?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="short-div">
                                <div class="row">
                                    <div class="col">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" value="<?= $profile['username']; ?>" disabled>
                                    </div>
                                    <div class="col">
                                        <label for="telp">Nomer Telpon</label>
                                        <input type="text" class="form-control" id="telp" name="telp" value="<?= $profile['telp']; ?>" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" value="<?= $profile['email']; ?>" disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="password">Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" value="<?= $profile['password']; ?>" id="password" name="password" disabled>
                                <div class="input-group-append">
                                    <button onclick="showpassword()" class="btn btn-outline-secondary" type="button" id="buton_eye"><span data-feather="eye" id="show"></span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="alamat">Alamat Seller</label>
                        <textarea type="text" class="form-control" name="alamat" id="alamat" rows="7" disabled><?= $profile['address']; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <a href="/admin/update_profile" type="button" class="btn btn-primary">Update data diri</a>
                        <a href="/admin/update_password" type="button" class="btn btn-outline-primary">Update password</a>
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