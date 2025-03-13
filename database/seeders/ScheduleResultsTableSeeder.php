<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScheduleResultsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('schedule_results')->insert([
            'id_team_1' => 1,
            'id_team_2' => 2,
            'score_team1' => 0,
            'score_team2' => 0,
            'id_stadium' => 1,
            'date_time' => '2025-06-01 15:00:00',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}