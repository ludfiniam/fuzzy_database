<?php

namespace App\Controllers;

use App\Models\PhoneModel;
use App\Models\LoginModel;
use App\Models\BahanBodyModel;
use App\Models\GpuModel;
use App\Models\JenisLayarModel;
use App\Models\MerekModel;
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
	protected $use_tipe;
	//-------------------------
	protected $ui_hp;
	protected $network = ['5G', '4G', '3G', '2G'];
	protected $internal = ['4', '8', '16', '32', '64', '128', '256', '512'];
	protected $ram = ['0.5', '1', '2', '3', '4', '6', '8', '12'];
	protected $jml_sim = ['Dual', 'Single'];
	protected $tipe_sim = ['Mini SIM', 'Micro SIM', 'Nano SIM'];
	protected $sim_stand = ['Stand-by all', 'One-hybrit'];
	protected $core_cpu = ['Single core', 'Dual core', 'Quard core', 'Octa core'];
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


	public function __construct()
	{
		$this->smartphone 		= new PhoneModel();
		$this->user 			= new LoginModel();
		$this->merek 			= new MerekModel();
		$this->processor 		= new ProcessorModel();
		$this->bahan_body 		= new BahanBodyModel();
		$this->jenis_layar 		= new JenisLayarModel();
		$this->pelindung_layar 	= new PelindungLayarModel();
		$this->Gpu 				= new GpuModel();
		$this->ui_hp 			= new UiSistemModel();
		$this->usb_tipe			= new USBtipeModel();
	}

	public function index()
	{
		return view('Admin/dashboard');
	}

	////////////////////////////////////////////////////////////////
	//////////////////////  DATA SMARTPHONE  ///////////////////////
	////////////////////////////////////////////////////////////////

	public function datasmartphone()
	{
		$session = session();
		//-------------------Validasi GET----------------------- 
		$CURRENT = $this->request->getVar('page_t_smartphone') ? $this->request->getVar('page_t_smartphone') : 1;
		//-------------Jumlah data di dalam table---------------
		$data_inpage = 2;
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


	public function d_m()
	{
		$session = session();
		$session->remove('key_smartphone');
		return redirect()->to('/admin/datasmartphone');
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
			'v_jenis_gpu'		=> $this->Gpu->findAll(),
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

	public function updatesmartphone()
	{
		$insertAll = $this->request->getVar();
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
			return redirect()->to('/admin/insert_datamobil')->withInput();
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

		//----------------------------------------------------------------------//
		return redirect()->to('/admin/detail_smartphone/' . $slug);
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
			'v_jenis_gpu'		=> $this->Gpu->findAll(),
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
			return redirect()->to('/admin/insert_datamobil')->withInput();
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

		//----------------------------------------------------------------------//
		session()->setFlashdata('true', 'Data smartphone ' . $insertAll['nama_smartphone'] . ' berhasil di tambahkan');
		return redirect()->to('/admin/datasmartphone');
	}


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
		//-------------------------------------------------------------------//
		//-----------------  delete data berdasarkan id  --------------------//
		$this->smartphone->delete($data_delete);
		session()->setFlashdata('msg', 'Data berhasil di hapus');
		return redirect()->to('/admin/datasmartphone');
	}


	public function detail_smartphone($slug)
	{
		$datasmartphone = $this->smartphone->findSmartphoneBySlug($slug);
		$data = [
			'smartphone' 	=> $datasmartphone
		];
		return view('Admin/datasmartphone/detail_smartphone', $data);
	}


	public function logout()
	{
		session()->destroy();
		return redirect()->to('/index/login');
	}
}
