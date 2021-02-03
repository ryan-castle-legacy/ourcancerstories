<?php

// * File: 				/routes/website/blogger.php
// * Description:		This file holds the routes for the public-facing pages on the AtomizeCRM Frontend.
// * Created:			17th December 2020 at 12:03
// * Updated:			17th December 2020 at 23:22
// * Author:			Ryan Castle
// * Notes:

// ----------

// Import external packages and scripts
use App\Http\Controllers\APIRequest;


// ----------

// @route               GET /blogs
// @description         The blogs listing page
// @access              Public
Route::get('/blogs', function() {
	// Get blogs
    $blogs = APIRequest::performRequest('GET', '/blogs');
    // Return view for this page
    return view('website/blogger/home', ['blogs' => $blogs]);
})->name('blogger-home');


// @route               GET /blog/:blog_url
// @description         The blogs page
// @access              Public
Route::get('/blog/{blog_url}', function($blog_url = null) {
	// Get blog
    $blog = APIRequest::performRequest('GET', '/blog/'.$blog_url);
    // Return view for this page
    return view('website/blogger/page', ['blog' => $blog]);
})->name('blogger-page');


// @route               GET /blogs/create
// @description         This page will allow the user to create a blog
// @access              Private
Route::get('/blogs/create', function() {
	// Check if user is not a blogger yet
	if (Auth::user()->blog_url == null) {
		// Return view for this creation page
	    return view('website/blogger/create');
	}
	// Send the blogger back to their blog
	return Redirect::route('blogger-page', ['blog_url' => Auth::user()->blog_url]);
})->middleware('auth')->name('blogger-create');


// @route               POST /blogs/create
// @description         This page handles submissions to create a blog
// @access              Private
Route::post('/blogs/create', function() {
	// Check if user is not a blogger yet
	if (Auth::user()->blog_url == null) {
	    // Capture data from the request
	    $data = Request::all();
	    // Validate data that has been sent through
	    $validation = Validator::make($data, array(
			'blog_name'        => ['string', 'min:2', 'max:64', 'required'],
			'blog_url'         => ['string', 'min:2', 'max:64', 'alpha_dash', 'required'],
	        'description'      => ['string', 'min:22', 'max:256', 'required'],
	    ));
	    // Check if the validation has failed
	    if ($validation->fails()) {
	        // Return redirect with errors
	        return Redirect::back()->withErrors($validation)->withInput();
	    }
	    // Check if the blog URL is already used
	    if (APIRequest::performRequest('GET', '/blog/exists/'.$data['blog_url'])) {
	        // Return message to the user
	        return Redirect::back()->withErrors(['blog_url' => 'This blog URL is already use.'])->withInput();
	    }
	    // Send data to API to create new blog
	    $blog = APIRequest::performRequest('POST', '/blog/create', array(
	        'blog_url'			=> $data['blog_url'],
	        'name'          	=> $data['blog_name'],
	        'description'       => $data['description'],
	        'user_id'          	=> Auth::user()->id
	    ));
		// Add Session data about owning a blog
		Session::put('blog_url', $data['blog_url']);
	    // Send user to their blog page
	    return Redirect::route('blogger-page', ['blog_url' => $data['blog_url']]);
	}
	// Send the blogger back to their blog
	return Redirect::route('blogger-page', ['blog_url' => Auth::user()->blog_url]);
})->middleware('auth')->name('blogger-create');


// @route               GET /blogs/write
// @description         This page allows the blogger to write an article
// @access              Private
Route::get('/blogs/write', function() {
	// Check if user is a blogger
	if (Auth::user()->blog_url) {
		// Get blog data
	    $blog = APIRequest::performRequest('GET', '/blog/'.Auth::user()->blog_url);
		// Check if the writer has drafted a post already
		$draft = null;
		// Return view for this writing page
	    return view('website/blogger/writer', ['blog' => $blog, 'draft' => $draft]);
	}
	// Send the blogger back to their blog
	return Redirect::route('blogger-page', ['blog_url' => Auth::user()->blog_url]);
})->middleware('auth')->name('blogger-write');
