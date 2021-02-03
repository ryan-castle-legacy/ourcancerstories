<?php

// * File: 				/app/Http/Middleware/APIAuthorisedOnly.php
// * Description:		This file holds the middleware that ensures only authorised requests are received by the API.
// * Created:			16th December 2020 at 22:31
// * Updated:			17th December 2020 at 00:11
// * Author:			Ryan Castle
// * Notes:
// * TODO:              Re-map the whitelist to the database rather than it being hard-coded.

// ----------

// Define the namespace for this controller
namespace App\Http\Middleware;

// Import external packages and scripts
use Closure;
use DB;
use Request;
use Exception;


// ----------

class APIAuthorisedOnly {

    // Handle the request
    public function handle($request, Closure $next) {
        // Attempt running code
        try {
            // Collect the public token from the request
            $receivedToken = Request::header('OCSAPIToken');
            // Collect the bearer token from the request
            $receivedBearer = Request::bearerToken();
            // Check if the tokens were set
            if (!empty(trim($receivedToken)) && !empty(trim($receivedBearer))) {
                // Whitelist pairing public tokens with Bearer tokens
                $whitelist = array(
                    'PUBLIC-FROM-FRONTEND'  => 'SECRET-FROM-FRONTEND',
                );
                // Check if the request has matching tokens
                if ($whitelist[$receivedToken] === $receivedBearer) {
                    // Set header for allowing CORS request
                    header('Access-Control-Allow-Origin: '.Request::header('host'));
                    // Continue with the request
                    return $next($request);
                }
            }
            // Return a status of 403 (unauthorised)
            return response()->json(['error' => 403, 'message' => 'Unauthorised Request.'], 403);
        } catch (Exception $error) {
            // Return the error
            return response()->json(['error' => 500, 'message' => 'Something Went Wrong - '.$error->getMessage()], 500);
        }
    }

}
