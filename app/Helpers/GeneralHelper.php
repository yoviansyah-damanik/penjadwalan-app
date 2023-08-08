<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class GeneralHelper
{
    public static function get_months()
    {
        $month = new Collection();
        foreach (range(1, 12) as $range)
            $month->push(Carbon::now()->setMonth($range)->translatedFormat('F'));

        return $month;
    }

    public static function generate_random_color()
    {
        return '#' . dechex(rand(0x000000, 0xFFFFFF));
    }

    public static function get_sidebar_menu()
    {
        if (Auth::user()->role_name == 'Administrator')
            $arr = [
                [
                    'name' => __('Master Data'),
                    'set' => [
                        [
                            'name' => __('Officers'),
                            'route' => 'officer',
                            'icon' => 'bi bi-person-badge',
                            'feature' => ['show', 'create'],
                        ],
                        [
                            'name' => __('Areas'),
                            'route' => 'area',
                            'icon' => 'bi bi-building',
                            'feature' => ['show', 'create'],
                        ],
                        [
                            'name' => __('Timetables'),
                            'route' => 'timetable',
                            'icon' => 'bi bi-calendar2-event',
                            'feature' => ['show', 'create'],
                        ],
                    ],
                ],
                [
                    'name' => __('Data Manage'),
                    'set' => [
                        [
                            'name' => __('Schedules'),
                            'route' => 'schedule',
                            'icon' => 'bi bi-calendar-range-fill',
                            'feature' => ['show', 'create'],
                        ],
                        [
                            'name' => __('Attendances'),
                            'route' => 'attendance',
                            'icon' => 'bi bi-calendar2-check',
                            'feature' => ['show', 'create'],
                        ],
                    ],
                ],
                [
                    'name' => __('Print'),
                    'set' => [
                        [
                            'name' => __('Scheduling Report'),
                            'route' => 'scheduling-report',
                            'icon' => 'bi bi-printer',
                        ],
                        [
                            'name' => __('Attendance Report'),
                            'route' => 'attendance-report',
                            'icon' => 'bi bi-printer',
                        ],
                    ],
                ],
                [
                    'name' => __('General'),
                    'set' => [
                        [
                            'name' => __('Users'),
                            'route' => 'user',
                            'icon' => 'bi bi-people',
                            'feature' => ['show', 'create'],
                        ],
                        [
                            'name' => __('Account'),
                            'route' => 'account',
                            'icon' => 'bi bi-printer',
                        ],
                    ],
                ],
            ];
        else
            $arr = [
                [
                    'name' => __('Print'),
                    'set' => [
                        [
                            'name' => __('Schedule'),
                            'route' => 'print.schedule',
                            'icon' => 'bi bi-printer',
                        ],
                        [
                            'name' => __('Attendance'),
                            'route' => 'print.attendance',
                            'icon' => 'bi bi-printer',
                        ],
                    ],
                ],
                [
                    'name' => __('General'),
                    'set' => [
                        [
                            'name' => __('Account'),
                            'route' => 'account',
                            'icon' => 'bi bi-printer',
                        ],
                    ],
                ],
            ];

        return $arr;
    }
}
