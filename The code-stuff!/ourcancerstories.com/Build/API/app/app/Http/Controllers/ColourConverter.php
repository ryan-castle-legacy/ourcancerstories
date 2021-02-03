<?php

// * File: 				/app/Http/Controllers/ColourConverter.php
// * Description:		This file holds the methods for manipulating hexadecimal colours to RGB colours.
// * Created:			4th January 2021 at 11:37
// * Updated:			4th January 2021 at 11:41
// * Author:			Ryan Castle
// * Notes:

// ----------

// Define the namespace for this controller
namespace App\Http\Controllers;

// Import external packages and scripts
use App\Http\Controllers\Controller;


// ----------

class ColourConverter extends Controller {

    public static function hexToRGB($hex) {

		$hex = str_replace('#', '', $hex);

		if(strlen($hex) == 3) {
		$r = hexdec(substr($hex,0,1).substr($hex,0,1));
		$g = hexdec(substr($hex,1,1).substr($hex,1,1));
		$b = hexdec(substr($hex,2,1).substr($hex,2,1));
		} else {
		$r = hexdec(substr($hex,0,2));
		$g = hexdec(substr($hex,2,2));
		$b = hexdec(substr($hex,4,2));
		}
		$rgb = array($r, $g, $b);
		//return implode(",", $rgb); // returns the rgb values separated by commas
		return $rgb; // returns an array with the rgb values
    }

}
