<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\Supplier_model;
use Config\Services;


class Supplier extends Controller
{
    protected $modul = "supplier";
    
    public function index()
    {
       // var_dump(session('lastname'));die();
        $model = new Supplier_model();
        $data['suppliers'] =  $model->getSupplier();
        $data['title'] = 'Supplier List';
        $data['arr'] = 'List';
        Services::template('suppliers/index', $data);
    }
    
    public function add()
    {
        $data['urlmethod'] = $this->modul.'/save';
        $data['arr'] = 'Add';
        $data['title'] = 'Form Supplier';
        Services::template('suppliers/form', $data);
    }

    public function save()
    {
        $model = new Supplier_model();
        $data = array(
            'supplier_name' => $this->request->getPost('supplier_name'),
            'supplier_phone' => $this->request->getPost('supplier_phone'),
            'lat' => $this->request->getPost('lat'),
            'long' => $this->request->getPost('long'),
            'street' => $this->request->getPost('street'),
            'city' => $this->request->getPost('city'),
            'country' => $this->request->getPost('country'),
        );
        $model->saveSupplier($data);
        session()->setFlashData('success', 'Data is saved successfully!');
        return redirect()->to('/supplier');
    }

    public function edit($id)
    {
        $model = new Supplier_model();
        $data['supplier'] = $model->getSupplier($id)->getRow();
        $data['urlmethod'] = $this->modul.'/update';
        $data['arr'] = 'Edit';
        $data['title'] = 'Form Supplier';
        Services::template('suppliers/form', $data);
    }


    public function view($id)
    {
        $model = new Supplier_model();
        $data['supplier'] = $model->getSupplier($id)->getRow();
        $data['arr'] = 'View';
        $data['urlmethod'] = $this->modul;
        $data['v'] = "";
        $data['title'] = 'Supplier Detail';
        Services::template('suppliers/form', $data);
    }

    public function update()
    {
        $model = new Supplier_model();
        $id = $this->request->getPost('id');
        $data = array(
            'supplier_name' => $this->request->getPost('supplier_name'),
            'supplier_phone' => $this->request->getPost('supplier_phone'),
            'lat' => $this->request->getPost('lat'),
            'long' => $this->request->getPost('long'),
            'street' => $this->request->getPost('street'),
            'city' => $this->request->getPost('city'),
            'country' => $this->request->getPost('country'),
        );
        $model->updateSupplier($data,$id);
        session()->setFlashData('success', 'Data is updated successfully!');
        return redirect()->to('/supplier');
    }

    public function delete($id)
    {
        
        try {
            $model =  new Supplier_model();
            $model->deleteSupplier($id);
        } catch (\Throwable $th) {
            //throw $th;
            session()->setFlashData('error', 'Something wrongs because '.$th->getMessage());
            return redirect()->to('/supplier');
        }
       
        return redirect()->to('/supplier');
    }
}


?>