<?php

namespace App\Http\Middleware;

use Closure;

class WidgetCORS {

    public function handle($request, Closure $next) {
		// Continue with request
	    return $next($request)
	        ->header('Access-Control-Allow-Origin', '*')
	        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS')
			->header('Access-Control-Allow-Headers', 'Content-Type, Accept, Authorization, X-Requested-With, Application')
			->header('Access-Control-Max-Age', '400');
    }

}
