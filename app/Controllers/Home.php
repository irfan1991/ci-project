<?php namespace App\Controllers;
//Panggil JWT
use \Firebase\JWT\JWT;
//Panggil Controller Auth
use App\Controllers\Auth;
use CodeIgniter\RESTful\ResourceController;

header("Access-Control-Allow-Origin: *");
header('Content-type: application/json; charset=UTF-8');
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding
,Access-Control-Allow-Headers,Authorization,X-Requested-With");


class Home extends ResourceController
{
	public function __construct()
	{
		$this->protect = new Auth();
	}
	public function index()
	{
		$secret_key = $this->protect->privateKey();
		$token = null;
		$authHeader = $this->request->getServer('HTTP_AUTHORIZATION');

		$arr = explode(" ", $authHeader);
		$token = $arr[1];
		if ($token) {
			try {
				$decoded = JWT::decode($token, $secret_key, array('RS256'));
				if ($decoded) {
					$output = [
						'message' => 'Access granted'
					];
					return $this->respond($output, 200);
				}
			} catch (\Throwable $th) {
				$output = [
					'error' => $th->getMessage()
				];
				return $this->respond($output, 401);
			}
		} 
		
		// return view('welcome_message');
	}

	//--------------------------------------------------------------------

}
