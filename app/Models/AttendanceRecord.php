<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AttendanceRecord extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    const STATUS = [
        ['name' => 'not_present', 'code' => 0, 'abb' => 'A'],
        ['name' => 'present', 'code' => 1, 'abb' => 'H'],
        ['name' => 'permit', 'code' => 2, 'abb' => 'I'],
        ['name' => 'leave', 'code' => 3, 'abb' => 'C'],
    ];

    protected function attendanceStatusText(): Attribute
    {
        return new Attribute(
            get: fn () => collect(self::STATUS)->where('code', $this->attendance_status)->first()['name']
        );
    }

    protected function attendanceStatusAbb(): Attribute
    {
        return new Attribute(
            get: fn () => collect(self::STATUS)->where('code', $this->attendance_status)->first()['abb']
        );
    }

    public function scopePresent($query)
    {
        return $query->where('attendance_status', collect(self::STATUS)->where('name', 'present')->first()['code']);
    }

    public function scopeNotPresent($query)
    {
        return $query->where('attendance_status', collect(self::STATUS)->where('name', 'not_present')->first()['code']);
    }

    public function scopePermit($query)
    {

        return $query->where('attendance_status', collect(self::STATUS)->where('name', 'permit')->first()['code']);
    }

    public function scopeLeave($query)
    {
        return $query->where('attendance_status', collect(self::STATUS)->where('name', 'leave')->first()['code']);
    }
}
