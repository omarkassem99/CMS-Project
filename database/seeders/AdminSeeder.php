<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name'=> 'Omar',
            "email"=> "admin@gmail.com",
            "country_code"=> "+20",
            "phone"=> "1114466133",
            "password"=> Hash::make('123456789'),
            "image"=>'admin_images/image1.jpg'
        ]);
    }
}
