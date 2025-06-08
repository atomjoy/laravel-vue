<?php

namespace App\Mail\Auth\Client;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ChangeMail extends Mailable
{
	use Queueable, SerializesModels;

	public function __construct(
		public User $user,
		public $code = 'invalid',
	) {}

	public function build()
	{
		return $this->subject(trans('email.change.subject'))
			->view('emails.change');
	}
}
