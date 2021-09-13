<?php

namespace App\Models;

use CodeIgniter\Model;

class Fk_ramModel extends Model
{
    protected $table = 'fk_ram';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kd_rules','ket_status','batas_bawah','batas_tengah','batas_atas','ket_aktif'];
}
