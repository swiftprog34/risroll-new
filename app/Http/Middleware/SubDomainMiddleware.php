<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SubDomainMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

//        dd($request->subdomain);
        if (!in_array($request->subdomain, config('subdomains'))) {
            return  redirect()->route('index', 'samara');
        }

        $request->session()->put('city', $request->subdomain);

        if($request->subdomain == null) {
            $request->session()->put('need_choose_city', 'true');
            $request->session()->put('city', 'samara');
        }

        return $next($request);
    }
}
