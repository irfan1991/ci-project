<?php 
namespace App\Controllers;

// Panggil JWT
use \Firebase\JWT\JWT;
// panggil class Auht
use App\Controllers\Auth;
// panggil restful api codeigniter 4
use CodeIgniter\RESTful\ResourceController;
 
header("Access-Control-Allow-Origin: * ");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 

class ApiProduct extends ResourceController
{
    protected $format = 'json';
    protected $modelName = 'App\Models\Product_model';
    protected $token = null;

 	

    public function __construct()
    {
        // inisialisasi class Auth dengan $this->protect
        $this->protect = new Auth();
    }


    public function index()
    {
        $secret_key = $this->protect->privateKey();
        $authHeader = $this->request->getServer('HTTP_AUTHORIZATION');
        $arr = explode(" ", $authHeader);
        $token = $arr[1];

            if($token){
    
                try {
            
                    $decoded = JWT::decode($token, $secret_key, array('HS256'));
            
                    // Access is granted. Add code of the operation here 
                    if($decoded){
                        // response true
                        $output = [
                            'message' => 'Access granted',
                            'data' => $this->model->getProduct()
                        ];
                        return $this->respond($output, 200);
                    }
                    
            
                } catch (\Exception $e){
    
                    $output = [
                        'message' => 'Access denied',
                        "error" => $e->getMessage()
                    ];
            
                    return $this->respond($output, 401);
                }
            }
    }
 	
        


    public function create()
    {
       
        $validation = \Config\Services::validation();
        $name = $this->request->getPost('product_name');
        $price = $this->request->getPost('product_price');
        $stock = $this->request->getPost('product_stock');
        $category = $this->request->getPost('product_category');
        $description = $this->request->getPost('description');
        $photo = $this->request->getFile('photo');
        $id = $this->request->getPost('product_id');
 //var_dump($_FILES);die();
        if (!$id) {

            if ($photo != NULL) {
                $photo->move(ROOTPATH.'public/uploads');
                $getPhoto = $photo->getName();
             } else {
                $getPhoto = NULL;
             }
    
    
            $data = [
                'product_name' => $name,
                'product_price' => $price,
                'product_stock' => $stock,
                'product_category' => $category,
                'description' => $description,
                'photo' => $getPhoto
            ];
            if ($validation->run($data, 'product') == FALSE) {
                $response = [
                    'status' => 500,
                    'error' => true,
                    'data' => $validation->getErrors(),
                ];
                return $this->respond($response, 500);
    
            } else {
                $simpan = $this->model->saveProduct($data);
                if ($simpan) {
                    $msg = ["message" => "Berhasil disimpan"];
                    $response = [
                        'status' => 200,
                        'error' => false,
                        'data' => $msg
                    ];
                    return $this->respond($response, 200);
                }
                
            }

        } else {
            
            $cek = $this->model->where('product_id',$id)->first();
    
            if ($photo != NULL) {
               unlink(ROOTPATH.'public/uploads/'.$cek["photo"]);
               $photo->move(ROOTPATH.'public/uploads');
               $getPhoto = $photo->getName();
            } else {
               $getPhoto = $cek["photo"];
            }
    
            $data = [
                'product_name' => $name,
                'product_price' => $price,
                'product_stock' => $stock,
                'product_category' => $category,
                'description' => $description,
                'photo' => $getPhoto
            ];
    
            if ($validation->run($data, 'product') == FALSE) {
                
                $response = [
                    'status' => 500,
                    'error' => true,
                    'data' => $validation->getErrors()
                ];
                return $this->respond($response,500);
            } else {
                $simpan = $this->model->updateProduct($data, $id);
                if ($simpan) {
                    $msg = ['message' => 'Data berhasil diupdate'];
                    $response = [
                        'status' => 200,
                        'error' => false,
                        'data' => $msg
                    ];
                    return $this->respond($response, 200);
                }
    
            }
        }
        

       

        
    }


    public function show($id = NULL)
    {
        $get = $this->model->getProduct($id)->getRowArray();
        if ($get) {
            $code = 200;
            $response = [
                'status' => $code ,
                'error' => false,
                'data' => $get
            ];
        } else {
            $code = 401;
            $response = [
                'status' => $code ,
                'error' => true,
                'data' => ['message' => 'Not Found']
            ];
        }
        return $this->respond($response, $code);
    }

    public function edit($id = NULL)
    {
        $get = $this->model->getProduct($id)->getRowArray();
        var_dump($get);die();
        if ($get) {
            $code = 200;
            $response = [
                'status' => $code ,
                'error' => false,
                'data' => $get
            ];
        } else {
            $code = 401;
            $response = [
                'status' => $code ,
                'error' => true,
                'data' => ['message' => 'Not Found']
            ];
        }
        return $this->respond($response, $code);
    }


   

    public function update($id = NULL)
    {
        helper(['form', 'array','text']);
        
        $validation = \Config\Services::validation();
        var_dump($_REQUEST);die();
        $name = $this->request->getPost('product_name');
        $price = $this->request->getPost('product_price');
        $stock = $this->request->getPost('product_stock');
        $category = $this->request->getPost('product_category');
        $description = $this->request->getPost('description');
        var_dump($this->request->getRawInput());die();
        $cek = $this->model->where('product_id',$id)->first();
        $photo = $this->request->getFile('photo');

        if ($photo != NULL) {
           unlink(ROOTPATH.'public/uploads/'.$cek["photo"]);
           $photo->move(ROOTPATH.'public/uploads');
           $getPhoto = $photo->getName();
        } else {
           $getPhoto = $cek["photo"];
        }

        $data = [
            'product_name' => $name,
            'product_price' => $price,
            'product_stock' => $stock,
            'product_category' => $category,
            'description' => $description,
            'photo' => $getPhoto
        ];

        if ($validation->run($data, 'product') == FALSE) {
            
            $response = [
                'status' => 500,
                'error' => true,
                'data' => $validation->getErrors()
            ];
            return $this->respond($response,500);
        } else {
            $simpan = $this->model->updateProduct($data, $id);
            if ($simpan) {
                $msg = ['message' => 'Data berhasil diupdate'];
                $response = [
                    'status' => 200,
                    'error' => false,
                    'data' => $msg
                ];
                return $this->respond($response, 200);
            }

        }
        

    }


    public function delete($id = NULL)
    {
        $hapus = $this->model->deleteProduct($id);
        if ($hapus) {
            $code = 200;
            $msg = ['message' => 'Deleted category successfully'];
            $response = [
                'status' => $code,
                'error' => false,
                'data' => $msg
            ];
        } else {
            $code = 401;
            $msg = ['message' => 'Not Found'];
            $response = [
                'status' => $code,
                'error' => true,
                'data' => $msg
            ];
         
        }
        return $this->respond($response);
    }


}


?>
