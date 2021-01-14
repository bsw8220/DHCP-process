<?php

namespace App\Models;

use CodeIgniter\Model;

class BoardModel extends Model
{
    protected $table = 'board';
    protected $primarykey = 'id';
    protected $createField = 'create_at';
    protected $allowFields = ['title', 'name', 'comment', 'wdate'];
}