<?php

namespace App\Controllers;

use App\Models\BahanBodyModel;
use App\Models\Fk_antutuModel;
use App\Models\Fk_batraiModel;
use App\Models\Fk_hargaModel;
use App\Models\Fk_internalModel;
use App\Models\Fk_processorModel;
use App\Models\Fk_ramModel;
use App\Models\Fk_resolusi_layarModel;
use App\Models\Fk_tahunModel;
use App\Models\GpuModel;
use App\Models\JenisLayarModel;
use App\Models\LoginModel;
use App\Models\MerekModel;
use App\Models\PelindungLayarModel;
use App\Models\PhoneModel;
use App\Models\ProcessorModel;
use App\Models\UiSistemModel;
use App\Models\USBtipeModel;

class Index extends BaseController
{
    protected $Data_smartphone;
    protected $loginModel;
    protected $MerekModel;
    protected $FkHarga;
    protected $FkRAM;
    protected $FkInternal;
    protected $FkTahun;
    protected $UImodel;
    protected $ProcessorModel;
    protected $FkProcessor;
    protected $GpuModel;
    protected $Fkantutu;
    protected $BodyModel;
    protected $FkLebarLayar;
    protected $TipeLayarModel;
    protected $PelindungLayarModel;
    protected $FkResolusiKamera;
    protected $FkBatrai;
    protected $CasConectorModel;


    public function __construct()
    {
        $this->Data_smartphone = new PhoneModel();
        $this->MerekModel   = new MerekModel();
        $this->loginModel   = new LoginModel();
        $this->FkHarga      = new Fk_hargaModel();
        $this->FkRAM        = new Fk_ramModel();
        $this->FkInternal   = new Fk_internalModel();
        $this->FkTahun      = new Fk_tahunModel();
        $this->UImodel      = new UiSistemModel();
        $this->ProcessorModel = new ProcessorModel();
        $this->FkProcessor  = new Fk_processorModel();
        $this->GpuModel     = new GpuModel();
        $this->Fkantutu     = new Fk_antutuModel();
        $this->BodyModel    = new BahanBodyModel();
        $this->FkLebarLayar = new Fk_resolusi_layarModel();
        $this->TipeLayarModel = new JenisLayarModel();
        $this->PelindungLayarModel = new PelindungLayarModel();
        $this->FkResolusiKamera = new Fk_resolusi_layarModel();
        $this->FkBatrai     = new Fk_batraiModel();
        $this->CasConectorModel = new USBtipeModel();
    }

    public function index()
    {
        $merek = $this->MerekModel->findAll();
        $data = [
            'merek' => $merek,
        ];
        return view('Public/dashboard', $data);
    }

    public function search()
    {
        $merek      = $this->MerekModel->findAll();
        $harga      = $this->FkHarga->findAll();
        $ram        = $this->FkRAM->findAll();
        $internal   = $this->FkInternal->findAll();
        $tahun      = $this->FkTahun->findAll();
        $UIos       = $this->UImodel->findAll();
        $processor  = $this->ProcessorModel->findAll();
        $speedProcessor = $this->FkProcessor->findAll();
        $gpu        = $this->GpuModel->findAll();
        $antutu     = $this->Fkantutu->findAll();
        $body       = $this->BodyModel->findAll();
        $lebar_layar = $this->FkLebarLayar->findAll();
        $tipe_layar = $this->TipeLayarModel->findAll();
        $pelindung_layar = $this->PelindungLayarModel->findAll();
        $resolusi_kamera = $this->FkResolusiKamera->findAll();
        $batrai     = $this->FkBatrai->findAll();
        $cas        = $this->CasConectorModel->findAll();

        $session = session();
        //-------------------Validasi GET----------------------- 
        $CURRENT = $this->request->getVar('page_t_smartphone') ? $this->request->getVar('page_t_smartphone') : 1;
        //-------------Jumlah data di dalam table---------------
        $data_inpage = 5;
        //------------------------------------------------------
        $keyword = $this->request->getVar('key_smartphone');

        if (session()->get('key_smartphone') != Null) {
            $FindSmartphone = $this->Data_smartphone->FindAllSmartphonePaginationForPublic(session()->get('key_smartphone'));
        } else {
            $FindSmartphone = $this->Data_smartphone->allSmartphonePaginationForPublic();
        }

        $data = [
            'smartphone' => $FindSmartphone->paginate($data_inpage, 't_smartphone'),
            'merek'     => $merek,
            'harga'     => $harga,
            'ram'       => $ram,
            'internal'  => $internal,
            'tahun'     => $tahun,
            'ui_os'     => $UIos,
            'processor' => $processor,
            'speedprocessor' => $speedProcessor,
            'gpu'       => $gpu,
            'antutu'    => $antutu,
            'body'      => $body,
            'lebar_layar'    => $lebar_layar,
            'tipe_layar' => $tipe_layar,
            'pelindung_layar' => $pelindung_layar,
            'resolusi_kamera' => $resolusi_kamera,
            'batrai'    => $batrai,
            'cas'       => $cas,
            'pager'     => $this->Data_smartphone->pager,
            'CURRENT'   => $CURRENT,
            'data_inpage'     => $data_inpage,
        ];
        return view('Public/search', $data);
    }

    public function login()
    {
        return view('Public/login');
    }

    public function try_login()
    {
        $session = session();
        $data = $this->request->getPost();
        $id = false;

        if ($data) {
            //Jika ada kiriman data
            $id = $this->loginModel->where('email', $data['email'])->orWhere('username', $data['email'])->first();
        } else {
            //Jika kosong tanpa post
            return redirect()->to('/login');
        }

        if ($id) {
            //jika data yang dikirimkan ada dalam database
            if ($id['password'] == $data['password']) {
                if ($id['active_account'] == 'active') {
                    //Jika password yang dikirimkan sama dengan yang berada di database
                    $ses_data = [
                        'id'              => $id['id'],
                        'name'            => $id['full_name'],
                        'email'           => $id['email'],
                        'hk_akses'        => $id['hak_akses'],
                        'log_in'          => true
                    ];
                    $session->set($ses_data);
                    if ($id['hak_akses'] == "1") {
                        //Jika hak akses merupakan Admin 
                        return redirect()->to('/admin');
                    } else {
                        //Jika hak akses merupakan Seller
                        return redirect()->to('/user');
                    }
                } else {
                    //Jika akun tidak aktive
                    $session->setFlashdata('ass', 'Akun anda saat ini tidak dapat diakses, Harap hubungi admin di nomor : +62 898 5222 402');
                    return redirect()->to('/index/login');
                }
            } else {
                // Jika password salah namun email benar
                $session->setFlashdata('msg', 'Email/Username dan Password mungkin ada yang salah');
                return redirect()->to('/index/login');
            }
        } else {
            // jika email dan username tidak di temukan
            $session->setFlashdata('msg', 'Email/Username dan Password mungkin ada yang salah');
            return redirect()->to('/index/login');
        }
    }
}
