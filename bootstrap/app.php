<?php

use App\Http\Middleware\AuthCheck;
use App\Http\Middleware\RedirectLogin;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias(['authcheck'=>AuthCheck::class,'redirectauth'=> RedirectLogin::class]);

    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
