<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
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
        //$path = $request->file('image')->store('images');

        $path = public_path('images/product');
        !is_dir($path) &&
            mkdir($path, 0777, true);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move($path, $imageName);

        $model = $imageables[$request->model]::findOrFail($request->id);

        $image = Image::find($model->image);
        if($image !== null) {
            File::delete(public_path($model->image->first()->path));
            $image->first()->delete();
        }

        $model->image()->save(Image::make(['path' => '/images/product/'.$imageName]));
        return redirect()->back()->with('alert', 'Изображение было успешно обновлено');
    }
}
