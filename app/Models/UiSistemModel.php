<?php

namespace App\Models;

use CodeIgniter\Model;

class UiSistemModel extends Model
{
    protected $table = 't_jenis_ui_os';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_ui_os'];
}
?>