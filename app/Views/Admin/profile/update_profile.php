<?= $this->extend('Admin/tamplate'); ?>
<?= $this->section('content_admin'); ?>

<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <p></p>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-10">
                            <h3 class="card-title">Data Profile</h3>
                        </div>
                        <div class="col row justify-content-end">
                            <a href="/admin/profile" type="button" class="btn"><span data-feather="arrow-left-circle"></span></a>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <form action="/admin/function_updateprofile" method="POST" enctype="multipart/form-data">
                        <?= csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="full_name">Nama Seller</label>
                                <input type="hidden" name="id" id="id" value="<?= $profile_lama['id']; ?>">
                                <input type="hidden" name="usernameasli" id="usernameasli" value="<?= $profile_lama['username']; ?>">
                                <input type="hidden" name="emailasli" id="emailasli" value="<?= $profile_lama['email']; ?>">
                                <input type="hidden" name="image_profile_lama" value="<?= $profile_lama['image_profile']; ?>">
                                <input type="text" class="form-control" id="full_name" name="full_name" value="<?= $profile_lama['full_name']; ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="username">Username</label>
                                <input type="mail" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?>" id="username" name="username" value="<?= $profile_lama['username']; ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('username'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="telp">Nomer Telpon</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">+62</span>
                                    </div>
                                    <input type="tel" class="form-control" id="telp" name="telp" value="<?= $profile_lama['telp'] ?>" placeholder="ex: 81212340987" pattern="[8]{1}[0-9]{9}|[8]{1}[0-9]{10}|[8]{1}[0-9]{11}" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email">Email</label>
                                <input type="mail" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?= $profile_lama['email']; ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('email'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-2">
                                <img src="/assets/image/profile/<?= ($profile_lama['image_profile'] != null) ? $profile_lama['image_profile'] : 'default.jpg'; ?>" class="img-thumbnail img-preview">
                            </div>
                            <div class="col-10">
                                <label for="image_profile">Poto profile</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input <?= ($validation->hasError('image_profile')) ? 'is-invalid' : ''; ?>" id="image_profile" name="image_profile" onchange="previewImage()">
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('image_profile'); ?>
                                    </div>
                                    <label class="custom-file-label" for="customFile"><?= ($profile_lama['image_profile'] != null) ? $profile_lama['image_profile'] : 'Pilih poto'; ?></label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="alamat">Alamat Seller</label>
                                <textarea type="text" class="form-control" name="alamat" id="alamat" rows="7"><?= $profile_lama['address']; ?></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <button class="btn btn-primary" type="submit" name="submit" value="submit" onclick="return confirm('Apakah anda yakin mengupdate data profile?')">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
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