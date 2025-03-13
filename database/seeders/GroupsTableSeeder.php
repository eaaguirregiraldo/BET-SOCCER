<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupsTableSeeder extends Seeder
{
    public function run()
    {
        $groups = [
            ['description' => 'A', 'team_name' => 'Palmeiras'],
            ['description' => 'A', 'team_name' => 'FC Porto'],
            ['description' => 'A', 'team_name' => 'Al Ahly'],
            ['description' => 'A', 'team_name' => 'Inter Miami'],
            
            ['description' => 'B', 'team_name' => 'Paris Saint-Germain'],
            ['description' => 'B', 'team_name' => 'Atlético de Madrid'],
            ['description' => 'B', 'team_name' => 'Botafogo'],
            ['description' => 'B', 'team_name' => 'Seattle Sounders'],
            
            ['description' => 'C', 'team_name' => 'Bayern Múnich'],
            ['description' => 'C', 'team_name' => 'Auckland City'],
            ['description' => 'C', 'team_name' => 'Boca Juniors'],
            ['description' => 'C', 'team_name' => 'Benfica'],
            
            ['description' => 'D', 'team_name' => 'Flamengo'],
            ['description' => 'D', 'team_name' => 'Espérance de Tunis'],
            ['description' => 'D', 'team_name' => 'Chelsea FC'],
            ['description' => 'D', 'team_name' => 'Club León'],
            
            ['description' => 'E', 'team_name' => 'River Plate'],
            ['description' => 'E', 'team_name' => 'Urawa Red Diamonds'],
            ['description' => 'E', 'team_name' => 'Monterrey'],
            ['description' => 'E', 'team_name' => 'Inter de Milán'],
            
            ['description' => 'F', 'team_name' => 'Fluminense'],
            ['description' => 'F', 'team_name' => 'Borussia Dortmund'],
            ['description' => 'F', 'team_name' => 'Ulsan Hyundai'],
            ['description' => 'F', 'team_name' => 'Mamelodi Sundowns'],
            
            ['description' => 'G', 'team_name' => 'Manchester City'],
            ['description' => 'G', 'team_name' => 'Wydad Casablanca'],
            ['description' => 'G', 'team_name' => 'Al-Ain'],
            ['description' => 'G', 'team_name' => 'Juventus'],
            
            ['description' => 'H', 'team_name' => 'Real Madrid'],
            ['description' => 'H', 'team_name' => 'Al-Hilal'],
            ['description' => 'H', 'team_name' => 'Pachuca'],
            ['description' => 'H', 'team_name' => 'Red Bull Salzburgo'],
        ];

        foreach ($groups as $group) {
            $teamId = DB::table('teams')->where('name', $group['team_name'])->value('id');
            
            if ($teamId) {
                DB::table('groups')->insert([
                    'description' => $group['description'],
                    'id_team' => $teamId,
                    'GF' => 0,
                    'GC' => 0,
                    'DG' => 0,
                    'Points' => 0,
                    'PJ' => 0,
                    'PG' => 0,
                    'PP' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}