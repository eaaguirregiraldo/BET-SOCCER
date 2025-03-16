<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Usuario administrador verificado
        DB::table('users')->insert([
            'email' => 'admin@example.com',
            'password' => Hash::make('admin'),
            'role' => 'Admin',
            'name' => 'Administrador',
            'email_verified_at' => Carbon::now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        DB::table('users')->insert([
            'email' => 'email@example.com',
            'password' => Hash::make('password'),
            'role' => 'Admin_Group_Bed',
            'name' => 'Pepito Perez',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}