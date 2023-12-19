<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TransactionStatus;

class TransactionStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $statusNames = [
            'Pending', 
            'Completed', 
            'Cancelled'
        ]; 
        foreach ($statusNames as $statusName) {
            TransactionStatus::create([
                'name' => $statusName
            ]);
        }
    }
}
