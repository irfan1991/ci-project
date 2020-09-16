<?php
namespace App\Database\Seeds;
use CodeIgniter\Database\Seeder;

class CategorySeeder extends Seeder
{
    
    public function run()
    {
        $data1 = [
            'category_name' => 'Pakaian',
            'category_status' => 'Active'
        ];

        $data2 = [
            'category_name' => 'Elektronik',
            'category_status' => 'Active'
        ];

        $data3 = [
            'category_name' => 'Makanan',
            'category_status' => 'Active'
        ];

        $this->db->table('categories')->insert($data1);
        $this->db->table('categories')->insert($data2);
        $this->db->table('categories')->insert($data3);
    }
}



?>