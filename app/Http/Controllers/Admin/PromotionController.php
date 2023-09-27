<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Promotion\PromotionRequest;
use App\Models\City;
use App\Models\Promotion;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PromotionController extends Controller
{

    public function index()
    {
        $citiesWithNested = City::with(['promotions' => function($promotions) {
            $promotions->orderBy('sort_order');
        }])->get();
        return view('admin.promotion.index', compact('citiesWithNested'));
    }

    public function create()
    {
        $cities = City::orderBy('city_name')->pluck('city_name', 'id');
        return view('admin.promotion.create', compact('cities'));
    }

    public function store(PromotionRequest $request)
    {

        $data = $request->all();

        if($request->has('expiration_date')) {
            $datetime = Carbon::parse($request->expiration_date);
            $data['expiration_date'] = $datetime;
        }

        $is_active = "0";
        if($request->has('is_active')) {
            $is_active = "1";
        }
        $data['is_active'] = $is_active;

        Promotion::create($data);
        return redirect()->route('promotion.index')->with('alert', trans('alerts.promotions.created'));
    }

    public function edit(string $id)
    {
        $promotion = Promotion::findOrFail($id);
        $cities = City::orderBy('city_name')->pluck('city_name', 'id');
        return view('admin.promotion.edit', compact('promotion', 'cities'));
    }

    public function update(PromotionRequest $request, Promotion $promotion)
    {


        $data = $request->all();

        if($request->has('expiration_date')) {
            $datetime = Carbon::parse($request->expiration_date);
            $data['expiration_date'] = $datetime;
        }

        $is_active = "0";
        if($request->has('is_active')) {
            $is_active = "1";
        }
        $data['is_active'] = $is_active;

        $promotion->update($data);
        return redirect()->route('promotion.index')->with('alert', trans('alerts.promotions.edited'));
    }

    public function destroy(Promotion $promotion)
    {
        $promotion->delete();
        return redirect()->route('promotion.index')->with('alert', trans('alerts.promotions.deleted'));
    }

    public function updateOrder(Request $request){
        if($request->has('ids')){
            $arr = explode(',',$request->input('ids'));

            foreach($arr as $sortOrder => $id){
                $category = Promotion::find($id);
                $category->sort_order = $sortOrder;
                $category->save();
            }
            return ['success'=>true,'message'=>'Updated'];
        }
        return ['success'=>false,'message'=>'error'];
    }
}
