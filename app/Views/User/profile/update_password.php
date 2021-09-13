<?= $this->extend('User/tamplate'); ?>
<?= $this->section('content_user'); ?>

<main role="main" class="container">
    <p></p>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-10">
                    <h3 class="card-title">Update password</h3>
                </div>
                <div class="col row justify-content-end">
                    <a href="/user/profile" type="button" class="btn"><span data-feather="arrow-left-circle"></span></a>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive">
            <div class="container">
                <form action="/user/function_updatepassword" method="POST">
                    <?= csrf_field(); ?>
                    <div class="row justify-content-center">
                        <div class="col-md-6 mb-3">
                            <label for="password1">Old Password</label>
                            <input type="password" class="form-control <?= (session()->getFlashdata('validation_lama')) ? 'is-invalid' : ''; ?>" id="password1" name="password1">
                            <div class="invalid-feedback">
                                <?= session()->getFlashdata('validation_lama'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-6 mb-3">
                            <label for="password2">New Password</label>
                            <input type="password" class="form-control <?= (session()->getFlashdata('validation_baru')) ? 'is-invalid' : ''; ?>" id="password2" name="password2">
                            <div class="invalid-feedback">
                                <?= session()->getFlashdata('validation_baru'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-6 mb-3">
                            <label for="password3">Verifikasi New Password</label>
                            <input type="password" class="form-control <?= (session()->getFlashdata('validation_baru')) ? 'is-invalid' : ''; ?>" id="password3" name="password3">
                            <div class="invalid-feedback">
                                <?= session()->getFlashdata('validation_baru'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-6 mb-3">
                            <button type="submit" name="submit" value="submit" class="btn btn-primary" onclick="return confirm('Apakah anda mengupdate password')">Perbarui Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?= $this->endSection(); ?>