<?php

namespace Database\Seeders;

use App\Helpers\GeneralHelper;
use App\Models\Timetable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimetableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timetables = [
            [
                'title' => 'Pagi',
                'start' => '08:00:00',
                'end' => '20:00:00',
            ],
            [
                'title' => 'Pagi',
                'start' => '08:00:00',
                'end' => '18:00:00',
            ],
            [
                'title' => 'Malam',
                'start' => '20:00:00',
                'end' => '08:00:00',
            ],
            [
                'title' => 'Off/Standby/Cuti'
            ]
        ];

        foreach ($timetables as $timetable)
            Timetable::create([
                'title' => $timetable['title'],
                'start' => $timetable['start'] ?? null,
                'end' => $timetable['end'] ?? null,
                'color' => GeneralHelper::generate_random_color()
            ]);
    }
}
