<?php

// * File: 				/app/Http/Controllers/Database.php
// * Description:		This file holds the controller for making requests to the Database.
// * Created:			17th December 2020 at 10:39
// * Updated:			16th December 2020 at 10:53
// * Author:			Ryan Castle
// * Notes:

// ----------

// Define the namespace for this controller
namespace App\Http\Controllers;

// Import external packages and scripts
use App\Http\Controllers\Controller;
use DB;


// ----------

class Database extends Controller {

    public static function isConnected() {
        // Attempt running code
        try {
            // Get the database's connection
            DB::connection()->getPdo();
            // Return true
            return true;
        } catch (Exception $error) { }
        // Return false
        return false;
    }

}


    