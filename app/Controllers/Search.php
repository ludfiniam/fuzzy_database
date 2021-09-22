<?php

namespace App\Controllers;

class Search extends BaseController
{
    public function index()
    {
        $post = $this->request->getPost();
        d($post);
    }

    public function keyword()
    {
        $session = session();
        $keyword = $this->request->getVar('key_smartphone');
        $session->set(['key_smartphone' => $keyword]);
        return redirect()->to('/search');
    }

    public function delete_key()
    {
        $session = session();
        $session->remove('key_smartphone');
        return redirect()->to('/search');
    }
}
