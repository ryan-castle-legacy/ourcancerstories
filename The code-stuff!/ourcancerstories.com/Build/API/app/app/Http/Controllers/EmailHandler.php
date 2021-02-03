<?php

// * File: 				/app/Http/Controllers/EmailHandler.php
// * Description:		This file holds the controller for sending emails
// * Created:			10th January 2021 at 14:04
// * Updated:			11th January 2021 at 10:26
// * Author:			Ryan Castle
// * Notes:

// ----------

// Define the namespace for this controller
namespace App\Http\Controllers;

// Import external packages and scripts
use App\Http\Controllers\Controller;
use Mail;


// ----------

class EmailHandler extends Controller {


    public static function sendEmail($view, $recipient, $subject, $message, $sender, $replyTo) {
        // Attempt running code
        try {
			// Create data-holding array to pass through the Mail object
			$emailData = array(
				'recipient'	=> $recipient,
				'subject'	=> $subject,
				'sender'	=> array(
					'email'		=> $sender['email'],
					'name'		=> $sender['name'],
				),
				'replyTo'	=> array(
					'email'		=> $replyTo['email'],
					'name'		=> $replyTo['name'],
				),
				'message'	=> $message,
			);
			// Send email
			Mail::send('emails.'.$view, ['emailData' => $emailData], function($email) use ($emailData) {
				// Set the data about the email
				$email->from($emailData['sender']['email'], $emailData['sender']['name']);
				$email->replyTo($emailData['replyTo']['email'], $emailData['replyTo']['name']);
				$email->to($emailData['recipient']);
				$email->subject($emailData['subject']);
			});
			// Errors
			if (Mail::failures()) {
				// Return response to sending
				return false;
			}
			// Return true as sent
			return true;
        } catch (Exception $error) {
            // Return the error
            return $error->getMessage();
        }
    }


}


/*


// Send email to business
Route::post('/widget/chat/sendEmail/', function(Request $request) {
	try {

		// Email info
		$email = array(
			'recipient'			=> $settings->supportEmailAddress,
			'message'			=> $data['message'],
			'customer'			=> $data['clientEmail'],
		);
		// Send message
		Mail::send([], ['email' => $email], function ($m) use ($email) {
			$m->from('noreply@atomizecrm.com', 'AtomizeCRM');
			$m->to($email['recipient']);
			$m->replyTo($email['customer']);
			$m->subject('AtomizeCRM - New enquiry notification.');
			$m->setBody('<h1>New AtomizeCRM Enquiry</h1><p>You have received a new enquiry via the AtomizeCRM help widget.</p><br/><p>Email: '.$email['customer'].'</p><p>Message: '.$email['message'].'</p>', 'text/html');
		});
		// Errors
		if (Mail::failures()) {
			// Return response to sending
			return json_encode(false);
		}
		// Send response back
		return json_encode($data);
	} catch (Exception $e) {
		// Return error
		return json_encode(['message' => $e->getMessage(), 'line' => $e->getLine(), 'trace' => json_encode($e->getTrace())]);
	}
})->middleware('widgetCORS');


*/
