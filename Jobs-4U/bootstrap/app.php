<?php

use App\Http\Middleware\user\userRedirect;
use App\Http\Middleware\user\CheckRequestMethod;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        // $middleware->prepend(userRedirect::class);
        // $middleware->prepend(CheckRequestMethod::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
