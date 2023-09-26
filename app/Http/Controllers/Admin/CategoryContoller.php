<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryContoller extends Controller
{
    public function index()
    {
        $categories = Category::with('city')->get();
        return view('admin.category.index', compact('categories'));
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

}
