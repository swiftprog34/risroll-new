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
        $id = session()->getId();
        $userCart = Cart::where('session_id', $id)->first();
        if($userCart === null) {
            $userCart = Cart::make([
                'session_id' => $id,
            ]);
        }

        DB::transaction(function() use ($request, $userCart) {
            $userCart->save();
            $product = Product::where('id', $request->product_id)->firstOrFail();
            $userCart->products()->attach($userCart->session_id,
                [
                    'product_id' => $product->id,
                    'price' => $product->price,
                    'quantity' => 1
                ]);
        });
    }

    public function changeQuantity(Request $request) {
        $id = session()->getId();
        $userCart = Cart::where('session_id', $id)->firstOrFail();
        $products = $userCart->products;
        $products->map(function($product, $request) {
            if($product->id == $request->id) {
                $product->quantity += $request->quantity;
            }
        });

        $filteredProducts = $products->reject(function ($product, int $key) {
            return $product->quantity > 0;
        });
        $userCart->products()->attach($userCart->session_id,
            $filteredProducts);
    }

    public function removeProduct(Request $request) {
        $id = session()->getId();
        $userCart = Cart::where('session_id', $id)->firstOrFail();
        $filteredProducts = $userCart->products->reject(function ($product, $request) {
            return $product->id != $request->product_id;
        });
        $userCart->products()->attach($userCart->session_id,
            $filteredProducts);
    }
}
