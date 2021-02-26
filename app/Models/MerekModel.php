<?php

namespace App\Models;

use CodeIgniter\Model;

class MerekModel extends Model
{
    protected $table = 't_jenis_merek';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_merek'];
}
?>