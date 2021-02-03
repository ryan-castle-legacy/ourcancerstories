<?php

namespace App\Http\Middleware;

use Closure;

class Preflight {

    public function handle($request, Closure $next) {
		// Continue with request
		if ($request->getMethod() === "OPTIONS") {
            return response('');
        }
		return $next($request);
    }

}
