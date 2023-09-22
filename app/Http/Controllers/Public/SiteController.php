<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index(string $subdomain = 'samara') {
        dd($subdomain);
    }

    public function product( string $name, string $subdomain = 'samara') {
        dd($name . $subdomain);
    }
}
