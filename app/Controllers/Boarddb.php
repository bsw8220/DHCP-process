<?php 
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\BoardModel;

class Boarddb extends ResourceController
{
    public function index()
    {
    	$boardModel = new BoardModel();
        $boardModel->orderBy('wdate', 'DESC');
    	$data = $boardModel -> findAll();
    	return $this->respond($data);
    }

    public function create()
    {
        $db = db_connect('default');
        $builder = $db->table('board');
        $data = [
        	'name' => $this->request->getPost('name'),
            'title' => $this->request->getPost('title'),
            'comment'  => $this->request->getPost('comment'),
            'pass' => $this->request->getPost('pass'),
            ];
        $builder->insert($data);
        // $query = $db->query('ALTER TABLE board AUTO_INCREMENT=1');
        // $query = $db->query('SET @COUNT = 0');
        // $query = $db->query('UPDATE board SET id = @COUNT:=@COUNT+1');
        $results = $query->getResult();

	    return $this->respondCreated($results);
    }

    public function editData()
    {
        $db = db_connect('default');
        $builder = $db->table('board');
        $data = [
            'id' => $this->request->getPost('id'),
        	'name' => $this->request->getPost('name'),
            'title' => $this->request->getPost('title'),
            'comment'  => $this->request->getPost('comment'),
            ];
        $builder->update($data, ["id"=>$data["id"]]);
        
	    return $this->respondCreated($data["id"]);
    }

    public function eachdata($id)
    {
        $boardModel = new BoardModel();
    	$data = $boardModel -> find($id);
        return $this->respond($data);
    }

    public function deletedata($id)
    {
    	$boardModel = new BoardModel();
    	
    	if($boardModel->find($id)){

	         $boardModel->delete($id);
      	}
        // $query = $boardModel->query('ALTER TABLE board AUTO_INCREMENT=1');
        // $query = $boardModel->query('SET @COUNT = 0');
        // $query = $boardModel->query('UPDATE board SET id = @COUNT:=@COUNT+1');
        return $this->respondDeleted("success");
    }
}