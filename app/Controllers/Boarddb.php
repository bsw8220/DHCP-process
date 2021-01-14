<?php 
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\BoardModel;

class Boarddb extends ResourceController
{
    public function index()
    {
      $db = \Config\Database::connect('default');
      $query = $db->query('SELECT * FROM board');
      $results = $query->getResult();
      return $this->respond($results);

    }

    public function list()
    {
      $db = \Config\Database::connect('default');
      $query = $db->query('SELECT id, title, name, wdate FROM board');
      $results = $query->getResult();
      return $this->respond($results);

    }
}