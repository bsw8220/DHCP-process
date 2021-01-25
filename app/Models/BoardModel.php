<?php

namespace App\Models;

use CodeIgniter\Model;

class BoardModel extends Model
{
    protected $table = 'board';
    protected $primarykey = 'id';
    protected $createField = 'created_at';
    // protected $updateField = 'updated_at';
    protected $allowFields = ['title', 'name', 'comment', 'pass', 'wdate'];
}