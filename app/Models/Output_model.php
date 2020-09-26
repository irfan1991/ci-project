<?php 
namespace App\Models;
use CodeIgniter\Model;

class Output_model extends Model {
    protected $table = "outputs";
    
    public function getOutput($id = false, $time = false)
    {
        if ($id === false AND $time === false) {
            return $this->db->table($this->table." a ")
            ->select(' a.*, DATE_FORMAT(a.time, "%W,%M %e %Y, %r") as waktu , b.product_name, c.customer_name')->join('product b ','a.product_id=b.product_id','left')
            ->join('customers c ','a.customer_id=c.id','left')->groupBy(["a.customer_id", "a.time"])
            ->get()->getResultArray();
        } else {
            return $this->db->table($this->table." a ")
            ->select(' a.*, DATE_FORMAT(a.time, "%W, %M %e %Y, %r") as waktu , b.product_name, c.customer_name')->join('product b ','a.product_id=b.product_id','left')
            ->join('customers c ','a.customer_id=c.id','left')->getWhere(['customer_id' => $id, 'time' => $time])->getResultArray();
        }
        
    }

    public function saveOutput($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }


    public function deleteOutput($id,$time)
    {
        $query = $this->db->table($this->table)->delete(array('customer_id' => $id, 'time' => $time));
        return $query;
    }
}


?>

