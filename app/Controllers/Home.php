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

	public function viewcon()
	{
		echo view('Board/BoardWrite');
	}

	public function rewrite()
	{
		echo view('Board/BoardWrite');
	}

	//--------------------------------------------------------------------

}
?>