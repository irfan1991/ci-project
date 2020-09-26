<?php
namespace App\Database\Seeds;
use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class RoleSeeder extends Seeder
{
    
    
    public function run()
    {
        $data1 = [
            'name' => 'Administrator',
           
        ];

        $data2 = [
            'name' => 'Operator',
           
        ];

        $data3 = [
            'name' => 'User',
           
        ];

        $this->db->table('roles')->insert($data1);
        $this->db->table('roles')->insert($data2);
        $this->db->table('roles')->insert($data3);
    }
}



?>