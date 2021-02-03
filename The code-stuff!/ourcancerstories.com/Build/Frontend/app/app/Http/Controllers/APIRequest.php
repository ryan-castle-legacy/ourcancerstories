<?php

// * File: 				/app/Http/Controllers/APIRequest.php
// * Description:		This file holds the controller for making requests to the API.
// * Created:			16th December 2020 at 18:32
// * Updated:			16th December 2020 at 18:38
// * Author:			Ryan Castle
// * Notes:

// ----------

// Define the namespace for this controller
namespace App\Http\Controllers;

// Import external packages and scripts
use App\Http\Controllers\Controller;


// ----------

class APIRequest extends Controller {

    public static function performRequest($method, $location, $data = false, $is3rdParty = false, $sendDataAsJSON = false) {
        // Attempt running code
        try {
			$header = array(
                'OCSAPIToken: '.getenv('API_TOKEN_PUBLIC'),
                'Authorization: Bearer '.getenv('API_TOKEN_SECRET'),
                'x-csrf-token: '.csrf_token(),
            );
			// Check if the data will be passed as JSON (widget location only)
			if ($sendDataAsJSON === true) {
				// Add JSON contentr type to the header
				$header[sizeof($header)] = 'Content-Type: application/json';
			}
			// Create CURL handler
            $curlHandler = curl_init();
            // Check if the location is the AtomizeCRM API (not a 3rd-party API)
            if (!$is3rdParty) {
                // Add AtomizeCRM's API host to the location string
                $location = getenv('API_URL').$location;
            }
            // Set CURL options
            curl_setopt($curlHandler, CURLOPT_HTTPHEADER, $header);
            curl_setopt($curlHandler, CURLOPT_URL, $location);
            curl_setopt($curlHandler, CURLOPT_RETURNTRANSFER, true);
            // Switch the type of method
            switch (strtoupper($method)) {
                case 'GET':
                    // Set CURL options
                    curl_setopt($curlHandler, CURLOPT_POST, false);
                break;
                case 'POST':
                    // Set CURL options
                    curl_setopt($curlHandler, CURLOPT_POST, true);
                    curl_setopt($curlHandler, CURLOPT_POSTFIELDS, $data);
                break;
            }
			// Execute the CURL request
            $curlResponse = curl_exec($curlHandler);
            // Collect the CURL request's status
            $curlStatus = curl_getinfo($curlHandler, CURLINFO_HTTP_CODE);
            // Close the CURL request
            curl_close($curlHandler);
            // Check if the request was not successful
            if ($curlStatus != 200) {
                // Check if there was an error
                if ($curlResponse === false) {
                    // Capture any errors in the request
                    $curlErrors = curl_error($curlHandler);
                    // Return the error
                    return 'CURL Error: '.$curlErrors;
                }
                // Return default error with prefix of the status code
                return 'This request was unsuccessful and has a '.$curlStatus.' status. Message: '.$curlResponse;
            }
            // Check if the response was a valid JSON object
            if (APIRequest::isJSON($curlResponse)) {
                // Decode the data from a JSON object
                $dataAsJSON = json_decode($curlResponse);
                // Convert the data from an object to an array
                $dataAsArray = (array) $dataAsJSON;
                // Return the response data
                return $dataAsArray;
            }
            // Return the response data
            return $curlResponse;
        } catch (Exception $error) {
            // Return the error
            return $error->getMessage();
        }
    }


    private static function isJSON($subject) {
        // Attempt running code
        try {
            // Decode the subject item
            json_decode($subject);
            // Check if there was not an error
            if (json_last_error() == JSON_ERROR_NONE) {
                // Return true
                return true;
            }
        } catch (Exception $error) { }
        // Return false
        return false;
    }

}
