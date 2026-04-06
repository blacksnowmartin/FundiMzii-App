<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middleware = [
        // Global HTTP middleware
    ];

    protected $middlewareGroups = [
        'web' => [
            // Web middleware
        ],

        'api' => [
            // API middleware
        ],
    ];

    protected $middlewareAliases = [
        // Middleware aliases
    ];

    protected $routeMiddleware = [
        // Route middleware
    ];
}