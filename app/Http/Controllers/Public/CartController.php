<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{

    public function addProduct(Request $request)
    {
        $sid = session()->getId();
        $userCart = Cart::where('session_id', $sid)->first();

        if($userCart === null) {
            $userCart = Cart::make([
                'session_id' => $sid,
            ]);
            $userCart->save();
        }


        $desiredProduct = $userCart->products->firstWhere("id", $request->id);

        if($desiredProduct === null) {
            $product = Product::where('id', $request->id)->firstOrFail();
            $userCart->products()->attach($userCart->session_id,
                [
                    'product_id' => $product->id,
                    'price' => $product->price,
                    'quantity' => 1
                ]
            );
        }

        $sum = $userCart->products->sum(function ($product) {
            return $product->pivot->price * $product->pivot->quantity;
        });

        return response()->json([
            'status' => 1,
            'data' => $sum,
            'key' => $sid
        ]);
    }

    public function changeQuantity(Request $request) {
        $sid = session()->getId();
        $userCart = Cart::where('session_id', $sid)->firstOrFail();

        $products = $userCart->products;
        $allcart = 0;
        foreach ($products as $product) {
            if($product->id == $request->id) {
                $product->pivot->quantity += $request->quantity;
                $allcart = $product->pivot->quantity;
            }
        }

        if($allcart <= 0) {
            $userCart->products()->detach($request->id);
        } else {
            $userCart->products()->updateExistingPivot($request->id,
                ['quantity' => $allcart]
            );
        }

        $sum = $userCart->products->sum(function ($product) {
            return $product->pivot->price * $product->pivot->quantity;
        });

        return response()->json([
            'status' => 1,
            'data' => $sum,
            'key' => $sid,
            'allcart' => $allcart,
            'all' => $allcart,
        ]);
    }

    public function removeProduct(Request $request) {
        $sid = session()->getId();
        $userCart = Cart::where('session_id', $sid)->firstOrFail();

        $filteredProducts = $userCart->products->reject(function ($product, $request) {
            return $product->id != $request->product_id;
        });

        $userCart->products()->sync($userCart->session_id,
            $filteredProducts);

        $sum = $userCart->products->sum(function ($product) {
            return $product->pivot->price * $product->pivot->quantity;
        });

        return response()->json([
            'status' => 1,
            'data' => $sum,
            'key' => $sid
        ]);
    }
}
