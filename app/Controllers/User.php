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

class User extends BaseController
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
		$session = session();
		$merek = $this->merek->Alldata();
		$profile = $this->user->profileUser(session()->get('id'));
		$count_smartphon = $this->smartphone->select('id_seller,merek, count(merek) as jumlah_smartphone')->where('id_seller', $session->get('id'))->join('t_jenis_merek', 't_smartphone.merek = t_jenis_merek.nama_merek', 'left')->groupBy('t_smartphone.merek')->findAll();
		$count_signal = $this->smartphone->select('id_seller,network, count(network) as jumlah_smartphone')->where('id_seller', $session->get('id'))->groupBy('t_smartphone.network')->findAll();
		$count_allSmartphone = $this->smartphone->select('id_seller, count(id_seller) as jumlah_smartphone')->where('id_seller', $session->get('id'))->groupBy('t_smartphone.id_seller')->findAll();
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
			'p_profile' 	=> $profile['image_profile'],
			'full_name'		=> $profile['full_name'],
			'email'			=> $profile['email'],
			'phone'			=> substr($profile['telp'], 1),
			'address'		=> $profile['address'],
			'merek'			=> $merek,
			'count'			=> $count_smartphon,
			'count_network'		=> $count_signal,
			'network'		=> $this->network,
			'count_smartphon' => $count_allSmartphone,
			'data_smartphone' 	=> $FindSmartphone->paginate($data_inpage, 't_smartphone'),
			'pager'				=> $this->smartphone->pager,
			'CURRENT'       => $CURRENT,
			'data_inpage'     => $data_inpage,
		];
		return view('User/dashboard.php', $data);
	}


	public function data_smartphone()
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
		return view('User/Smartphone/Alldata.php', $data);
	}



	public function detail_smartphone($slug)
	{
		$datasmartphone = $this->smartphone->findSmartphoneBySlug($slug);
		$data = [
			'smartphone' 	=> $datasmartphone
		];
		return view('User/Smartphone/detail_smartphone', $data);
	}



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
		return view('User/Smartphone/insert_new_smartphone', $data);
	}


	public function tambah_smartphone(Type $var = null)
	{
		$insertAll = $this->request->getVar();
		$slug = url_title($insertAll['nama_smartphone'] . '_by_' . $insertAll['seller'], '_', true);

		//---------- Validasi Slug -------------//
		$validate = $this->smartphone->where('slug', $slug)->find();
		if ($validate != null) {
			$data_validate = 'data smartphone serupa telah anda buat sebelumnya, data harus unique!!! ';
			session()->setFlashdata('validate', $data_validate);
			return redirect()->to('/user/insert_new_smartphone')->withInput();
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
			return redirect()->to('/user/insert_new_smartphone')->withInput();
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
		return redirect()->to('/user/data_smartphone');
	}


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
		return view('User/Smartphone/update_smartphone', $data);
	}


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
				return redirect()->to('/user/insert_new_smartphone')->withInput();
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
			return redirect()->to('/user/update_smartphone/' . $insertAll['slug'])->withInput();
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
		return redirect()->to('/user/detail_smartphone/' . $slug);
	}


	//function 	 smartphone
	public function delete_smartphone()
	{
		$data_delete = $this->request->getPost('id');
		if ($data_delete == null) {
			return redirect()->to('/user/data_smartphone');
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
		return redirect()->to('/user/data_smartphone');
	}


	public function profile()
	{
		$session = session();
		$profile = $this->user->profileUser($session->get('id'));
		$data = [
			'profile' => $profile
		];
		return view('User/profile/view_profile', $data);
	}


	public function update_profile()
	{
		$session = session();
		$profile = $this->user->profileUser($session->get('id'));
		$profile['telp'] = substr($profile['telp'], 1);
		$data = [
			'profile_lama' => $profile,
			'validation' => \Config\Services::validation()
		];
		return view('User/profile/update_profile', $data);
	}


	public function function_updateprofile()
	{
		$update = $this->request->getPost();
		if ($update == null) {
			return redirect()->to('/user/profile');
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
					return redirect()->to('/user/update_profile')->withInput();
				}
			} else {
				if (!$this->validate([
					'email'     => [
						'rules'     => 'is_unique[t_account.email]',
						'errors'    => [
							'is_unique' => '{field} sudah terdaftar di database'
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
					return redirect()->to('/user/update_profile')->withInput();
				}
			}
		} elseif ($update['email'] == $update['emailasli']) {
			if (!$this->validate([
				'username'     => [
					'rules'     => 'is_unique[t_account.username]',
					'errors'    => [
						'is_unique' => '{field} sudah terdaftar di database'
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
				return redirect()->to('/user/update_profile')->withInput();
			}
		} else {
			if (!$this->validate([
				'email'     => [
					'rules'     => 'is_unique[t_account.email]',
					'errors'    => [
						'is_unique' => '{field} sudah terdaftar di database'
					]
				],
				'username'  => [
					'rules'     => 'is_unique[t_account.username]',
					'errors'    => [
						'is_unique' => '{field} sudah terdaftar di database'
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
				return redirect()->to('/user/update_profile')->withInput();
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
			'full_name'     => $update['full_name'],
			'username'      => $update['username'],
			'email'         => $update['email'],
			'telp'          => $update['telp'],
			'address'       => $update['alamat'],
			'image_profile' => $name_profile
		];
		$this->user->save($data);
		return redirect()->to('/user/profile');
	}


	public function update_password()
	{
		session();
		return view('User/profile/update_password');
	}


	public function function_updatepassword()
	{
		$update = $this->request->getPost();
		$validation = $this->user->select('password')->where('id', session()->get('id'))->first();
		if ($update['password1'] != $validation['password']) {
			$error = "Password lama tidak sesuai !";
			session()->setFlashdata('validation_lama', $error);
			return redirect()->to('/user/update_password');
		}
		if ($update['password2'] != $update['password3']) {
			$error = "Password baru tidak sama !";
			session()->setFlashdata('validation_baru', $error);
			return redirect()->to('/user/update_password');
		}
		$data = [
			'id'        => session()->get('id'),
			'password'  => $update['password3']
		];
		$this->user->save($data);
		return redirect()->to('/user/profile');
	}


	public function logout()
	{
		session()->destroy();
		return redirect()->to('/index/login');
	}
}
