<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\Product_model;
use App\Models\Category_model;
use Config\Services;

class Product extends Controller
{

    protected $modul = "product";

    public function __construct()
    {
        helper('form');
        helper('file');
    }

    public function index()
    {
        $model = new Product_model();
        $data['products'] =  $model->getProduct();
        $data['title'] = 'Product List';
        $data['arr'] = 'List';
        Services::template('products/index', $data);
       
    }
    
    public function add()
    {
        $model = new Category_model();
        $data['categories'] = $model->getCategory();
        $data['urlmethod'] = $this->modul.'/save';
        $data['arr'] = 'Add';
        $data['title'] = 'Form Product';
        Services::template('products/form', $data);
    }

    public function save()
    {
        $model = new Product_model();
          if ($_FILES['photo']['name'] != "") {
            $photo = $this->request->getFile('photo');
            $photo->move(ROOTPATH.'public/uploads');
            $getPhoto = $photo->getName();
         } else {
            $getPhoto = NULL;
         }

        $data = array(
            'product_name' => $this->request->getPost('product_name'),
            'product_price' => $this->request->getPost('product_price'),
            'product_stock' => $this->request->getPost('product_stock'),
            'product_category' => $this->request->getPost('product_category'),
            'photo' => $getPhoto,
            'description' => $this->request->getPost('description'),
          
        );
        $model->saveProduct($data);
        session()->setFlashData('success', 'Data is saved successfully!');
        return redirect()->to('/product');
    }

    public function edit($id)
    {
        $model = new Product_model();
        $modelCat = new Category_model();
        $data['categories'] = $modelCat->getCategory();
        $data['product'] = $model->getProduct($id)->getRow();
        $data['urlmethod'] = $this->modul.'/update';
        $data['arr'] = 'Edit';
        $data['title'] = 'Form Product';
        Services::template('products/form', $data);
    }


    public function view($id)
    {
        $model = new Product_model();
        $data['product'] = $model->getProduct($id)->getRow();
        $data['arr'] = 'View';
        $data['urlmethod'] = $this->modul;
        $data['v'] = "";
        $data['title'] = 'Product Detail';
        Services::template('products/form', $data);
        
    }

    public function update()
    {
        $model = new Product_model();
        $id = $this->request->getPost('product_id');
        $cek = $model->where('product_id',$id)->first();
       if ($_FILES['photo']['name'] != "") {
          $photo = $this->request->getFile('photo');
          unlink(ROOTPATH.'public/uploads/'.$cek["photo"]);
          $photo->move(ROOTPATH.'public/uploads');
          $getPhoto = $photo->getName();
       } else {
          $getPhoto = $cek["photo"];
       }

        $value = '';
        $data = array(
            'product_name' => $this->request->getPost('product_name'),
            'product_price' => $this->request->getPost('product_price'),
            'product_stock' => $this->request->getPost('product_stock'),
            'product_category' => $this->request->getPost('product_category'),
             'photo' => $getPhoto,
            'description' => $this->request->getPost('description'),
        );
        $model->updateProduct($data,$id);
        session()->setFlashData('success', 'Data is updated successfully!');
        return redirect()->to('/product');
    }

    public function delete($id)
    {
        $model =  new Product_model();
        $cek = $model->where('product_id',$id)->first();
        if ($cek["photo"] != NULL ) {
            unlink(ROOTPATH.'public/uploads/'.$cek["photo"]);
        }
        $model->deleteProduct($id);
        session()->setFlashData('success', 'Data is deleted successfully!');
        return redirect()->to('/product');
    }
}


?>