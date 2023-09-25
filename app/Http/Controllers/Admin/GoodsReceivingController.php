<?php

namespace App\Http\Controllers\Admin;

use App\Enums\GoodsReceivingVariant;
use App\Http\Controllers\Controller;
use App\Http\Requests\GoodsReceiving\GoodsReceivingCreateRequest;
use App\Models\City;
use App\Models\DeliveryZone;
use App\Models\GoodsReceiving;
use Illuminate\Http\Request;

class GoodsReceivingController extends Controller
{
    public function index()
    {
        $receivings = GoodsReceiving::with('zone')->get();
        return view('admin.receiving.index', compact('receivings'));
    }

    public function create()
    {
        $receiving_variants = collect(GoodsReceivingVariant::toArray());
        $zones = DeliveryZone::orderBy('name')->pluck('name', 'id');
        return view('admin.receiving.create', compact('zones', 'receiving_variants'));
    }

    public function store(GoodsReceivingCreateRequest $request)
    {
        GoodsReceiving::create($request->validated());
        return redirect()->route('zone.edit', [ $request->delivery_zone_id ])->with('alert', trans('alerts.receivings.created'));
    }

    public function edit(GoodsReceiving $receiving)
    {
        $receiving_variants = collect(GoodsReceivingVariant::toArray());
        $zones = DeliveryZone::orderBy('name')->pluck('name', 'id');
        return view('admin.receiving.edit', compact('receiving', 'receiving_variants', 'zones'));
    }

    public function update(GoodsReceivingCreateRequest $request, GoodsReceiving $receiving)
    {
        $receiving->update($request->all());
        return redirect()->route('zone.edit', [ $request->delivery_zone_id ])->with('alert', trans('alerts.receivings.edited'));
    }

    public function destroy(GoodsReceiving $receiving)
    {
        $id = $receiving->delivery_zone_id;
        $receiving->delete();
        return redirect()->route('zone.edit', [ $id ])->with('alert', trans('alerts.receivings.deleted'));
    }
}
