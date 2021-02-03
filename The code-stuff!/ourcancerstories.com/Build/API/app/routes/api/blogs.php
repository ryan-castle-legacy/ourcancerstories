<?php

// * File: 				/routes/api/user.php
// * Description:		This file holds the routes that interact with the User model.
// * Created:			17th December 2020 at 18:33
// * Updated:			17th December 2020 at 18:37
// * Author:			Ryan Castle
// * Notes:

// ----------

// Import external packages and scripts
use App\Http\Controllers\Database;
use App\Http\Controllers\EmailHandler;
use App\User;
use App\Models\Blog;


// ----------

// @route               GET /blogs
// @description         Return all blog records
// @access              Public
Route::get('/blogs', function() {
    // Attempt running code
    try {
		// Get all blogs data
        $blogs = DB::table('blogs')->orderBy('name', 'ASC')->get();
		// Return the data
		return json_encode($blogs);
    } catch (Exception $error) {
        // Set the headers for the return data
        header('Content-Type: application/json');
        // Return the error
        return array('message' => $error->getMessage());
    }
})->middleware('apiAuthorisedOnly');


// @route               GET /blog/:blog_url
// @description         Return blog data
// @access              Public
Route::get('/blog/{blog_url}', function($blog_url) {
    // Attempt running code
    try {
		// Get all blog data
		$blog = DB::table('blogs')->where('blog_url', '=', $blog_url)->first();
		// Check if the blog was found
		if ($blog) {
			// Get user's blog record
			$blog->owner = DB::table('users')->where('id', '=', $blog->user_id)->first();
		}
		// Return the data
		return json_encode($blog);
    } catch (Exception $error) {
        // Set the headers for the return data
        header('Content-Type: application/json');
        // Return the error
        return array('message' => $error->getMessage());
    }
})->middleware('apiAuthorisedOnly');


// @route               GET /blog/exists/:blog_url
// @description         Return a Boolean whether the supplied blog URL is registed with a blog already
// @access              Public
Route::get('/blog/exists/{blog_url}', function(String $blog_url) {
    // Attempt running code
    try {
        // Find the user record
        $blog = DB::table('blogs')->where('blog_url', '=', $blog_url)->first();
        // Check if user was found
        if ($blog) {
            // Send the result
            return true;
        }
        // Return the data
        return false;
    } catch (Exception $error) {
        // Set the headers for the return data
        header('Content-Type: application/json');
        // Return the error
        return array('message' => $error->getMessage());
    }
})->middleware('apiAuthorisedOnly');


// @route               POST /blog/create
// @description         Creation of a new blog
// @access              Public
Route::post('/blog/create', function() {
    // Attempt running code
    try {
        // Collect data from the request
        $data = Request::all();
        // Search for an existing blog record
        $blog = DB::table('blogs')->where('blog_url', '=', $data['blog_url'])->first();
        // Check if blog was found
        if ($blog) {
            // Send an error
            return json_encode(['error' => 'This blog URL is already in use.']);
        }
        // Create a new Blog from the model
        $blog = Blog::create([
            'blog_url'     		=> $data['blog_url'],
            'name'      		=> $data['name'],
			'description'		=> $data['description'],
            'user_id'       	=> $data['user_id'],
        ]);
        // Get the blog's details
        $blog = DB::table('blogs')->where('blog_url', '=', $data['blog_url'])->first();
		// Update the user's account data with their blog URL
		DB::table('users')->where('id', '=', $data['user_id'])->update([
			'blog_url'	=> $data['blog_url'],
		]);
        // Return the Blogger Model's data
		return json_encode(['blog' => $blog]);
    } catch (Exception $error) {
        // Set the headers for the return data
        header('Content-Type: application/json');
        // Return the error
        return array('message' => $error->getLine().' - '.$error->getMessage());
    }
})->middleware('apiAuthorisedOnly');
