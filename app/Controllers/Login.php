<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\Auth_model;

class Login extends Controller
{
    
    public function __construct()
    {
        $this->auth = new Auth_model();

    }   

    public function index()
    {
        echo view('layout/header');
        echo view('login');
        echo view('layout/footerlogin');
    }


    public function proses()
    {
        $email = htmlspecialchars($this->request->getPost('email'));
        $password = htmlspecialchars($this->request->getPost('password'));

        $cek_login = $this->auth->cek_login($email);
    
        if (password_verify($password, $cek_login['password'])) {
            session()->set("id", $cek_login['id']);
            session()->set("password", $cek_login['password']);
            session()->set("email", $cek_login['email']);
            session()->set("firstname", $cek_login['first_name']);
            session()->set("lastname", $cek_login['last_name']);

            return redirect()->to('/hello');
        } else {
            return redirect()->to('/login');
        }

    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
    
}

?>