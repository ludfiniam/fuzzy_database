<?php

namespace App\Models;

use CodeIgniter\Model;

class USBtipeModel extends Model
{
    protected $table = 't_jenis_usb';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_usb'];
}
?>