<?= $this->extend('Admin/tamplate'); ?>
<?= $this->section('content_admin'); ?>


<div class="container-fluid">
    <p></p>
    <div class="row"></div>
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
                            <input type="text" class="form-control" value="0 Orang" disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="jsa">Sales non-aktive</label>
                            <input type="text" class="form-control" value="0 Orang" disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="jsa">Semua Sales</label>
                            <input type="text" class="form-control" value="0 Orang" disabled>
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
                    <div class="row mb-3">
                        <div class="col">
                            <label for="">
                                SAMSUNG
                            </label>
                            <input type="text" value="0 Pcs" class="form-control" disabled>
                        </div>
                        <div class="col">
                            <label for="">
                                XIOMI
                            </label>
                            <input type="text" value="0 Pcs" class="form-control" disabled>
                        </div>
                        <div class="col">
                            <label for="">
                                OPPO
                            </label>
                            <input type="text" value="0 Pcs" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="">
                                VIVO
                            </label>
                            <input type="text" value="0 Pcs" class="form-control" disabled>
                        </div>
                        <div class="col">
                            <label for="">
                                ASUZ
                            </label>
                            <input type="text" value="0 Pcs" class="form-control" disabled>
                        </div>
                        <div class="col">
                            <label for="">
                                Realme
                            </label>
                            <input type="text" value="0 Pcs" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="">
                                Semua Smartphone
                            </label>
                            <input type="text" value="0 Pcs" class="form-control" disabled>
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
                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <!-- <?//= $pager->links('seller', 'mobil_page'); ?> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>