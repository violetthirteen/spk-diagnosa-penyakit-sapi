<?php

use App\Http\Middleware\AdminMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
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

        $middleware->trustProxies(at: '*');

    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*'),
        );
    })
    ->create();

// Vercel serverless: redirect writable storage to /tmp
if (getenv('VERCEL')) {
    $tmpBase = '/tmp/storage';
    foreach (['', '/framework', '/framework/views', '/framework/cache', '/framework/cache/data', '/logs', '/app'] as $sub) {
        $p = $tmpBase . $sub;
        if (!is_dir($p)) {
            mkdir($p, 0755, true);
        }
    }
    $app->useStoragePath($tmpBase);
}
