<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\City\CityCreateRequest;
use App\Http\Requests\City\CityUpdateRequest;
use App\Models\City;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::all();
        return view('admin.city.index', compact('cities'));
    }

    public function create()
    {
        return view('admin.city.create');
    }

    public function store(CityCreateRequest $request)
    {
        City::create($request->validated());
        return redirect()->route('city.index')->with('alert', trans('alerts.cities.created'));
    }

    public function edit(City $city)
    {
        return view('admin.city.edit', compact('city'));
    }

    public function update(CityUpdateRequest $request, City $city)
    {
        $city->update($request->all());
        return redirect()->route('city.index')->with('alert', trans('alerts.cities.edited'));
    }

    public function destroy(City $city)
    {
        //
    }
}
