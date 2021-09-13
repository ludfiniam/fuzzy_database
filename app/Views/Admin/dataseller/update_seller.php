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
                            <h3 class="card-title">Update <?= $data_seller['full_name']; ?></h3>
                        </div>
                        <div class="col row justify-content-end">
                            <a href="/admin/detail_seller/<?= $data_seller['username']; ?>" type="button" class="btn"><span data-feather="arrow-left-circle"></span></a>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <form action="/admin/data_sellerupdate" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="full_name">Nama Seller</label>
                                <input type="hidden" id="id" name="id" value="<?= $data_seller['id']; ?>">
                                <input type="hidden" id="usernameasli" name="usernameasli" value="<?= $data_seller['username']; ?>">
                                <input type="hidden" name="image_profile_lama" value="<?= $data_seller['image_profile']; ?>">
                                <input type="hidden" id="emailasli" name="emailasli" value="<?= $data_seller['email']; ?>">
                                <input type="text" class="form-control" id="full_name" name="full_name" value="<?= $data_seller['full_name']; ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="username">Username</label>
                                <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" id="usernam" name="username" value="<?= $data_seller['username']; ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('username'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="telp">Nomer Telpon</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">+62</span>
                                    </div>
                                    <input type="tel" class="form-control" id="telp" name="telp" value="<?= $data_seller['telp'] ?>" placeholder="ex: 81212340987" pattern="[8]{1}[0-9]{9}|[8]{1}[0-9]{10}|[8]{1}[0-9]{11}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="email">Email</label>
                                <input type="mail" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?= $data_seller['email']; ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('email'); ?>
                                </div>
                            </div>
                            <div class="col-md-4 ">
                                <label for="password">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" value="<?= $data_seller['password']; ?>" id="password" name="password">
                                    <div class="input-group-append">
                                        <button onclick="showpassword()" class="btn btn-outline-secondary" type="button" id="buton_eye"><span data-feather="eye" id="show"></span></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-2">
                                <img src="/assets/image/profile/<?= ($data_seller['image_profile']) ? $data_seller['image_profile'] : 'default.jpg'; ?>" class="img-thumbnail img-preview">
                            </div>
                            <div class="col-10">
                                <label for="image_profile">Poto profile</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input <?= ($validation->hasError('image_profile')) ? 'is-invalid' : ''; ?>" id="image_profile" name="image_profile" onchange="previewImage()">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('image_profile'); ?>
                                    </div>
                                    <label class="custom-file-label" for="customFile"><?= ($data_seller['image_profile']) ? $data_seller['image_profile'] : 'default.jpg'; ?></label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="alamat">Alamat Seller</label>
                            <textarea type="text" class="form-control" name="alamat" id="alamat" rows="7"><?= $data_seller['address']; ?></textarea>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary" name="submit" value="submit" onclick="return confirm('Apakah anda yakin mengupdate data seller <?= $data_seller['full_name']; ?>?')">Update</button>
                        </div>
                    </form>
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

<script>
    function previewImage() {
        const image = document.querySelector('#image_profile');
        const imagelabel = document.querySelector('.custom-file-label');
        const imagepreview = document.querySelector('.img-preview');

        imagelabel.textContent = image.files[0].name;
        const fileimage = new FileReader();
        fileimage.readAsDataURL(image.files[0]);

        fileimage.onload = function(e) {
            imagepreview.src = e.target.result;
        }
    }
</script>

<?= $this->endSection(); ?>