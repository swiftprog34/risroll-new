<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PickupPoint\PickupCreateRequest;
use App\Http\Requests\PickupPoint\PickupUpdateRequest;
use App\Models\City;
use App\Models\Pickup;
use Illuminate\Http\Request;

class PickupPointController extends Controller
{

    public function index()
    {
        $citiesWithNested = City::with(['pickupPoints' => function($pickups) {
            $pickups->orderBy('sort_order');
        }])->get();

        //$pickups = Pickup::with('city')->get();
        return view('admin.pickup.index', compact('citiesWithNested'));
    }

    public function create()
    {
        $cities = City::orderBy('city_name')->pluck('city_name', 'id');
        return view('admin.pickup.create', compact('cities'));
    }

    public function store(PickupCreateRequest $request)
    {
        Pickup::create($request->validated());
        return redirect()->route('pickup.index')->with('alert', trans('alerts.pickups.created'));
    }

    public function edit(Pickup $pickup)
    {
        $cities = City::orderBy('city_name')->pluck('city_name', 'id');
        return view('admin.pickup.edit', compact('pickup', 'cities'));
    }

    public function update(PickupUpdateRequest $request, Pickup $pickup)
    {
        $pickup->update($request->all());
        return redirect()->route('pickup.index')->with('alert', trans('alerts.pickups.edited'));
    }

    public function destroy(Pickup $pickup)
    {
        $pickup->delete();
        return redirect()->route('pickup.index')->with('alert', trans('alerts.pickups.deleted'));
    }

    public function updateOrder(Request $request){
        if($request->has('ids')){
            $arr = explode(',',$request->input('ids'));

            foreach($arr as $sortOrder => $id){
                $category = Pickup::find($id);
                $category->sort_order = $sortOrder;
                $category->save();
            }
            return ['success'=>true,'message'=>'Updated'];
        }
        return ['success'=>false,'message'=>'error'];
    }
}
