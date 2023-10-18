<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\City;
use App\Models\Order;
use App\Models\Pickup;
use App\Models\Product;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index(Request $request)
    {

        $subdomain = $request->route()->parameter('subdomain') ?: 'samara';
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

        $categoriesMainDesktop = Category::where('city_id', $cityWithNested->id)->take(8)->get();
        $header_title = "RisRoll (".$cityWithNested->city_name.")";
        return view('client.index', compact('categoriesMainDesktop', 'cityWithNested', 'userCartSum', 'userCart', 'header_title'));
    }

    public function category(Request $request, $uid)
    {
        $subdomain = $request->route()->parameter('subdomain') ?: 'samara';

        $cityWithNested = City::where('slug', $subdomain)->with(['categories' => function($categories) {
            $categories->orderBy('sort_order');
        }])->firstOrFail();

        $currentCategory = Category::where(["uid" => $uid])->with(['products' => function($products){
            $products->orderBy('sort_order');
        }])->firstOrFail();
        $categoriesMainDesktop = Category::where('city_id', $cityWithNested->id)->take(8)->get();

        $sid = session()->getId();
        $userCart = Cart::where('session_id', $sid)->with('products')->first();
        $userCartSum =  $userCart !== null ? $userCart->products->sum(function ($product) {
            return $product->pivot->price * $product->pivot->quantity;
        }) : 0;

        $header_title = $currentCategory->title;

        return view('client.category', compact('cityWithNested', 'currentCategory', 'categoriesMainDesktop', 'userCartSum', 'userCart', 'header_title'));
    }

    public function product(Request $request, $uid)
    {
        $subdomain = $request->route()->parameter('subdomain') ?: 'samara';

        $cityWithNested = City::where('slug', $subdomain)->with(['categories' => function($categories) {
            $categories->orderBy('sort_order');
        }])->firstOrFail();

        $categoriesMainDesktop = Category::where('city_id', $cityWithNested->id)->take(8)->get();
        $product = Product::where(["uid"=> $uid])->with('category')->firstOrFail();

        $sid = session()->getId();
        $userCart = Cart::where('session_id', $sid)->with('products')->first();
        $userCartSum = $userCart !== null  ? $userCart->products->sum(function ($product) {
            return $product->pivot->price * $product->pivot->quantity;
        }) : 0 ;

        $header_title = $product->title;

        return view('client.product', compact('cityWithNested', 'categoriesMainDesktop', 'product', 'userCartSum', 'userCart', 'header_title'));
    }

    public function page()
    {

    }

    public function checkout(Request $request)
    {
        $subdomain = $request->route()->parameter('subdomain') ?: 'samara';
        $cityWithNested = City::where('slug', $subdomain)->with(['categories' => function($categories) {
            $categories->orderBy('sort_order');
        }])->firstOrFail();
        $categoriesMainDesktop = Category::where('city_id', $cityWithNested->id)->take(8)->get();

        $sid = session()->getId();
        $userCart = Cart::where('session_id', $sid)->with('products')->first();
        $userCartSum = $userCart !== null ? $userCart->products->sum(function ($product) {
            return $product->pivot->price * $product->pivot->quantity;
        }) : 0;

        $header_title = "Корзина";

        return view('client.checkout', compact('categoriesMainDesktop', 'cityWithNested', 'userCartSum', 'userCart', 'header_title'));
    }

    public function chooseCity($choosedCity) {

    }


    public function terms(Request $request) {
        $subdomain = $request->route()->parameter('subdomain') ?: 'samara';
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

        $header_title = "Пользовательское соглашение";

        $categoriesMainDesktop = Category::where('city_id', $cityWithNested->id)->take(8)->get();
        return view('client.terms', compact('categoriesMainDesktop', 'cityWithNested', 'userCartSum', 'userCart', 'header_title'));
    }

    public function privacy(Request $request) {
        $subdomain = $request->route()->parameter('subdomain') ?: 'samara';
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


        $header_title = "Политика конфиденциальности";
        $categoriesMainDesktop = Category::where('city_id', $cityWithNested->id)->take(8)->get();
        return view('client.privacy', compact('categoriesMainDesktop', 'cityWithNested', 'userCartSum', 'userCart', 'header_title'));
    }

    public function promotions(Request $request) {
        $subdomain = $request->route()->parameter('subdomain') ?: 'samara';
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


        $categoriesMainDesktop = Category::where('city_id', $cityWithNested->id)->take(8)->get();
        return view('client.promotions', compact('categoriesMainDesktop', 'cityWithNested', 'userCartSum', 'userCart', 'header_title'));
    }

    public function contacts(Request $request) {
        $subdomain = $request->route()->parameter('subdomain') ?: 'samara';
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

        $header_title = "Контакты";

        $categoriesMainDesktop = Category::where('city_id', $cityWithNested->id)->take(8)->get();
        return view('client.contacts', compact('categoriesMainDesktop', 'cityWithNested', 'userCartSum', 'userCart', 'header_title'));
    }

    public function delivery(Request $request) {
        $subdomain = $request->route()->parameter('subdomain') ?: 'samara';
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

        $header_title = "Доставка и оплата";

        $categoriesMainDesktop = Category::where('city_id', $cityWithNested->id)->take(8)->get();
        return view('client.delivery', compact('categoriesMainDesktop', 'cityWithNested', 'userCartSum', 'userCart', 'header_title'));
    }

    public function search(Request $request) {
        $subdomain = $request->route()->parameter('subdomain') ?: 'samara';
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

        $header_title = "Поиск";

        $categoriesMainDesktop = Category::where('city_id', $cityWithNested->id)->take(8)->get();
        return view('client.search', compact('categoriesMainDesktop', 'cityWithNested', 'userCartSum', 'userCart', 'header_title'));
    }

    public function createOrder(Request $request) {
        dd($request);

        if($request->has('locations')) {
            $location =  Pickup::findOrFail($request->locations);
        } else {
            $location = $request->locations;
        }
        $persons = $request->persons;
        $street = $request->street;
        $home = $request->home;
        $apart = $request->apart;
        $entrance = $request->entrance;
        $floor = $request->floor;
        $receiving_type = $request->receiving_type;
        $toDate = $request->odated;
        $datetime = $request->datetime;
        $toTime = $request->otimed;
        $payType = $request->pay;
        $userName = $request->uname;
        $phone = $request->phone;
        $comment = $request->comment;

        $sid = session()->getId();
        $userCart = Cart::where('session_id', $sid)->with('products')->first();
        $userCartSum = $userCart !== null ? $userCart->products->sum(function ($product) {
            return $product->pivot->price * $product->pivot->quantity;
        }) : 0;

        foreach ($userCart->products as $cartProduct) {
            $sum = $cartProduct->pivot->quantity * $cartProduct->pivot->price;
            $quantity = $cartProduct->pivot->quantity;
            $title = $cartProduct->title;
            echo "Товар $title в количестве $quantity на сумму $sum";
            echo ' <br/>';
        }

        if($location !== null) {
            echo "Cамовывоз $location->name";
        }
        echo '<br/>';
        echo "Количество персон $persons";
        echo ' <br/>';
        echo "улица $street, дом $home, квартира $apart, подьезд $entrance, этаж, $floor";
        echo ' <br/>';
        echo "способ получения заказа $receiving_type";
        echo ' <br/>';
        echo "если нужно, $datetime, на дату/время $toDate / $toTime";
        echo ' <br/>';
        echo "с типом оплаты $payType";
        echo ' <br/>';
        echo "пользователь $userName, телефон $phone";
        echo ' <br/>';
        echo "комментарий к заказу $comment";

        $userCart = Cart::where('session_id', $sid)->with('products')->first();
        $userCart->delete();
    }
}
