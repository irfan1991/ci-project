<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Config\Services;
use Firebase\JWT\JWT;
use CodeIgniter\API\ResponseTrait;


class AuthFilter implements FilterInterface
{
	use ResponseTrait;

	public function before(RequestInterface $request , $arguments = null)
	{
			
		try
		{
		$key        = Services::getSecretKey();
		$authHeader = $request->getServer('HTTP_AUTHORIZATION');
		$arr        = explode(' ', $authHeader);
		$token      = $arr[1];

	
			JWT::decode($token, $key, ['HS256']);
		
		}
		catch (\Exception $e)
		{
			
			$output = [
				'message' => 'Access denied',
				"error" => $e->getMessage()
			];
			return Services::response()
				->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED)->setJSON(json_encode($output));
		}
	}

	//--------------------------------------------------------------------

	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
	{
		// Do something here
	
	}
}