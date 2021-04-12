<?php

namespace App\Models;

use CodeIgniter\Model;

class Items extends Model {
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['id', 'name', 'img', 'description', 'price', 'created_ts', 'isActive'];
}
