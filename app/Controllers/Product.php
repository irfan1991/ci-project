<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\Product_model;
use App\Models\Category_model;

class Product extends Controller
{

    public function __construct()
    {
        helper('form');
        helper('file');
    }

    public function index()
    {
        $model = new Product_model();
        $data['products'] =  $model->getProduct();
        return view('products/index', $data);
    }
    
    public function add()
    {
        $model = new Category_model();
        $data['categories'] = $model->getCategory();
        return view('products/add', $data);
    }

    public function save()
    {
        $model = new Product_model();
        // $validate = $this->validate(['potho'] => )
        $photo = $this->request->getFile('photo');
          if ($photo != NULL) {
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
        return redirect()->to('/product');
    }

    public function edit($id)
    {
        $model = new Product_model();
        $modelCat = new Category_model();
        $data['categories'] = $modelCat->getCategory();
        $data['product'] = $model->getProduct($id)->getRow();
        return view('products/edit', $data);
    }


    public function view($id)
    {
        $model = new Product_model();
        $data['product'] = $model->getProduct($id)->getRow();
        return view('products/view', $data);
    }

    public function update()
    {
        $model = new Product_model();
        $id = $this->request->getPost('product_id');
        $photo = $this->request->getFile('photo');
        $cek = $model->where('product_id',$id)->first();
       if ($photo != NULL) {
          unlink(ROOTPATH.'public/uploads/'.$cek["photo"]);
          $photo->move(ROOTPATH.'public/uploads');
          $getPhoto = $photo->getName();
       } else {
          $getPhoto = $cek["photo"];
       }
       
       
       
//   var_dump($cek["photo"]);die();
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
        return redirect()->to('/product');
    }

    public function delete($id)
    {
        $model =  new Product_model();
        $cek = $model->where('product_id',$id)->first();
        if ($cek["photo"] !== NULL || $cek["photo"] !== " ") {
            unlink(ROOTPATH.'public/uploads/'.$cek["photo"]);
        }
        $model->deleteProduct($id);
        return redirect()->to('/product');
    }
}


?>