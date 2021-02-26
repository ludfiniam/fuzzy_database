<?php

namespace App\Models;

use CodeIgniter\Model;

class BahanBodyModel extends Model
{
    protected $table = 't_jenis_bahan_body';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_bahan_body'];
}
?>