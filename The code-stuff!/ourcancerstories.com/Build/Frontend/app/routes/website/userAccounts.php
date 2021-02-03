<?php

// * File: 				/routes/website/userAccounts.php
// * Description:		This file holds the routes for the pages regarding user accounts (signing in, creating a new account, email address verification, etc.) on the AtomizeCRM Frontend.
// * Created:			16th December 2020 at 16:33
// * Updated:			16th December 2020 at 16:36
// * Author:			Ryan Castle
// * Notes:

// ----------

// Import external packages and scripts
use App\Http\Controllers\APIRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


// ----------

// @route               GET /signup
// @description         This page displays the form to registering a new user account.
// @access              Public
Route::get('/signup', function() {
    // Return view for this page
    return view('website/userAccounts/signup');
})->middleware('guest')->name('userAccounts-signup');


// @route               POST /signup
// @description         This page handles submissions from the new user registration form.
// @access              Public
Route::post('/signup', function() {
    // Capture data from the request
    $data = Request::all();
    // Validate data that has been sent through
    $validation = Validator::make($data, array(
        'firstname'         => ['string', 'max:64', 'required'],
        'lastname'          => ['string', 'max:64', 'required'],
        'email'             => ['string', 'email', 'max:255', 'required'],
        'password'          => ['string', 'min:8', 'required_with:confirmPassword', 'same:confirmPassword'],
        'confirmPassword'   => ['string', 'min:8'],
    ));
    // Check if the validation has failed
    if ($validation->fails()) {
        // Return redirect with errors
        return Redirect::back()->withErrors($validation)->withInput();
    }
    // Check if the email address is already used
    if (APIRequest::performRequest('GET', '/user/exists/'.$data['email'])) {
        // Return message to the user
        return Redirect::back()->withErrors(['email' => 'This email address is already use.'])->withInput();
    }
    // Hash password
    $password = Hash::make($data['password']);
    // Send data to API to create new user
    $user = APIRequest::performRequest('POST', '/user/create', array(
        'firstname'         => $data['firstname'],
        'lastname'          => $data['lastname'],
        'email'             => $data['email'],
        'password'          => $password
    ));
    // Authorise user's session
    Auth::loginUsingId($user['user']->id, true);
    // Return user to their dashboard
    return Redirect::route('community-home');
})->middleware('guest')->name('userAccounts-signup');


// @route               GET /logout
// @description         This page will sign the user out of their account
// @access              Private
Route::get('/logout', function() {
    // Sign out the user and redirect them to the public home page
    return Redirect::route('community-home')->with(Auth::logout());
})->middleware('auth')->name('userAccounts-logout');


// @route               GET /login
// @description         This page displays the form for a user to log into their account.
// @access              Public
Route::get('/login', function() {
    // Return view for this page
    return view('website/userAccounts/login');
})->middleware('guest')->name('userAccounts-login');


// @route               POST /login
// @description         This page handles submissions from the sign in form.
// @access              Public
Route::post('/login', function() {
    // Capture data from the request
    $data = Request::all();
    // Validate data that has been sent through
    $validation = Validator::make($data, array(
        'email'             => ['string', 'email', 'required'],
        'password'          => ['string', 'required'],
    ));
    // Check if the validation has failed
    if ($validation->fails()) {
        // Return redirect with errors
        return Redirect::back()->withErrors($validation)->withInput();
    }
    // Check if the email address is not registered
    if (!APIRequest::performRequest('GET', '/user/exists/'.$data['email'])) {
        // Return message to the user
        return Redirect::back()->withErrors(['email' => 'This account does not exist.'])->withInput();
    }
    // Send data to API to check the user's credentials
    $user = APIRequest::performRequest('POST', '/user/check-login', array(
        'email'             => $data['email'],
        'password'          => $data['password']
    ));
    // Check if the user has signed in with the correct details
    if (isset($user['user']) && isset($user['user']->id)) {
        // Authorise user's session
        Auth::loginUsingId($user['user']->id, true);
        // Save the user's session ID
        DB::table('users')->where('id', '=', $user['user']->id)->update(['last_session' => Session::getId()]);
        // Return user to their dashboard
        return Redirect::route('community-home');
    }
    // Return message to the user
    return Redirect::back()->withErrors(['email' => 'These credentials are incorrect.'])->withInput();
})->middleware('guest')->name('userAccounts-login');


// @route               GET /reset-password
// @description         This page displays the form for a user to reset their password.
// @access              Public
Route::get('/reset-password', function() {
    // Return view for this page
    return view('website/userAccounts/resetPassword');
})->middleware('guest')->name('userAccounts-resetPassword');


// @route               POST /reset-password
// @description         This page handles submissions from the password reset form.
// @access              Public
Route::post('/reset-password', function() {
    // Capture data from the request
    $data = Request::all();
    // Validate data that has been sent through
    $validation = Validator::make($data, array(
        'email'             => ['string', 'email', 'required'],
    ));
    // Check if the validation has failed
    if ($validation->fails()) {
        // Return redirect with errors
        return Redirect::back()->withErrors($validation)->withInput();
    }
    // Send email to user to reset the password
    $reset = APIRequest::performRequest('POST', '/user/reset-password', array(
		'email'		=> $data['email']
	));
	// Check if reset email was sent
	if ($reset[0] == 'sent_email') {
		// Return message to the user
	    return Redirect::back()->with(['info' => 'You have been sent an email to \''.$data['email'].'\' to reset your password.']);
	}
    // Return message to the user that the email is not registed
    return Redirect::back()->with(['info' => 'This email address is not registered to an account.']);
})->middleware('guest')->name('userAccounts-resetPassword');


// @route               GET /reset-password/:resetPasswordToken
// @description         This page handles visits to reset passwords
// @access              Public
Route::get('/reset-password/{resetPasswordToken}', function($resetPasswordToken) {
	// Get data about the token
    $data = APIRequest::performRequest('GET', '/user/reset-password/'.$resetPasswordToken);
	// Switch status from the the API request
	switch ($data['status']) {
		case 'token_valid':
			// Display the page to reset the password
			return view('website/userAccounts/resetPassword-submit', ['resetPasswordToken' => $resetPasswordToken]);
		break;
		case 'token_expired':
			// Display that the password reset token has expired
			return view('website/userAccounts/resetPassword-expired');
		break;
		case 'not_valid':
		default:
			// Display that the password reset token is not valid
			return view('website/userAccounts/resetPassword-invalid');
		break;
	}
})->middleware('guest');


// @route               POST /reset-password/:resetPasswordToken
// @description         This page handles submissions from the password reset form.
// @access              Public
Route::post('/reset-password/{resetPasswordToken}', function($resetPasswordToken) {
	// Capture data from the request
    $data = Request::all();
    // Validate data that has been sent through
    $validation = Validator::make($data, array(
        'password'          => ['string', 'min:8', 'required_with:confirmPassword', 'same:confirmPassword'],
        'confirmPassword'   => ['string', 'min:8'],
    ));
    // Check if the validation has failed
    if ($validation->fails()) {
        // Return redirect with errors
        return Redirect::back()->withErrors($validation)->withInput();
    }
	// Hash new password
    $password = Hash::make($data['password']);
    // Send data to API to create new user
    $result = APIRequest::performRequest('POST', '/user/update-password', array(
		'resetPasswordToken'    => $resetPasswordToken,
        'password'          	=> $password
    ));
	// Check if successful
	if ($result['status'] == 'successful') {
	    // Return user to the login
	    return Redirect::route('userAccounts-login')->with(['info' => 'Your password has been successfully changed.']);
	}
	// Display that the password reset token has expired
	return view('website/userAccounts/resetPassword-expired');
})->middleware('guest')->name('userAccounts-resetPassword-submit');
