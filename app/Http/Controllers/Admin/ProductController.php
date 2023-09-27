<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function edit(Product $product)
    {
        return view('admin.product.edit', compact('product'));
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function updateOrder(Request $request){
        if($request->has('ids')){
            $arr = explode(',',$request->input('ids'));

            foreach($arr as $sortOrder => $id){
                $category = Product::find($id);
                $category->sort_order = $sortOrder;
                $category->save();
            }
            return ['success'=>true,'message'=>'Updated'];
        }
        return ['success'=>false,'message'=>'error'];
    }

}
