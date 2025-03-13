<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupBetsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('group_bets')->insert([
            'id_tournament' => 1,
            'id_user_admin' => 1,
            'id_user_group_bet' => 2,
            'description' => 'polla equipo de trabajo',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}