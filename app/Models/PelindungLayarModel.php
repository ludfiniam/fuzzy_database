<?php

namespace App\Models;

use CodeIgniter\Model;

class PelindungLayarModel extends Model
{
    protected $table = 't_jenis_protect_layar';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_protect_layar'];
}
?>