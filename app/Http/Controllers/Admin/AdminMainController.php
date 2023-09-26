<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AdminMainController extends Controller
{
    public function index() {
        $cities = City::all();
        return view('admin.city.index', compact('cities'));
    }

    public function fetchData(string $restaurantID, string $wid, string $cityId)
    {
        $response = Http::get(
            'https://online.mobidel.ru/getMenu.php?restaurantID=' . $restaurantID . '&wid=' . $wid);

        $jsonData = $response->json();
        foreach ($jsonData as $categoryAndProducts) {

            $prepared_category = Category::where('uid', $categoryAndProducts['description']['id'])->first();

            if (is_null($prepared_category)) {
                $prepared_category = new Category();
            }

            $prepared_category['uid'] = $categoryAndProducts['description']['id'];
            //$prepared_category['image'] = $categoryAndProducts['description']['image'];
            $prepared_category['title'] = $categoryAndProducts['description']['name'];
            $prepared_category['slug'] = Str::slug($categoryAndProducts["description"]["name"], '-', 'ru');
            $prepared_category['city_id'] = $cityId;
            try {
                $prepared_category->save();
            } catch (\Throwable $e) {
                Log::debug($e->getMessage());
            }

            foreach ($categoryAndProducts['childrens'] as $product) {

                if ($product["description"]["price"] !== "0") {
                    $prepares_product = Product::where('uid', $product["description"]["id"])->first();

                    if (is_null($prepares_product)) {
                        $prepares_product = new Product();
                    }

                    $prepares_product['uid'] = $product["description"]["id"];
                    $prepares_product['title'] = $product["description"]["name"];
                    $prepares_product['slug'] = Str::slug($product["description"]["name"], '-', 'ru');
                    //$prepares_product['img'] = $product["description"]["image"];
                    $prepares_product['price'] = $product["description"]["price"];
                    $prepares_product['description'] = $product["description"]["description"];
                    $prepares_product['sku'] = $product["description"]["oneCID"];
                    $prepares_product['category_uid'] = $product["description"]["parent"];
                    try {
                        $prepares_product->save();
                    } catch (\Throwable $e) {
                        Log::debug($e->getMessage());
                    }

                }

            }

        }
        return redirect()->back()->with('success', 'Товары и категории успешно выгружены.');
    }
}
