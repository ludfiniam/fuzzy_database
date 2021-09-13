<?php

namespace App\Models;

use CodeIgniter\Model;

class Fk_Model extends Model
{
    protected $table = 'rules';
    protected $primaryKey = 'id';
    protected $allowedFields = ['rules'];
}
