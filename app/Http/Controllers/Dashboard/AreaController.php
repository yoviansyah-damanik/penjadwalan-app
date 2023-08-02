<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Area;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\AreaRequest;

class AreaController extends Controller
{
    public function index()
    {
        $areas = Area::paginate(15);

        return view('dashboard.pages.area.index', compact('areas'));
    }

    public function show(Area $area)
    {
        return view('dashboard.pages.area.show', compact('area'));
    }

    public function create()
    {
        return view('dashboard.pages.area.create');
    }

    public function store(AreaRequest $request)
    {
        $new_area = new Area();
        $new_area->name = $request->name;
        $new_area->description = $request->description;
        $new_area->save();

        return to_route('area')
            ->with('store_success', true)
            ->with('alert_feature', __('Area'));
    }

    public function edit(Area $area)
    {
        return view('dashboard.pages.area.edit', compact('area'));
    }

    public function update(Area $area, AreaRequest $request)
    {
        $area->name = $request->name;
        $area->description = $request->description;
        $area->save();

        return to_route('area')
            ->with('store_success', true)
            ->with('alert_feature', __('Area'));
    }

    public function destroy(Area $area)
    {
        $area->delete();

        return to_route('area')
            ->with('delete_success', true)
            ->with('alert_feature', __('Area'));
    }
}
