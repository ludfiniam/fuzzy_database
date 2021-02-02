<?php

namespace App\Controllers;

class Index extends BaseController
{
	public function index()
	{
		return view('welcome_message');
	}
	
	public function login()
	{
		return view('Public/login');
	}
}
?>