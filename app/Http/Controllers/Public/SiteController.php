<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index(Request $request) {
        dd($request->route()->parameters());
    }

    public function product(Request $request) {
        dd($request->route()->parameters());
    }
}
