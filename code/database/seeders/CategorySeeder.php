<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $categoryNames = ['Fresh vegetables', 'Fresh fruits', 'Groceries', 'Dairy food', 'Frozen food',
        'Bakeries', 'Fresh Fish and meat', 'Sea Foods', 'Fresh poultry', 'Sauces',
        'Pickles', 'Noodles', 'Soups', 'Confectionery', 'Canned food',
        'Meat products', 'Pet foods', 'Cereals', 'Coffee', 'Tea', 'Snacks',
        'Spices', 'Seasonings'];
        foreach ($categoryNames as $categoryName) {
            Category::create([
                'name' => $categoryName
            ]);
        }
    }
}
