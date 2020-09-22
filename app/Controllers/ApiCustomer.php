<?php 
namespace App\Controllers;
use Config\Services;
use Firebase\JWT\JWT;
use CodeIgniter\RESTful\ResourceController;

class ApiCustomer extends ResourceController
{
    protected $format = 'json';
    protected $modelName = 'App\Models\Customer_model';

    public function index()
    {
       
        return $this->respond($this->model->getCustomer(), 200);
    }

    public function create()
    {
       
        $validation = \Config\Services::validation();
        $name = $this->request->getPost('customer_name');
        $phone = $this->request->getPost('customer_phone');
        $lat = $this->request->getPost('lat');
        $long = $this->request->getPost('long');
        $street = $this->request->getPost('street');
        $city = $this->request->getPost('city');
        $country = $this->request->getPost('country');

            $data = [
                'customer_name' => $name,
                'customer_phone' => $phone,
                'lat' => $lat,
                'long' => $long,
                'street' => $street,
                'city' => $city,
                'country' => $country,
            ];
            if ($validation->run($data, 'customer') == FALSE) {
                $response = [
                    'status' => 500,
                    'error' => true,
                    'data' => $validation->getErrors(),
                ];
                return $this->respond($response, 500);
    
            } else {
                $simpan = $this->model->saveCustomer($data);
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

            
        }
   
    public function show($id = NULL)
    {
        $get = $this->model->getCustomer($id)->getRowArray();
        if ($get) {
            $code = 200;
            $response = [
                'status' => $code ,
                'error' => false,
                'data' => $get
            ];
        } else {
            $code = 404;
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
        $get = $this->model->getCustomer($id)->getRowArray();
      
        if ($get) {
            $code = 200;
            $response = [
                'status' => $code ,
                'error' => false,
                'data' => $get
            ];
        } else {
            $code = 404;
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
        $validation = \Config\Services::validation();
       
        $data = $this->request->getRawInput();
        if ($validation->run($data, 'customer') == FALSE) {
            
            $response = [
                'status' => 500,
                'error' => true,
                'data' => $validation->getErrors()
            ];
            return $this->respond($response,500);
        } else {
            $simpan = $this->model->updateCustomer($data, $id);
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
        $hapus = $this->model->deleteCustomer($id);
        if ($hapus) {
            $code = 200;
            $msg = ['message' => 'Deleted data successfully'];
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
