<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\Category_model;
use Config\Services;

class Category extends Controller
{
    protected $modul = "category";

    public function index()
    {
        $model = new Category_model();
        $data['categories'] =  $model->getCategory();
        $data['title'] = 'Category List';
        $data['arr'] = 'List';
        Services::template('categories/index', $data);
    }
    
    public function add()
    {
        $data['urlmethod'] = $this->modul.'/save';
        $data['arr'] = 'Add';
        $data['title'] = 'Form Category';
        Services::template('categories/form', $data);
    }

    public function save()
    {
        $model = new Category_model();
        $data = array(
            'category_name' => $this->request->getPost('category_name'),
            'category_status' => $this->request->getPost('status'),
        );
        $model->saveCategory($data);
        session()->setFlashData('success', 'Data is saved successfully!');
        return redirect()->to('/category');
    }

    public function edit($id)
    {
        $model = new Category_model();
        $data['category'] = $model->getCategory($id)->getRow();
        $data['urlmethod'] = $this->modul.'/update';
        $data['arr'] = 'Edit';
        $data['title'] = 'Form Category';
        Services::template('categories/form', $data);
    }


    public function view($id)
    {
        $model = new Category_model();
        $data['category'] = $model->getCategory($id)->getRow();
        $data['arr'] = 'View';
        $data['urlmethod'] = $this->modul;
        $data['v'] = "";
        $data['title'] = 'Category Detail';
        Services::template('categories/form', $data);
    }

    public function update()
    {
        $model = new Category_model();
        $id = $this->request->getPost('id');
        $data = array(
            'category_name' => $this->request->getPost('category_name'),
            'category_status' => $this->request->getPost('status'),
        );
        $model->updateCategory($data,$id);
        session()->setFlashData('success', 'Data is updated successfully!');
        return redirect()->to('/category');
    }

    public function delete($id)
    {
        
        try {
            $model =  new Category_model();
            $model->deleteCategory($id);
        } catch (\Throwable $th) {
            //throw $th;
            session()->setFlashData('error', 'Something wrongs because '.$th->getMessage());
            return redirect()->to('/category');
        }
       
        return redirect()->to('/category');
    }
}


?>