<?php

namespace App\Models;

use CodeIgniter\Model;

class BoardModel extends Model
{
    protected $table = 'calendar';
    protected $primarykey = 'id';
    protected $createField = 'create_at';
    protected $allowFields = ['memo', 'import', 'expend', 'balance', 'dateTime'];
}