<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\Category_model;

class Category extends Controller
{
    public function index()
    {
        $model = new Category_model();
        $data['categories'] =  $model->getCategory();
        return view('categories/index', $data);
    }
    
    public function add()
    {
        return view('categories/add');
    }

    public function save()
    {
        $model = new Category_model();
        $data = array(
            'category_name' => $this->request->getPost('category_name'),
        );
        $model->saveCategory($data);
        return redirect()->to('/category');
    }

    public function edit($id)
    {
        $model = new Category_model();
        $data['category'] = $model->getCategory($id)->getRow();
        return view('categories/edit', $data);
    }


    public function view($id)
    {
        $model = new Category_model();
        $data['category'] = $model->getCategory($id)->getRow();
        return view('categories/view', $data);
    }

    public function update()
    {
        $model = new Category_model();
        $id = $this->request->getPost('id');
        $data = array(
            'category_name' => $this->request->getPost('category_name'),
           
        );
        $model->updateCategory($data,$id);
        return redirect()->to('/category');
    }

    public function delete($id)
    {
        try {
            $model =  new Category_model();
            $model->deleteCategory($id);
        } catch (\Throwable $th) {
            //throw $th;
            session()->setFlashData('error', 'Tidak bisa dihapus karena '.$th->getMessage());
        }
      
        return redirect()->to('/category');
    }
}


?>