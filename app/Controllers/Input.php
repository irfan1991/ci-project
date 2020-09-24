<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\Input_model;
use App\Models\Product_model;
use App\Models\Supplier_model;
use Config\Services;
use CodeIgniter\I18n\Time;

class Input extends Controller
{
    protected $modul = "input";

    public function index()
    {  
        $model = new Input_model();
        $data['inputs'] =  $model->getInput();
        $data['title'] = 'Input List';
        $data['arr'] = 'List';
        Services::template('inputs/index', $data);
    }
    
    public function add()
    {
        $model = new Product_model();
        $models = new Supplier_model();
        $data['products'] =  $model->getProduct();
        $data['suppliers'] =  $models->getSupplier();
        $data['urlmethod'] = $this->modul.'/save';
        $data['arr'] = 'Add';
        $data['title'] = 'Form Input';
        Services::template('inputs/form', $data);
    }

    public function save()
    {
        $model = new Input_model();
        $data = array(
            'input_name' => $this->request->getPost('input_name'),
            'input_status' => $this->request->getPost('status'),
        );
        $model->saveInput($data);
        session()->setFlashData('success', 'Data is saved successfully!');
        return redirect()->to('/input');
    }

    public function edit($id)
    {
        $model = new Input_model();
        $data['input'] = $model->getInput($id)->getRow();
        $data['urlmethod'] = $this->modul.'/update';
        $data['arr'] = 'Edit';
        $data['title'] = 'Form Input';
        Services::template('inputs/form', $data);
    }


    public function view($id)
    {
        $model = new Input_model();
        $data['input'] = $model->getInput($id)->getRow();
        $data['arr'] = 'View';
        $data['urlmethod'] = $this->modul;
        $data['v'] = "";
        $data['title'] = 'Input Detail';
        Services::template('inputs/form', $data);
    }

    public function update()
    {
        $model = new Input_model();
        $id = $this->request->getPost('id');
        $data = array(
            'input_name' => $this->request->getPost('input_name'),
            'input_status' => $this->request->getPost('status'),
        );
        $model->updateInput($data,$id);
        session()->setFlashData('success', 'Data is updated successfully!');
        return redirect()->to('/input');
    }

    public function delete($id)
    {
        
        try {
            $model =  new Input_model();
            $model->deleteInput($id);
        } catch (\Throwable $th) {
            //throw $th;
            session()->setFlashData('error', 'Something wrongs because '.$th->getMessage());
            return redirect()->to('/input');
        }
       
        return redirect()->to('/input');
    }
}


?>