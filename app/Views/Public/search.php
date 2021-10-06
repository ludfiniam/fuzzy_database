<?= $this->extend('Public/tamplate'); ?>
<?= $this->section('content_public'); ?>
<?php
function rupiah($angka)
{

	$hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
	return $hasil_rupiah;
}
?>
<!-- =============================== -->
<p></p>
<p></p>
<p></p>
<p></p>
<section id="standart" class="align-items-center">
	<div class="container" data-aos="fade-up">
		<div class="row mb-3 align-items-center justify-content-center">
			<p></p>
			<p></p>
			<h1 class="text-center">Search Smartphone</h1>

		</div>
		<div class="row">
			<?php d(session()->get()) ?>
			<?php d($smartphone) ?>
			<div class="col-xs-2 col-md-2 mb-3">
				<div class="card">
					<div class="card-header">
						<h4 class=" d-flex align-items-center justify-content-center">Fiter</h4>
					</div>
					<div class="card-body table-responsive text-center">
						<form action="/search" method="post">
							<div class="row mb-2">
								<div class="col-12">
									<label for="merek">Merek</label>
									<select class="form-control text-center" name="merek" <?= session()->get('data_filter') == 'Yes' ? 'disabled' : ''; ?>>
										<option value="0">All</option>
										<?php foreach ($merek as $brand) {
										?>
											<option value="<?= $brand['slug']; ?>" <?= session()->get('fk_merek') == $brand['slug'] ? 'selected' : ''; ?>><?= $brand['nama_merek']; ?></option>
										<?php
										} ?>
									</select>
								</div>
							</div>
							<div class="row mb-2">
								<div class="col-12">
									<label for="harga">Harga</label>
									<select class="form-control text-center" name="harga" <?= session()->get('data_filter') == 'Yes' ? 'disabled' : ''; ?>>
										<option value="0">All</option>
										<?php foreach ($harga as $duit) {
											if ($duit['ket_aktif'] != 'false') {
										?>
												<option value="<?= $duit['id']; ?>" <?= session()->get('fk_harga') == $duit['id'] ? 'selected' : ''; ?>><?= $duit['ket_status']; ?></option>
										<?php
											}
										} ?>
									</select>
								</div>
							</div>
							<div class="row mb-2">
								<div class="col-12">
									<label for="ram">RAM</label>
									<select class="form-control text-center" name="ram" <?= session()->get('data_filter') == 'Yes' ? 'disabled' : ''; ?>>
										<option value="0">All</option>
										<?php foreach ($ram as $ram_hp) {
											if ($ram_hp['ket_aktif'] != 'false') {
										?>
												<option value="<?= $ram_hp['id']; ?>" <?= session()->get('fk_ram') == $ram_hp['id'] ? 'selected' : ''; ?>><?= $ram_hp['ket_status']; ?></option>
										<?php
											}
										} ?>
									</select>
								</div>
							</div>
							<div class="row mb-2">
								<div class="col-12">
									<label for="internal">Internal</label>
									<select class="form-control text-center" name="internal" <?= session()->get('data_filter') == 'Yes' ? 'disabled' : ''; ?>>
										<option value="0">All</option>
										<?php foreach ($internal as $penyimpanan) {
											if ($penyimpanan['ket_aktif'] != 'false') {
										?>
												<option value="<?= $penyimpanan['id']; ?>" <?= session()->get('fk_internal') == $penyimpanan['id'] ? 'selected' : ''; ?>><?= $penyimpanan['ket_status']; ?></option>
										<?php
											}
										} ?>
									</select>
								</div>
							</div>
							<div class="row mb-2">
								<div class="col-12">
									<label for="tahun">Tahun</label>
									<select class="form-control text-center" name="tahun" <?= session()->get('data_filter') == 'Yes' ? 'disabled' : ''; ?>>
										<option value="0">All</option>
										<?php foreach ($tahun as $keluaran) {
											if ($keluaran['ket_aktif'] != 'false') {
										?>
												<option value="<?= $keluaran['id']; ?>" <?= session()->get('fk_tahun') == $keluaran['id'] ? 'selected' : ''; ?>><?= $keluaran['ket_status']; ?></option>
										<?php
											}
										} ?>
									</select>
								</div>
							</div>
							<div class="row mb-2">
								<div class="col-12">
									<label for="ui_os">UI OS</label>
									<select class="form-control text-center" name="ui_os" <?= session()->get('data_filter') == 'Yes' ? 'disabled' : ''; ?>>
										<option value="0">All</option>
										<?php foreach ($ui_os as $UI) {
										?>
											<option value="<?= $UI['id']; ?>" <?= session()->get('fk_ui_os') == $UI['id'] ? 'selected' : ''; ?>><?= $UI['nama_ui_os']; ?></option>
										<?php
										} ?>
									</select>
								</div>
							</div>
							<div class="row mb-2">
								<div class="col-12">
									<label for="jns_processor">Processor</label>
									<select class="form-control text-center" name="jns_processor" <?= session()->get('data_filter') == 'Yes' ? 'disabled' : ''; ?>>
										<option value="0">All</option>
										<?php foreach ($processor as $cpu) {
										?>
											<option value="<?= $cpu['id']; ?>" <?= session()->get('fk_jns_processor') == $cpu['id'] ? 'selected' : ''; ?>><?= $cpu['nama_chipset']; ?></option>
										<?php
										} ?>
									</select>
								</div>
							</div>
							<div class="row mb-2">
								<div class="col-12">
									<label for="speed_processor">Speed Processor</label>
									<select class="form-control text-center" name="speed_processor" <?= session()->get('data_filter') == 'Yes' ? 'disabled' : ''; ?>>
										<option value="0">All</option>
										<?php foreach ($speedprocessor as $speedcpu) {
											if ($speedcpu['ket_aktif'] != 'false') {
										?>
												<option value="<?= $speedcpu['id']; ?>" <?= session()->get('fk_speed_processor') == $speedcpu['id'] ? 'selected' : ''; ?>><?= $speedcpu['ket_status']; ?></option>
										<?php
											}
										} ?>
									</select>
								</div>
							</div>
							<div class="row mb-2">
								<div class="col-12">
									<label for="jenis_gpu">Jenis GPU</label>
									<select class="form-control text-center" name="jenis_gpu" <?= session()->get('data_filter') == 'Yes' ? 'disabled' : ''; ?>>
										<option value="0">All</option>
										<?php foreach ($gpu as $grapic) {
										?>
											<option value="<?= $grapic['id']; ?>" <?= session()->get('fk_gpu') == $grapic['id'] ? 'selected' : ''; ?>><?= $grapic['nama_gpu']; ?></option>
										<?php
										} ?>
									</select>
								</div>
							</div>
							<div class="row mb-2">
								<div class="col-12">
									<label for="antutu">Skor Antutu</label>
									<select class="form-control text-center" name="antutu" <?= session()->get('data_filter') == 'Yes' ? 'disabled' : ''; ?>>
										<option value="0">All</option>
										<?php foreach ($antutu as $scoreantutu) {
											if ($scoreantutu['ket_aktif'] != 'false') {
										?>
												<option value="<?= $scoreantutu['id']; ?>" <?= session()->get('fk_antutu') == $scoreantutu['id'] ? 'selected' : ''; ?>><?= $scoreantutu['ket_status']; ?></option>
										<?php
											}
										} ?>
									</select>
								</div>
							</div>
							<div class="row mb-2">
								<div class="col-12">
									<label for="bahan_body">Bahan Body</label>
									<select class="form-control text-center" name="bahan_body" <?= session()->get('data_filter') == 'Yes' ? 'disabled' : ''; ?>>
										<option value="0">All</option>
										<?php foreach ($body as $material) {
										?>
											<option value="<?= $material['id']; ?>" <?= session()->get('fk_bahan_body') == $material['id'] ? 'selected' : ''; ?>><?= $material['nama_bahan_body']; ?></option>
										<?php
										} ?>
									</select>
								</div>
							</div>
							<div class="row mb-2">
								<div class="col-12">
									<label for="resolusi_layar">Lebar Layar</label>
									<select class="form-control text-center" name="resolusi_layar" <?= session()->get('data_filter') == 'Yes' ? 'disabled' : ''; ?>>
										<option value="0">All</option>
										<?php foreach ($lebar_layar as $layar_hp) {
											if ($layar_hp['ket_aktif'] != 'false') {
										?>
												<option value="<?= $layar_hp['id']; ?>" <?= session()->get('fk_resolusi_layar') == $layar_hp['id'] ? 'selected' : ''; ?>><?= $layar_hp['ket_status']; ?></option>
										<?php
											}
										} ?>
									</select>
								</div>
							</div>
							<div class="row mb-2">
								<div class="col-12">
									<label for="tipe_layar">Tipe Layar</label>
									<select class="form-control text-center" name="tipe_layar" <?= session()->get('data_filter') == 'Yes' ? 'disabled' : ''; ?>>
										<option value="0">All</option>
										<?php foreach ($tipe_layar as $jenis_layar) {
										?>
											<option value="<?= $jenis_layar['id']; ?>" <?= session()->get('fk_tipe_layar') == $jenis_layar['id'] ? 'selected' : ''; ?>><?= $jenis_layar['nama_jenis_layar']; ?></option>
										<?php
										} ?>
									</select>
								</div>
							</div>
							<div class="row mb-2">
								<div class="col-12">
									<label for="proteksi_layar">Pelindung Layar</label>
									<select class="form-control text-center" name="proteksi_layar" <?= session()->get('data_filter') == 'Yes' ? 'disabled' : ''; ?>>
										<option value="0">All</option>
										<?php foreach ($pelindung_layar as $protect_layar) {
										?>
											<option value="<?= $protect_layar['id']; ?>" <?= session()->get('fk_proteksi_layar') == $protect_layar['id'] ? 'selected' : ''; ?>><?= $protect_layar['nama_protect_layar']; ?></option>
										<?php
										} ?>
									</select>
								</div>
							</div>
							<div class="row mb-2">
								<div class="col-12">
									<label for="resolusi_kamera_belakang">Resolusi Kamera</label>
									<select class="form-control text-center" name="resolusi_kamera_belakang" <?= session()->get('data_filter') == 'Yes' ? 'disabled' : ''; ?>>
										<option value="0">All</option>
										<?php foreach ($resolusi_kamera as $kamera_mp) {
											if ($kamera_mp['ket_aktif'] != 'false') {
										?>
												<option value="<?= $kamera_mp['id']; ?>" <?= session()->get('fk_kamera_belakang') == $kamera_mp['id'] ? 'selected' : ''; ?>><?= $kamera_mp['ket_status']; ?></option>
										<?php
											}
										} ?>
									</select>
								</div>
							</div>
							<div class="row mb-2">
								<div class="col-12">
									<label for="kapasitas_batrai">Kapasitas Batrai</label>
									<select class="form-control text-center" name="kapasitas_batrai" <?= session()->get('data_filter') == 'Yes' ? 'disabled' : ''; ?>>
										<option value="0">All</option>
										<?php foreach ($batrai as $daya_tahan) {
											if ($daya_tahan['ket_aktif'] != 'false') {
										?>
												<option value="<?= $daya_tahan['id']; ?>" <?= session()->get('fk_kapasitas_batrai') == $daya_tahan['id'] ? 'selected' : ''; ?>><?= $daya_tahan['ket_status']; ?></option>
										<?php
											}
										} ?>
									</select>
								</div>
							</div>
							<div class="row mb-2">
								<div class="col-12">
									<label for="usb_tipe">Tipe USB Carger</label>
									<select class="form-control text-center" name="usb_tipe" <?= session()->get('data_filter') == 'Yes' ? 'disabled' : ''; ?>>
										<option value="0">All</option>
										<?php foreach ($cas as $carger) {
										?>
											<option value="<?= $carger['id']; ?>" <?= session()->get('fk_usb_tipe') == $carger['id'] ? 'selected' : ''; ?>><?= $carger['nama_usb']; ?></option>
										<?php
										} ?>
									</select>
								</div>
							</div>
							<div class="row mb-2">
								<div class="col-12">
									<label for="filter">Filter</label>
									<select class="form-control text-center" name="filter" <?= session()->get('data_filter') == 'Yes' ? 'disabled' : ''; ?>>
										<option value="and" <?= session()->get('filter') == 'and' ? 'selected' : ''; ?>>AND</option>
										<option value="or" <?= session()->get('filter') == 'or' ? 'selected' : ''; ?>>OR</option>
									</select>
								</div>
							</div>
							<div class="row mb-2">
								<div class="col-12">
									<?php if (session()->get('data_filter') == 'Yes') {
									?>
										<a href="/search/delete_filter" class="btn btn-danger">Hapus Filter</a>
									<?php
									} else {
									?>
										<button class="btn btn-primary" value="submit" type="submit">cari</button>
									<?php
									} ?>
								</div>
							</div>

						</form>
					</div>
					<div class="card-footer">

					</div>
				</div>
			</div>
			<div class="col-xs-10 col-md-10 mb-3">
				<div class="short-div mb-3">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-12">
									<form action="/search/keyword" method="POST">
										<div class="row justify-content-between">
											<div class="col-12">
												<?php if (session()->get('key_smartphone') == null) { ?>
													<!-- sebelum input search -->
													<div class="input-group">
														<input type="text" class="form-control" name="key_smartphone" placeholder="Masukan pencarian...">
														<div class="input-group-append">
															<button class="btn btn-outline-secondary" type="submit" name="submit">Cari</button>
														</div>
													</div>
													<!--  -->
												<?php } else { ?>
													<!-- sesudah search -->
													<div class="input-group">
														<input type="text" class="form-control" name="key_smartphone" placeholder="<?= session()->get('key_smartphone'); ?>" disabled>
														<div class="input-group-append">
															<a href="/search/delete_key" class="btn btn-outline-danger" type="button"><span data-feather="delete"></span></a>
														</div>
													</div>
													<!--  -->
												<?php } ?>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="short-div">
					<div class="card">
						<div class="card-header">
							<h4 class=" d-flex align-items-center justify-content-center">Data Smartphone</h4>
						</div>
						<div class="card-body table-responsive">
							<?php
							$data = 1;
							$a = 1 + ($data_inpage * ($CURRENT - 1));
							foreach ($smartphone as $smartphone) { ?>
								<div class="row mb-3">
									<div class="col-12">
										<div class="card">
											<div class="card-body table-responsive">
												<div class="row">
													<div class="col-1 d-flex align-items-center justify-content-center mb-3">
														<h4 class="text-center"><?= $a; ?></h4>
													</div>
													<div class="col-xs-3 col-md-3 mb-3">
														<div id="carouselExampleControls<?= $data; ?>" class="carousel slide" data-bs-ride="carousel">
															<div class="carousel-inner">
																<div class="carousel-item active">
																	<img src="/assets/image/smartphone/<?= ($smartphone['image1'] != null) ? $smartphone['image1'] : 'default.jpg'; ?>" class="d-block w-100" alt="First slide">
																</div>
																<div class="carousel-item">
																	<img src="/assets/image/smartphone/<?= ($smartphone['image2'] != null) ? $smartphone['image2'] : 'default.jpg'; ?>" class="d-block w-100" alt="Second slide">
																</div>
																<div class="carousel-item">
																	<img src="/assets/image/smartphone/<?= ($smartphone['image3'] != null) ? $smartphone['image3'] : 'default.jpg'; ?>" class="d-block w-100" alt="Third slide">
																</div>
															</div>
															<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls<?= $data; ?>" data-bs-slide="prev">
																<span class="carousel-control-prev-icon" aria-hidden="true"></span>
																<span class="visually-hidden">Previous</span>
															</button>
															<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls<?= $data; ?>" data-bs-slide="next">
																<span class="carousel-control-next-icon" aria-hidden="true"></span>
																<span class="visually-hidden">Next</span>
															</button>
														</div>
													</div>
													<div class="col-xs-6 col-md-6 mb-3">
														<div class="short-div mb-2">
															<label for="nama_smartphone" class="form-label small">Nama Smartphone</label>
															<div type="text" class="form-control form-control-lg" id="nama_smartphone"><?= $smartphone['nama_smartphone']; ?>
															</div>
														</div>
														<div class="short-div">
															<div class="row">
																<div class="col-xs-5 col-md-5 mb-2">
																	<form class="form-floating">
																		<div type="text" class="form-control form-control-sm" id="harga"><?= rupiah($smartphone['harga']); ?>
																		</div>
																		<label for="toko" class="form-label small">Harga</label>
																	</form>
																</div>
																<div class="col-xs-7 col-md-7 mb-2">
																	<form class="form-floating">
																		<div type="text" class="form-control form-control-sm" id="toko"><?= $smartphone['nama_seller']; ?>
																		</div>
																		<label for="toko" class="form-label small">Toko</label>
																	</form>
																</div>
															</div>
														</div>
														<div class="short-div mb-2">
															<div class="row">
																<div class="col-xs-6 col-md-6 mb-2">
																	<form class="form-floating">
																		<div type="text" class="form-control form-control-sm" id="merek"><?= $smartphone['merek']; ?>
																		</div>
																		<label for="merek" class="form-label small">Merek</label>
																	</form>
																</div>
																<div class="col-xs-6 col-md-6 mb-2">
																	<form class="form-floating">
																		<div type="text" class="form-control form-control-sm" id="tahun"><?= $smartphone['tahun']; ?>
																		</div>
																		<label for="tahun" class="form-label small">Tahun</label>
																	</form>
																</div>
															</div>
														</div>
													</div>
													<div class="col-xs-2 col-md-2 mb-3  d-flex align-items-center justify-content-center">
														<a href="/detail_smartphone/<?= $smartphone['slug']; ?>" class="btn btn-primary text-center">detail</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							<?php
								$a++;
								$data++;
							} ?>
						</div>
						<div class="card-footer">
							<div class="row justify-content-end text-end">
								<div class="col">
									<?= $pager->links('t_smartphone', 'smartphone') ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</section><!-- End Hero -->
<!-- =============================== -->
<?= $this->endSection(); ?>