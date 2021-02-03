<?php

// * File: 				/app/Http/Controllers/TimeElapsed.php
// * Description:		This file holds the methods for manipulating times/dates into nicer-looking strings
// * Created:			28th December 2020 at 19:01
// * Updated:			28th December 2020 at 19:8
// * Author:			Ryan Castle
// * Notes:

// ----------

// Define the namespace for this controller
namespace App\Http\Controllers;

// Import external packages and scripts
use App\Http\Controllers\Controller;
use DateTime;


// ----------

class TimeElapsed extends Controller {

    public static function howLongSince($DBString, $full = false) {

		$now = new DateTime;
		// Convert the TimeStamp from the MySQL database to the PHP DateTime object to get the time 'ago'
		$ago = date_create_from_format('Y-m-d H:i:s', $DBString);
		// Work out the time difference
		$diff = $now->diff($ago);

		$diff->w = floor($diff->d / 7);
		$diff->d -= $diff->w * 7;

		$string = array(
			'y' => 'year',
			'm' => 'month',
			'w' => 'week',
			'd' => 'day',
			'h' => 'hour',
			'i' => 'minute',
			's' => 'second',
		);

		foreach ($string as $k => &$v) {
			if ($diff->$k) {
				$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
			} else {
				unset($string[$k]);
			}
		}

		if (!$full) $string = array_slice($string, 0, 1);
		return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

}
