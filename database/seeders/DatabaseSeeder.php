<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            TournamentsTableSeeder::class,
            TeamsTableSeeder::class,
            GroupsTableSeeder::class,
            ScheduleResultsTableSeeder::class,
            StadiumsTableSeeder::class,
            AssociatedImagesTableSeeder::class,
            UsersTableSeeder::class,
            BetsTableSeeder::class,
            GroupBetsTableSeeder::class,
        ]);
    }
}