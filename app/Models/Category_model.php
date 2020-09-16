<?php 
namespace App\Models;
use CodeIgniter\Model;

class category_model extends Model {
    protected $table = "categories";
    
    public function getCategory($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id' => $id]);
        }
        
    }

    public function saveCategory($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updateCategory($data, $id)
    {
        $query = $this->db->table($this->table)->update($data, array('id' => $id));
        return $query;
    }

    public function deleteCategory($id)
    {
        $query = $this->db->table($this->table)->delete(array('id' => $id));
        return $query;
    }
}


?>

