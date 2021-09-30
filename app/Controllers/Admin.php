<?php

namespace App\Controllers;

use App\Models\PhoneModel;
use App\Models\LoginModel;
use App\Models\BahanBodyModel;
use App\Models\Fk_antutuModel;
use App\Models\Fk_batraiModel;
use App\Models\Fk_hargaModel;
use App\Models\Fk_internalModel;
use App\Models\Fk_Model;
use App\Models\Fk_resolusi_layarModel;
use App\Models\Fk_tahunModel;
use App\Models\Fk_processorModel;
use App\Models\Fk_ramModel;
use App\Models\Fk_resolusi_kameraModel;
use App\Models\GpuModel;
use App\Models\JenisLayarModel;
use App\Models\MerekModel;
use App\Models\nilai_fkAntutuModel;
use App\Models\nilai_fkBatraiModel;
use App\Models\nilai_fkHargaModel;
use App\Models\nilai_fkInternalModel;
use App\Models\nilai_fkResolusilayarModel;
use App\Models\nilai_fkTahunModel;
use App\Models\nilai_fkProcessorModel;
use App\Models\nilai_fkRamModel;
use App\Models\nilai_fkResolusikameraModel;
use App\Models\PelindungLayarModel;
use App\Models\ProcessorModel;
use App\Models\UiSistemModel;
use App\Models\USBtipeModel;



class Admin extends BaseController
{

	protected $smartphone;
	protected $user;
	//--- Variable non-fuzzy ---
	protected $merek;
	protected $processor;
	protected $bahan_body;
	protected $jenis_layar;
	protected $pelindung_layar;
	protected $gpu;
	protected $usb_tipe;
	//-------------------------
	protected $ui_hp;
	protected $network = ['5G', '4G', '3G', '2G'];
	protected $internal = ['4', '8', '16', '32', '64', '128', '256', '512'];
	protected $ram = ['0.5', '1', '1.5', '2', '3', '4', '6', '8', '12'];
	protected $jml_sim = ['Dual', 'Single'];
	protected $tipe_sim = ['Mini SIM', 'Micro SIM', 'Nano SIM'];
	protected $sim_stand = ['Stand-by all', 'One-hybrit'];
	protected $core_cpu = ['Single core', 'Dual core', 'Quad core', 'Octa core'];
	protected $main_camera_tipe = ['None', 'Single', 'Double', 'Tripel', 'Quard'];
	protected $front_camera_tipe = ['None', 'Single', 'Double', 'Tripel'];
	protected $WLAN = ['Yes', 'No'];
	protected $bluetooth = ['Yes', 'No'];
	protected $infrared = ['No', 'Yes'];
	protected $radio = ['Yes', 'No'];
	protected $fingerprint = ['No', 'Yes'];
	protected $face_unlock = ['No', 'Yes'];
	protected $tipe_batrai = ['Removable', 'Non-removable'];
	protected $tipe_carging = ['Non fast carging', 'Fast carging'];
	//------Fungsi Keanggotaan------
	protected $fk;
	protected $fk_harga;
	protected $nilai_fk_harga;
	protected $fk_tahun;
	protected $nilai_fk_tahun;
	protected $fk_resolusi_layar;
	protected $nilai_fk_resolusi_layar;
	protected $fk_processor;
	protected $nilai_fk_processor;
	protected $fk_internal;
	protected $nilai_fk_internal;
	protected $fk_ram;
	protected $nilai_fk_ram;
	protected $fk_resolusi_main_kamera;
	protected $nilai_fk_resolusi_main_kamera;
	protected $fk_batrai;
	protected $nilai_fk_batrai;
	protected $fk_antutu;
	protected $nilai_fk_antutu;


	public function __construct()
	{
		$this->smartphone 		= new PhoneModel();
		$this->user 			= new LoginModel();
		$this->merek 			= new MerekModel();
		$this->processor 		= new ProcessorModel();
		$this->bahan_body 		= new BahanBodyModel();
		$this->jenis_layar 		= new JenisLayarModel();
		$this->pelindung_layar 	= new PelindungLayarModel();
		$this->gpu 				= new GpuModel();
		$this->ui_hp 			= new UiSistemModel();
		$this->usb_tipe			= new USBtipeModel();
		$this->fk				= new Fk_Model();
		$this->fk_harga			= new Fk_hargaModel();
		$this->nilai_fk_harga	= new nilai_fkHargaModel();
		$this->fk_tahun			= new Fk_tahunModel();
		$this->nilai_fk_tahun	= new nilai_fkTahunModel();
		$this->fk_resolusi_layar = new Fk_resolusi_layarModel();
		$this->nilai_fk_resolusi_layar = new nilai_fkResolusilayarModel();
		$this->fk_processor 	= new Fk_processorModel();
		$this->nilai_fk_processor = new nilai_fkProcessorModel();
		$this->fk_internal 		= new Fk_internalModel();
		$this->nilai_fk_internal = new nilai_fkInternalModel();
		$this->fk_ram			= new Fk_ramModel();
		$this->nilai_fk_ram		= new nilai_fkRamModel();
		$this->fk_resolusi_main_kamera = new Fk_resolusi_kameraModel();
		$this->nilai_fk_resolusi_main_kamera = new nilai_fkResolusikameraModel();
		$this->fk_batrai		= new Fk_batraiModel();
		$this->nilai_fk_batrai 	= new nilai_fkBatraiModel();
		$this->fk_antutu		= new Fk_antutuModel();
		$this->nilai_fk_antutu 	= new nilai_fkAntutuModel();
	}



	public function index()
	{
		$countSeller = $this->user->select('hak_akses,count(hak_akses) as jml')->where('hak_akses', '2')->groupBy('hak_akses')->first();
		$countSellerActive = $this->user->select('active_account,count(active_account) as jml')->where('active_account', 'active')->where('hak_akses', '2')->groupBy('active_account')->first();
		$countSellerNonActive = $this->user->select('active_account,count(active_account) as jml')->where('active_account', 'non-active')->where('hak_akses', '2')->groupBy('active_account')->first();
		$data = [
			'AllSeller' => $countSeller,
			'activeSeller' => $countSellerActive,
			'NonactiveSeller' => $countSellerNonActive
		];
		return view('Admin/dashboard');
	}

	////////////////////////////////////////////////////////////////
	//////////////////////  DATA SMARTPHONE  ///////////////////////
	////////////////////////////////////////////////////////////////


	//view all smartphone by admin
	public function datasmartphone()
	{
		$session = session();
		//-------------------Validasi GET----------------------- 
		$CURRENT = $this->request->getVar('page_t_smartphone') ? $this->request->getVar('page_t_smartphone') : 1;
		//-------------Jumlah data di dalam table---------------
		$data_inpage = 5;
		//------------------------------------------------------
		$keyword = $this->request->getVar('key_smartphone');
		if ($keyword) {
			$session->set(['key_smartphone' => $keyword]);
			$FindSmartphone = $this->smartphone->FindAllSmartphonePaginationAdmin($keyword, session()->get('id'));
		} else if (session()->get('key_smartphone') != Null) {
			$FindSmartphone = $this->smartphone->FindAllSmartphonePaginationAdmin(session()->get('key_smartphone'), session()->get('id'));
		} else {
			$FindSmartphone = $this->smartphone->allSmartphonePaginationAdmin(session()->get('id'));
		}
		$data = [
			'data_smartphone' 	=> $FindSmartphone->paginate($data_inpage, 't_smartphone'),
			'pager'				=> $this->smartphone->pager,
			'CURRENT'       => $CURRENT,
			'data_inpage'     => $data_inpage,
		];
		return view('Admin/datasmartphone/all_smartphone', $data);
	}


	//delete search smartphone
	public function d_m()
	{
		$session = session();
		$session->remove('key_smartphone');
		return redirect()->to('/admin/datasmartphone');
	}

	//update form by slug
	public function update_smartphone($slug)
	{
		$datasmartphone = $this->smartphone->findSmartphoneBySlug($slug);
		$data = [
			'smartphone'		=> $datasmartphone,
			'v_merek' 			=> $this->merek->findAll(),
			'v_body'			=> $this->bahan_body->findAll(),
			'v_jenis_layar'		=> $this->jenis_layar->findAll(),
			'v_protect_layar'	=> $this->pelindung_layar->findAll(),
			'v_jenis_chipset'	=> $this->processor->findAll(),
			'v_ui_os'			=> $this->ui_hp->findAll(),
			'v_jenis_gpu'		=> $this->gpu->findAll(),
			'v_tipe_usb'		=> $this->usb_tipe->findAll(),
			'v_main_camera_tipe' => $this->main_camera_tipe,
			'v_front_camera_tipe' => $this->front_camera_tipe,
			'v_network' 		=> $this->network,
			'v_internal'		=> $this->internal,
			'v_ram'				=> $this->ram,
			'v_jml_sim'			=> $this->jml_sim,
			'v_tipe_sim'		=> $this->tipe_sim,
			'v_sim_stand'		=> $this->sim_stand,
			'v_core_cpu'		=> $this->core_cpu,
			'v_WLAN'			=> $this->WLAN,
			'v_bluetooth'		=> $this->bluetooth,
			'v_infrared'		=> $this->infrared,
			'v_radio'			=> $this->radio,
			'v_fingerprint'		=> $this->fingerprint,
			'v_faceunlock'		=> $this->face_unlock,
			'v_tipe_batrai'		=> $this->tipe_batrai,
			'v_tipe_carging'	=> $this->tipe_carging,
			'validation' => \Config\Services::validation()
		];
		return view('Admin/datasmartphone/update_smartphone', $data);
	}


	//function update smartphone
	public function updatesmartphone()
	{
		$insertAll = $this->request->getPost();
		$slug = url_title($insertAll['nama_smartphone'] . '_by_' . $insertAll['seller'], '_', true);

		//---------- Validasi Slug -------------//
		if ($slug != $insertAll['slug']) {
			$validate = $this->smartphone->where('slug', $slug)->find();
			if ($validate != null) {
				$data_validate = 'data smartphone serupa telah anda buat sebelumnya, data harus unique!!! ';
				session()->setFlashdata('validate', $data_validate);
				return redirect()->to('/admin/insert_new_smartphone')->withInput();
			}
		}
		//--------------------------------------//

		//--------    Validasi Image    --------// 
		if (!$this->validate([
			'image_smartphone1' => [
				'rules'     => 'max_size[image_smartphone1,1024]|is_image[image_smartphone1]|mime_in[image_smartphone1,image/jpg,image/jpeg,image/png]',
				'errors'    => [
					'max_size' => 'File maximal 1MB',
					'is_image' => 'Yang anda upload bukan gambar',
					'mime_in'  => 'Yang anda upload bukan gambar'
				]
			],
			'image_smartphone2' => [
				'rules'     => 'max_size[image_smartphone2,1024]|is_image[image_smartphone2]|mime_in[image_smartphone2,image/jpg,image/jpeg,image/png]',
				'errors'    => [
					'max_size' => 'File maximal 1MB',
					'is_image' => 'Yang anda upload bukan gambar',
					'mime_in'  => 'Yang anda upload bukan gambar'
				]
			],
			'image_smartphone3' => [
				'rules'     => 'max_size[image_smartphone3,1024]|is_image[image_smartphone3]|mime_in[image_smartphone3,image/jpg,image/jpeg,image/png]',
				'errors'    => [
					'max_size' => 'File maximal 1MB',
					'is_image' => 'Yang anda upload bukan gambar',
					'mime_in'  => 'Yang anda upload bukan gambar'
				]
			],
		])) {
			return redirect()->to('/admin/update_smartphone/' . $insertAll['slug'])->withInput();
		}
		//------------------------------------//

		/////////////////// Get image post ////////////////////
		$image1 = $this->request->getFile('image_smartphone1');
		$image2 = $this->request->getFile('image_smartphone2');
		$image3 = $this->request->getFile('image_smartphone3');
		///////////////////////////////////////////////////////

		//------    Validation image ada atau tidak   -------//
		if ($image1->getError() == 4) {
			$name_image1 = null;
		} else {
			//ambil nama file image smartphone1
			$name_image1 = $image1->getRandomName();
		}
		if ($image2->getError() == 4) {
			$name_image2 = null;
		} else {
			//ambil nama file image smartphone2
			$name_image2 = $image2->getRandomName();
		}
		if ($image3->getError() == 4) {
			$name_image3 = null;
		} else {
			//ambil nama file image smartphone3
			$name_image3 = $image3->getRandomName();
		}
		//---------------------------------------------------//

		$data_insert = [
			'id'				=> $insertAll['id'],
			'slug' 				=> $slug,
			'nama_smartphone'	=> $insertAll['nama_smartphone'],
			'merek'				=> $insertAll['merek'],
			'harga'				=> $insertAll['harga'],
			'tahun'				=> $insertAll['tahun'],
			'network'			=> $insertAll['network'],
			'tebal'				=> $insertAll['tebal'],
			'berat'				=> $insertAll['berat'],
			'bahan_body'		=> $insertAll['body'],
			'sim'				=> $insertAll['jml_sim'],
			'tipe_sim'			=> $insertAll['tipe_sim'],
			'sim_stand'			=> $insertAll['sim_stand'],
			'jenis_layar'		=> $insertAll['jenis_layar'],
			'jenis_protect_layar' => $insertAll['jenis_protect_layar'],
			'resolution_layar'	=> $insertAll['resolusi_layar'],
			'tipe_ui_os'		=> $insertAll['ui_os'],
			'jenis_chipset'		=> $insertAll['jenis_chipset'],
			'nama_chipset'		=> $insertAll['nama_chipset'],
			'clock_speed_cpu'	=> $insertAll['clock_speed_cpu'],
			'jumlah_core'		=> $insertAll['core_cpu'],
			'jenis_gpu'			=> $insertAll['jenis_gpu'],
			'nama_lengkap_gpu'	=> $insertAll['nama_gpu'],
			'internal_storage'	=> $insertAll['internal'],
			'ram'				=> $insertAll['ram'],
			'tipe_main_camera'	=> $insertAll['main_camera_tipe'],
			'resolusi_main_camera' => $insertAll['resolusi_main_camera'],
			'selfie_camera' => $insertAll['front_camera_tipe'],
			'resolusi_selfie_camera' => $insertAll['resolusi_front_camera'],
			'WLAN'				=> $insertAll['WLAN'],
			'bluetooth'			=> $insertAll['bluetooth'],
			'infrared'			=> $insertAll['infrared'],
			'radio'				=> $insertAll['radio'],
			'usb_tipe'			=> $insertAll['tipe_usb'],
			'fingerprint'		=> $insertAll['fingerprint'],
			'face_sensor'		=> $insertAll['faceunlock'],
			'tipe_batrai'		=> $insertAll['tipe_batrai'],
			'kapasitas_batrai'	=> $insertAll['kapasitas_batrai'],
			'tipe_charger'		=> $insertAll['tipe_carging'],
			'test_antutu'		=> ($insertAll['antutu_score'] == null) ? 0 : $insertAll['antutu_score'],
			'image1'			=> ($name_image1 == null) ? $insertAll['image1_1'] : $name_image1,
			'image2'			=> ($name_image2 == null) ? $insertAll['image2_2'] : $name_image2,
			'image3'			=> ($name_image3 == null) ? $insertAll['image3_3'] : $name_image3,
			'id_seller'			=> session()->get('id'),

		];
		//Save data baru smartphone
		$this->smartphone->save($data_insert);
		if ($name_image1 != null) {
			//pindahkan file image smartphone1
			$image1->move('assets/image/smartphone/', $name_image1);
			if ($insertAll['image1_1'] != null) {
				if ($insertAll['image1_1'] != 'default.jpg') {
					unlink('assets/image/smartphone/' . $insertAll['image1_1']);
				}
			}
		}
		if ($name_image2 != null) {
			//pindahkan file image smartphone2
			$image2->move('assets/image/smartphone/', $name_image2);
			if ($insertAll['image2_2'] != null) {
				if ($insertAll['image2_2'] != 'default.jpg') {
					unlink('assets/image/smartphone/' . $insertAll['image2_2']);
				}
			}
		}
		if ($name_image3 != null) {
			//pindahkan file image smartphone3
			$image3->move('assets/image/smartphone/', $name_image3);
			if ($insertAll['image3_3'] != null) {
				if ($insertAll['image3_3'] != 'default.jpg') {
					unlink('assets/image/smartphone/' . $insertAll['image3_3']);
				}
			}
		}

		//----------------  Pemberian Nilai keanggotaan Fuzzy ------------------//
		$data_smartphone = $this->smartphone->select('id, harga, tahun, kapasitas_batrai, test_antutu, internal_storage, clock_speed_cpu, ram, resolusi_main_camera, resolution_layar')->where('id', $insertAll['id'])->first();
		$batas_keanggotaan = $this->fk_harga->where('ket_aktif', 'true')->findAll();
		$this->nilai_fk_harga->Hitung_fk($data_smartphone['id'], $data_smartphone['harga'], $batas_keanggotaan);
		$batas_keanggotaan = $this->fk_tahun->where('ket_aktif', 'true')->findAll();
		$this->nilai_fk_tahun->Hitung_fk($data_smartphone['id'], $data_smartphone['tahun'], $batas_keanggotaan);
		$batas_keanggotaan = $this->fk_batrai->where('ket_aktif', 'true')->findAll();
		$this->nilai_fk_batrai->Hitung_fk($data_smartphone['id'], $data_smartphone['kapasitas_batrai'], $batas_keanggotaan);
		$batas_keanggotaan = $this->fk_antutu->where('ket_aktif', 'true')->findAll();
		$this->nilai_fk_antutu->Hitung_fk($data_smartphone['id'], $data_smartphone['test_antutu'], $batas_keanggotaan);
		$batas_keanggotaan = $this->fk_internal->where('ket_aktif', 'true')->findAll();
		$this->nilai_fk_internal->Hitung_fk($data_smartphone['id'], $data_smartphone['internal_storage'], $batas_keanggotaan);
		$batas_keanggotaan = $this->fk_processor->where('ket_aktif', 'true')->findAll();
		$this->nilai_fk_processor->Hitung_fk($data_smartphone['id'], $data_smartphone['clock_speed_cpu'], $batas_keanggotaan);
		$batas_keanggotaan = $this->fk_ram->where('ket_aktif', 'true')->findAll();
		$this->nilai_fk_ram->Hitung_fk($data_smartphone['id'], $data_smartphone['ram'], $batas_keanggotaan);
		$batas_keanggotaan = $this->fk_resolusi_main_kamera->where('ket_aktif', 'true')->findAll();
		$this->nilai_fk_resolusi_main_kamera->Hitung_fk($data_smartphone['id'], $data_smartphone['resolusi_main_camera'], $batas_keanggotaan);
		$batas_keanggotaan = $this->fk_resolusi_layar->where('ket_aktif', 'true')->findAll();
		$this->nilai_fk_resolusi_layar->Hitung_fk($data_smartphone['id'], $data_smartphone['resolution_layar'], $batas_keanggotaan);
		//----------------------------------------------------------------------//
		return redirect()->to('/admin/detail_smartphone/' . $slug);
	}


	//form insert new smartphone
	public function insert_new_smartphone()
	{
		$data = [
			'v_merek' 			=> $this->merek->findAll(),
			'v_body'			=> $this->bahan_body->findAll(),
			'v_jenis_layar'		=> $this->jenis_layar->findAll(),
			'v_protect_layar'	=> $this->pelindung_layar->findAll(),
			'v_jenis_chipset'	=> $this->processor->findAll(),
			'v_ui_os'			=> $this->ui_hp->findAll(),
			'v_jenis_gpu'		=> $this->gpu->findAll(),
			'v_tipe_usb'		=> $this->usb_tipe->findAll(),
			'v_main_camera_tipe' => $this->main_camera_tipe,
			'v_front_camera_tipe' => $this->front_camera_tipe,
			'v_network' 		=> $this->network,
			'v_internal'		=> $this->internal,
			'v_ram'				=> $this->ram,
			'v_jml_sim'			=> $this->jml_sim,
			'v_tipe_sim'		=> $this->tipe_sim,
			'v_sim_stand'		=> $this->sim_stand,
			'v_core_cpu'		=> $this->core_cpu,
			'v_WLAN'			=> $this->WLAN,
			'v_bluetooth'		=> $this->bluetooth,
			'v_infrared'		=> $this->infrared,
			'v_radio'			=> $this->radio,
			'v_fingerprint'		=> $this->fingerprint,
			'v_faceunlock'		=> $this->face_unlock,
			'v_tipe_batrai'		=> $this->tipe_batrai,
			'v_tipe_carging'	=> $this->tipe_carging,
			'validation' => \Config\Services::validation()
		];
		return view('Admin/datasmartphone/insert_new_smartphone', $data);
	}


	// function insert new smartphone
	public function tambah_smartphone()
	{

		$insertAll = $this->request->getVar();
		$slug = url_title($insertAll['nama_smartphone'] . '_by_' . $insertAll['seller'], '_', true);

		//---------- Validasi Slug -------------//
		$validate = $this->smartphone->where('slug', $slug)->find();
		if ($validate != null) {
			$data_validate = 'data smartphone serupa telah anda buat sebelumnya, data harus unique!!! ';
			session()->setFlashdata('validate', $data_validate);
			return redirect()->to('/admin/insert_new_smartphone')->withInput();
		}
		//--------------------------------------//

		//--------    Validasi Image    --------// 
		if (!$this->validate([
			'image_smartphone1' => [
				'rules'     => 'max_size[image_smartphone1,1024]|is_image[image_smartphone1]|mime_in[image_smartphone1,image/jpg,image/jpeg,image/png]',
				'errors'    => [
					'max_size' => 'File maximal 1MB',
					'is_image' => 'Yang anda upload bukan gambar',
					'mime_in'  => 'Yang anda upload bukan gambar'
				]
			],
			'image_smartphone2' => [
				'rules'     => 'max_size[image_smartphone2,1024]|is_image[image_smartphone2]|mime_in[image_smartphone2,image/jpg,image/jpeg,image/png]',
				'errors'    => [
					'max_size' => 'File maximal 1MB',
					'is_image' => 'Yang anda upload bukan gambar',
					'mime_in'  => 'Yang anda upload bukan gambar'
				]
			],
			'image_smartphone3' => [
				'rules'     => 'max_size[image_smartphone3,1024]|is_image[image_smartphone3]|mime_in[image_smartphone3,image/jpg,image/jpeg,image/png]',
				'errors'    => [
					'max_size' => 'File maximal 1MB',
					'is_image' => 'Yang anda upload bukan gambar',
					'mime_in'  => 'Yang anda upload bukan gambar'
				]
			],
		])) {
			return redirect()->to('/admin/insert_new_smartphone')->withInput();
		}
		//------------------------------------//

		/////////////////// Get image post ////////////////////
		$image1 = $this->request->getFile('image_smartphone1');
		$image2 = $this->request->getFile('image_smartphone2');
		$image3 = $this->request->getFile('image_smartphone3');
		///////////////////////////////////////////////////////

		//------    Validation image ada atau tidak   -------//
		if ($image1->getError() == 4) {
			$name_image1 = 'default.jpg';
		} else {
			//ambil nama file image smartphone1
			$name_image1 = $image1->getRandomName();
		}
		if ($image2->getError() == 4) {
			$name_image2 = 'default.jpg';
		} else {
			//ambil nama file image smartphone2
			$name_image2 = $image2->getRandomName();
		}
		if ($image3->getError() == 4) {
			$name_image3 = 'default.jpg';
		} else {
			//ambil nama file image smartphone3
			$name_image3 = $image3->getRandomName();
		}
		//---------------------------------------------------//

		$data_insert = [
			'slug' 				=> $slug,
			'nama_smartphone'	=> $insertAll['nama_smartphone'],
			'merek'				=> $insertAll['merek'],
			'harga'				=> $insertAll['harga'],
			'tahun'				=> $insertAll['tahun'],
			'network'			=> $insertAll['network'],
			'tebal'				=> $insertAll['tebal'],
			'berat'				=> $insertAll['berat'],
			'bahan_body'		=> $insertAll['body'],
			'sim'				=> $insertAll['jml_sim'],
			'tipe_sim'			=> $insertAll['tipe_sim'],
			'sim_stand'			=> $insertAll['sim_stand'],
			'jenis_layar'		=> $insertAll['jenis_layar'],
			'jenis_protect_layar' => $insertAll['jenis_protect_layar'],
			'resolution_layar'	=> $insertAll['resolusi_layar'],
			'tipe_ui_os'		=> $insertAll['ui_os'],
			'jenis_chipset'		=> $insertAll['jenis_chipset'],
			'nama_chipset'		=> $insertAll['nama_chipset'],
			'clock_speed_cpu'	=> $insertAll['clock_speed_cpu'],
			'jumlah_core'		=> $insertAll['core_cpu'],
			'jenis_gpu'			=> $insertAll['jenis_gpu'],
			'nama_lengkap_gpu'	=> $insertAll['nama_gpu'],
			'internal_storage'	=> $insertAll['internal'],
			'ram'				=> $insertAll['ram'],
			'tipe_main_camera'	=> $insertAll['main_camera_tipe'],
			'resolusi_main_camera' => $insertAll['resolusi_main_camera'],
			'tipe_selfie_camera' => $insertAll['front_camera_tipe'],
			'resolusi_selfie_camera' => $insertAll['resolusi_front_camera'],
			'WLAN'				=> $insertAll['WLAN'],
			'bluetooth'			=> $insertAll['bluetooth'],
			'infrared'			=> $insertAll['infrared'],
			'radio'				=> $insertAll['radio'],
			'usb_tipe'			=> $insertAll['tipe_usb'],
			'fingerprint'		=> $insertAll['fingerprint'],
			'face_sensor'		=> $insertAll['faceunlock'],
			'tipe_batrai'		=> $insertAll['tipe_batrai'],
			'kapasitas_batrai'	=> $insertAll['kapasitas_batrai'],
			'tipe_charger'		=> $insertAll['tipe_carging'],
			'test_antutu'		=> ($insertAll['antutu_score'] == null) ? 0 : $insertAll['antutu_score'],
			'image1'			=> $name_image1,
			'image2'			=> $name_image2,
			'image3'			=> $name_image3,
			'id_seller'			=> session()->get('id'),

		];
		//Save data baru smartphone
		$this->smartphone->save($data_insert);
		if ($name_image1 != 'default.jpg') {
			//pindahkan file image smartphone1
			$image1->move('assets/image/smartphone/', $name_image1);
		}
		if ($name_image2 != 'default.jpg') {
			//pindahkan file image smartphone2
			$image2->move('assets/image/smartphone/', $name_image2);
		}
		if ($name_image3 != 'default.jpg') {
			//pindahkan file image smartphone3
			$image3->move('assets/image/smartphone/', $name_image3);
		}

		//----------------  Pemberian Nilai keanggotaan Fuzzy ------------------//
		$data_smartphone = $this->smartphone->select('id, harga, tahun, kapasitas_batrai, test_antutu, internal_storage, clock_speed_cpu, ram, resolusi_main_camera, resolution_layar')->where('slug', $slug)->first();
		$batas_keanggotaan = $this->fk_harga->where('ket_aktif', 'true')->findAll();
		$this->nilai_fk_harga->Hitung_fk($data_smartphone['id'], $data_smartphone['harga'], $batas_keanggotaan);
		$batas_keanggotaan = $this->fk_tahun->where('ket_aktif', 'true')->findAll();
		$this->nilai_fk_tahun->Hitung_fk($data_smartphone['id'], $data_smartphone['tahun'], $batas_keanggotaan);
		$batas_keanggotaan = $this->fk_batrai->where('ket_aktif', 'true')->findAll();
		$this->nilai_fk_batrai->Hitung_fk($data_smartphone['id'], $data_smartphone['kapasitas_batrai'], $batas_keanggotaan);
		$batas_keanggotaan = $this->fk_antutu->where('ket_aktif', 'true')->findAll();
		$this->nilai_fk_antutu->Hitung_fk($data_smartphone['id'], $data_smartphone['test_antutu'], $batas_keanggotaan);
		$batas_keanggotaan = $this->fk_internal->where('ket_aktif', 'true')->findAll();
		$this->nilai_fk_internal->Hitung_fk($data_smartphone['id'], $data_smartphone['internal_storage'], $batas_keanggotaan);
		$batas_keanggotaan = $this->fk_processor->where('ket_aktif', 'true')->findAll();
		$this->nilai_fk_processor->Hitung_fk($data_smartphone['id'], $data_smartphone['clock_speed_cpu'], $batas_keanggotaan);
		$batas_keanggotaan = $this->fk_ram->where('ket_aktif', 'true')->findAll();
		$this->nilai_fk_ram->Hitung_fk($data_smartphone['id'], $data_smartphone['ram'], $batas_keanggotaan);
		$batas_keanggotaan = $this->fk_resolusi_main_kamera->where('ket_aktif', 'true')->findAll();
		$this->nilai_fk_resolusi_main_kamera->Hitung_fk($data_smartphone['id'], $data_smartphone['resolusi_main_camera'], $batas_keanggotaan);
		$batas_keanggotaan = $this->fk_resolusi_layar->where('ket_aktif', 'true')->findAll();
		$this->nilai_fk_resolusi_layar->Hitung_fk($data_smartphone['id'], $data_smartphone['resolution_layar'], $batas_keanggotaan);
		//----------------------------------------------------------------------//
		session()->setFlashdata('true', 'Data smartphone ' . $insertAll['nama_smartphone'] . ' berhasil di tambahkan');
		return redirect()->to('/admin/datasmartphone');
	}


	//function delete smartphone
	public function delete_smartphone()
	{
		$data_delete = $this->request->getPost('id');
		if ($data_delete == null) {
			return redirect()->to('/admin/datasmartphone');
		}
		//----------------  Menghapus image1,image2,image3  -----------------//
		$b1 = $this->smartphone->select('image1')->where('id', $data_delete)->first();
		$b2 = $this->smartphone->select('image2')->where('id', $data_delete)->first();
		$b3 = $this->smartphone->select('image3')->where('id', $data_delete)->first();
		if ($b1['image1'] != null) {
			if ($b1['image1'] != 'default.jpg') {
				unlink('assets/image/smartphone/' . $b1['image1']);
			}
		}
		if ($b2['image2'] != null) {
			if ($b2['image2'] != 'default.jpg') {
				unlink('assets/image/smartphone/' . $b2['image2']);
			}
		}
		if ($b3['image3'] != null) {
			if ($b3['image3'] != 'default.jpg') {
				unlink('assets/image/smartphone/' . $b3['image3']);
			}
		}
		//--------------- delete nilai fungsi keanggotaan -------------------//
		$id = $this->nilai_fk_harga->select('id')->where('id_smartphone', $data_delete)->first();
		$this->nilai_fk_harga->delete($id);
		$id = $this->nilai_fk_tahun->select('id')->where('id_smartphone', $data_delete)->first();
		$this->nilai_fk_tahun->delete($id);
		$id = $this->nilai_fk_batrai->select('id')->where('id_smartphone', $data_delete)->first();
		$this->nilai_fk_batrai->delete($id);
		$id = $this->nilai_fk_antutu->select('id')->where('id_smartphone', $data_delete)->first();
		$this->nilai_fk_antutu->delete($id);
		$id = $this->nilai_fk_internal->select('id')->where('id_smartphone', $data_delete)->first();
		$this->nilai_fk_internal->delete($id);
		$id = $this->nilai_fk_processor->select('id')->where('id_smartphone', $data_delete)->first();
		$this->nilai_fk_processor->delete($id);
		$id = $this->nilai_fk_ram->select('id')->where('id_smartphone', $data_delete)->first();
		$this->nilai_fk_ram->delete($id);
		$id = $this->nilai_fk_resolusi_main_kamera->select('id')->where('id_smartphone', $data_delete)->first();
		$this->nilai_fk_resolusi_main_kamera->delete($id);
		$id = $this->nilai_fk_resolusi_layar->select('id')->where('id_smartphone', $data_delete)->first();
		$this->nilai_fk_resolusi_layar->delete($id);
		//-----------------  delete data berdasarkan id  --------------------//
		$this->smartphone->delete($data_delete);
		session()->setFlashdata('msg', 'Data berhasil di hapus');
		return redirect()->to('/admin/datasmartphone');
	}


	// form detail by slug
	public function detail_smartphone($slug)
	{
		$datasmartphone = $this->smartphone->findSmartphoneBySlug($slug);
		$data = [
			'smartphone' 	=> $datasmartphone
		];
		return view('Admin/datasmartphone/detail_smartphone', $data);
	}



	//////////////////////////////////////////////////////////////////////////
	//------------------           Data Seller           -------------------//
	//////////////////////////////////////////////////////////////////////////

	//view all seller
	public function data_seller()
	{
		$session = session();
		//-------------------Validasi GET----------------------- 
		$CURRENT = $this->request->getVar('page_t_account') ? $this->request->getVar('page_t_account') : 1;
		//-------------Jumlah data di dalam table---------------
		$data_inpage = 5;
		//------------------------------------------------------
		$keyword = $this->request->getVar('key_seller');
		if ($keyword) {
			$session->set(['key_seller' => $keyword]);
			$DataSeller = $this->user->FindSellerPagination($keyword);
		} else if (session()->get('key_seller') != Null) {
			$DataSeller = $this->user->FindSellerPagination(session()->get('key_seller'));
		} else {
			$DataSeller = $this->user->AllSellerPagination();
		}
		$data = [
			'data_seller' 		=> $DataSeller->paginate($data_inpage, 't_account'),
			'pager'				=> $this->user->pager,
			'CURRENT'       	=> $CURRENT,
			'data_inpage'     	=> $data_inpage,
		];
		return view('Admin/dataseller/all_seller', $data);
	}


	// delete search seller
	public function d_s()
	{
		$session = session();
		$session->remove('key_seller');
		return redirect()->to('/admin/data_seller');
	}


	// form detail informasi seller
	public function detail_seller($username)
	{
		$data_user = $this->user->detailUser($username);
		if ($data_user == null) {
			$data_validate = 'Seller yang anda cari detailnya tidak di temukan!';
			session()->setFlashdata('user_not_fount', $data_validate);
			return redirect()->to('/admin/data_seller');
		}
		$data = [
			'data_account' => $data_user
		];
		return view('Admin/dataseller/detail_seller', $data);
	}


	//function active non-aktifkan
	public function update_active_seller($username)
	{
		$dataSeller = $this->user->detailUser($username);
		$data = [
			'id' 	=> $dataSeller['id'],
			'active_account' => ($dataSeller['active_account'] == 'active') ? 'non-active' : 'active'
		];
		$this->user->save($data);
		return redirect()->to('/admin/data_seller');
	}


	//form insert seller
	public function insert_new_user()
	{
		session();
		$data = [
			'validation' => \Config\Services::validation()
		];
		return view('Admin/dataseller/insert_seller', $data);
	}


	//fuction insert seller
	public function insert_newseller()
	{
		$postreq = $this->request->getPost();
		if ($postreq == null) {
			return redirect()->to('/admin');
		}
		//--------------------- Validasi -----------------------
		if (!$this->validate([
			'username'  => [
				'rules' => 'required|is_unique[t_account.username]',
				'errors' => [
					'required' => '{field} seller harus di isi.',
					'is_unique' => '{field} seller tidak boleh sama'
				]
			],
			'email'     => [
				'rules' => 'required|is_unique[t_account.email]',
				'errors' => [
					'required' => '{field} seller harus di isi',
					'is_unique' => '{field} seller tidak boleh sama'
				]
			],
			'image_profile' => [
				'rules'     => 'max_size[image_profile,1024]|is_image[image_profile]|mime_in[image_profile,image/jpg,image/jpeg,image/png]',
				'errors'    => [
					'max_size' => 'File maximal 1MB',
					'is_image' => 'Yang anda upload bukan gambar',
					'mime_in'  => 'Yang anda upload bukan gambar'
				]
			]
		])) {
			return redirect()->to('/admin/insert_new_user')->withInput();
		}
		//------------------ end validasi ----------------------
		//ambil profile
		$image_profile = $this->request->getFile('image_profile');
		if ($image_profile->getError() == 4) {
			//set default
			$name_profile = 'default.jpg';
		} else {
			//ambil nama file profile
			$name_profile = $image_profile->getRandomName();
			//pindahkan profile
			$image_profile->move('assets/image/profile', $name_profile);
		}
		$telp = '0' . $postreq['telp'];
		$data =
			[
				'hak_akses'     => $postreq['hak_akses'],
				'username'      => $postreq['username'],
				'full_name'     => $postreq['full_name'],
				'email'         => $postreq['email'],
				'password'      => $postreq['password'],
				'telp'          => $telp,
				'address'       => $postreq['alamat'],
				'image_profile' => $name_profile,
				'active_account' => 'active'
			];
		$this->user->save($data);
		return redirect()->to('/admin/data_seller');
	}


	// Update form seller
	public function update_seller($username)
	{
		session();
		$data_seller = $this->user->detailUser($username);
		$data_seller['telp'] = substr($data_seller['telp'], 1);
		$data = [
			'data_seller' => $data_seller,
			'validation'  => \Config\Services::validation()
		];
		return view('Admin/dataseller/update_seller', $data);
	}


	// Function update seller
	public function data_sellerupdate()
	{
		$update = $this->request->getPost();
		if ($update == null) {
			return redirect()->to('/admin/data_seller');
		}
		//------------------ Validasi Update -------------------
		if ($update['username'] != $update['usernameasli']) {
			if (!$this->validate([
				'username'     => [
					'rules'     => 'is_unique[t_account.username]',
					'errors'    => [
						'is_unique' => '{field} seller harus berbeda'
					]
				]
			])) {
				return redirect()->to('/admin/update_seller/' . $update['usernameasli'])->withInput();
			}
		}
		if ($update['email'] != $update['emailasli']) {
			if (!$this->validate([
				'email'         => [
					'rules'     => 'is_unique[t_account.email]',
					'errors'    => [
						'is_unique' => '{field} seller harus berbeda'
					]
				]
			])) {
				return redirect()->to('/admin/update_seller/' . $update['usernameasli'])->withInput();
			}
		}
		if (!$this->validate([
			'image_profile' => [
				'rules'     => 'max_size[image_profile,1024]|is_image[image_profile]|mime_in[image_profile,image/jpg,image/jpeg,image/png]',
				'errors'    => [
					'max_size' => 'File maximal 1MB',
					'is_image' => 'Yang anda upload bukan gambar',
					'mime_in'  => 'Yang anda upload bukan gambar'
				]
			]
		])) {
			return redirect()->to('/admin/update_seller/' . $update['usernameasli'])->withInput();
		}
		//------------------   end validasi  -------------------
		//ambil profile
		$image_profile = $this->request->getFile('image_profile');
		if ($image_profile->getError() == 4) {
			$name_profile = $update['image_profile_lama'];
		} else {
			if ($update['image_profile_lama'] == null) {
				//lewat saja
			} else if ($update['image_profile_lama'] != 'default.jpg') {
				unlink('assets/image/profile/' . $update['image_profile_lama']);
			}
			//ambil nama file profile
			$name_profile = $image_profile->getRandomName();
			//pindahkan profile
			$image_profile->move('assets/image/profile', $name_profile);
		}

		$data =
			[
				'id'            => $update['id'],
				'slug'			=> url_title($update['full_name'] . '_telp-0' . $update['telp'], '-', true),
				'username'      => $update['username'],
				'email'         => $update['email'],
				'telp'          => '0' . $update['telp'],
				'full_name'     => $update['full_name'],
				'address'       => $update['alamat'],
				'password'      => $update['password'],
				'image_profile' => $name_profile
			];
		$this->user->save($data);
		return redirect()->to('/admin/detail_seller/' . $update['username']);
	}


	//delete Seller
	public function deleteSeller()
	{
		$dataPost = $this->request->getPost();
		if ($dataPost == null) {
			return redirect()->to('/admin/data_seller');
		}
		//------------    menghapus image smartphone by id_seller    --------------
		$image1 = $this->smartphone->select('id,image1,image2,image3')->where('id_seller', $dataPost['id'])->findAll();
		foreach ($image1 as $img1) {
			if ($img1['image1'] == null) {
			} elseif ($img1['image1'] != 'default.jpg') {
				unlink('assets/image/smartphone/' . $img1['image1']);
			}
			if ($img1['image2'] == null) {
			} elseif ($img1['image2'] != 'default.jpg') {
				unlink('assets/image/smartphone/' . $img1['image2']);
			}
			if ($img1['image3'] == null) {
			} elseif ($img1['image3'] != 'default.jpg') {
				unlink('assets/image/smartphone/' . $img1['image3']);
			}
			//-------------Delete Fungsi keanggotan sesuai id smartphone-------------
			$id = $this->nilai_fk_harga->select('id')->where('id_smartphone', $img1['id'])->first();
			$this->nilai_fk_harga->delete($id);
			$id = $this->nilai_fk_tahun->select('id')->where('id_smartphone', $img1['id'])->first();
			$this->nilai_fk_tahun->delete($id);
			$id = $this->nilai_fk_batrai->select('id')->where('id_smartphone', $img1['id'])->first();
			$this->nilai_fk_batrai->delete($id);
			$id = $this->nilai_fk_antutu->select('id')->where('id_smartphone', $img1['id'])->first();
			$this->nilai_fk_antutu->delete($id);
			$id = $this->nilai_fk_internal->select('id')->where('id_smartphone', $img1['id'])->first();
			$this->nilai_fk_internal->delete($id);
			$id = $this->nilai_fk_processor->select('id')->where('id_smartphone', $img1['id'])->first();
			$this->nilai_fk_processor->delete($id);
			$id = $this->nilai_fk_ram->select('id')->where('id_smartphone', $img1['id'])->first();
			$this->nilai_fk_ram->delete($id);
			$id = $this->nilai_fk_resolusi_main_kamera->select('id')->where('id_smartphone', $img1['id'])->first();
			$this->nilai_fk_resolusi_main_kamera->delete($id);
			$id = $this->nilai_fk_resolusi_layar->select('id')->where('id_smartphone', $img1['id'])->first();
			$this->nilai_fk_resolusi_layar->delete($id);
			//-----------------------------------------------------------------------
		}
		//-----------------------------------------------------------------------
		//--------------------  Menghapus image profile -------------------------
		$imageProfile = $this->user->detailUser($dataPost['id']);
		if ($imageProfile['image_profile'] == null) {
		} elseif ($imageProfile['image_profile'] != 'default.jpg') {
			unlink('assets/image/profile/' . $imageProfile['image_profile']);
		}
		//-----------------------------------------------------------------------
		//------------------------  delete database  ----------------------------
		$this->smartphone->deletePhoneSeller($dataPost['id']);
		$this->user->deleteSeller($dataPost['id']);
		//-----------------------------------------------------------------------
		$data_validate = 'data seller beserta data smartphonenya telah dihapus...';
		session()->setFlashdata('msg', $data_validate);
		return redirect()->to('/admin/data_seller');
	}



	////////////////////////////////////////////////////////////////////////////////////////////
	////------------------------------------  PROFILE  -------------------------------------//// 
	////////////////////////////////////////////////////////////////////////////////////////////

	// detail profile
	public function profile()
	{
		$session = session();
		$profile = $this->user->profileUser($session->get('id'));
		$data = [
			'profile' => $profile
		];
		return view('Admin/profile/view_profile', $data);
	}


	// Form Update Profile
	public function update_profile()
	{
		$session = session();
		$profile = $this->user->profileUser($session->get('id'));
		$profile['telp'] = substr($profile['telp'], 1);
		$data = [
			'profile_lama' => $profile,
			'validation' => \Config\Services::validation()
		];
		return view('Admin/profile/update_profile', $data);
	}


	// Form Update Password
	public function update_password()
	{
		session();
		return view('Admin/profile/update_password');
	}


	//----------------- function update profile -------------------//
	public function function_updateprofile()
	{
		$update = $this->request->getPost();
		if ($update == null) {
			return redirect()->to('/admin');
		}
		//------------------------- Validasi Update ---------------------------
		if ($update['username'] == $update['usernameasli']) {
			if ($update['email'] == $update['emailasli']) {
				if (!$this->validate([
					'image_profile' => [
						'rules'     => 'max_size[image_profile,1024]|is_image[image_profile]|mime_in[image_profile,image/jpg,image/jpeg,image/png]',
						'errors'    => [
							'max_size' => 'File maximal 1MB',
							'is_image' => 'Yang anda upload bukan gambar',
							'mime_in'  => 'Yang anda upload bukan gambar'
						]
					]
				])) {
					return redirect()->to('/admin/update_profile')->withInput();
				}
			} else {
				if (!$this->validate([
					'email'     => [
						'rules'     => 'is_unique[t_account.email]',
						'errors'    => [
							'is_unique' => '{field} seller harus berbeda'
						]
					],
					'image_profile' => [
						'rules'     => 'max_size[image_profile,1024]|is_image[image_profile]|mime_in[image_profile,image/jpg,image/jpeg,image/png]',
						'errors'    => [
							'max_size' => 'File maximal 1MB',
							'is_image' => 'Yang anda upload bukan gambar',
							'mime_in'  => 'Yang anda upload bukan gambar'
						]
					]
				])) {
					return redirect()->to('/admin/update_profile')->withInput();
				}
			}
		} elseif ($update['email'] == $update['emailasli']) {
			if (!$this->validate([
				'username'     => [
					'rules'     => 'is_unique[t_account.username]',
					'errors'    => [
						'is_unique' => '{field} seller harus berbeda'
					]
				],
				'image_profile' => [
					'rules'     => 'max_size[image_profile,1024]|is_image[image_profile]|mime_in[image_profile,image/jpg,image/jpeg,image/png]',
					'errors'    => [
						'max_size' => 'File maximal 1MB',
						'is_image' => 'Yang anda upload bukan gambar',
						'mime_in'  => 'Yang anda upload bukan gambar'
					]
				]
			])) {
				return redirect()->to('/admin/update_profile')->withInput();
			}
		} else {
			if (!$this->validate([
				'email'     => [
					'rules'     => 'is_unique[t_account.email]',
					'errors'    => [
						'is_unique' => '{field} seller harus berbeda'
					]
				],
				'username'  => [
					'rules'     => 'is_unique[t_account.username]',
					'errors'    => [
						'is_unique' => '{field} seller harus berbeda'
					]
				],
				'image_profile' => [
					'rules'     => 'max_size[image_profile,1024]|is_image[image_profile]|mime_in[image_profile,image/jpg,image/jpeg,image/png]',
					'errors'    => [
						'max_size' => 'File maximal 1MB',
						'is_image' => 'Yang anda upload bukan gambar',
						'mime_in'  => 'Yang anda upload bukan gambar'
					]
				]
			])) {
				return redirect()->to('/admin/update_profile')->withInput();
			}
		}
		//-------------------------- end validation ------------------------------
		//ambil profile
		$image_profile = $this->request->getFile('image_profile');
		if ($image_profile->getError() == 4) {
			$name_profile = $update['image_profile_lama'];
		} else {
			if ($update['image_profile_lama'] != 'default.jpg') {
				if ($update['image_profile_lama'] != null) {
					unlink('assets/image/profile/' . $update['image_profile_lama']);
				}
			}
			//ambil nama file profile
			$name_profile = $image_profile->getRandomName();
			//pindahkan profile
			$image_profile->move('assets/image/profile', $name_profile);
		}
		$update['telp'] = '0' . $update['telp'];
		$data = [
			'id'            => $update['id'],
			'slug'			=> url_title($update['full_name'] . '_telp-' . $update['telp'], '-', true),
			'full_name'     => $update['full_name'],
			'username'      => $update['username'],
			'email'         => $update['email'],
			'telp'          => $update['telp'],
			'address'       => $update['alamat'],
			'image_profile' => $name_profile
		];
		$this->user->save($data);
		return redirect()->to('/admin/profile');
	}



	//------------------------- function update password -------------------------
	public function function_updatepassword()
	{
		$update = $this->request->getPost();
		$validation = $this->user->select('password')->where('id', session()->get('id'))->first();
		if ($update['password1'] != $validation['password']) {
			$error = "Password lama tidak sesuai !";
			session()->setFlashdata('validation_lama', $error);
			return redirect()->to('/admin/update_password');
		}
		if ($update['password2'] != $update['password3']) {
			$error = "Password baru tidak sama !";
			session()->setFlashdata('validation_baru', $error);
			return redirect()->to('/admin/update_password');
		}
		$data = [
			'id'        => session()->get('id'),
			'password'  => $update['password3']
		];
		$this->user->save($data);
		return redirect()->to('/admin/profile');
	}



	////////////////////////////////////////////////////////////////////////////////////////
	//------------------------------ Keanggotaan Non-fuzzy -------------------------------//
	//------------------------------         MEREK         -------------------------------//
	////////////////////////////////////////////////////////////////////////////////////////

	// Fungsi keanggotaan non-fuzzy jenis merek
	public function jenis_merek()
	{
		$session = session();
		//-------------------Validasi GET----------------------- 
		$CURRENT = $this->request->getVar('page_t_jenis_merek') ? $this->request->getVar('page_t_jenis_merek') : 1;
		//-------------Jumlah data di dalam table---------------
		$data_inpage = 4;
		//------------------------------------------------------
		$keyword = $this->request->getVar('key_merek');
		if ($keyword) {
			$session->set(['key_merek' => $keyword]);
			$data_non_fuzzy = $this->merek->pagination_find($keyword);
		} else if (session()->get('key_merek') != Null) {
			$data_non_fuzzy = $this->merek->pagination_find(session()->get('key_merek'));
		} else {
			$data_non_fuzzy = $this->merek->pagination_all();
		}

		$data = [
			'data_non_fuzzy'	=> $data_non_fuzzy->paginate($data_inpage, 't_jenis_merek'),
			'pager'				=> $this->merek->pager,
			'CURRENT'       	=> $CURRENT,
			'data_inpage'     	=> $data_inpage,
			'validation' => \Config\Services::validation()

		];
		return view('Admin/nonFuzzy/jenis_merek', $data);
	}


	// hapus search merek
	public function d_merek()
	{
		$session = session();
		$session->remove('key_merek');
		return redirect()->to('/admin/jenis_merek');
	}


	// add merek 
	public function add_merek()
	{
		$getPost = $this->request->getPost();
		if ($getPost == null) {
			return redirect()->to('/admin/jenis_merek');
		}
		////////////////   Validasi Image  ///////////////////
		if (!$this->validate([
			'image_merek_insert' => [
				'rules'     => 'max_size[image_merek_insert,1024]|is_image[image_merek_insert]|mime_in[image_merek_insert,image/jpg,image/jpeg,image/png]',
				'errors'    => [
					'max_size' => 'File maximal 1MB',
					'is_image' => 'Yang anda upload bukan gambar',
					'mime_in'  => 'Yang anda upload bukan gambar'
				]
			],
		])) {
			return redirect()->to('/admin/jenis_merek')->withInput();
		}

		/////////////////// Get image post ////////////////////
		$image1 = $this->request->getFile('image_merek_insert');
		///////////////////////////////////////////////////////

		//------    Validation image ada atau tidak   -------//
		if ($image1->getError() == 4) {
			$name_image1 = 'default.jpg';
		} else {
			//ambil nama file image merek
			$name_image1 = $image1->getRandomName();
		}
		//---------------------------------------------------//

		$data = [
			'nama_merek' => $getPost['tambahkan'],
			'logo_img'	 => $name_image1,
		];
		$this->merek->save($data);
		$merekUp = $this->merek->select('id, nama_merek')->where("nama_merek='" . $getPost['tambahkan'] . "' AND logo_img='" . $name_image1 . "'")->findAll();
		$data = [
			'id' => $merekUp[0]['id'],
			'nama_merek' => $getPost['tambahkan'],
			'logo_img'	 => $name_image1,
			'slug' => url_title($merekUp[0]['nama_merek'] . '_url-by-' . $merekUp[0]['id'], '_', true),
		];
		$this->merek->save($data);
		if ($name_image1 != 'default.jpg') {
			//pindahkan file image merek
			$image1->move('assets/image/merek/', $name_image1);
		}
		$data_validate = 'data merek ' . $getPost['tambahkan'] . ' sudah di tambahkan...';
		session()->setFlashdata('true', $data_validate);
		return redirect()->to('/admin/jenis_merek');
	}


	// update merek 
	public function update_merek()
	{
		$getPost = $this->request->getPost();
		if ($getPost == null) {
			return redirect()->to('/admin/jenis_merek');
		}

		////////////////   Validasi Image  ///////////////////
		if (!$this->validate([
			'image_merek_update_' . $getPost['col'] => [
				'rules'     => 'max_size[image_merek_update_' . $getPost['col'] . ',1024]|is_image[image_merek_update_' . $getPost['col'] . ']|mime_in[image_merek_update_' . $getPost['col'] . ',image/jpg,image/jpeg,image/png]',
				'errors'    => [
					'max_size' => 'File maximal 1MB',
					'is_image' => 'Yang anda upload bukan gambar',
					'mime_in'  => 'Yang anda upload bukan gambar'
				]
			],
		])) {
			return redirect()->to('/admin/jenis_merek?page_t_jenis_merek=' . $getPost['laman'])->withInput();
		}

		/////////////////// Get image post ////////////////////
		$image1 = $this->request->getFile('image_merek_update_' . $getPost['col']);
		///////////////////////////////////////////////////////

		//------    Validation image ada atau tidak   -------//
		if ($image1->getError() == 4) {
			$name_image1 = $getPost['img_lawas'];
		} else {
			//ambil nama file image merek
			$name_image1 = $image1->getRandomName();
		}
		//---------------------------------------------------//

		$data = [
			'id'		=> $getPost['id'],
			'slug' 		=> url_title($getPost['nama_merek'] . '_url-by-' . $getPost['id'], '_', true),
			'nama_merek' => $getPost['nama_merek'],
			'logo_img'	 => $name_image1,
		];
		$this->merek->save($data);
		if ($name_image1 != $getPost['img_lawas']) {
			//pindahkan file image merek
			$image1->move('assets/image/merek/', $name_image1);
			if ($getPost['img_lawas'] != null || $getPost['img_lawas'] != 'default.png') {
				unlink('assets/image/merek/' . $getPost['img_lawas']);
			}
		}
		$data_validate = 'data merek ' . $getPost['nama_merek_lama'] . ' sudah di update menjadi ' . $getPost['nama_merek'] . '...';
		session()->setFlashdata('true', $data_validate);
		return redirect()->to('/admin/jenis_merek');
	}


	// delete merek
	public function delete_merek()
	{
		$getPost = $this->request->getPost();
		if ($getPost == null) {
			return redirect()->to('/admin/jenis_merek');
		}
		$this->merek->delete_data($getPost['id']);
		if ($getPost['img_lawas'] != null || $getPost['img_lawas'] != 'default.png') {
			unlink('assets/image/merek/' . $getPost['img_lawas']);
		}
		$data_validate = 'data merek ' . $getPost['nama_merek_lama'] . ' sudah di hapus...';
		session()->setFlashdata('msg', $data_validate);
		return redirect()->to('/admin/jenis_merek');
	}


	////////////////////////////////////////////////////////////////////////////////////////
	//------------------------------ Keanggotaan Non-fuzzy -------------------------------//
	//------------------------------         UI OS         -------------------------------//
	////////////////////////////////////////////////////////////////////////////////////////

	// Fungsi keanggotaan non-fuzzy jenis ui_hp
	public function jenis_ui_os()
	{
		$session = session();
		//-------------------Validasi GET----------------------- 
		$CURRENT = $this->request->getVar('page_t_jenis_ui_os') ? $this->request->getVar('page_t_jenis_ui_os') : 1;
		//-------------Jumlah data di dalam table---------------
		$data_inpage = 4;
		//------------------------------------------------------
		$keyword = $this->request->getVar('key_ui_os');
		if ($keyword) {
			$session->set(['key_ui_os' => $keyword]);
			$data_non_fuzzy = $this->ui_hp->pagination_find($keyword);
		} else if (session()->get('key_ui_os') != Null) {
			$data_non_fuzzy = $this->ui_hp->pagination_find(session()->get('key_ui_os'));
		} else {
			$data_non_fuzzy = $this->ui_hp->pagination_all();
		}

		$data = [
			'data_non_fuzzy'	=> $data_non_fuzzy->paginate($data_inpage, 't_jenis_ui_os'),
			'pager'				=> $this->ui_hp->pager,
			'CURRENT'       	=> $CURRENT,
			'data_inpage'     	=> $data_inpage,
		];
		return view('Admin/nonFuzzy/jenis_ui_os', $data);
	}


	// hapus search ui os
	public function d_ui_os()
	{
		$session = session();
		$session->remove('key_ui_os');
		return redirect()->to('/admin/jenis_ui_os');
	}


	// add ui os 
	public function add_ui_os()
	{
		$getPost = $this->request->getPost();
		if ($getPost == null) {
			return redirect()->to('/admin/jenis_ui_os');
		}
		$data = [
			'nama_ui_os' => $getPost['tambahkan'],
		];
		$this->ui_hp->save($data);
		$data_validate = 'data UI OS ' . $getPost['tambahkan'] . ' sudah di tambahkan...';
		session()->setFlashdata('true', $data_validate);
		return redirect()->to('/admin/jenis_ui_os');
	}


	// update ui os 
	public function update_ui_os()
	{
		$getPost = $this->request->getPost();
		if ($getPost == null) {
			return redirect()->to('/admin/jenis_ui_os');
		}
		$data = [
			'id'		=> $getPost['id'],
			'nama_ui_os' => $getPost['nama_ui_os'],
		];
		$this->ui_hp->save($data);
		$data_validate = 'data UI OS ' . $getPost['nama_ui_os_lama'] . ' sudah di update menjadi ' . $getPost['nama_ui_os'] . '...';
		session()->setFlashdata('true', $data_validate);
		return redirect()->to('/admin/jenis_ui_os');
	}


	// delete ui os
	public function delete_ui_os()
	{
		$getPost = $this->request->getPost();
		if ($getPost == null) {
			return redirect()->to('/admin/jenis_ui_os');
		}
		$this->ui_hp->delete_data($getPost['id']);
		$data_validate = 'data UI OS ' . $getPost['nama_ui_os_lama'] . ' sudah di hapus...';
		session()->setFlashdata('msg', $data_validate);
		return redirect()->to('/admin/jenis_ui_os');
	}


	////////////////////////////////////////////////////////////////////////////////////////
	//------------------------------ Keanggotaan Non-fuzzy -------------------------------//
	//------------------------------      Jenis Layar      -------------------------------//
	////////////////////////////////////////////////////////////////////////////////////////


	// Fungsi keanggotaan non-fuzzy jenis layar
	public function jenis_layar()
	{
		$session = session();
		//-------------------Validasi GET----------------------- 
		$CURRENT = $this->request->getVar('page_t_jenis_layar') ? $this->request->getVar('page_t_jenis_layar') : 1;
		//-------------Jumlah data di dalam table---------------
		$data_inpage = 4;
		//------------------------------------------------------
		$keyword = $this->request->getVar('key_layar');
		if ($keyword) {
			$session->set(['key_layar' => $keyword]);
			$data_non_fuzzy = $this->jenis_layar->pagination_find($keyword);
		} else if (session()->get('key_layar') != Null) {
			$data_non_fuzzy = $this->jenis_layar->pagination_find(session()->get('key_layar'));
		} else {
			$data_non_fuzzy = $this->jenis_layar->pagination_all();
		}

		$data = [
			'data_non_fuzzy'	=> $data_non_fuzzy->paginate($data_inpage, 't_jenis_layar'),
			'pager'				=> $this->jenis_layar->pager,
			'CURRENT'       	=> $CURRENT,
			'data_inpage'     	=> $data_inpage,
		];
		return view('Admin/nonFuzzy/jenis_layar', $data);
	}


	// hapus search Jenis Layar
	public function d_layar()
	{
		$session = session();
		$session->remove('key_layar');
		return redirect()->to('/admin/jenis_layar');
	}


	// add jenis layar
	public function add_layar()
	{
		$getPost = $this->request->getPost();
		if ($getPost == null) {
			return redirect()->to('/admin/jenis_layar');
		}
		$data = [
			'nama_jenis_layar' => $getPost['tambahkan'],
		];
		$this->jenis_layar->save($data);
		$data_validate = 'data jenis layar ' . $getPost['tambahkan'] . ' sudah di tambahkan...';
		session()->setFlashdata('true', $data_validate);
		return redirect()->to('/admin/jenis_layar');
	}


	// update jenis layar 
	public function update_layar()
	{
		$getPost = $this->request->getPost();
		if ($getPost == null) {
			return redirect()->to('/admin/jenis_layar');
		}
		$data = [
			'id'		=> $getPost['id'],
			'nama_jenis_layar' => $getPost['nama_layar'],
		];
		$this->jenis_layar->save($data);
		$data_validate = 'data jenis layar ' . $getPost['nama_layar_lama'] . ' sudah di update menjadi ' . $getPost['nama_layar'] . '...';
		session()->setFlashdata('true', $data_validate);
		return redirect()->to('/admin/jenis_layar');
	}


	// delete jenis Layar
	public function delete_layar()
	{
		$getPost = $this->request->getPost();
		if ($getPost == null) {
			return redirect()->to('/admin/jenis_layar');
		}
		$this->jenis_layar->delete_data($getPost['id']);
		$data_validate = 'data jenis layar ' . $getPost['nama_layar_lama'] . ' sudah di hapus...';
		session()->setFlashdata('msg', $data_validate);
		return redirect()->to('/admin/jenis_layar');
	}


	////////////////////////////////////////////////////////////////////////////////////////
	//------------------------------ Keanggotaan Non-fuzzy -------------------------------//
	//------------------------------     Protect Layar     -------------------------------//
	////////////////////////////////////////////////////////////////////////////////////////


	// Fungsi keanggotaan non-fuzzy Protect Layar
	public function jenis_protect_layar()
	{
		$session = session();
		//-------------------Validasi GET----------------------- 
		$CURRENT = $this->request->getVar('page_t_jenis_protect_layar') ? $this->request->getVar('page_t_jenis_protect_layar') : 1;
		//-------------Jumlah data di dalam table---------------
		$data_inpage = 4;
		//------------------------------------------------------
		$keyword = $this->request->getVar('key_protect_layar');
		if ($keyword) {
			$session->set(['key_protect_layar' => $keyword]);
			$data_non_fuzzy = $this->pelindung_layar->pagination_find($keyword);
		} else if (session()->get('key_protect_layar') != Null) {
			$data_non_fuzzy = $this->pelindung_layar->pagination_find(session()->get('key_protect_layar'));
		} else {
			$data_non_fuzzy = $this->pelindung_layar->pagination_all();
		}

		$data = [
			'data_non_fuzzy'	=> $data_non_fuzzy->paginate($data_inpage, 't_jenis_protect_layar'),
			'pager'				=> $this->pelindung_layar->pager,
			'CURRENT'       	=> $CURRENT,
			'data_inpage'     	=> $data_inpage,
		];
		return view('Admin/nonFuzzy/jenis_protect_layar', $data);
	}


	// hapus search Protect Layar
	public function d_protect_layar()
	{
		$session = session();
		$session->remove('key_protect_layar');
		return redirect()->to('/admin/jenis_protect_layar');
	}


	// add protect layar
	public function add_protect_layar()
	{
		$getPost = $this->request->getPost();
		if ($getPost == null) {
			return redirect()->to('/admin/jenis_protect_layar');
		}
		if ($getPost['tambahkan'] == null) {
			session()->setFlashdata('validation', 'kosong');
			return redirect()->to('/admin/jenis_protect_layar');
		}
		$data = [
			'nama_protect_layar' => $getPost['tambahkan'],
		];
		$this->pelindung_layar->save($data);
		$data_validate = 'data protect layar ' . $getPost['tambahkan'] . ' sudah di tambahkan...';
		session()->setFlashdata('true', $data_validate);
		return redirect()->to('/admin/jenis_protect_layar');
	}


	// update protect layar 
	public function update_protect_layar()
	{
		$getPost = $this->request->getPost();
		if ($getPost == null) {
			return redirect()->to('/admin/jenis_protect_layar');
		}
		$data = [
			'id'		=> $getPost['id'],
			'nama_protect_layar' => $getPost['nama_protect_layar'],
		];
		$this->pelindung_layar->save($data);
		$data_validate = 'data protect layar ' . $getPost['nama_protect_layar_lama'] . ' sudah di update menjadi ' . $getPost['nama_protect_layar'] . '...';
		session()->setFlashdata('true', $data_validate);
		return redirect()->to('/admin/jenis_protect_layar');
	}


	// delete protect layar
	public function delete_protect_layar()
	{
		$getPost = $this->request->getPost();
		if ($getPost == null) {
			return redirect()->to('/admin/jenis_protect_layar');
		}
		$this->pelindung_layar->delete_data($getPost['id']);
		$data_validate = 'data protect layar ' . $getPost['nama_protect_layar_lama'] . ' sudah di hapus...';
		session()->setFlashdata('msg', $data_validate);
		return redirect()->to('/admin/jenis_protect_layar');
	}


	////////////////////////////////////////////////////////////////////////////////////////
	//------------------------------ Keanggotaan Non-fuzzy -------------------------------//
	//------------------------------    Jenis Bahan Body   -------------------------------//
	////////////////////////////////////////////////////////////////////////////////////////


	// Fungsi keanggotaan non-fuzzy jenis bahan body
	public function jenis_bahan_body()
	{
		$session = session();
		//-------------------Validasi GET----------------------- 
		$CURRENT = $this->request->getVar('page_t_jenis_bahan_body') ? $this->request->getVar('page_t_jenis_bahan_body') : 1;
		//-------------Jumlah data di dalam table---------------
		$data_inpage = 4;
		//------------------------------------------------------
		$keyword = $this->request->getVar('key_bahan_body');
		if ($keyword) {
			$session->set(['key_bahan_body' => $keyword]);
			$data_non_fuzzy = $this->bahan_body->pagination_find($keyword);
		} else if (session()->get('key_bahan_body') != Null) {
			$data_non_fuzzy = $this->bahan_body->pagination_find(session()->get('key_bahan_body'));
		} else {
			$data_non_fuzzy = $this->bahan_body->pagination_all();
		}

		$data = [
			'data_non_fuzzy'	=> $data_non_fuzzy->paginate($data_inpage, 't_jenis_bahan_body'),
			'pager'				=> $this->bahan_body->pager,
			'CURRENT'       	=> $CURRENT,
			'data_inpage'     	=> $data_inpage,
		];
		return view('Admin/nonFuzzy/jenis_bahan_body', $data);
	}


	// hapus search Jenis bahan_body
	public function d_bahan_body()
	{
		$session = session();
		$session->remove('key_bahan_body');
		return redirect()->to('/admin/jenis_bahan_body');
	}


	// add jenis bahan_body
	public function add_bahan_body()
	{
		$getPost = $this->request->getPost();
		if ($getPost == null) {
			return redirect()->to('/admin/jenis_bahan_body');
		}
		$data = [
			'nama_bahan_body' => $getPost['tambahkan'],
		];
		$this->bahan_body->save($data);
		$data_validate = 'data bahan body ' . $getPost['tambahkan'] . ' sudah di tambahkan...';
		session()->setFlashdata('true', $data_validate);
		return redirect()->to('/admin/jenis_bahan_body');
	}


	// update jenis bahan_body 
	public function update_bahan_body()
	{
		$getPost = $this->request->getPost();
		if ($getPost == null) {
			return redirect()->to('/admin/jenis_bahan_body');
		}
		$data = [
			'id'		=> $getPost['id'],
			'nama_bahan_body' => $getPost['nama_bahan_body'],
		];
		$this->bahan_body->save($data);
		$data_validate = 'data bahan body ' . $getPost['nama_bahan_body_lama'] . ' sudah di update menjadi ' . $getPost['nama_bahan_body'] . '...';
		session()->setFlashdata('true', $data_validate);
		return redirect()->to('/admin/jenis_bahan_body');
	}


	// delete jenis bahan_body
	public function delete_bahan_body()
	{
		$getPost = $this->request->getPost();
		if ($getPost == null) {
			return redirect()->to('/admin/jenis_bahan_body');
		}
		$this->bahan_body->delete_data($getPost['id']);
		$data_validate = 'data bahan_body ' . $getPost['nama_bahan_body_lama'] . ' sudah di hapus...';
		session()->setFlashdata('msg', $data_validate);
		return redirect()->to('/admin/jenis_bahan_body');
	}



	////////////////////////////////////////////////////////////////////////////////////////
	//------------------------------ Keanggotaan Non-fuzzy -------------------------------//
	//------------------------------       Processor       -------------------------------//
	////////////////////////////////////////////////////////////////////////////////////////

	// Fungsi keanggotaan non-fuzzy jenis processor
	public function jenis_chipset()
	{
		$session = session();
		//-------------------Validasi GET----------------------- 
		$CURRENT = $this->request->getVar('page_t_jenis_chipset') ? $this->request->getVar('page_t_jenis_chipset') : 1;
		//-------------Jumlah data di dalam table---------------
		$data_inpage = 4;
		//------------------------------------------------------
		$keyword = $this->request->getVar('key_chipset');
		if ($keyword) {
			$session->set(['key_chipset' => $keyword]);
			$data_non_fuzzy = $this->processor->pagination_find($keyword);
		} else if (session()->get('key_chipset') != Null) {
			$data_non_fuzzy = $this->processor->pagination_find(session()->get('key_chipset'));
		} else {
			$data_non_fuzzy = $this->processor->pagination_all();
		}

		$data = [
			'data_non_fuzzy'	=> $data_non_fuzzy->paginate($data_inpage, 't_jenis_chipset'),
			'pager'				=> $this->processor->pager,
			'CURRENT'       	=> $CURRENT,
			'data_inpage'     	=> $data_inpage,
		];
		return view('Admin/nonFuzzy/jenis_chipset', $data);
	}


	// hapus search chipset processor
	public function d_chipset()
	{
		$session = session();
		$session->remove('key_chipset');
		return redirect()->to('/admin/jenis_chipset');
	}


	// add chipset processor
	public function add_chipset()
	{
		$getPost = $this->request->getPost();
		if ($getPost == null) {
			return redirect()->to('/admin/jenis_chipset');
		}
		$data = [
			'nama_chipset' => $getPost['tambahkan'],
		];
		$this->processor->save($data);
		$data_validate = 'data chipset processor' . $getPost['tambahkan'] . ' sudah di tambahkan...';
		session()->setFlashdata('true', $data_validate);
		return redirect()->to('/admin/jenis_chipset');
	}


	// update chipset processor
	public function update_chipset()
	{
		$getPost = $this->request->getPost();
		if ($getPost == null) {
			return redirect()->to('/admin/jenis_chipset');
		}
		$data = [
			'id'		=> $getPost['id'],
			'nama_chipset' => $getPost['nama_chipset'],
		];
		$this->processor->save($data);
		$data_validate = 'data chipset ' . $getPost['nama_chipset_lama'] . ' sudah di update menjadi ' . $getPost['nama_chipset'] . '...';
		session()->setFlashdata('true', $data_validate);
		return redirect()->to('/admin/jenis_chipset');
	}


	// delete chipset processor
	public function delete_chipset()
	{
		$getPost = $this->request->getPost();
		if ($getPost == null) {
			return redirect()->to('/admin/jenis_chipset');
		}
		$this->processor->delete_data($getPost['id']);
		$data_validate = 'data chipset ' . $getPost['nama_chipset_lama'] . ' sudah di hapus...';
		session()->setFlashdata('msg', $data_validate);
		return redirect()->to('/admin/jenis_chipset');
	}



	////////////////////////////////////////////////////////////////////////////////////////
	//------------------------------ Keanggotaan Non-fuzzy -------------------------------//
	//------------------------------          GPU          -------------------------------//
	////////////////////////////////////////////////////////////////////////////////////////

	// Fungsi keanggotaan non-fuzzy jenis gpu
	public function jenis_gpu()
	{
		$session = session();
		//-------------------Validasi GET----------------------- 
		$CURRENT = $this->request->getVar('page_t_jenis_gpu') ? $this->request->getVar('page_t_jenis_gpu') : 1;
		//-------------Jumlah data di dalam table---------------
		$data_inpage = 4;
		//------------------------------------------------------
		$keyword = $this->request->getVar('key_gpu');
		if ($keyword) {
			$session->set(['key_gpu' => $keyword]);
			$data_non_fuzzy = $this->gpu->pagination_find($keyword);
		} else if (session()->get('key_gpu') != Null) {
			$data_non_fuzzy = $this->gpu->pagination_find(session()->get('key_gpu'));
		} else {
			$data_non_fuzzy = $this->gpu->pagination_all();
		}

		$data = [
			'data_non_fuzzy'	=> $data_non_fuzzy->paginate($data_inpage, 't_jenis_gpu'),
			'pager'				=> $this->gpu->pager,
			'CURRENT'       	=> $CURRENT,
			'data_inpage'     	=> $data_inpage,
		];
		return view('Admin/nonFuzzy/jenis_gpu', $data);
	}


	// hapus search gpu
	public function d_gpu()
	{
		$session = session();
		$session->remove('key_gpu');
		return redirect()->to('/admin/jenis_gpu');
	}


	// add gpu 
	public function add_gpu()
	{
		$getPost = $this->request->getPost();
		if ($getPost == null) {
			return redirect()->to('/admin/jenis_gpu');
		}
		$data = [
			'nama_gpu' => $getPost['tambahkan'],
		];
		$this->gpu->save($data);
		$data_validate = 'data gpu ' . $getPost['tambahkan'] . ' sudah di tambahkan...';
		session()->setFlashdata('true', $data_validate);
		return redirect()->to('/admin/jenis_gpu');
	}


	// update gpu 
	public function update_gpu()
	{
		$getPost = $this->request->getPost();
		if ($getPost == null) {
			return redirect()->to('/admin/jenis_gpu');
		}
		$data = [
			'id'		=> $getPost['id'],
			'nama_gpu' => $getPost['nama_gpu'],
		];
		$this->gpu->save($data);
		$data_validate = 'data gpu ' . $getPost['nama_gpu_lama'] . ' sudah di update menjadi ' . $getPost['nama_gpu'] . '...';
		session()->setFlashdata('true', $data_validate);
		return redirect()->to('/admin/jenis_gpu');
	}


	// delete gpu
	public function delete_gpu()
	{
		$getPost = $this->request->getPost();
		if ($getPost == null) {
			return redirect()->to('/admin/jenis_gpu');
		}
		$this->gpu->delete_data($getPost['id']);
		$data_validate = 'data gpu ' . $getPost['nama_gpu_lama'] . ' sudah di hapus...';
		session()->setFlashdata('msg', $data_validate);
		return redirect()->to('/admin/jenis_gpu');
	}


	////////////////////////////////////////////////////////////////////////////////////////
	//------------------------------ Keanggotaan Non-fuzzy -------------------------------//
	//------------------------------          USB          -------------------------------//
	////////////////////////////////////////////////////////////////////////////////////////

	// Fungsi keanggotaan non-fuzzy jenis usb
	public function jenis_usb()
	{
		$session = session();
		//-------------------Validasi GET----------------------- 
		$CURRENT = $this->request->getVar('page_t_jenis_usb') ? $this->request->getVar('page_t_jenis_usb') : 1;
		//-------------Jumlah data di dalam table---------------
		$data_inpage = 4;
		//------------------------------------------------------
		$keyword = $this->request->getVar('key_usb');
		if ($keyword) {
			$session->set(['key_usb' => $keyword]);
			$data_non_fuzzy = $this->usb_tipe->pagination_find($keyword);
		} else if (session()->get('key_usb') != Null) {
			$data_non_fuzzy = $this->usb_tipe->pagination_find(session()->get('key_usb'));
		} else {
			$data_non_fuzzy = $this->usb_tipe->pagination_all();
		}

		$data = [
			'data_non_fuzzy'	=> $data_non_fuzzy->paginate($data_inpage, 't_jenis_usb'),
			'pager'				=> $this->usb_tipe->pager,
			'CURRENT'       	=> $CURRENT,
			'data_inpage'     	=> $data_inpage,
		];
		return view('Admin/nonFuzzy/jenis_usb', $data);
	}


	// hapus search usb
	public function d_usb()
	{
		$session = session();
		$session->remove('key_usb');
		return redirect()->to('/admin/jenis_usb');
	}


	// add usb 
	public function add_usb()
	{
		$getPost = $this->request->getPost();
		if ($getPost == null) {
			return redirect()->to('/admin/jenis_usb');
		}
		$data = [
			'nama_usb' => $getPost['tambahkan'],
		];
		$this->usb_tipe->save($data);
		$data_validate = 'data USB ' . $getPost['tambahkan'] . ' sudah di tambahkan...';
		session()->setFlashdata('true', $data_validate);
		return redirect()->to('/admin/jenis_usb');
	}


	// update usb 
	public function update_usb()
	{
		$getPost = $this->request->getPost();
		if ($getPost == null) {
			return redirect()->to('/admin/jenis_usb');
		}
		$data = [
			'id'		=> $getPost['id'],
			'nama_usb' => $getPost['nama_usb'],
		];
		$this->usb_tipe->save($data);
		$data_validate = 'data USB ' . $getPost['nama_usb_lama'] . ' sudah di update menjadi ' . $getPost['nama_usb'] . '...';
		session()->setFlashdata('true', $data_validate);
		return redirect()->to('/admin/jenis_usb');
	}


	// delete usb
	public function delete_usb()
	{
		$getPost = $this->request->getPost();
		if ($getPost == null) {
			return redirect()->to('/admin/jenis_usb');
		}
		$this->usb_tipe->delete_data($getPost['id']);
		$data_validate = 'data USB ' . $getPost['nama_usb_lama'] . ' sudah di hapus...';
		session()->setFlashdata('msg', $data_validate);
		return redirect()->to('/admin/jenis_usb');
	}


	///////////////////////////////////////////////////////////////////////////////////
	//--------------------------    Fungsi Keanggotaan    ---------------------------//
	//--------------------------           Harga          ---------------------------//
	///////////////////////////////////////////////////////////////////////////////////


	public function keanggotaan_harga()
	{
		session();
		$fk_harga   	= $this->fk_harga->findAll();
		$fk             = $this->fk->findAll();
		$data = [
			'fungsi_keanggotaan' => $fk,
			'fk_harga'       => $fk_harga
		];
		return view('Admin/Fuzzy/keanggotaan_harga', $data);
	}



	public function update_fk_harga()
	{
		$post = $this->request->getPost();
		if ($post == null) {
			return redirect()->to('/admin/keanggotaan_harga');
		}
		//validasi struktur nilai fungsi keaanggotaan
		for ($i = 1; $i <= $post['row']; $i++) {
			if ($post['ket_aktif' . $i] == 'true') {
				if ($post['fungsi_keanggotaan' . $i] == 3 || $post['fungsi_keanggotaan' . $i] == 6) {
					if ($post['batas_bawah' . $i] >= $post['batas_tengah' . $i] || $post['batas_atas' . $i] <= $post['batas_tengah' . $i] || $post['batas_atas' . $i] <= $post['batas_bawah' . $i]) {
						//kondisi Salah
						session()->setFlashdata('1warning' . $i, 'data tidak dapat di proses');
						return redirect()->to('/admin/keanggotaan_harga')->withInput();
					}
				} else {
					if ($post['batas_bawah' . $i] >= $post['batas_atas' . $i]) {
						//kondisi Salah
						session()->setFlashdata('warning' . $i, 'data tidak dapat di proses');
						return redirect()->to('/admin/keanggotaan_harga')->withInput();
					}
				}
			}
		}
		//input update ke table fk_harga
		for ($a = 1; $a <= $post['row']; $a++) {
			if ($post['ket_aktif' . $a] == 'true') {
				if ($post['fungsi_keanggotaan' . $a] == 3 || $post['fungsi_keanggotaan' . $a] == 6) {
					$data = [
						'id'		=> $post['id' . $a],
						'kd_rules'      => $post['fungsi_keanggotaan' . $a],
						'ket_status'    => $post['himpunan' . $a],
						'batas_bawah'   => $post['batas_bawah' . $a],
						'batas_tengah'  => $post['batas_tengah' . $a],
						'batas_atas'    => $post['batas_atas' . $a],
						'ket_aktif'     => $post['ket_aktif' . $a]

					];
				} else {
					$data = [
						'id'		=> $post['id' . $a],
						'kd_rules'      => $post['fungsi_keanggotaan' . $a],
						'ket_status'    => $post['himpunan' . $a],
						'batas_bawah'   => $post['batas_bawah' . $a],
						'batas_tengah'  => 0,
						'batas_atas'    => $post['batas_atas' . $a],
						'ket_aktif'     => $post['ket_aktif' . $a]

					];
				}
			} else {
				$data = [
					'id'		=> $post['id' . $a],
					'kd_rules'      => 1,
					'ket_status'    => '',
					'batas_bawah'   => 0,
					'batas_tengah'  => 0,
					'batas_atas'    => 0,
					'ket_aktif'     => $post['ket_aktif' . $a]

				];
			}
			$this->fk_harga->save($data);
		}
		$this->nilai_fk_harga->truncate();
		$batas_keanggotaan = $this->fk_harga->where('ket_aktif', 'true')->findAll();
		$data_smartphone = $this->smartphone->select('id, harga')->findAll();
		foreach ($data_smartphone as $smartphone) {
			$this->nilai_fk_harga->Hitung_fk($smartphone['id'], $smartphone['harga'], $batas_keanggotaan);
		}
		return redirect()->to('/admin/keanggotaan_harga');
	}


	///////////////////////////////////////////////////////////////////////////////////
	//--------------------------    Fungsi Keanggotaan    ---------------------------//
	//--------------------------           Tahun          ---------------------------//
	///////////////////////////////////////////////////////////////////////////////////


	public function keanggotaan_tahun()
	{
		session();
		$fk_tahun   	= $this->fk_tahun->findAll();
		$fk             = $this->fk->findAll();
		$data = [
			'fungsi_keanggotaan' => $fk,
			'fk_tahun'       => $fk_tahun
		];
		return view('Admin/Fuzzy/keanggotaan_tahun', $data);
	}



	public function update_fk_tahun()
	{
		$post = $this->request->getPost();
		if ($post == null) {
			return redirect()->to('/admin/keanggotaan_tahun');
		}
		//validasi struktur nilai fungsi keaanggotaan
		for ($i = 1; $i <= $post['row']; $i++) {
			if ($post['ket_aktif' . $i] == 'true') {
				if ($post['fungsi_keanggotaan' . $i] == 3 || $post['fungsi_keanggotaan' . $i] == 6) {
					if ($post['batas_bawah' . $i] >= $post['batas_tengah' . $i] || $post['batas_atas' . $i] <= $post['batas_tengah' . $i] || $post['batas_atas' . $i] <= $post['batas_bawah' . $i]) {
						//kondisi Salah
						session()->setFlashdata('1warning' . $i, 'data tidak dapat di proses');
						return redirect()->to('/admin/keanggotaan_tahun')->withInput();
					}
				} else {
					if ($post['batas_bawah' . $i] >= $post['batas_atas' . $i]) {
						//kondisi Salah
						session()->setFlashdata('warning' . $i, 'data tidak dapat di proses');
						return redirect()->to('/admin/keanggotaan_tahun')->withInput();
					}
				}
			}
		}
		//input update ke table fk_tahun
		for ($a = 1; $a <= $post['row']; $a++) {
			if ($post['ket_aktif' . $a] == 'true') {
				if ($post['fungsi_keanggotaan' . $a] == 3 || $post['fungsi_keanggotaan' . $a] == 6) {
					$data = [
						'id'		=> $post['id' . $a],
						'kd_rules'      => $post['fungsi_keanggotaan' . $a],
						'ket_status'    => $post['himpunan' . $a],
						'batas_bawah'   => $post['batas_bawah' . $a],
						'batas_tengah'  => $post['batas_tengah' . $a],
						'batas_atas'    => $post['batas_atas' . $a],
						'ket_aktif'     => $post['ket_aktif' . $a]

					];
				} else {
					$data = [
						'id'		=> $post['id' . $a],
						'kd_rules'      => $post['fungsi_keanggotaan' . $a],
						'ket_status'    => $post['himpunan' . $a],
						'batas_bawah'   => $post['batas_bawah' . $a],
						'batas_tengah'  => 0,
						'batas_atas'    => $post['batas_atas' . $a],
						'ket_aktif'     => $post['ket_aktif' . $a]

					];
				}
			} else {
				$data = [
					'id'		=> $post['id' . $a],
					'kd_rules'      => 1,
					'ket_status'    => '',
					'batas_bawah'   => 0,
					'batas_tengah'  => 0,
					'batas_atas'    => 0,
					'ket_aktif'     => $post['ket_aktif' . $a]

				];
			}
			$this->fk_tahun->save($data);
		}
		$this->nilai_fk_tahun->truncate();
		$batas_keanggotaan = $this->fk_tahun->where('ket_aktif', 'true')->findAll();
		$data_smartphone = $this->smartphone->select('id, tahun')->findAll();
		foreach ($data_smartphone as $smartphone) {
			$this->nilai_fk_tahun->Hitung_fk($smartphone['id'], $smartphone['tahun'], $batas_keanggotaan);
		}
		return redirect()->to('/admin/keanggotaan_tahun');
	}


	///////////////////////////////////////////////////////////////////////////////////
	//--------------------------    Fungsi Keanggotaan    ---------------------------//
	//--------------------------      Resolusi Layar      ---------------------------//
	///////////////////////////////////////////////////////////////////////////////////

	public function keanggotaan_resolusi_layar()
	{
		session();
		$fk_resolusi_layar	= $this->fk_resolusi_layar->findAll();
		$fk             	= $this->fk->findAll();
		$data = [
			'fungsi_keanggotaan' => $fk,
			'fk_resolusi_layar'  => $fk_resolusi_layar
		];
		return view('Admin/Fuzzy/keanggotaan_resolusi_layar', $data);
	}


	public function update_fk_resolusi_layar()
	{
		$post = $this->request->getPost();
		if ($post == null) {
			return redirect()->to('/admin/keanggotaan_resolusi_layar');
		}
		//validasi struktur nilai fungsi keaanggotaan
		for ($i = 1; $i <= $post['row']; $i++) {
			if ($post['ket_aktif' . $i] == 'true') {
				if ($post['fungsi_keanggotaan' . $i] == 3 || $post['fungsi_keanggotaan' . $i] == 6) {
					if ($post['batas_bawah' . $i] >= $post['batas_tengah' . $i] || $post['batas_atas' . $i] <= $post['batas_tengah' . $i] || $post['batas_atas' . $i] <= $post['batas_bawah' . $i]) {
						//kondisi Salah
						session()->setFlashdata('1warning' . $i, 'data tidak dapat di proses');
						return redirect()->to('/admin/keanggotaan_resolusi_layar')->withInput();
					}
				} else {
					if ($post['batas_bawah' . $i] >= $post['batas_atas' . $i]) {
						//kondisi Salah
						session()->setFlashdata('warning' . $i, 'data tidak dapat di proses');
						return redirect()->to('/admin/keanggotaan_resolusi_layar')->withInput();
					}
				}
			}
		}
		//input update ke table fk_resolusi_layar
		for ($a = 1; $a <= $post['row']; $a++) {
			if ($post['ket_aktif' . $a] == 'true') {
				if ($post['fungsi_keanggotaan' . $a] == 3 || $post['fungsi_keanggotaan' . $a] == 6) {
					$data = [
						'id'		=> $post['id' . $a],
						'kd_rules'      => $post['fungsi_keanggotaan' . $a],
						'ket_status'    => $post['himpunan' . $a],
						'batas_bawah'   => $post['batas_bawah' . $a],
						'batas_tengah'  => $post['batas_tengah' . $a],
						'batas_atas'    => $post['batas_atas' . $a],
						'ket_aktif'     => $post['ket_aktif' . $a]

					];
				} else {
					$data = [
						'id'		=> $post['id' . $a],
						'kd_rules'      => $post['fungsi_keanggotaan' . $a],
						'ket_status'    => $post['himpunan' . $a],
						'batas_bawah'   => $post['batas_bawah' . $a],
						'batas_tengah'  => 0,
						'batas_atas'    => $post['batas_atas' . $a],
						'ket_aktif'     => $post['ket_aktif' . $a]

					];
				}
			} else {
				$data = [
					'id'		=> $post['id' . $a],
					'kd_rules'      => 1,
					'ket_status'    => '',
					'batas_bawah'   => 0,
					'batas_tengah'  => 0,
					'batas_atas'    => 0,
					'ket_aktif'     => $post['ket_aktif' . $a]

				];
			}
			$this->fk_resolusi_layar->save($data);
		}
		$this->nilai_fk_resolusi_layar->truncate();
		$batas_keanggotaan = $this->fk_resolusi_layar->where('ket_aktif', 'true')->findAll();
		$data_smartphone = $this->smartphone->select('id, resolution_layar')->findAll();
		foreach ($data_smartphone as $smartphone) {
			$this->nilai_fk_resolusi_layar->Hitung_fk($smartphone['id'], $smartphone['resolution_layar'], $batas_keanggotaan);
		}
		return redirect()->to('/admin/keanggotaan_resolusi_layar');
	}


	///////////////////////////////////////////////////////////////////////////////////
	//--------------------------    Fungsi Keanggotaan    ---------------------------//
	//--------------------------         Processor        ---------------------------//
	///////////////////////////////////////////////////////////////////////////////////

	public function keanggotaan_processor()
	{
		session();
		$fk_processor	= $this->fk_processor->findAll();
		$fk             	= $this->fk->findAll();
		$data = [
			'fungsi_keanggotaan' => $fk,
			'fk_processor'  => $fk_processor
		];
		return view('Admin/Fuzzy/keanggotaan_processor', $data);
	}


	public function update_fk_processor()
	{
		$post = $this->request->getPost();
		if ($post == null) {
			return redirect()->to('/admin/keanggotaan_processor');
		}
		//validasi struktur nilai fungsi keaanggotaan
		for ($i = 1; $i <= $post['row']; $i++) {
			if ($post['ket_aktif' . $i] == 'true') {
				if ($post['fungsi_keanggotaan' . $i] == 3 || $post['fungsi_keanggotaan' . $i] == 6) {
					if ($post['batas_bawah' . $i] >= $post['batas_tengah' . $i] || $post['batas_atas' . $i] <= $post['batas_tengah' . $i] || $post['batas_atas' . $i] <= $post['batas_bawah' . $i]) {
						//kondisi Salah
						session()->setFlashdata('1warning' . $i, 'data tidak dapat di proses');
						return redirect()->to('/admin/keanggotaan_processor')->withInput();
					}
				} else {
					if ($post['batas_bawah' . $i] >= $post['batas_atas' . $i]) {
						//kondisi Salah
						session()->setFlashdata('warning' . $i, 'data tidak dapat di proses');
						return redirect()->to('/admin/keanggotaan_processor')->withInput();
					}
				}
			}
		}
		//input update ke table fk_processor
		for ($a = 1; $a <= $post['row']; $a++) {
			if ($post['ket_aktif' . $a] == 'true') {
				if ($post['fungsi_keanggotaan' . $a] == 3 || $post['fungsi_keanggotaan' . $a] == 6) {
					$data = [
						'id'		=> $post['id' . $a],
						'kd_rules'      => $post['fungsi_keanggotaan' . $a],
						'ket_status'    => $post['himpunan' . $a],
						'batas_bawah'   => $post['batas_bawah' . $a],
						'batas_tengah'  => $post['batas_tengah' . $a],
						'batas_atas'    => $post['batas_atas' . $a],
						'ket_aktif'     => $post['ket_aktif' . $a]

					];
				} else {
					$data = [
						'id'		=> $post['id' . $a],
						'kd_rules'      => $post['fungsi_keanggotaan' . $a],
						'ket_status'    => $post['himpunan' . $a],
						'batas_bawah'   => $post['batas_bawah' . $a],
						'batas_tengah'  => 0,
						'batas_atas'    => $post['batas_atas' . $a],
						'ket_aktif'     => $post['ket_aktif' . $a]

					];
				}
			} else {
				$data = [
					'id'		=> $post['id' . $a],
					'kd_rules'      => 1,
					'ket_status'    => '',
					'batas_bawah'   => 0,
					'batas_tengah'  => 0,
					'batas_atas'    => 0,
					'ket_aktif'     => $post['ket_aktif' . $a]

				];
			}
			$this->fk_processor->save($data);
		}
		$this->nilai_fk_processor->truncate();
		$batas_keanggotaan = $this->fk_processor->where('ket_aktif', 'true')->findAll();
		$data_smartphone = $this->smartphone->select('id, clock_speed_cpu')->findAll();
		foreach ($data_smartphone as $smartphone) {
			$this->nilai_fk_processor->Hitung_fk($smartphone['id'], $smartphone['clock_speed_cpu'], $batas_keanggotaan);
		}
		return redirect()->to('/admin/keanggotaan_processor');
	}


	///////////////////////////////////////////////////////////////////////////////////
	//--------------------------    Fungsi Keanggotaan    ---------------------------//
	//--------------------------          Internal        ---------------------------//
	///////////////////////////////////////////////////////////////////////////////////

	public function keanggotaan_internal()
	{
		session();
		$fk_internal	= $this->fk_internal->findAll();
		$fk             = $this->fk->findAll();
		$data = [
			'fungsi_keanggotaan' => $fk,
			'fk_internal'  => $fk_internal
		];
		return view('Admin/Fuzzy/keanggotaan_internal', $data);
	}


	public function update_fk_internal()
	{
		$post = $this->request->getPost();
		if ($post == null) {
			return redirect()->to('/admin/keanggotaan_internal');
		}
		//validasi struktur nilai fungsi keaanggotaan
		for ($i = 1; $i <= $post['row']; $i++) {
			if ($post['ket_aktif' . $i] == 'true') {
				if ($post['fungsi_keanggotaan' . $i] == 3 || $post['fungsi_keanggotaan' . $i] == 6) {
					if ($post['batas_bawah' . $i] >= $post['batas_tengah' . $i] || $post['batas_atas' . $i] <= $post['batas_tengah' . $i] || $post['batas_atas' . $i] <= $post['batas_bawah' . $i]) {
						//kondisi Salah
						session()->setFlashdata('1warning' . $i, 'data tidak dapat di proses');
						return redirect()->to('/admin/keanggotaan_internal')->withInput();
					}
				} else {
					if ($post['batas_bawah' . $i] >= $post['batas_atas' . $i]) {
						//kondisi Salah
						session()->setFlashdata('warning' . $i, 'data tidak dapat di proses');
						return redirect()->to('/admin/keanggotaan_internal')->withInput();
					}
				}
			}
		}
		//input update ke table fk_internal
		for ($a = 1; $a <= $post['row']; $a++) {
			if ($post['ket_aktif' . $a] == 'true') {
				if ($post['fungsi_keanggotaan' . $a] == 3 || $post['fungsi_keanggotaan' . $a] == 6) {
					$data = [
						'id'		=> $post['id' . $a],
						'kd_rules'      => $post['fungsi_keanggotaan' . $a],
						'ket_status'    => $post['himpunan' . $a],
						'batas_bawah'   => $post['batas_bawah' . $a],
						'batas_tengah'  => $post['batas_tengah' . $a],
						'batas_atas'    => $post['batas_atas' . $a],
						'ket_aktif'     => $post['ket_aktif' . $a]

					];
				} else {
					$data = [
						'id'		=> $post['id' . $a],
						'kd_rules'      => $post['fungsi_keanggotaan' . $a],
						'ket_status'    => $post['himpunan' . $a],
						'batas_bawah'   => $post['batas_bawah' . $a],
						'batas_tengah'  => 0,
						'batas_atas'    => $post['batas_atas' . $a],
						'ket_aktif'     => $post['ket_aktif' . $a]

					];
				}
			} else {
				$data = [
					'id'		=> $post['id' . $a],
					'kd_rules'      => 1,
					'ket_status'    => '',
					'batas_bawah'   => 0,
					'batas_tengah'  => 0,
					'batas_atas'    => 0,
					'ket_aktif'     => $post['ket_aktif' . $a]

				];
			}
			$this->fk_internal->save($data);
		}
		$this->nilai_fk_internal->truncate();
		$batas_keanggotaan = $this->fk_internal->where('ket_aktif', 'true')->findAll();
		$data_smartphone = $this->smartphone->select('id, internal_storage')->findAll();
		foreach ($data_smartphone as $smartphone) {
			$this->nilai_fk_internal->Hitung_fk($smartphone['id'], $smartphone['internal_storage'], $batas_keanggotaan);
		}
		return redirect()->to('/admin/keanggotaan_internal');
	}


	///////////////////////////////////////////////////////////////////////////////////
	//--------------------------    Fungsi Keanggotaan    ---------------------------//
	//--------------------------          RAM        ---------------------------//
	///////////////////////////////////////////////////////////////////////////////////

	public function keanggotaan_ram()
	{
		session();
		$fk_ram			= $this->fk_ram->findAll();
		$fk             = $this->fk->findAll();
		$data = [
			'fungsi_keanggotaan' => $fk,
			'fk_ram'  => $fk_ram
		];
		return view('Admin/Fuzzy/keanggotaan_ram', $data);
	}


	public function update_fk_ram()
	{
		$post = $this->request->getPost();
		if ($post == null) {
			return redirect()->to('/admin/keanggotaan_ram');
		}
		//validasi struktur nilai fungsi keaanggotaan
		for ($i = 1; $i <= $post['row']; $i++) {
			if ($post['ket_aktif' . $i] == 'true') {
				if ($post['fungsi_keanggotaan' . $i] == 3 || $post['fungsi_keanggotaan' . $i] == 6) {
					if ($post['batas_bawah' . $i] >= $post['batas_tengah' . $i] || $post['batas_atas' . $i] <= $post['batas_tengah' . $i] || $post['batas_atas' . $i] <= $post['batas_bawah' . $i]) {
						//kondisi Salah
						session()->setFlashdata('1warning' . $i, 'data tidak dapat di proses');
						return redirect()->to('/admin/keanggotaan_ram')->withInput();
					}
				} else {
					if ($post['batas_bawah' . $i] >= $post['batas_atas' . $i]) {
						//kondisi Salah
						session()->setFlashdata('warning' . $i, 'data tidak dapat di proses');
						return redirect()->to('/admin/keanggotaan_ram')->withInput();
					}
				}
			}
		}
		//input update ke table fk_ram
		for ($a = 1; $a <= $post['row']; $a++) {
			if ($post['ket_aktif' . $a] == 'true') {
				if ($post['fungsi_keanggotaan' . $a] == 3 || $post['fungsi_keanggotaan' . $a] == 6) {
					$data = [
						'id'		=> $post['id' . $a],
						'kd_rules'      => $post['fungsi_keanggotaan' . $a],
						'ket_status'    => $post['himpunan' . $a],
						'batas_bawah'   => $post['batas_bawah' . $a],
						'batas_tengah'  => $post['batas_tengah' . $a],
						'batas_atas'    => $post['batas_atas' . $a],
						'ket_aktif'     => $post['ket_aktif' . $a]

					];
				} else {
					$data = [
						'id'		=> $post['id' . $a],
						'kd_rules'      => $post['fungsi_keanggotaan' . $a],
						'ket_status'    => $post['himpunan' . $a],
						'batas_bawah'   => $post['batas_bawah' . $a],
						'batas_tengah'  => 0,
						'batas_atas'    => $post['batas_atas' . $a],
						'ket_aktif'     => $post['ket_aktif' . $a]

					];
				}
			} else {
				$data = [
					'id'		=> $post['id' . $a],
					'kd_rules'      => 1,
					'ket_status'    => '',
					'batas_bawah'   => 0,
					'batas_tengah'  => 0,
					'batas_atas'    => 0,
					'ket_aktif'     => $post['ket_aktif' . $a]

				];
			}
			$this->fk_ram->save($data);
		}
		$this->nilai_fk_ram->truncate();
		$batas_keanggotaan = $this->fk_ram->where('ket_aktif', 'true')->findAll();
		$data_smartphone = $this->smartphone->select('id, ram')->findAll();
		foreach ($data_smartphone as $smartphone) {
			$this->nilai_fk_ram->Hitung_fk($smartphone['id'], $smartphone['ram'], $batas_keanggotaan);
		}
		return redirect()->to('/admin/keanggotaan_ram');
	}



	///////////////////////////////////////////////////////////////////////////////////
	//--------------------------    Fungsi Keanggotaan    ---------------------------//
	//--------------------------   Resolusi Main Kamera   ---------------------------//
	///////////////////////////////////////////////////////////////////////////////////

	public function keanggotaan_resolusi_main_kamera()
	{
		session();
		$fk_resolusi_main_kamera			= $this->fk_resolusi_main_kamera->findAll();
		$fk             = $this->fk->findAll();
		$data = [
			'fungsi_keanggotaan' => $fk,
			'fk_resolusi_main_kamera'  => $fk_resolusi_main_kamera
		];
		return view('Admin/Fuzzy/keanggotaan_resolusi_main_kamera', $data);
	}


	public function update_fk_resolusi_main_kamera()
	{
		$post = $this->request->getPost();
		if ($post == null) {
			return redirect()->to('/admin/keanggotaan_resolusi_main_kamera');
		}
		//validasi struktur nilai fungsi keaanggotaan
		for ($i = 1; $i <= $post['row']; $i++) {
			if ($post['ket_aktif' . $i] == 'true') {
				if ($post['fungsi_keanggotaan' . $i] == 3 || $post['fungsi_keanggotaan' . $i] == 6) {
					if ($post['batas_bawah' . $i] >= $post['batas_tengah' . $i] || $post['batas_atas' . $i] <= $post['batas_tengah' . $i] || $post['batas_atas' . $i] <= $post['batas_bawah' . $i]) {
						//kondisi Salah
						session()->setFlashdata('1warning' . $i, 'data tidak dapat di proses');
						return redirect()->to('/admin/keanggotaan_resolusi_main_kamera')->withInput();
					}
				} else {
					if ($post['batas_bawah' . $i] >= $post['batas_atas' . $i]) {
						//kondisi Salah
						session()->setFlashdata('warning' . $i, 'data tidak dapat di proses');
						return redirect()->to('/admin/keanggotaan_resolusi_main_kamera')->withInput();
					}
				}
			}
		}
		//input update ke table fk_resolusi_main_kamera
		for ($a = 1; $a <= $post['row']; $a++) {
			if ($post['ket_aktif' . $a] == 'true') {
				if ($post['fungsi_keanggotaan' . $a] == 3 || $post['fungsi_keanggotaan' . $a] == 6) {
					$data = [
						'id'		=> $post['id' . $a],
						'kd_rules'      => $post['fungsi_keanggotaan' . $a],
						'ket_status'    => $post['himpunan' . $a],
						'batas_bawah'   => $post['batas_bawah' . $a],
						'batas_tengah'  => $post['batas_tengah' . $a],
						'batas_atas'    => $post['batas_atas' . $a],
						'ket_aktif'     => $post['ket_aktif' . $a]

					];
				} else {
					$data = [
						'id'		=> $post['id' . $a],
						'kd_rules'      => $post['fungsi_keanggotaan' . $a],
						'ket_status'    => $post['himpunan' . $a],
						'batas_bawah'   => $post['batas_bawah' . $a],
						'batas_tengah'  => 0,
						'batas_atas'    => $post['batas_atas' . $a],
						'ket_aktif'     => $post['ket_aktif' . $a]

					];
				}
			} else {
				$data = [
					'id'		=> $post['id' . $a],
					'kd_rules'      => 1,
					'ket_status'    => '',
					'batas_bawah'   => 0,
					'batas_tengah'  => 0,
					'batas_atas'    => 0,
					'ket_aktif'     => $post['ket_aktif' . $a]

				];
			}
			$this->fk_resolusi_main_kamera->save($data);
		}
		$this->nilai_fk_resolusi_main_kamera->truncate();
		$batas_keanggotaan = $this->fk_resolusi_main_kamera->where('ket_aktif', 'true')->findAll();
		$data_smartphone = $this->smartphone->select('id, resolusi_main_camera')->findAll();
		foreach ($data_smartphone as $smartphone) {
			$this->nilai_fk_resolusi_main_kamera->Hitung_fk($smartphone['id'], $smartphone['resolusi_main_camera'], $batas_keanggotaan);
		}
		return redirect()->to('/admin/keanggotaan_resolusi_main_kamera');
	}



	///////////////////////////////////////////////////////////////////////////////////
	//--------------------------    Fungsi Keanggotaan    ---------------------------//
	//--------------------------           Batrai         ---------------------------//
	///////////////////////////////////////////////////////////////////////////////////

	public function keanggotaan_batrai()
	{
		session();
		$fk_batrai		= $this->fk_batrai->findAll();
		$fk             = $this->fk->findAll();
		$data = [
			'fungsi_keanggotaan' => $fk,
			'fk_batrai'  => $fk_batrai
		];
		return view('Admin/Fuzzy/keanggotaan_batrai', $data);
	}


	public function update_fk_batrai()
	{
		$post = $this->request->getPost();
		if ($post == null) {
			return redirect()->to('/admin/keanggotaan_batrai');
		}
		//validasi struktur nilai fungsi keaanggotaan
		for ($i = 1; $i <= $post['row']; $i++) {
			if ($post['ket_aktif' . $i] == 'true') {
				if ($post['fungsi_keanggotaan' . $i] == 3 || $post['fungsi_keanggotaan' . $i] == 6) {
					if ($post['batas_bawah' . $i] >= $post['batas_tengah' . $i] || $post['batas_atas' . $i] <= $post['batas_tengah' . $i] || $post['batas_atas' . $i] <= $post['batas_bawah' . $i]) {
						//kondisi Salah
						session()->setFlashdata('1warning' . $i, 'data tidak dapat di proses');
						return redirect()->to('/admin/keanggotaan_batrai')->withInput();
					}
				} else {
					if ($post['batas_bawah' . $i] >= $post['batas_atas' . $i]) {
						//kondisi Salah
						session()->setFlashdata('warning' . $i, 'data tidak dapat di proses');
						return redirect()->to('/admin/keanggotaan_batrai')->withInput();
					}
				}
			}
		}
		//input update ke table fk_batrai
		for ($a = 1; $a <= $post['row']; $a++) {
			if ($post['ket_aktif' . $a] == 'true') {
				if ($post['fungsi_keanggotaan' . $a] == 3 || $post['fungsi_keanggotaan' . $a] == 6) {
					$data = [
						'id'		=> $post['id' . $a],
						'kd_rules'      => $post['fungsi_keanggotaan' . $a],
						'ket_status'    => $post['himpunan' . $a],
						'batas_bawah'   => $post['batas_bawah' . $a],
						'batas_tengah'  => $post['batas_tengah' . $a],
						'batas_atas'    => $post['batas_atas' . $a],
						'ket_aktif'     => $post['ket_aktif' . $a]

					];
				} else {
					$data = [
						'id'		=> $post['id' . $a],
						'kd_rules'      => $post['fungsi_keanggotaan' . $a],
						'ket_status'    => $post['himpunan' . $a],
						'batas_bawah'   => $post['batas_bawah' . $a],
						'batas_tengah'  => 0,
						'batas_atas'    => $post['batas_atas' . $a],
						'ket_aktif'     => $post['ket_aktif' . $a]

					];
				}
			} else {
				$data = [
					'id'		=> $post['id' . $a],
					'kd_rules'      => 1,
					'ket_status'    => '',
					'batas_bawah'   => 0,
					'batas_tengah'  => 0,
					'batas_atas'    => 0,
					'ket_aktif'     => $post['ket_aktif' . $a]

				];
			}
			$this->fk_batrai->save($data);
		}
		$this->nilai_fk_batrai->truncate();
		$batas_keanggotaan = $this->fk_batrai->where('ket_aktif', 'true')->findAll();
		$data_smartphone = $this->smartphone->select('id, kapasitas_batrai')->findAll();
		foreach ($data_smartphone as $smartphone) {
			$this->nilai_fk_batrai->Hitung_fk($smartphone['id'], $smartphone['kapasitas_batrai'], $batas_keanggotaan);
		}
		return redirect()->to('/admin/keanggotaan_batrai');
	}



	///////////////////////////////////////////////////////////////////////////////////
	//--------------------------    Fungsi Keanggotaan    ---------------------------//
	//--------------------------           Antutu         ---------------------------//
	///////////////////////////////////////////////////////////////////////////////////

	public function keanggotaan_antutu()
	{
		session();
		$fk_antutu		= $this->fk_antutu->findAll();
		$fk             = $this->fk->findAll();
		$data = [
			'fungsi_keanggotaan' => $fk,
			'fk_antutu'  => $fk_antutu
		];
		return view('Admin/Fuzzy/keanggotaan_antutu', $data);
	}


	public function update_fk_antutu()
	{
		$post = $this->request->getPost();
		if ($post == null) {
			return redirect()->to('/admin/keanggotaan_antutu');
		}
		//validasi struktur nilai fungsi keaanggotaan
		for ($i = 1; $i <= $post['row']; $i++) {
			if ($post['ket_aktif' . $i] == 'true') {
				if ($post['fungsi_keanggotaan' . $i] == 3 || $post['fungsi_keanggotaan' . $i] == 6) {
					if ($post['batas_bawah' . $i] >= $post['batas_tengah' . $i] || $post['batas_atas' . $i] <= $post['batas_tengah' . $i] || $post['batas_atas' . $i] <= $post['batas_bawah' . $i]) {
						//kondisi Salah
						session()->setFlashdata('1warning' . $i, 'data tidak dapat di proses');
						return redirect()->to('/admin/keanggotaan_antutu')->withInput();
					}
				} else {
					if ($post['batas_bawah' . $i] >= $post['batas_atas' . $i]) {
						//kondisi Salah
						session()->setFlashdata('warning' . $i, 'data tidak dapat di proses');
						return redirect()->to('/admin/keanggotaan_antutu')->withInput();
					}
				}
			}
		}
		//input update ke table fk_antutu
		for ($a = 1; $a <= $post['row']; $a++) {
			if ($post['ket_aktif' . $a] == 'true') {
				if ($post['fungsi_keanggotaan' . $a] == 3 || $post['fungsi_keanggotaan' . $a] == 6) {
					$data = [
						'id'		=> $post['id' . $a],
						'kd_rules'      => $post['fungsi_keanggotaan' . $a],
						'ket_status'    => $post['himpunan' . $a],
						'batas_bawah'   => $post['batas_bawah' . $a],
						'batas_tengah'  => $post['batas_tengah' . $a],
						'batas_atas'    => $post['batas_atas' . $a],
						'ket_aktif'     => $post['ket_aktif' . $a]

					];
				} else {
					$data = [
						'id'		=> $post['id' . $a],
						'kd_rules'      => $post['fungsi_keanggotaan' . $a],
						'ket_status'    => $post['himpunan' . $a],
						'batas_bawah'   => $post['batas_bawah' . $a],
						'batas_tengah'  => 0,
						'batas_atas'    => $post['batas_atas' . $a],
						'ket_aktif'     => $post['ket_aktif' . $a]

					];
				}
			} else {
				$data = [
					'id'		=> $post['id' . $a],
					'kd_rules'      => 1,
					'ket_status'    => '',
					'batas_bawah'   => 0,
					'batas_tengah'  => 0,
					'batas_atas'    => 0,
					'ket_aktif'     => $post['ket_aktif' . $a]

				];
			}
			$this->fk_antutu->save($data);
		}
		$this->nilai_fk_antutu->truncate();
		$batas_keanggotaan = $this->fk_antutu->where('ket_aktif', 'true')->findAll();
		$data_smartphone = $this->smartphone->select('id, test_antutu')->findAll();
		foreach ($data_smartphone as $smartphone) {
			$this->nilai_fk_antutu->Hitung_fk($smartphone['id'], $smartphone['test_antutu'], $batas_keanggotaan);
		}
		return redirect()->to('/admin/keanggotaan_antutu');
	}





	//logout
	public function logout()
	{
		session()->destroy();
		return redirect()->to('/login');
	}
}
