<?php

// * File: 				/routes/website/public.php
// * Description:		This file holds the routes for the public-facing pages on the AtomizeCRM Frontend.
// * Created:			16th December 2020 at 16:33
// * Updated:			16th December 2020 at 16:36
// * Author:			Ryan Castle
// * Notes:

// ----------

// Import external packages and scripts
use App\Http\Controllers\APIRequest;


// ----------

// // @route               GET /
// // @description         The landing page
// // @access              Public
// Route::get('/', function() {
//     // Return view for this page
//     return view('website/public/landing');
// })->name('public-home');


// @route               GET /legal/terms-of-service
// @description         This page displays the terms of service for AtomizeCRM
// @access              Public
Route::get('/legal/terms-of-service', function() {
    // Return view for this page
    return view('website/public/termsOfService');
})->name('public-termsOfService');

















// // @route               GET /testing-api
// // @description         Just a testing route
// // @access              Public
// Route::get('/testing-api', function() {
//     // Attempt running code
//     try {
//         // Create request
//         $data = APIRequest::performRequest('GET', '/test');
//         // Return the data
//         return $data;
//     } catch (Exception $error) {
//         // Return the error
//         return $error->getMessage();
//     }
// });
//
//
// // @route               GET /testing-api-db
// // @description         Just a testing route
// // @access              Public
// Route::get('/testing-api-db', function() {
//     // Attempt running code
//     try {
//         // Create request
//         $data = APIRequest::performRequest('GET', '/test-db');
//         // Return the data
//         return $data;
//     } catch (Exception $error) {
//         // Return the error
//         return $error->getMessage();
//     }
// });
