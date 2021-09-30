<?php

namespace App\Controllers;

class Search extends BaseController
{
    public function index()
    {
        $session = session();
        $post = $this->request->getPost();
        $data = [
            'data_filter'   => 'Yes',
            'fk_merek'      => $post['merek'],
            'fk_harga'      => $post['harga'],
            'fk_ram'        => $post['ram'],
            'fk_internal'   => $post['internal'],
            'fk_tahun'      => $post['tahun'],
            'fk_ui_os'      => $post['ui_os'],
            'fk_jns_processor' => $post['jns_processor'],
            'fk_speed_processor' => $post['speed_processor'],
            'fk_jenis_gpu'  => $post['jenis_gpu'],
            'fk_antutu'     => $post['antutu'],
            'fk_bahan_body' => $post['bahan_body'],
            'fk_resolusi_layar' => $post['resolusi_layar'],
            'fk_tipe_layar' => $post['tipe_layar'],
            'fk_proteksi_layar' => $post['proteksi_layar'],
            'fk_kamera_belakang' => $post['resolusi_kamera_belakang'],
            'fk_kapasitas_batrai' => $post['kapasitas_batrai'],
            'fk_usb_tipe'   => $post['usb_tipe'],
        ];
        $session->set($data);
        return redirect()->to('/search');
    }

    public function delete_filter()
    {
        $session = session();
        $data = [
            'data_filter',
            'fk_merek',
            'fk_harga',
            'fk_ram',
            'fk_internal',
            'fk_tahun',
            'fk_ui_os',
            'fk_jns_processor',
            'fk_speed_processor',
            'fk_jenis_gpu',
            'fk_antutu',
            'fk_bahan_body',
            'fk_resolusi_layar',
            'fk_tipe_layar',
            'fk_proteksi_layar',
            'fk_kamera_belakang',
            'fk_kapasitas_batrai',
            'fk_usb_tipe',
        ];
        $session->remove($data);
        return redirect()->to('/search');
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
