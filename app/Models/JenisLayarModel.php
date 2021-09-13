<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisLayarModel extends Model
{
    protected $table = 't_jenis_layar';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_jenis_layar'];


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
        $data = $this->like('nama_jenis_layar', $key);
        return $data;
    }

    public function delete_data($id)
    {
        $this->where('id', $id)->delete();
    }
}
