<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory, Sluggable;
    protected $guarded = ['id'];

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

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function officers()
    {
        return $this->hasManyThrough(Officer::class, Schedule::class, 'area_id', 'id', 'id', 'officer_id');
    }
}
