<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BankName;

class BankNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $bankNames = [
            'BCA', 
            'BRI', 
            'Mandiri', 
            'BNI',
            'CIMB Niaga',
            'BTN',
            'Danamon',
            'Permata',
            'Maybank',
        ];
        foreach ($bankNames as $bankName) {
            BankName::create([
                'name' => $bankName
            ]);
        }
    }
}
