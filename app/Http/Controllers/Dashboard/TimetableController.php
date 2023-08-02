<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\GeneralHelper;
use App\Models\Timetable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\TimetableRequest;

class TimetableController extends Controller
{
    public function index()
    {
        $timetables = Timetable::paginate(15);

        return view('dashboard.pages.timetable.index', compact('timetables'));
    }

    public function show(Timetable $timetable)
    {
        return view('dashboard.pages.timetable.show', compact('timetable'));
    }

    public function create()
    {
        $color = GeneralHelper::generate_random_color();
        return view('dashboard.pages.timetable.create', compact('color'));
    }

    public function store(TimetableRequest $request)
    {
        $new_timetable = new Timetable();
        $new_timetable->title = $request->title;
        $new_timetable->start = $request->start;
        $new_timetable->end = $request->end;
        $new_timetable->color = $request->color;
        $new_timetable->description = $request->description;
        $new_timetable->save();

        return to_route('timetable')
            ->with('store_success', true)
            ->with('alert_feature', __('Timetable'));
    }

    public function edit(Timetable $timetable)
    {
        $color = GeneralHelper::generate_random_color();
        return view('dashboard.pages.timetable.edit', compact('timetable', 'color'));
    }

    public function update(Timetable $timetable, TimetableRequest $request)
    {
        $timetable->title = $request->title;
        $timetable->start = $request->start;
        $timetable->end = $request->end;
        $timetable->color = $request->color;
        $timetable->description = $request->description;
        $timetable->save();

        return to_route('timetable')
            ->with('store_success', true)
            ->with('alert_feature', __('Timetable'));
    }

    public function destroy(Timetable $timetable)
    {
        $timetable->delete();

        return to_route('timetable')
            ->with('delete_success', true)
            ->with('alert_feature', __('Timetable'));
    }
}
