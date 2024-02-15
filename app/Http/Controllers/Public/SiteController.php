<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Mail\SendOrderEmail;
use App\Models\Cart;
use App\Models\Category;
use App\Models\City;
use App\Models\Order;
use App\Models\Pickup;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
class SiteController extends Controller
{
    public function index(Request $request)
    {
        $subdomain = $request->route()->parameter('subdomain') ?: 'samara';
        $cities = City::all();
        $cityWithNested = City::where('slug', $subdomain)->with(['categories' => function($categories) {
            $categories->orderBy('sort_order');
        }])->with(['pickupPoints' => function($points) {
            $points->orderBy('name');
        }])->with(['promotions' => function($promotions) {
            $promotions->orderBy('sort_order')->with('image');
        }])->firstOrFail();

        $sid = session()->getId();
        $userCart = Cart::where('session_id', $sid)->with('products')->first();

        $userCartSum = $userCart !== null ? $userCart->products->sum(function ($product) {
            return $product->pivot->price * $product->pivot->quantity;
        }) : 0;

        $now = Carbon::now('GMT+'.$cityWithNested->utc_time);
        $time_from = Carbon::createFromTimeString($cityWithNested->time_from, 'GMT+'.$cityWithNested->utc_time);
        $time_till = Carbon::createFromTimeString($cityWithNested->time_till, 'GMT+'.$cityWithNested->utc_time);
        $can_receive_orders = $now->between($time_from, $time_till);

        $categoriesMainDesktop = Category::where('city_id', $cityWithNested->id)->take(8)->get();
        $header_title = "RisRoll";
        return view('client.index', compact('can_receive_orders', 'cities','categoriesMainDesktop', 'cityWithNested', 'userCartSum', 'userCart', 'header_title'));
    }

    public function category(Request $request)
    {
//        $id = $request->route()->parameter('id');
        $id = $request->route()->parameter('slug');
        $subdomain = $request->route()->parameter('subdomain') ?: 'samara';
        $cities = City::all();
        $cityWithNested = City::where('slug', $subdomain)->with(['categories' => function($categories) {
            $categories->orderBy('sort_order');
        }])->firstOrFail();

//        $currentCategory = Category::where(["uid" => $id])->with(['products' => function($products){
//            $products->orderBy('sort_order');
//        }])->firstOrFail();
        $currentCategory = Category::where(["slug" => $id])->with(['products' => function($products){
            $products->orderBy('sort_order');
        }])->firstOrFail();

        $categoriesMainDesktop = Category::where('city_id', $cityWithNested->id)->take(8)->get();

        $sid = session()->getId();
        $userCart = Cart::where('session_id', $sid)->with('products')->first();
        $userCartSum =  $userCart !== null ? $userCart->products->sum(function ($product) {
            return $product->pivot->price * $product->pivot->quantity;
        }) : 0;

        $now = Carbon::now('GMT+'.$cityWithNested->utc_time);
        $time_from = Carbon::createFromTimeString($cityWithNested->time_from, 'GMT+'.$cityWithNested->utc_time);
        $time_till = Carbon::createFromTimeString($cityWithNested->time_till, 'GMT+'.$cityWithNested->utc_time);
        $can_receive_orders = $now->between($time_from, $time_till);

        $header_title = $currentCategory->title;

        return view('client.category', compact('can_receive_orders', 'cities','cityWithNested', 'currentCategory', 'categoriesMainDesktop', 'userCartSum', 'userCart', 'header_title'));
    }

    public function product(Request $request)
    {
        //$uid = $request->route()->parameter('id');
        $uid = $request->route()->parameter('slug');
        $subdomain = $request->route()->parameter('subdomain') ?: 'samara';
        $cities = City::all();
        $cityWithNested = City::where('slug', $subdomain)->with(['categories' => function($categories) {
            $categories->orderBy('sort_order');
        }])->firstOrFail();

        $categoriesMainDesktop = Category::where('city_id', $cityWithNested->id)->take(8)->get();
//        $product = Product::where(["uid"=> $uid])->with('category')->firstOrFail();
        $product = Product::where(["slug"=> $uid])->with('category')->firstOrFail();

        $sid = session()->getId();
        $userCart = Cart::where('session_id', $sid)->with('products')->first();
        $userCartSum = $userCart !== null  ? $userCart->products->sum(function ($product) {
            return $product->pivot->price * $product->pivot->quantity;
        }) : 0 ;

        $now = Carbon::now('GMT+'.$cityWithNested->utc_time);
        $time_from = Carbon::createFromTimeString($cityWithNested->time_from, 'GMT+'.$cityWithNested->utc_time);
        $time_till = Carbon::createFromTimeString($cityWithNested->time_till, 'GMT+'.$cityWithNested->utc_time);
        $can_receive_orders = $now->between($time_from, $time_till);

        $header_title = $product->title;

        return view('client.product', compact('can_receive_orders', 'cities','cityWithNested', 'categoriesMainDesktop', 'product', 'userCartSum', 'userCart', 'header_title'));
    }

    public function page()
    {

    }

    public function checkout(Request $request)
    {
        $subdomain = $request->route()->parameter('subdomain') ?: 'samara';
        $cities = City::all();
        $cityWithNested = City::where('slug', $subdomain)->with(['categories' => function($categories) {
            $categories->orderBy('sort_order');
        }])->firstOrFail();
        $categoriesMainDesktop = Category::where('city_id', $cityWithNested->id)->take(8)->get();

        $sid = session()->getId();
        $userCart = Cart::where('session_id', $sid)->with('products')->first();
        $userCartSum = $userCart !== null ? $userCart->products->sum(function ($product) {
            return $product->pivot->price * $product->pivot->quantity;
        }) : 0;

        $now = Carbon::now('GMT+'.$cityWithNested->utc_time);
        $time_from = Carbon::createFromTimeString($cityWithNested->time_from, 'GMT+'.$cityWithNested->utc_time);
        $time_till = Carbon::createFromTimeString($cityWithNested->time_till, 'GMT+'.$cityWithNested->utc_time);
        $can_receive_orders = $now->between($time_from, $time_till);

        $header_title = "Корзина";

        return view('client.checkout', compact('can_receive_orders', 'cities','categoriesMainDesktop', 'cityWithNested', 'userCartSum', 'userCart', 'header_title'));
    }

    public function chooseCity($choosedCity) {

    }


    public function terms(Request $request) {
        $subdomain = $request->route()->parameter('subdomain') ?: 'samara';
        $cities = City::all();
        $cityWithNested = City::where('slug', $subdomain)->with(['categories' => function($categories) {
            $categories->orderBy('sort_order');
        }])->with(['pickupPoints' => function($points) {
            $points->orderBy('name');
        }])->with(['promotions' => function($promotions) {
            $promotions->orderBy('sort_order');
        }])->firstOrFail();

        $sid = session()->getId();
        $userCart = Cart::where('session_id', $sid)->with('products')->first();
        $userCartSum = $userCart !== null ? $userCart->products->sum(function ($product) {
            return $product->pivot->price * $product->pivot->quantity;
        }) : 0;

        $now = Carbon::now('GMT+'.$cityWithNested->utc_time);
        $time_from = Carbon::createFromTimeString($cityWithNested->time_from, 'GMT+'.$cityWithNested->utc_time);
        $time_till = Carbon::createFromTimeString($cityWithNested->time_till, 'GMT+'.$cityWithNested->utc_time);
        $can_receive_orders = $now->between($time_from, $time_till);

        $header_title = "Пользовательское соглашение";

        $categoriesMainDesktop = Category::where('city_id', $cityWithNested->id)->take(8)->get();
        return view('client.terms', compact('can_receive_orders', 'cities','categoriesMainDesktop', 'cityWithNested', 'userCartSum', 'userCart', 'header_title'));
    }

    public function privacy(Request $request) {
        $subdomain = $request->route()->parameter('subdomain') ?: 'samara';
        $cities = City::all();
        $cityWithNested = City::where('slug', $subdomain)->with(['categories' => function($categories) {
            $categories->orderBy('sort_order');
        }])->with(['pickupPoints' => function($points) {
            $points->orderBy('name');
        }])->with(['promotions' => function($promotions) {
            $promotions->orderBy('sort_order');
        }])->firstOrFail();

        $sid = session()->getId();
        $userCart = Cart::where('session_id', $sid)->with('products')->first();
        $userCartSum = $userCart !== null ? $userCart->products->sum(function ($product) {
            return $product->pivot->price * $product->pivot->quantity;
        }) : 0;

        $now = Carbon::now('GMT+'.$cityWithNested->utc_time);
        $time_from = Carbon::createFromTimeString($cityWithNested->time_from, 'GMT+'.$cityWithNested->utc_time);
        $time_till = Carbon::createFromTimeString($cityWithNested->time_till, 'GMT+'.$cityWithNested->utc_time);
        $can_receive_orders = $now->between($time_from, $time_till);

        $header_title = "Политика конфиденциальности";
        $categoriesMainDesktop = Category::where('city_id', $cityWithNested->id)->take(8)->get();
        return view('client.privacy', compact('can_receive_orders', 'cities','categoriesMainDesktop', 'cityWithNested', 'userCartSum', 'userCart', 'header_title'));
    }

    public function promotions(Request $request) {
        $subdomain = $request->route()->parameter('subdomain') ?: 'samara';
        $cities = City::all();
        $cityWithNested = City::where('slug', $subdomain)->with(['categories' => function($categories) {
            $categories->orderBy('sort_order');
        }])->with(['pickupPoints' => function($points) {
            $points->orderBy('name');
        }])->with(['promotions' => function($promotions) {
            $promotions->orderBy('sort_order');
        }])->firstOrFail();

        $sid = session()->getId();
        $userCart = Cart::where('session_id', $sid)->with('products')->first();
        $userCartSum = $userCart !== null ? $userCart->products->sum(function ($product) {
            return $product->pivot->price * $product->pivot->quantity;
        }) : 0;
        $header_title = "Акции";

        $now = Carbon::now('GMT+'.$cityWithNested->utc_time);
        $time_from = Carbon::createFromTimeString($cityWithNested->time_from, 'GMT+'.$cityWithNested->utc_time);
        $time_till = Carbon::createFromTimeString($cityWithNested->time_till, 'GMT+'.$cityWithNested->utc_time);
        $can_receive_orders = $now->between($time_from, $time_till);

        $categoriesMainDesktop = Category::where('city_id', $cityWithNested->id)->take(8)->get();
        return view('client.promotions', compact('can_receive_orders', 'cities','categoriesMainDesktop', 'cityWithNested', 'userCartSum', 'userCart', 'header_title'));
    }

    public function contacts(Request $request) {
        $subdomain = $request->route()->parameter('subdomain') ?: 'samara';
        $cities = City::all();
        $cityWithNested = City::where('slug', $subdomain)->with(['categories' => function($categories) {
            $categories->orderBy('sort_order');
        }])->with(['pickupPoints' => function($points) {
            $points->orderBy('name');
        }])->with(['promotions' => function($promotions) {
            $promotions->orderBy('sort_order');
        }])->firstOrFail();

        $sid = session()->getId();
        $userCart = Cart::where('session_id', $sid)->with('products')->first();
        $userCartSum = $userCart !== null ? $userCart->products->sum(function ($product) {
            return $product->pivot->price * $product->pivot->quantity;
        }) : 0;

        $now = Carbon::now('GMT+'.$cityWithNested->utc_time);
        $time_from = Carbon::createFromTimeString($cityWithNested->time_from, 'GMT+'.$cityWithNested->utc_time);
        $time_till = Carbon::createFromTimeString($cityWithNested->time_till, 'GMT+'.$cityWithNested->utc_time);
        $can_receive_orders = $now->between($time_from, $time_till);

        $header_title = "Контакты";

        $categoriesMainDesktop = Category::where('city_id', $cityWithNested->id)->take(8)->get();
        return view('client.contacts', compact('can_receive_orders', 'cities','categoriesMainDesktop', 'cityWithNested', 'userCartSum', 'userCart', 'header_title'));
    }

    public function delivery(Request $request) {
        $subdomain = $request->route()->parameter('subdomain') ?: 'samara';
        $cities = City::all();
        $cityWithNested = City::where('slug', $subdomain)->with(['categories' => function($categories) {
            $categories->orderBy('sort_order');
        }])->with(['pickupPoints' => function($points) {
            $points->orderBy('name');
        }])->with(['promotions' => function($promotions) {
            $promotions->orderBy('sort_order');
        }])->firstOrFail();

        $sid = session()->getId();
        $userCart = Cart::where('session_id', $sid)->with('products')->first();
        $userCartSum = $userCart !== null ? $userCart->products->sum(function ($product) {
            return $product->pivot->price * $product->pivot->quantity;
        }) : 0;

        $now = Carbon::now('GMT+'.$cityWithNested->utc_time);
        $time_from = Carbon::createFromTimeString($cityWithNested->time_from, 'GMT+'.$cityWithNested->utc_time);
        $time_till = Carbon::createFromTimeString($cityWithNested->time_till, 'GMT+'.$cityWithNested->utc_time);
        $can_receive_orders = $now->between($time_from, $time_till);

        $header_title = "Доставка";

        $categoriesMainDesktop = Category::where('city_id', $cityWithNested->id)->take(8)->get();
        return view('client.delivery', compact('can_receive_orders', 'cities','categoriesMainDesktop', 'cityWithNested', 'userCartSum', 'userCart', 'header_title'));
    }

    public function search(Request $request) {
        $subdomain = $request->route()->parameter('subdomain') ?: 'samara';
        $cities = City::all();
        $cityWithNested = City::where('slug', $subdomain)->with(['categories' => function($categories) {
            $categories->orderBy('sort_order');
        }])->with(['pickupPoints' => function($points) {
            $points->orderBy('name');
        }])->with(['promotions' => function($promotions) {
            $promotions->orderBy('sort_order');
        }])->with(['products' => function($products) {
            $products->where('title', 'like', '%' . request('tmpl') . '%');
        }])->firstOrFail();

        $sid = session()->getId();
        $userCart = Cart::where('session_id', $sid)->with('products')->first();
        $userCartSum = $userCart !== null ? $userCart->products->sum(function ($product) {
            return $product->pivot->price * $product->pivot->quantity;
        }) : 0;

        $now = Carbon::now('GMT+'.$cityWithNested->utc_time);
        $time_from = Carbon::createFromTimeString($cityWithNested->time_from, 'GMT+'.$cityWithNested->utc_time);
        $time_till = Carbon::createFromTimeString($cityWithNested->time_till, 'GMT+'.$cityWithNested->utc_time);
        $can_receive_orders = $now->between($time_from, $time_till);

        $header_title = "Поиск";

        $categoriesMainDesktop = Category::where('city_id', $cityWithNested->id)->take(8)->get();
        return view('client.search', compact('can_receive_orders', 'cities','categoriesMainDesktop', 'cityWithNested', 'userCartSum', 'userCart', 'header_title'));
    }

    public function createOrder(Request $request) {
        $subdomain = $request->route()->parameter('subdomain') ?: 'samara';
        $cities = City::all();
        $cityWithNested = City::where('slug', $subdomain)->with(['categories' => function($categories) {
            $categories->orderBy('sort_order');
        }])->with(['pickupPoints' => function($points) {
            $points->orderBy('name');
        }])->with(['promotions' => function($promotions) {
            $promotions->orderBy('sort_order');
        }])->with(['products' => function($products) {
            $products->where('title', 'like', '%' . request('tmpl') . '%');
        }])->firstOrFail();
        $categoriesMainDesktop = Category::where('city_id', $cityWithNested->id)->take(8)->get();
        $sid = session()->getId();
        $userCart = Cart::where('session_id', $sid)->with('products')->first();
        $userCartSum = $userCart !== null ? $userCart->products->sum(function ($product) {
            return $product->pivot->price * $product->pivot->quantity;
        }) : 0;

        $order = new Order();

        if($request->has('locations')) {
            $location =  Pickup::findOrFail($request->locations);
        } else {
            $location = $request->locations;
        }
        $order->user_id = 0;
        $order->persons = $request->persons;
        $order->street = $request->street;
        $order->home = $request->home;
        $order->apart = $request->apart;
        $order->entrance = $request->entrance;
        $order->floor = $request->floor;
        $order->receiving_type = $request->receiving_type;
        $order->to_date = $request->odated;
        $order->date_time = $request->datetime;
        $order->to_time = $request->otimed;
        $order->pay_type = $request->pay;
        $order->username = $request->uname;
        $order->phone = $request->phone;
        $order->comment = $request->comment;

        $order->save();

        $sid = session()->getId();
        $userCart = Cart::where('session_id', $sid)->with('products')->first();
        $userCartSum = $userCart !== null ? $userCart->products->sum(function ($product) {
            return $product->pivot->price * $product->pivot->quantity;
        }) : 0;

        $total_sum = 0;
        foreach ($userCart->products as $cartProduct) {
            $sum = $cartProduct->pivot->quantity * $cartProduct->pivot->price;
            $total_sum = $total_sum + $sum;
            $quantity = $cartProduct->pivot->quantity;
            $title = $cartProduct->title;
            $order->products()->attach($order->id,
                [
                    'product_id' => $cartProduct->id,
                    'price' => $cartProduct->pivot->price,
                    'quantity' => $cartProduct->pivot->quantity
                ]
            );
        }

        $order->total_sum_without_delivery = $total_sum;
        $order->total_sum = $total_sum + $request->delivery_price;
        $order->delivery_price = $request->delivery_price;
        $order->location = $location;

        $order->save();
        $now = Carbon::now('GMT+'.$cityWithNested->utc_time);
        $time_from = Carbon::createFromTimeString($cityWithNested->time_from, 'GMT+'.$cityWithNested->utc_time);
        $time_till = Carbon::createFromTimeString($cityWithNested->time_till, 'GMT+'.$cityWithNested->utc_time);
        $can_receive_orders = $now->between($time_from, $time_till);

        Mail::send(new SendOrderEmail($order, $cityWithNested->email, ''));
//        $userCart = Cart::where('session_id', $sid)->with('products')->first();
//        $userCart->delete();
        return view('client.ordered', compact('can_receive_orders', 'cities','cityWithNested', 'categoriesMainDesktop', 'userCartSum'));
    }
}
