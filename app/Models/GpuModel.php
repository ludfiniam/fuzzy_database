<?php

namespace App\Models;

use CodeIgniter\Model;

class GpuModel extends Model
{
    protected $table = 't_jenis_gpu';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_gpu'];

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
        $data = $this->like('nama_gpu', $key);
        return $data;
    }

    public function delete_data($id)
    {
        $this->where('id', $id)->delete();
    }
}
