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
                    <form action="/admin/insert_newseller" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="full_name">Nama Seller</label>
                                <input type="hidden" name="hak_akses" value="2">
                                <input type="text" class="form-control" id="full_name" name="full_name" value="<?= old('full_name'); ?>" placeholder="Masukan nama dealer anda..." required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="username">Username</label>
                                <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" id="username" name="username" value="<?= old('username'); ?>" placeholder="Masukan username..." required>
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
                                    <input type="tel" class="form-control" id="telp" name="telp" value="<?= old('telp'); ?>" placeholder="ex: 81212340987" pattern="[8]{1}[0-9]{9}|[8]{1}[0-9]{10}|[8]{1}[0-9]{11}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="email">Email</label>
                                <input type="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?= old('email'); ?>" placeholder="ex: abc@mail.com" required>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('email'); ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="password">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" value="" id="password" name="password" placeholder="Masukan password" required>
                                    <div class="input-group-append">
                                        <button onclick="showpassword()" class="btn btn-outline-secondary" type="button" id="buton_eye"><span data-feather="eye" id="show"></span></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <img src="/assets/image/profile/default.jpg" class="img-thumbnail img-preview">
                            </div>
                            <div class="col-10">
                                <label for="image_profile">Poto profile</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input <?= ($validation->hasError('image_profile')) ? 'is-invalid' : ''; ?>" id="image_profile" name="image_profile" onchange="previewImage()">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('image_profile'); ?>
                                    </div>
                                    <label class="custom-file-label" for="customFile">Pilih photo</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="alamat">Alamat Seller</label>
                            <textarea type="text" class="form-control" name="alamat" id="alamat" rows="7" placeholder="Masukan Alamat..." required><?= old('alamat'); ?></textarea>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary" name="submit" value="submit">tambah seller</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- show password javascript -->
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
<!-- show image prifiew profile -->
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