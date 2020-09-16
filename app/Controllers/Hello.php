<?php namespace App\Controllers;

class Hello extends BaseController
{
	public function index()
	{
        $data['title'] = "Hello World  from Codeigniter 4";
		return view('hello_view', $data);
    }
    
public function hari($nama)
{
    $data['title'] = "Hello World  from Codeigniter 4";
    $data['hari'] = $nama;
	return view('hello2_view', $data);
}

	//--------------------------------------------------------------------

}
