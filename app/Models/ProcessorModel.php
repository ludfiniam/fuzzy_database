<?php

namespace App\Models;

use CodeIgniter\Model;

class ProcessorModel extends Model
{
    protected $table = 't_jenis_chipset';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_chipset'];
}
?>