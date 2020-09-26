<?php
namespace App\Database\Seeds;
use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    
    public function run()
    {
        $data1 = [
            'first_name' => 'Irfan',
            'last_name' => 'Prasetyo',
            'email' => 'asisten91@gmail.com',
            'password' => '$2y$10$pqRA/VilP2IbYJ0VY6/cuOlp7IMGMQ2IuSzev7pd0p/EnYOH5z2Sy',
        ];

    
        $this->db->table('users')->insert($data1);
    
    }
}



?>