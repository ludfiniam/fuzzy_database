<?php

namespace App\Models;

use CodeIgniter\Model;

class GpuModel extends Model
{
    protected $table = 't_jenis_gpu';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_gpu'];
}
?>