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
        //
        $products = [
            [
                'name' => 'Beras',
                'description' => 'Beras premium berkualitas tinggi.',
                'price' => 20000.00,
                'unit_id' => 3, 
                'category_id' => 3, 
                'stock' => 1000,
            ],
            [
                'name' => 'Gula',
                'description' => 'Gula pasir berkualitas tinggi.',
                'price' => 15000.00,
                'unit_id' => 3, 
                'category_id' => 3, 
                'stock' => 800,
            ],
            [
                'name' => 'Minyak Goreng',
                'description' => 'Minyak goreng nabati berkualitas.',
                'price' => 25000.00,
                'unit_id' => 4, 
                'category_id' => 3, 
                'stock' => 500,
            ],
            [
                'name' => 'Telur',
                'description' => 'Telur ayam segar.',
                'price' => 2500.00,
                'unit_id' => 1, 
                'category_id' => 9, 
                'stock' => 1500,
            ],
            [
                'name' => 'Ayam Potong',
                'description' => 'Ayam potong siap masak.',
                'price' => 30000.00,
                'unit_id' => 3, 
                'category_id' => 9, 
                'stock' => 600,
            ],
            [
                'name' => 'Daging Sapi',
                'description' => 'Daging sapi beku berkualitas tinggi.',
                'price' => 75000.00,
                'unit_id' => 3, 
                'category_id' => 7, 
                'stock' => 300,
            ],
            [
                'name' => 'Ikan Segar',
                'description' => 'Ikan segar dari laut.',
                'price' => 40000.00,
                'unit_id' => 3, 
                'category_id' => 8, 
                'stock' => 400,
            ],
            [
                'name' => 'Susu',
                'description' => 'Susu segar murni.',
                'price' => 10000.00,
                'unit_id' => 4, 
                'category_id' => 4, 
                'stock' => 700,
            ],
            [
                'name' => 'Roti',
                'description' => 'Roti tawar segar.',
                'price' => 5000.00,
                'unit_id' => 1, 
                'category_id' => 6, 
                'stock' => 800,
            ],
            [
                'name' => 'Mie Instan',
                'description' => 'Mie instan berbagai rasa.',
                'price' => 3000.00,
                'unit_id' => 1, 
                'category_id' => 11, 
                'stock' => 1200,
            ],
            [
                'name' => 'Sabun Mandi',
                'description' => 'Sabun mandi beraroma segar.',
                'price' => 7000.00,
                'unit_id' => 1, 
                'category_id' => 16, 
                'stock' => 900,
            ],
            [
                'name' => 'Sabun Cuci Piring',
                'description' => 'Sabun cuci piring efektif.',
                'price' => 4000.00,
                'unit_id' => 1, 
                'category_id' => 18, 
                'stock' => 600,
            ],
            [
                'name' => 'Sabun Cuci Tangan',
                'description' => 'Sabun cuci tangan antibakteri.',
                'price' => 5000.00,
                'unit_id' => 1, 
                'category_id' => 16, 
                'stock' => 700,
            ],
            [
                'name' => 'Shampoo',
                'description' => 'Shampoo untuk rambut sehat.',
                'price' => 8000.00,
                'unit_id' => 1, 
                'category_id' => 16, 
                'stock' => 800,
            ],
            [
                'name' => 'Pasta Gigi',
                'description' => 'Pasta gigi untuk gigi bersih.',
                'price' => 4000.00,
                'unit_id' => 1, 
                'category_id' => 16, 
                'stock' => 750,
            ],
            [
                'name' => 'Es Krim',
                'description' => 'Es krim berbagai rasa.',
                'price' => 10000.00,
                'unit_id' => 4, 
                'category_id' => 14, 
                'stock' => 400,
            ],
        ];

        foreach ($products as $productData) {
            Product::create([
                'name' => $productData['name'],
                'description' => $productData['description'],
                'price' => $productData['price'],
                'unit_id' => $productData['unit_id'],
                'category_id' => $productData['category_id'],
                'stock' => $productData['stock'],
            ]);
        }
    }
}