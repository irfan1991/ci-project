<?php
namespace App\Database\Seeds;
use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class ProductSeeder extends Seeder
{
    
    
    public function run()
    {
        
        $data1 = [
            'product_name' => 'Kaos Kaki',
            'product_stock' => 10,
            'product_price' =>  12000,
            'product_category' => 1,
            'description' => 'Barang Bagus',
        ];

        $data2 = [
            'product_name' => 'Kulkas',
            'product_stock' => 30,
            'product_price' =>  5200000,
            'product_category' => 2,
            'description' => 'Barang Bagus',
        ];

        $data3 = [
            'product_name' => 'Kue Tar',
            'product_stock' => 8,
            'product_price' =>  29000,
            'product_category' => 1,
            'description' => 'Makanan Enak',
        ];

        $this->db->table('product')->insert($data1);
        $this->db->table('product')->insert($data2);
        $this->db->table('product')->insert($data3);
    }
}



?>