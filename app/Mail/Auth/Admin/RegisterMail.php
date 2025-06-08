<?php

namespace App\Mail\Auth\Admin;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterMail extends Mailable
{
	use Queueable, SerializesModels;

	public function __construct(
		public User $user,
		public $code = 'invalid',
	) {}

	public function build()
	{
		return $this->subject(trans('email.register.subject'))
			->view('emails.register');
	}
}
