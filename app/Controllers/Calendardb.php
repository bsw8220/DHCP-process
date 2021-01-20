<?php 
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\CalendarModel;

class Calendardb extends ResourceController
{
    public function index()
    {
    	$CalendarModel = new CalendarModel();
    	$data = $CalendarModel -> findAll();
    	return $this->respond($data);
    }

    public function create()
    {
        $db = db_connect('default');
        $builder = $db->table('calendar');
        $data = [
            'memo'  => $this->request->getPost('memo'),
        	'type_info' => $this->request->getPost('type_info'),
            'credit' => $this->request->getPost('credit'),
            'dates'  => $this->request->getPost('dates'),
            'hour'  => $this->request->getPost('hour'),
            'minute'  => $this->request->getPost('minute'),
            ];
        $builder->insert($data);
	   return $this->respond($data);
    }

    public function editData()
    {
        $db = db_connect('default');
        $builder = $db->table('calendar');
        $data = [
            'id' => $this->request->getPost('id'),
            'memo'  => $this->request->getPost('memo'),
            'type_info' => $this->request->getPost('type_info'),
            'credit' => $this->request->getPost('credit'),
            'dates'  => $this->request->getPost('dates'),
            'hour'  => $this->request->getPost('hour'),
            'minute'  => $this->request->getPost('minute'),
            ];
        $builder->update($data, ["id"=>$data["id"]]);
        
        return $this->respondCreated($data["id"]);
    }

    public function eachdata($id)
    {
        $calendarModel = new CalendarModel();
    	$data = $calendarModel -> find($id);
        return $this->respond($data);
    }

    public function deletedata($id)
    {
    	$calendarModel = new CalendarModel();
        
        if($calendarModel->find($id)){

             $calendarModel->delete($id);
        }
        // $query = $boardModel->query('ALTER TABLE board AUTO_INCREMENT=1');
        // $query = $boardModel->query('SET @COUNT = 0');
        // $query = $boardModel->query('UPDATE board SET id = @COUNT:=@COUNT+1');
        return $this->respondDeleted("success");
    }
}