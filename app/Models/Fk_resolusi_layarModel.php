<?php

namespace App\Models;

use CodeIgniter\Model;

class Fk_resolusi_layarModel extends Model
{
    protected $table = 'fk_resolusi_layar';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kd_rules','ket_status','batas_bawah','batas_tengah','batas_atas','ket_aktif'];
}
