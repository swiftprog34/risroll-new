<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use Illuminate\Http\Request;

class CategoryContoller extends Controller
{
    public function index()
    {
        $citiesWithNested = City::with(['categories' => function($cats) {
            $cats->orderBy('sort_order')->with(['products' => function($prods){
                $prods->orderBy('sort_order');
            }]);
        }])->get();
        return view('admin.category.index', compact('citiesWithNested'));
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $category->update($request->only('description'));
        return redirect()->route('category.edit', [$category->id])->with('alert', trans('alerts.categories.edited'));
    }

    public function updateOrder(Request $request){
        if($request->has('ids')){
            $arr = explode(',',$request->input('ids'));

            foreach($arr as $sortOrder => $id){
                $category = Category::find($id);
                $category->sort_order = $sortOrder;
                $category->save();
            }
            return ['success'=>true,'message'=>'Updated'];
        }
        return ['success'=>false,'message'=>'error'];
    }

}
