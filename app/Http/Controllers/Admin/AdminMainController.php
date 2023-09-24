<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;

class AdminMainController extends Controller
{
    public function index() {
        $cities = City::all();
        return view('admin.city.index', compact('cities'));
    }
}
