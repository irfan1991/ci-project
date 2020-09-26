<?php
namespace App\Database\Seeds;
use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class UserRoleSeeder extends Seeder
{
    
    
    public function run()
    {
        
        $data1 = [
            'user_id' => 1,
            'role_id' => 1
        ];

     

        $this->db->table('user_role')->insert($data1);
    }
}



?>