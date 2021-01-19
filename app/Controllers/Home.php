<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		return view('Board/BoardList');
	}

	public function write()
	{
		echo view('Board/BoardWrite');
	}

	public function view($id)
	{
		echo view('Board/BoardView');
	}

	public function upData($id)
	{
		echo view('Board/BoardEdit');
	}

	public function calendar()
	{
		echo view('Calendar/Calendar');
	}

	//--------------------------------------------------------------------

}
?>