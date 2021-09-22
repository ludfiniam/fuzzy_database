<?php

namespace App\Models;

use CodeIgniter\Model;

class MerekModel extends Model
{
    protected $table = 't_jenis_merek';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_merek', 'logo_img', 'slug'];

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
        $data = $this->like('nama_merek', $key);
        return $data;
    }

    public function delete_data($id)
    {
        $this->where('id', $id)->delete();
    }
}
