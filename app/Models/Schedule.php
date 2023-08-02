<?php

namespace App\Models;

use App\Models\Scopes\ScheduleScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ScheduleScope);
    }

    public function scopeDate($query, $date)
    {
        return $query->where('date', $date);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function timetable()
    {
        return $this->belongsTo(Timetable::class);
    }

    public function officer()
    {
        return $this->belongsTo(Officer::class);
    }

    public function attendance_record()
    {
        return $this->hasOne(AttendanceRecord::class);
    }

    public function attendance()
    {
        return $this->hasOneThrough(Attendance::class, AttendanceRecord::class);
    }
}
