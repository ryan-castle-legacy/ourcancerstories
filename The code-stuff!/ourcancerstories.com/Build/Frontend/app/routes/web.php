<?php

// * File: 				/routes/web.php
// * Description:		This file brings all routes together for the AtomizeCRM Frontend.
// * Created:			16th December 2020 at 16:29
// * Updated:			16th December 2020 at 16:32
// * Author:			Ryan Castle
// * Notes:

// ----------

// Import external packages and scripts
use Illuminate\Support\Facades\Route;


// ----------

// Bring in the routes for the Frontend
require_once 'website/public.php';
require_once 'website/userAccounts.php';
require_once 'website/blogger.php';
require_once 'website/community.php';
