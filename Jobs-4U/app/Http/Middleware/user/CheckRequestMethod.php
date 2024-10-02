<?php

namespace App\Http\Middleware\user;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class CheckRequestMethod
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->isMethod('get') && (Route::is("user.authenticate") || Route::is("user.createAccount"))) 
        {
            return redirect()->back();
        }
        return $next($request);
    }
}
