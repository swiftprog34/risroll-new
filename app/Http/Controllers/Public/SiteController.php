<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index(Request $request)
    {

        $subdomain = $request->route()->parameter('subdomain') ?: 'samara';
        $cityWithNested = City::where('slug', $subdomain)->with(['categories' => function($categories) {
            $categories->orderBy('sort_order');
        }])->get();
        $categoriesMainDesktop = Category::where('city_id', $cityWithNested[0]->id)->take(8)->get();
        return view('client.index', compact('categoriesMainDesktop', 'cityWithNested'));
    }

    public function category(Request $request, $uid)
    {
        $subdomain = $request->route()->parameter('subdomain') ?: 'samara';

        $cityWithNested = City::where('slug', $subdomain)->with(['categories' => function($categories) {
            $categories->orderBy('sort_order');
        }])->get();

        $currentCategory = Category::where(["uid" => $uid])->with(['products' => function($products){
            $products->orderBy('sort_order');
        }])->firstOrFail();
        $categoriesMainDesktop = Category::take(8)->get();
        return view('client.category', compact('cityWithNested', 'currentCategory', 'categoriesMainDesktop'));
    }

    public function product(Request $request, $uid)
    {
        $subdomain = $request->route()->parameter('subdomain') ?: 'samara';

        $cityWithNested = City::where('slug', $subdomain)->with(['categories' => function($categories) {
            $categories->orderBy('sort_order');
        }])->get();

        $categoriesMainDesktop = Category::take(8)->get();
        $product = Product::where(["uid"=> $uid])->firstOrFail();
        return view('client.product', compact('cityWithNested', 'categoriesMainDesktop', 'product'));
    }

    public function page()
    {

    }

    public function checkout(Request $request)
    {
        $subdomain = $request->route()->parameter('subdomain') ?: 'samara';
        $cityWithNested = City::where('slug', $subdomain)->with(['categories' => function($categories) {
            $categories->orderBy('sort_order');
        }])->get();
        $categoriesMainDesktop = Category::where('city_id', $cityWithNested[0]->id)->take(8)->get();
        return view('client.checkout', compact('categoriesMainDesktop', 'cityWithNested'));
    }

    public function chooseCity($choosedCity) {

    }

    public function createOrder($request) {
        dd($request);
    }
}
