<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductImage;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $product_images = [
            [
                'product_id' => 1,
                'image_path' => 'Beras.jpg',
            ],
            [
                'product_id' => 2,
                'image_path' => 'Gula.png',
            ],
            [
                'product_id' => 3,
                'image_path' => 'Minyak Goreng.jpg',
            ],
            [
                'product_id' => 4,
                'image_path' => 'Telur.png',
            ],
            [
                'product_id' => 5,
                'image_path' => 'Ayam Potong.png',
            ],
            [
                'product_id' => 6,
                'image_path' => 'Daging Sapi.png',
            ],
            [
                'product_id' => 7,
                'image_path' => 'Ikan Segar.png',
            ],
            [
                'product_id' => 8,
                'image_path' => 'Susu.png',
            ],
            [
                'product_id' => 9,
                'image_path' => 'Roti.png',
            ],
            [
                'product_id' => 10,
                'image_path' => 'Mie Instan.png',
            ],
            [
                'product_id' => 11,
                'image_path' => 'Sabun Mandi.png',
            ],
            [
                'product_id' => 12,
                'image_path' => 'Sabun Cuci Piring.png',
            ],
            [
                'product_id' => 13,
                'image_path' => 'Sabun Cuci Tangan.png',
            ],
            [
                'product_id' => 14,
                'image_path' => 'Shampoo.png',
            ],
            [
                'product_id' => 15,
                'image_path' => 'Pasta Gigi.png',
            ],
            [
                'product_id' => 16,
                'image_path' => 'Es Krim.png',
            ],
        ];        

        foreach ($product_images as $product_image) {
            ProductImage::create([
                'product_id' => $product_image['product_id'],
                'image_path' => $product_image['image_path'],
            ]);
        }
    }
}
