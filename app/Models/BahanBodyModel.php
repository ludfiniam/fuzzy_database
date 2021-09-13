<?php

namespace App\Models;

use CodeIgniter\Model;

class BahanBodyModel extends Model
{
    protected $table = 't_jenis_bahan_body';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_bahan_body'];

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
        $data = $this->like('nama_bahan_body', $key);
        return $data;
    }

    public function delete_data($id)
    {
        $this->where('id', $id)->delete();
    }
}
