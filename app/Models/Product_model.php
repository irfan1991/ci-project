<?php 
namespace App\Models;
use CodeIgniter\Model;

class Product_model extends Model {
    protected $table = "product";

    
    
    public function getProduct($id = false)
    {
        if ($id === false) {
            return $this->db->table($this->table." a ")
            ->select(' a.* , b.category_name')->join('category b ','a.product_category=b.id','left')
            ->get()->getResultArray();
        } else {
            return$this->db->table($this->table." a ")
            ->select(' a.* , b.category_name, b.id')->join('category b ','a.product_category=b.id','left')
            ->getWhere(['a.product_id' => $id]);
        }
        
    }

    public function saveProduct($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updateProduct($data, $id)
    {
        $query = $this->db->table($this->table)->update($data, array('product_id' => $id));
        return $query;
    }

    public function deleteProduct($id)
    {
        $query = $this->db->table($this->table)->delete(array('product_id' => $id));
        return $query;
    }
}


?>

