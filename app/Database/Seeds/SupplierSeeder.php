<?php
namespace App\Database\Seeds;
use CodeIgniter\Database\Seeder;

class SupplierSeeder extends Seeder
{
    
    public function run()
    {
        $data1 = [
            'supplier_name' => 'Dilan Dhirga',
            'supplier_phone' => '089456789',
            'lat' => '-6.3106925',
            'long' => '106.7824432,15z',
            'street' => 'Karang Tengah',
            'city' => 'Jakarta Selatan',
            'country' => 'Jakarta'
        ];

     

        $this->db->table('suppliers')->insert($data1);
    }
}



?>