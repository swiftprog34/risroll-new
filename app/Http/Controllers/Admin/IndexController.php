<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    public function store(Request $request)
    {
        dd($request);
    }

    public function show(string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        dd($id);
    }
}
