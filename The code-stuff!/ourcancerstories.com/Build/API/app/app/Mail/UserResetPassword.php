<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserResetPassword extends Mailable
{
    use Queueable, SerializesModels;

	public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
		// return $this->from(env('SUPPORT_EMAIL'), env('SUPPORT_EMAIL_NAME'))
        // 	->replyTo(env('NOREPLY_EMAIL'), env('NOREPLY_EMAIL_NAME'))
		// 	->subject($this->data['subject'])
		// 	->view('emails.UserResetPassword')
		// 	->with([
		// 		'data'	=> $this->data,
		// 	]);
    }
}
