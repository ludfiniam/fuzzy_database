<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class SelerFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Verif session logged_in buat masuk laman admin
        if (session()->get('log_in') != true) {
            return redirect()->to('/index');
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
        if (session()->get('hk_akses') == 2) {
            return redirect()->to('/user');
        }
    }
}
