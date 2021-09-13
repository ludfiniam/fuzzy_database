<?php

namespace App\Controllers;

use App\Models\LoginModel;

class Index extends BaseController
{
    protected $loginModel;

    public function __construct()
    {
        $this->loginModel = new LoginModel();
    }

	public function index()
	{
		return view('Public/dashboard');
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
                        'log_in'	      => true
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
?>