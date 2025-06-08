<?php

namespace App\Mail\Auth\Client;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class F2aMail extends Mailable
{
	use Queueable, SerializesModels;

	public $user;
	public $password;

	public function __construct(User|Admin $user, $password)
	{
		$this->user = $user;
		$this->password = $password;
	}

	public function build()
	{
		return $this->subject(trans('email.f2a.subject'))
			->view('emails.f2a');
	}
}
