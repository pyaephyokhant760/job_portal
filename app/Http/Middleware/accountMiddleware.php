<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class accountMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {

            if (url()->current() === route('accountLoginPage') || url()->current() === route('accountRegisterPage')) {
                return back();
            }
            // return view('front.account.account');
        // return response('Hello from middleware');
        }

        return $next($request);
    }
}
