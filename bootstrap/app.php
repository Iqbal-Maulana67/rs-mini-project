<?php

use App\Http\Middleware\KasirMiddleware;
use App\Http\Middleware\LoginMiddleware;
use App\Http\Middleware\MarketingMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'auth.check' => LoginMiddleware::class,
            'auth.kasir' => KasirMiddleware::class,
            'auth.marketing' => MarketingMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
