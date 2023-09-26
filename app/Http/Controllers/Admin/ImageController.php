<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class ImageController extends Controller
{
    public function store(Request $request){

        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $imageables = config('imageable');
        if(!isset($imageables[$request->model])){
            Log::alert('Some moron try change model name, ip, model etc');

            throw ValidationException::withMessages([
                'model' => 'wrong model',
            ]);
        }
        $path = $request->file('image')->store('public/images');
        $model = $imageables[$request->model]::findOrFail($request->id);
        $model->image()->save(Image::make(['path' => $path]));
        return redirect()->back()->with('alert', 'Изображение было успешно обновлено');
    }
}
