<?php 
namespace App\Models;
use CodeIgniter\Model;

class Input_model extends Model {
    protected $table = "inputs";
    
    public function getInput($id = false, $time = false)
    {
        if ($id === false AND $time === false) {
            return $this->db->table($this->table." a ")
            ->select(' a.*, DATE_FORMAT(a.time, "%W,%M %e %Y, %r") as waktu , b.product_name, c.supplier_name')->join('product b ','a.product_id=b.product_id','left')
            ->join('suppliers c ','a.supplier_id=c.id','left')->groupBy(["a.supplier_id", "a.time"])
            ->get()->getResultArray();
        } else {
            return $this->db->table($this->table." a ")
            ->select(' a.*, DATE_FORMAT(a.time, "%W, %M %e %Y, %r") as waktu , b.product_name, c.supplier_name')->join('product b ','a.product_id=b.product_id','left')
            ->join('suppliers c ','a.supplier_id=c.id','left')->getWhere(['supplier_id' => $id, 'time' => $time])->getResultArray();
        }
        
    }

    public function saveInput($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }


    public function deleteInput($id,$time)
    {
        $query = $this->db->table($this->table)->delete(array('supplier_id' => $id, 'time' => $time));
        return $query;
    }

    public function amount()
    {
        return $this->db->table($this->table)
            ->select('SUM(amount) AS amount ')->groupBy('DATE_FORMAT(time,"%M")')->orderBy('time','ASC')->get()->getResultArray();

    }

    public function month()
    {
        return $this->db->table($this->table)
            ->select('DATE_FORMAT(time,"%M") as month')
            ->groupBy(['DATE_FORMAT(time,"%M")'])
            ->orderBy('time')
            ->get()->getResultArray();
    }
}


?>

