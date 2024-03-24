<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::truncate();
        User::create([
           'name' => 'rami',
            'constructorName'=> 'shopika',
            'email' => 'rami@gmail.com',
            'password' => Hash::make('rami2024')
        ]);
        User::create([
            'name' => 'raniya',
            'constructorName'=> 'tmraz',
            'email' => 'ran@gmail.com',
            'password' => Hash::make('ran2000')
        ]);

    }
}
