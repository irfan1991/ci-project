<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\Customer_model;
use Config\Services;

class Customer extends Controller
{
    protected $modul = "customer";

    public function index()
    {
        $model = new Customer_model();
        $data['customers'] =  $model->getCustomer();
        $data['title'] = 'Customer List';
        $data['arr'] = 'List';
        Services::template('customers/index', $data);
    }
    
    public function add()
    {
        $data['urlmethod'] = $this->modul.'/save';
        $data['arr'] = 'Add';
        $data['title'] = 'Form Customer';
        Services::template('customers/form', $data);
    }

    public function save()
    {
        $model = new Customer_model();
        $data = array(
            'customer_name' => $this->request->getPost('customer_name'),
            'customer_phone' => $this->request->getPost('customer_phone'),
            'lat' => $this->request->getPost('lat'),
            'long' => $this->request->getPost('long'),
            'street' => $this->request->getPost('street'),
            'city' => $this->request->getPost('city'),
            'country' => $this->request->getPost('country'),
        );
        $model->saveCustomer($data);
        session()->setFlashData('success', 'Data is saved successfully!');
        return redirect()->to('/customer');
    }

    public function edit($id)
    {
        $model = new Customer_model();
        $data['customer'] = $model->getCustomer($id)->getRow();
        $data['urlmethod'] = $this->modul.'/update';
        $data['arr'] = 'Edit';
        $data['title'] = 'Form Customer';
        Services::template('customers/form', $data);
    }


    public function view($id)
    {
        $model = new Customer_model();
        $data['customer'] = $model->getCustomer($id)->getRow();
        $data['arr'] = 'View';
        $data['urlmethod'] = $this->modul;
        $data['v'] = "";
        $data['title'] = 'Customer Detail';
        Services::template('customers/form', $data);
    }

    public function update()
    {
        $model = new Customer_model();
        $id = $this->request->getPost('id');
        $data = array(
            'customer_name' => $this->request->getPost('customer_name'),
            'customer_phone' => $this->request->getPost('customer_phone'),
            'lat' => $this->request->getPost('lat'),
            'long' => $this->request->getPost('long'),
            'street' => $this->request->getPost('street'),
            'city' => $this->request->getPost('city'),
            'country' => $this->request->getPost('country'),
        );
        $model->updateCustomer($data,$id);
        session()->setFlashData('success', 'Data is updated successfully!');
        return redirect()->to('/customer');
    }

    public function delete($id)
    {
        
        try {
            $model =  new Customer_model();
            $model->deleteCustomer($id);
        } catch (\Throwable $th) {
            //throw $th;
            session()->setFlashData('error', 'Something wrongs because '.$th->getMessage());
            return redirect()->to('/customer');
        }
       
        return redirect()->to('/customer');
    }
}


?>