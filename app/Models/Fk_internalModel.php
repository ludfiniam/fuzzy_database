<?php

namespace App\Models;

use CodeIgniter\Model;

class Fk_internalModel extends Model
{
    protected $table = 'fk_internal';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kd_rules','ket_status','batas_bawah','batas_tengah','batas_atas','ket_aktif'];
}
