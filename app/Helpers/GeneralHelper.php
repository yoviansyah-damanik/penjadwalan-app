<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Collection;

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
}
