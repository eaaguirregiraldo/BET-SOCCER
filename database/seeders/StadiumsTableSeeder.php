<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class StadiumsTableSeeder extends Seeder
{
    public function run()
    {
        $stadiums = [
            [
                'name' => 'Mercedes-Benz Stadium',
                'characteristics' => 'Capacidad: 71,000 espectadores, ubicado en Atlanta, Georgia.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Rose Bowl Stadium',
                'characteristics' => 'Capacidad: 90,000 espectadores, ubicado en Pasadena, California.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'MetLife Stadium',
                'characteristics' => 'Capacidad: 82,500 espectadores, ubicado en East Rutherford, Nueva Jersey.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'AT&T Stadium',
                'characteristics' => 'Capacidad: 80,000 espectadores, ubicado en Arlington, Texas.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'SoFi Stadium',
                'characteristics' => 'Capacidad: 70,000 espectadores, ubicado en Inglewood, California.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hard Rock Stadium',
                'characteristics' => 'Capacidad: 65,000 espectadores, ubicado en Miami Gardens, Florida.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Levi\'s Stadium',
                'characteristics' => 'Capacidad: 68,500 espectadores, ubicado en Santa Clara, California.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lumen Field',
                'characteristics' => 'Capacidad: 69,000 espectadores, ubicado en Seattle, Washington.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gillette Stadium',
                'characteristics' => 'Capacidad: 65,000 espectadores, ubicado en Foxborough, Massachusetts.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Soldier Field',
                'characteristics' => 'Capacidad: 61,500 espectadores, ubicado en Chicago, Illinois.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nissan Stadium',
                'characteristics' => 'Capacidad: 69,000 espectadores, ubicado en Nashville, Tennessee.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bank of America Stadium',
                'characteristics' => 'Capacidad: 75,000 espectadores, ubicado en Charlotte, Carolina del Norte.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Arrowhead Stadium',
                'characteristics' => 'Capacidad: 76,000 espectadores, ubicado en Kansas City, Misuri.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Empower Field at Mile High',
                'characteristics' => 'Capacidad: 76,000 espectadores, ubicado en Denver, Colorado.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Allegiant Stadium',
                'characteristics' => 'Capacidad: 65,000 espectadores, ubicado en Paradise, Nevada.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lincoln Financial Field',
                'characteristics' => 'Capacidad: 69,000 espectadores, ubicado en Filadelfia, Pensilvania.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insertar los estadios en la tabla
        DB::table('stadiums')->insert($stadiums);
    }
}