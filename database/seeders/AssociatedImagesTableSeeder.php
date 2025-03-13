<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssociatedImagesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('associated_images')->insert([
            'image' => 'base64_image_data_here',
            'id_stadium' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}