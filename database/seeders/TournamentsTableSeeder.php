<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TournamentsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('tournaments')->insert([
            'description' => 'Mundial de Clubes FIFA 2025',
            'amount_teams' => 32,
            'first_phase_groups' => 'S',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}