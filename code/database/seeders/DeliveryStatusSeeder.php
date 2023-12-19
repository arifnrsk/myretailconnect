<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DeliveryStatus;

class DeliveryStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $statusNames = [
            'Pending', 
            'Shipped', 
            'Delivered', 
            'Cancelled', 
            'Returned'
        ]; 
        foreach ($statusNames as $statusName) {
            DeliveryStatus::create([
                'name' => $statusName
            ]);
        }
    }
}
