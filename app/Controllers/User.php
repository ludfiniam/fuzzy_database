<?php

namespace App\Controllers;

class User extends BaseController
{
	public function index()
	{
	return view('welcome_message');
	}
	public function logout()
	{
		session()->destroy();
        return redirect()->to('/index/login');
	}
}
?>