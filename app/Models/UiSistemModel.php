<?php

namespace App\Models;

use CodeIgniter\Model;

class UiSistemModel extends Model
{
    protected $table = 't_jenis_ui_os';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_ui_os'];

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
        $data = $this->like('nama_ui_os', $key);
        return $data;
    }

    public function delete_data($id)
    {
        $this->where('id', $id)->delete();
    }
}
