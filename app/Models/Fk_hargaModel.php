<?php

namespace App\Models;

use CodeIgniter\Model;

class Fk_hargaModel extends Model
{
    protected $table = 'fk_harga';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kd_rules', 'ket_status', 'batas_bawah', 'batas_tengah', 'batas_atas', 'ket_aktif'];
}
