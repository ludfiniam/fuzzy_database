<?php

namespace App\Models;

use CodeIgniter\Model;

class PelindungLayarModel extends Model
{
    protected $table = 't_jenis_protect_layar';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_protect_layar'];

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
        $data = $this->like('nama_protect_layar', $key);
        return $data;
    }

    public function delete_data($id)
    {
        $this->where('id', $id)->delete();
    }
}
