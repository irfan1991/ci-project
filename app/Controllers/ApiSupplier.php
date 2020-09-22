<?php 
namespace App\Controllers;
use Config\Services;
use Firebase\JWT\JWT;
use CodeIgniter\RESTful\ResourceController;

class ApiSupplier extends ResourceController
{
    protected $format = 'json';
    protected $modelName = 'App\Models\Supplier_model';

    public function index()
    {
       
        return $this->respond($this->model->getSupplier(), 200);
    }

    public function create()
    {
       
        $validation = \Config\Services::validation();
        $name = $this->request->getPost('supplier_name');
        $phone = $this->request->getPost('supplier_phone');
        $lat = $this->request->getPost('lat');
        $long = $this->request->getPost('long');
        $street = $this->request->getPost('street');
        $city = $this->request->getPost('city');
        $country = $this->request->getPost('country');

            $data = [
                'supplier_name' => $name,
                'supplier_phone' => $phone,
                'lat' => $lat,
                'long' => $long,
                'street' => $street,
                'city' => $city,
                'country' => $country,
            ];
            if ($validation->run($data, 'supplier') == FALSE) {
                $response = [
                    'status' => 500,
                    'error' => true,
                    'data' => $validation->getErrors(),
                ];
                return $this->respond($response, 500);
    
            } else {
                $simpan = $this->model->saveSupplier($data);
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
        $get = $this->model->getSupplier($id)->getRowArray();
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
        $get = $this->model->getSupplier($id)->getRowArray();
      
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
        if ($validation->run($data, 'supplier') == FALSE) {
            
            $response = [
                'status' => 500,
                'error' => true,
                'data' => $validation->getErrors()
            ];
            return $this->respond($response,500);
        } else {
            $simpan = $this->model->updateSupplier($data, $id);
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
        $hapus = $this->model->deleteSupplier($id);
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
