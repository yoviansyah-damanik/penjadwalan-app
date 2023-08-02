<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\OfficerRequest;
use App\Models\Officer;
use Illuminate\Http\Request;

class OfficerController extends Controller
{
    public function index()
    {
        $officers = Officer::paginate(15);

        return view('dashboard.pages.officer.index', compact('officers'));
    }

    public function show(Officer $officer)
    {
        return view('dashboard.pages.officer.show', compact('officer'));
    }

    public function create()
    {
        return view('dashboard.pages.officer.create');
    }

    public function store(OfficerRequest $request)
    {
        $new_officer = new Officer();
        $new_officer->name = $request->name;
        $new_officer->address = $request->address;
        $new_officer->status = $request->status;
        $new_officer->save();

        return to_route('officer')
            ->with('store_success', true)
            ->with('alert_feature', __('Officer'));
    }

    public function edit(Officer $officer)
    {
        return view('dashboard.pages.officer.edit', compact('officer'));
    }

    public function update(Officer $officer, OfficerRequest $request)
    {
        $officer->name = $request->name;
        $officer->address = $request->address;
        $officer->slug = null;
        $officer->status = $request->status;
        $officer->save();

        return to_route('officer')
            ->with('store_success', true)
            ->with('alert_feature', __('Officer'));
    }

    public function destroy(Officer $officer)
    {
        $officer->delete();

        return to_route('officer')
            ->with('delete_success', true)
            ->with('alert_feature', __('Officer'));
    }
}
