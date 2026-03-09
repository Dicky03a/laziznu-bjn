<?php

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
        // Validate CSRF tokens for all non-API routes
        $middleware->validateCsrfTokens(except: [
            'api/*',
        ]);

        // Trust proxies from load balancers (CloudFlare, Nginx, etc)
        // Uncomment and configure for production load balancers
        // $middleware->trustProxies(at: ['*']);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Handle authentication exceptions for API requests
        $exceptions->shouldRenderJsonWhen(function ($request, $e) {
            return $request->is('api/*') || $request->expectsJson();
        });
    })->create();
