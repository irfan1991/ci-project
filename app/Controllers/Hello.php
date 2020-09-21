<?php namespace App\Controllers;

class Hello extends BaseController
{
	public function index()
	{
		echo view('layout/header');
		echo view('layout/sidebar');
		echo view('layout/topbar');
        echo view('hello_view');
        echo view('layout/footer');
    }
    

}
