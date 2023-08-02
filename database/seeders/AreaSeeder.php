<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $areas = ['Pos R17', 'Pos PH/PATROLI', 'OFFICE CAM G', 'MESS BATANGTORU', 'OFF/STANDBY/CUTY'];

        foreach ($areas as $area)
            Area::create(
                [
                    'name' => $area
                ]
            );
    }
}
