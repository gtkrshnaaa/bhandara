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
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Laravel 12 Modern Exception Handling
        
        // Report exceptions (for logging)
        $exceptions->reportable(function (Throwable $e) {
            // Custom reporting logic can be added here
        });
        
        // Render exceptions for web requests
        $exceptions->renderable(function (Throwable $e, $request) {
            // Return custom error views based on exception type
            if ($request->is('admin/*')) {
                // Admin area errors
                return response()->view('errors.admin', [
                    'exception' => $e,
                    'message' => $e->getMessage(),
                ], 500);
            }
            
            // Default error handling (will use Laravel's built-in error pages)
            return null;
        });
        
        // Custom throttle response
        $exceptions->throttle(function (Throwable $e) {
            return response('Too many requests', 429);
        });
    })->create();
