<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $table = 't_account';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'full_name', 'email', 'password', 'telp', 'active_account', 'hak_akses', 'address', 'image_profile'];
}
?>