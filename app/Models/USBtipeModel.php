<?php

namespace App\Models;

use CodeIgniter\Model;

class USBtipeModel extends Model
{
    protected $table = 't_jenis_usb';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_usb'];


    public function Alldata()
    {
        $data = $this->findAll();
        return $data;
    }

    public function pagination_all()
    {
        $data = $this;
        return $data;
    }

    public function pagination_find($key)
    {
        $data = $this->like('nama_usb', $key);
        return $data;
    }

    public function delete_data($id)
    {
        $this->where('id', $id)->delete();
    }

}
