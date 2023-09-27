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
        $citiesWithNested = City::with('categories.products')->get();
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

}
