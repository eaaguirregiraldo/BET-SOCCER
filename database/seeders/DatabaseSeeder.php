<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            TournamentsTableSeeder::class,
            TeamsTableSeeder::class,
            GroupsTableSeeder::class,            
            StadiumsTableSeeder::class,
            AssociatedImagesTableSeeder::class,
            ScheduleResultsTableSeeder::class,                                   
        ]);
    }
}