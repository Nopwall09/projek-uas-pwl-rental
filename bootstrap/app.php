<?php

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

        // alias middleware
        $middleware->alias([
            'role' => \App\Http\Middleware\Role::class,
        ]);

        // group admin
        $middleware->group('admin', [
            \Illuminate\Auth\Middleware\Authenticate::class,
            \App\Http\Middleware\Role::class . ':admin',
        ]);

        // group user
        $middleware->group('user', [
            \Illuminate\Auth\Middleware\Authenticate::class,
            \App\Http\Middleware\Role::class . ':user',
        ]);

        // group kasir
        $middleware->group('kasir', [
            \Illuminate\Auth\Middleware\Authenticate::class,
            \App\Http\Middleware\Role::class . ':kasir',
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
