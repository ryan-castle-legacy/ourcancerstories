<?php

// * File: 				/routes/website/community.php
// * Description:		This file holds the routes for the public-facing pages on the AtomizeCRM Frontend.
// * Created:			16th December 2020 at 16:33
// * Updated:			16th December 2020 at 16:36
// * Author:			Ryan Castle
// * Notes:

// ----------

// Import external packages and scripts
use App\Http\Controllers\APIRequest;


// ----------

// @route               GET /community
// @description         The community landing page
// @access              Public
Route::get('/', function() {

	// var_dump(Auth::user());
	// return;


	// Get users
    $users = APIRequest::performRequest('GET', '/users');
    // Return view for this page
    return view('website/community/home', ['users' => $users]);
})->name('community-home');


// @route               GET /community/:profile_url
// @description         The community user's profile page
// @access              Public
Route::get('/community/{profile_url}', function($profile_url = null) {
	// Get users
    $user = APIRequest::performRequest('GET', '/user/'.$profile_url);
    // Return view for this page
    return view('website/community/profile', ['user' => $user]);
})->name('community-profile');
