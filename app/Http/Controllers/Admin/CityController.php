<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CityCreateRequest;
use App\Http\Requests\CityUpdateRequest;
use App\Models\City;
use Illuminate\Http\Request;

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

    public function show(City $city)
    {
        //
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
