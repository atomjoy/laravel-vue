<?php

namespace App\Listeners;

use Exception;
use App\Models\User;
use App\Models\Admin;
use App\Events\PasswordReset;
use App\Events\PasswordResetMail;
use App\Events\PasswordResetMailError;
use App\Exceptions\JsonException;
use App\Mail\Auth\Client\PasswordMail;
use Illuminate\Support\Facades\Mail;

class PasswordResetListener
{
	public function handle(PasswordReset $event)
	{
		$this->sendEmail($event->user, $event->password);
	}

	public function sendEmail(User|Admin $user, $password)
	{
		if (config('send_password_email', true)) {
			try {
				Mail::to($user)->locale(app()->getLocale())->send(new PasswordMail($user, $password));
				PasswordResetMail::dispatch($user);
			} catch (Exception $e) {
				report($e);
				PasswordResetMailError::dispatch($user);
				throw new JsonException(__("reset.password.email.error"), 422);
			}
		}
	}
}
