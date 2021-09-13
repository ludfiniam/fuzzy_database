<?= $this->extend('Admin/tamplate'); ?>
<?= $this->section('content_admin'); ?>

<div class="conrtainer">
	<p></p>
	<div class="row mb-2">
		<?php if (session()->getFlashdata('user_not_fount')) : ?>
			<div class="col-12">
				<div class="alert alert-warning alert-dismissible fade show"><?= session()->getFlashdata('user_not_fount') ?>
					<button type="button btn-sm" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			</div>
		<?php endif; ?>
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
								<?php if (session()->get('key_seller') == null) { ?>
									<!-- sebelum input search -->
									<div class="input-group">
										<input type="text" class="form-control" name="key_seller" placeholder="Masukan pencarian...">
										<div class="input-group-append">
											<button class="btn btn-outline-secondary" type="submit" name="submit">Cari</button>
										</div>
									</div>
									<!--  -->
								<?php } else { ?>
									<!-- sesudah search -->
									<div class="input-group">
										<input type="text" class="form-control" name="key_seller" placeholder="<?= session()->get('key_seller'); ?>" disabled>
										<div class="input-group-append">
											<a href="/admin/d_s" class="btn btn-outline-danger" type="button"><span data-feather="delete"></span></a>
										</div>
									</div>
									<!--  -->
								<?php } ?>
							</div>
							<div class="col-2 offset-md-5 text-center">
								<a href="/admin/insert_new_user" class="btn btn-primary btn-sm"><span data-feather="plus-square"></span> Seller</a>
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
											<th scope="col" class="text-center align-center">Nama seller</th>
											<th scope="col" class="text-center align-center">Username</th>
											<th scope="col" class="text-center align-center">Email</th>
											<th scope="col" class="text-center align-center">Active account</th>
											<th scope="col" class="text-center align-center text-center">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$a = 1 + ($data_inpage * ($CURRENT - 1));
										foreach ($data_seller as $dm) { ?>
											<tr>
												<th scope="row" class="text-center"><?= $a; ?></th>
												<td class="text-center align-center"><a class="font-weight-bold" href="/admin/detail_seller/<?= $dm['username'] ?>"><?= $dm['full_name']; ?></a></td>
												<td class="text-center align-center"><?= $dm['username']; ?></td>
												<td class="text-center align-center"><?= $dm['email']; ?></td>
												<td class="text-center align-center"><span class="<?= ($dm['active_account'] == 'active') ? 'badge badge-success' : 'badge badge-danger'; ?>"><?= $dm['active_account'] ?></span></td>
												<td class="text-center align-center">
													<a type="button" data-toggle="tooltip" data-placement="left" title="<?= ($dm['active_account'] == 'active') ? 'Non-aktifkan' : 'Aktifkan'; ?>" <?= ($dm['active_account'] == 'active') ? 'class="btn btn-warning btn-sm"' : 'class="btn btn-success btn-sm"'; ?> class="btn btn-primary btn-sm" href="/admin/update_active_seller/<?= $dm['username'] ?>" onclick="return confirm('Apakah anda yakin <?= ($dm['active_account'] == 'active') ? 'menonaktifkan' : 'mengaktifkan'; ?> seller <?= $dm['full_name']; ?> beserta data smartphonenya?')"><?= ($dm['active_account'] == 'active') ? '<span data-feather="user-minus"></span>' : '<span data-feather="user-check"></span>'; ?></a>
													<a type="button" class="btn btn-primary btn-sm" href="/admin/update_seller/<?= $dm['username'] ?>">Update</a>
													<form action="/admin/data_seller/<?= $dm['id']; ?>" method="POST" class="d-inline">
														<?= csrf_field(); ?>
														<input type="hidden" name="_method" value="DELETE">
														<input type="hidden" name="id" value="<?= $dm['id']; ?>">
														<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin menghapus data seller <?= $dm['full_name']; ?> beserta data smartphonenya?')">Delete</button>
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
							<?= $pager->links('t_account', 'smartphone') ?>
						</div>
					</div>
				</div>
				<div class="card-footer"></div>
			</div>
		</div>
	</div>
</div>

<?= $this->endSection(); ?>