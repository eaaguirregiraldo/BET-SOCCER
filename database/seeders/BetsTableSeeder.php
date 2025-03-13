<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BetsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('bets')->insert([
            'id_user' => 1,
            'id_schedule' => 1,
            'score_team1' => 0,
            'score_team2' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}