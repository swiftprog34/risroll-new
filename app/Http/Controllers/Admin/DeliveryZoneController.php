<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeliveryZone\DeliveryZoneRequest;
use App\Models\City;
use App\Models\DeliveryZone;
use Illuminate\Http\Request;

class DeliveryZoneController extends Controller
{

    public function index()
    {
        $zones = DeliveryZone::with('city')->get();
        return view('admin.zone.index', compact('zones'));
    }

    public function create()
    {
        $cities = City::orderBy('city_name')->pluck('city_name', 'id');
        return view('admin.zone.create', compact('cities'));
    }

    public function store(DeliveryZoneRequest $request)
    {
        DeliveryZone::create($request->validated());
        return redirect()->route('zone.index')->with('alert', trans('alerts.zones.created'));
    }

    public function edit(DeliveryZone $zone)
    {
        $cities = City::orderBy('city_name')->pluck('city_name', 'id');
        return view('admin.zone.edit', compact('zone', 'cities'));
    }

    public function update(DeliveryZoneRequest $request, DeliveryZone $zone)
    {
        $zone->update($request->all());
        return redirect()->route('zone.index')->with('alert', trans('zones.pickups.edited'));
    }

    public function destroy(DeliveryZone $zone)
    {
        $zone->delete();
        return redirect()->route('zone.index')->with('alert', trans('alerts.zones.deleted'));
    }
}
