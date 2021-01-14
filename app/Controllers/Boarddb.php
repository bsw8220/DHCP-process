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

    public function insert()
    {
      $db = \Config\Database::connect('default');
      $query = $db->query('INSERT INTO `board` (`name`, `title`, `comment`, `wdate`) VALUES $title, $name, $comment, $wdate');
      $results = $query->getResult();
      return $this->respond($results);
    }

    public function eachdata($id)
    {
      $db = \Config\Database::connect('default');
      $query = $db->query('SELECT * FROM board where id ='.$id);
      $results = $query->getResult();
      return $this->respond($results);
    }

    public function deletedata($id)
    {
    	$boardModel = new BoardMode();
    	$data = $boardModel -> find($id);
    	if($data){
    		$boardModel -> delete($id);
    	}
    	return redirect()->to('Board/BoardList');
    }
}