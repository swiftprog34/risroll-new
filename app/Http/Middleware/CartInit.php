<?php

namespace App\Http\Middleware;

use App\Models\Cart;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CartInit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $sid = session()->getId();
        $userCart = Cart::where('session_id', $sid)->first();

        if($userCart === null) {
            $userCart = Cart::make([
                'session_id' => $sid,
            ]);
            $userCart->save();
        }

        return $next($request);
    }
}
