<?php 
namespace App\Models;
use CodeIgniter\Model;

class Input_model extends Model {
    protected $table = "inputs";
    
    public function getInput($id = false)
    {
        if ($id === false) {
            return $this->db->table($this->table." a ")
            ->select(' a.*, DATE_FORMAT(a.time, "%W,%M %e %Y, %r") as waktu , b.product_name, c.supplier_name')->join('product b ','a.product_id=b.product_id','left')
            ->join('suppliers c ','a.supplier_id=c.id','left')
            ->get()->getResultArray();
        } else {
            return $this->db->table($this->table." a ")
            ->select(' a.*, DATE_FORMAT(a.time, "%W, %M %e %Y, %r") as waktu , b.product_name, c.supplier_name')->join('product b ','a.product_id=b.product_id','left')
            ->join('suppliers c ','a.supplier_id=c.id','left')->getWhere(['id' => $id]);
        }
        
    }

    public function saveInput($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updateInput($data, $id)
    {
        $query = $this->db->table($this->table)->update($data, array('id' => $id));
        return $query;
    }

    public function deleteInput($id)
    {
        $query = $this->db->table($this->table)->delete(array('id' => $id));
        return $query;
    }
}


?>

