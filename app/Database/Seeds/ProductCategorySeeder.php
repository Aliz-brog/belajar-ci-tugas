<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    public function run()
    {
        // membuat data
        $data = [
            [
                'name' => 'Laptop Gaming',
                'description'  => 'Laptop gaming dengan performa tinggi',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'name' => 'Ultrabook',
                'description'  => 'Laptop tipis dan ringan untuk mobilitas tinggi',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'name' => 'Business Laptop',
                'description'  => 'Laptop untuk kebutuhan bisnis dan produktivitas',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]
        ];

        foreach ($data as $item) {
            // insert semua data ke tabel
            $this->db->table('product_category')->insert($item);
        }
    }
}
