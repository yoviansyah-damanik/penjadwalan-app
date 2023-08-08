<?php

namespace App\Models;

use App\Models\Scopes\OfficerScope;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Officer extends Model
{
    use HasFactory, Sluggable;
    const STATUS = ['Active', 'Inactive'];
    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new OfficerScope);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function officerHasSchedule($date)
    {
        return $this->schedules()->date($date)->count() > 0 ? true : false;
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'Active');
    }

    public function scopeHasSchedule($query, $date)
    {
        return $query->whereHas('schedules', function ($q) use ($date) {
            $q->where('date', $date);
        });
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
