<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'birthday' => '1990-01-01', 
            'phone_number' => '1234567890', 
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Guest User',
            'email' => 'guest@example.com',
            'password' => Hash::make('password123'),
            'birthday' => '2000-05-20', 
            'phone_number' => '0987654321', 
            'role' => 'guest',
        ]);
    }
}
