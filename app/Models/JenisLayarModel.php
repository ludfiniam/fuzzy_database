<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisLayarModel extends Model
{
    protected $table = 't_jenis_layar';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_jenis_layar'];
}
?>