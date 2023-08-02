<?php

namespace App\Models;

use App\Models\Scopes\AttendanceScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new AttendanceScope);
    }

    public function checker()
    {
        return $this->belongsTo(User::class, 'checker_id', 'id');
    }

    public function records()
    {
        return $this->hasMany(AttendanceRecord::class);
    }
}
