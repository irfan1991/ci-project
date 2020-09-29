<?php 
namespace App\Models;
use CodeIgniter\Model;

class User_model extends Model {
    protected $table = "users";
    
    public function getUser($id = false)
    {
        if ($id === false) {
            return $this->db->table($this->table." a ")
            ->select(' a.* ,  group_concat(b.name) AS roles')
            ->join('user_role c','a.id=c.user_id','left')
            ->join('roles b','c.role_id=b.id','left')
            ->groupBy(["a.id",])
            ->get()->getResultArray();
        } else {
            return $this->db->table($this->table." a ")
            ->select(' a.* ,  group_concat(b.name) AS roles')
            ->join('user_role c','a.id=c.user_id','left')
            ->join('roles b','c.role_id=b.id','left')
            ->getWhere(['a.id' => $id]);
        }
        
    }

    public function saveUser($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }

    public function updateUser($data, $id)
    {
        $query = $this->db->table($this->table)->update($data, array('id' => $id));
        return $query;
    }

    public function deleteUser($id)
    {
        $query = $this->db->table($this->table)->delete(array('id' => $id));
        return $query;
    }
}


?>

