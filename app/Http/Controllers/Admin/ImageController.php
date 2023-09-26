<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageCreateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class ImageController extends Controller
{
    public function store(Request $request){

        $imageables = config('imageable');

        if(!isset($imageables[$request->model])){
            Log::alert('Some moron try change model name, ip, model etc');

            throw ValidationException::withMessages([
                'model' => 'wrong model',
            ]);
        }
        dd($request);
        $model = $imageables[$request->model]::findOrFail($request->id);
        $model->images()->save(Image::make($request->only('path')));
        return redirect()->back();
    }
}
