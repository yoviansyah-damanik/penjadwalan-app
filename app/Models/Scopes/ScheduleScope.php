<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ScheduleScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $builder->with(['officer' => function ($q) {
            $q->orderBy('name', 'asc');
        }, 'area' => function ($q) {
            $q->orderBy('name', 'asc');
        }, 'timetable' => function ($q) {
            $q->orderBy('start', 'asc');
        }])
            ->orderBy('date', 'desc');
    }
}
