<?php

// * File: 				/routes/web.php
// * Description:		This file brings all routes together for the AtomizeCRM API.
// * Created:			16th December 2020 at 21:27
// * Updated:			16th December 2020 at 21:78
// * Author:			Ryan Castle
// * Notes:

// ----------

// Import external packages and scripts
use Illuminate\Support\Facades\Route;


// ----------

// Bring in the routes for the Frontend
require_once 'api/index.php';
require_once 'api/user.php';
require_once 'api/blogs.php';
