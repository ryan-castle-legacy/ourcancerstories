<?php

// * File: 				/routes/website/public.php
// * Description:		This file holds the routes for the public-facing pages on the AtomizeCRM Frontend.
// * Created:			16th December 2020 at 16:33
// * Updated:			16th December 2020 at 16:36
// * Author:			Ryan Castle
// * Notes:

// ----------

// Import external packages and scripts
use App\Http\Controllers\Database;


// ----------

// // @route               GET /test
// // @description         A test API route!
// // @access              Public
// Route::get('/test', function() {
//     // Create data object
//     $data = array(
//         'message'       => 'Hello from the API!',
//     );
//     // Set the headers for the return data
//     header('Content-Type: application/json');
//     // Return the data
//     return $data;
// })->middleware('apiAuthorisedOnly');
//
//
// // @route               GET /test-db
// // @description         Another test API route!
// // @access              Public
// Route::get('/test-db', function() {
//     // Attempt running code
//     try {
//
//         // Check if the API has a connection to the database
//         $isConnected = Database::isConnected();
//
//         $users = DB::table('users')->get();
//
//         // Create data object
//         $data = array(
//             'data'          => $users,
//         );
//
//
//         // Set the headers for the return data
//         header('Content-Type: application/json');
//         // Return the data
//         return $data;
//     } catch (Exception $error) {
//         // Set the headers for the return data
//         header('Content-Type: application/json');
//         // Return the error
//         return array('message' => $error->getMessage());;
//     }
// })->middleware('apiAuthorisedOnly');
