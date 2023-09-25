<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeliveryZone\DeliveryZoneRequest;
use App\Models\City;
use App\Models\DeliveryZone;
use App\Models\Index;
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

    public function edit(string $id)
    {
        $zone = DeliveryZone::with('indices')->with('goodsReceivings')->firstOrFail();
        $cities = City::orderBy('city_name')->pluck('city_name', 'id');
        $indices = $zone->indices->implode('value', ', ');
        $receivings = $zone->goodsReceivings;
        return view('admin.zone.edit', compact('zone', 'cities', 'indices', 'receivings'));
    }

    public function update(DeliveryZoneRequest $request, DeliveryZone $zone)
    {
        $zone->update($request->validated());
        if($request->has('indicies')) {
            $indices = explode(",", $request->indicies);
            $currentIndices = $zone->indices;
            foreach ($currentIndices as $currentIndex) {
                $index = Index::findOrFail($currentIndex->id);
                $index->delete();
            }
            foreach ($indices as $index) {
                $index = Index::create([
                    'value' => trim($index),
                    'delivery_zone_id' => $zone->id
                ]);
            }
        }

        return redirect()->route('zone.edit', [$zone->id])->with('alert', trans('alerts.zones.edited'));
    }

    public function destroy(DeliveryZone $zone)
    {
        $zone->delete();
        return redirect()->route('zone.index')->with('alert', trans('alerts.zones.deleted'));
    }
}
