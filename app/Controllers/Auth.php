<?php 
namespace App\Controllers;
use \Firebase\JWT\JWT;
use App\Models\Auth_model;
use Config\Services;
use CodeIgniter\RESTful\ResourceController;

class Auth extends ResourceController
{
        public function __construct()
        {
            $this->auth = new Auth_model();

        }   
        

        public function register()
        {
            $firstname = $this->request->getPost('first_name');
            $lastname = $this->request->getPost('last_name');
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $password_hash = password_hash($password, PASSWORD_BCRYPT);
            $data = json_decode(file_get_contents('php://input'));

            $dataRegister = [
                'first_name' => $firstname,
                'last_name' => $lastname,
                'email' => $email,
                'password' => $password_hash
            ];

            $register = $this->auth->register($dataRegister);

            if ($register == true) {
                $output = [
                    'status' => 200,
                    'message' => 'Berhasil Daftar'
                ];

                return $this->respond($output, 200);
            } else {
                $output = [
                    'status' => 400,
                    'message' => 'Gagal Daftar'
                ];

                return $this->respond($output, 400);
            }
            
        }

        public function login()
        {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $cek_login = $this->auth->cek_login($email);

            if (password_verify($password, $cek_login['password'])) {
                $secret_key = Services::getSecretKey();
                $issue_claim = "THE_CLAIM";
                $audience_claim = "THE_AUDIENCE";
                $issuedat_claim = time();
                $notbefore_claim = $issuedat_claim + 10;
                $expired_claim = $issuedat_claim + 3600;

                $token = array(
                    "iss" => $issue_claim,
                    "aud" => $audience_claim,
                    "iat" => $issuedat_claim,
                    "nbf" => $notbefore_claim,
                    "exp" => $expired_claim,
                    "data" => array(
                        "id" => $cek_login['id'],
                        "firstname" => $cek_login['first_name'],
                        "lastname" => $cek_login['last_name'],
                        "email" => $cek_login['email'],
                    )
                );


                $token = JWT::encode($token, $secret_key);
                $output = [
                    'status' => 200,
                    'message' => 'Berhasil Login',
                    'token' => $token, 
                    'email' =>$email,
                    "expiredAt" => $expired_claim
                ];

                
                return $this->respond($output, 200);

            } else {
               $output = [
                    'status' => 401,
                    'message' => 'Gagal Login',
                    'password' =>$password,
                  
                ];
                return $this->respond($output, 401);
            }
            
        }
}

?>