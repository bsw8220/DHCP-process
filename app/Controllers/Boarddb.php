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
    	$data = $boardModel -> findAll();
    	return $this->respond($data);
    }

    public function create()
    {
        // $boardModel = new BoardModel();
        $db = db_connect('default');
        $builder = $db->table('board');
        $data = [
        	'name' => $this->request->getPost('name'),
            'title' => $this->request->getPost('title'),
            'comment'  => $this->request->getPost('comment')
            ];
        $builder->insert($data);
        $response = [
	          'status'   => 201,
	          'error'    => null,
	          'messages' => [
              'success' => 'Employee created successfully'
	          ]
	      ];
	      return $this->respondCreated($response);
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

	         session()->setFlashdata('message', 'Deleted Successfully!');
	         session()->setFlashdata('alert-class', 'alert-success');
      	}else{
	         session()->setFlashdata('message', 'Record not found!');
	         session()->setFlashdata('alert-class', 'alert-danger');
      	}

      return redirect()->route('/');
    	return redirect()->to('Board/BoardList');
    }
}