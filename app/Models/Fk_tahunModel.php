<?php

namespace App\Models;

use CodeIgniter\Model;

class Fk_tahunModel extends Model
{
    protected $table = 'fk_tahun';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kd_rules','ket_status','batas_bawah','batas_tengah','batas_atas','ket_aktif'];
}
