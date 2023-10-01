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

        $userCart = Cart::where('session_id', $sid)->first();
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
        $price = 0;
        foreach ($products as $product) {
            if($product->id == $request->id) {
                $product->pivot->quantity += $request->quantity;
                $allcart = $product->pivot->quantity;
                $price = $product->pivot->price;
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
            'price' => $price,
        ]);
    }

    public function removeProduct(Request $request) {
        $sid = session()->getId();
        $userCart = Cart::where('session_id', $sid)->firstOrFail();

        $products = $userCart->products;
        foreach ($products as $product) {
            if($product->id == $request->id) {
                $userCart->products()->detach($request->id);
            }
        }

        $userCart = Cart::where('session_id', $sid)->firstOrFail();
        $sum = $userCart->products->sum(function ($product) {
            return $product->pivot->price * $product->pivot->quantity;
        });

        return response()->json([
            'status' => 1,
            'data' => $sum,
            'key' => $sid
        ]);
    }

    public function clearCart() {
        $sid = session()->getId();
        $userCart = Cart::where('session_id', $sid)->firstOrFail();

        $userCart->products->sync([]);

        return response()->json([
            'status' => 1,
            'data' => 0,
        ]);
    }
}
