<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class TeamsTableSeeder extends Seeder
{
    public function run()
    {
        $teams = [
            ['id_tournament' => 1, 'name' => 'Real Madrid', 'team_shield' => 'base64_image_data_here', 'created_at' => now(), 'updated_at' => now()],
            ['id_tournament' => 1, 'name' => 'Manchester City', 'team_shield' => 'base64_image_data_here', 'created_at' => now(), 'updated_at' => now()],
            ['id_tournament' => 1, 'name' => 'Bayern Munich', 'team_shield' => 'base64_image_data_here', 'created_at' => now(), 'updated_at' => now()],
            ['id_tournament' => 1, 'name' => 'Paris Saint-Germain', 'team_shield' => 'base64_image_data_here', 'created_at' => now(), 'updated_at' => now()],
            ['id_tournament' => 1, 'name' => 'Chelsea', 'team_shield' => 'base64_image_data_here', 'created_at' => now(), 'updated_at' => now()],
            ['id_tournament' => 1, 'name' => 'Flamengo', 'team_shield' => 'base64_image_data_here', 'created_at' => now(), 'updated_at' => now()],
            ['id_tournament' => 1, 'name' => 'Palmeiras', 'team_shield' => 'base64_image_data_here', 'created_at' => now(), 'updated_at' => now()],
            ['id_tournament' => 1, 'name' => 'Boca Juniors', 'team_shield' => 'base64_image_data_here', 'created_at' => now(), 'updated_at' => now()],
            ['id_tournament' => 1, 'name' => 'River Plate', 'team_shield' => 'base64_image_data_here', 'created_at' => now(), 'updated_at' => now()],
            ['id_tournament' => 1, 'name' => 'Monterrey', 'team_shield' => 'base64_image_data_here', 'created_at' => now(), 'updated_at' => now()],
            ['id_tournament' => 1, 'name' => 'León', 'team_shield' => 'base64_image_data_here', 'created_at' => now(), 'updated_at' => now()],
            ['id_tournament' => 1, 'name' => 'Seattle Sounders', 'team_shield' => 'base64_image_data_here', 'created_at' => now(), 'updated_at' => now()],
            ['id_tournament' => 1, 'name' => 'Al Ahly', 'team_shield' => 'base64_image_data_here', 'created_at' => now(), 'updated_at' => now()],
            ['id_tournament' => 1, 'name' => 'Al Hilal', 'team_shield' => 'base64_image_data_here', 'created_at' => now(), 'updated_at' => now()],
            ['id_tournament' => 1, 'name' => 'Wydad Casablanca', 'team_shield' => 'base64_image_data_here', 'created_at' => now(), 'updated_at' => now()],
            ['id_tournament' => 1, 'name' => 'Mamelodi Sundowns', 'team_shield' => 'base64_image_data_here', 'created_at' => now(), 'updated_at' => now()],
            ['id_tournament' => 1, 'name' => 'Urawa Red Diamonds', 'team_shield' => 'base64_image_data_here', 'created_at' => now(), 'updated_at' => now()],
            ['id_tournament' => 1, 'name' => 'Ulsan Hyundai', 'team_shield' => 'base64_image_data_here', 'created_at' => now(), 'updated_at' => now()],
            ['id_tournament' => 1, 'name' => 'Auckland City', 'team_shield' => 'base64_image_data_here', 'created_at' => now(), 'updated_at' => now()],
        ];
        
        DB::table('teams')->insert($teams);
    }
}