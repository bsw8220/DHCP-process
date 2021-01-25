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
        $builder->insert($_POST);
        // $query = $db->query('ALTER TABLE board AUTO_INCREMENT=1');
        // $query = $db->query('SET @COUNT = 0');
        // $query = $db->query('UPDATE board SET id = @COUNT:=@COUNT+1');
        return $this->respondCreated($_POST);
    }

    // public function editData()
    // {
    //     // $id = $_POST['id'];
    //     $db = db_connect('default');
    //     $builder = $db->table('board');
    //     // $boardModel = new BoardModel();
    //     // $boardID = $boardModel->find($id);
    //     // $boardID = $builder->find($id);
    //     // if(strcmp($_POST['pass'],$boardID['pass']) == 0){

    //         $builder->update($_POST, ['id'=>$_POST['id']);
    //     //     return $this->respondCreated("success");
        
    //     // }
    //     // return $this->failNotFound("실패했습니다.");
	   //  // return $this->respondCreated($_POST);
    //     return $this->respondCreated($_POST);
    // }
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

    public function deletedata()
    {
    	$id = $_POST['id'];
        $boardModel = new BoardModel();
    	$boardID = $boardModel->find($id);
    	if(strcmp($_POST['pass'],$boardID['pass']) == 0){

	         $boardModel->delete($boardID);
            return $this->respondDeleted("success");
      	}
        // $query = $boardModel->query('ALTER TABLE board AUTO_INCREMENT=1');
        // $query = $boardModel->query('SET @COUNT = 0');
        // $query = $boardModel->query('UPDATE board SET id = @COUNT:=@COUNT+1');
        return $this->failNotFound("실패했습니다.");

    }
}