<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Product::insert([
            [
                'name' => 'Keyboard',
                'sku' => 'PROD001',
                'price' => 500,
                'quantity' => 10,
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'name' => 'Mouse',
                'sku' => 'PROD002',
                'price' => 300,
                'quantity' => 15,
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'name' => 'Monitor',
                'sku' => 'PROD003',
                'price' => 7000,
                'quantity' => 5,
                'created_at' => now(), 'updated_at' => now()
            ],
        ]);
    }
}
