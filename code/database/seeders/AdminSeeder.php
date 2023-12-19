<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = \Faker\Factory::create();

        Admin::create([
            'name' => $faker->name,
            'email' => 'admin@mail.com',
            'birth_date' => $faker->date('Y-m-d', '1990-01-01'),
            'password' => bcrypt('@Admin23'), //Default password
            'profile_picture_path' => 'Admin profile picture.png'
        ]);
    }
}
