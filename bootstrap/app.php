<?php

use App\Http\Middleware\AdminMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Http\Middleware\TrustProxies;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function ($middleware) {

        $middleware->alias([
            'admin' => AdminMiddleware::class,
        ]);

        $middleware->trustProxies(
            at: '*',
            headers: TrustProxies::HEADER_X_FORWARDED_FOR |
                     TrustProxies::HEADER_X_FORWARDED_HOST |
                     TrustProxies::HEADER_X_FORWARDED_PORT |
                     TrustProxies::HEADER_X_FORWARDED_PROTO |
                     TrustProxies::HEADER_X_FORWARDED_PREFIX,
        );

    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*'),
        );
    })
    ->create();