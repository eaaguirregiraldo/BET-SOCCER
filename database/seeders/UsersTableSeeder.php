<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password123'),
            'birthday' => '1990-01-01',
            'email_verified_at' => Carbon::now(),
            'phone_number' => '1234567890',
            'role' => 'Admin', 
        ]);

        User::create([
            'name' => 'Guest User',
            'email' => 'guest@example.com',
            'password' => Hash::make('password123'),
            'birthday' => '2000-05-20',
            'phone_number' => '0987654321',
            'role' => 'Bet_User', 
        ]);
    }
}
