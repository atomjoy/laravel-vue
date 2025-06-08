<?php

namespace App\Listeners;

use Exception;
use App\Models\User;
use App\Events\EmailChange;
use App\Events\EmailChangeMail;
use App\Events\EmailChangeMailError;
use App\Exceptions\JsonException;
use App\Mail\Auth\Client\ChangeMail;
use App\Mail\Auth\Client\ChangeMailRecovery;
use Illuminate\Support\Facades\Mail;

class EmailChangeListener
{
	public function handle(EmailChange $event)
	{
		$this->sendEmail($event->user, $event->code);
	}

	public function sendEmail(User $user, $code)
	{
		if (config('send_email_change_email', true)) {
			try {
				Mail::to($user)->locale(app()->getLocale())->send(new ChangeMail($user, $code));
				Mail::to($user)->locale(app()->getLocale())->send(new ChangeMailRecovery($user, $code));

				EmailChangeMail::dispatch($user);
			} catch (Exception $e) {
				report($e);
				EmailChangeMailError::dispatch($user);
				throw new JsonException(__("email.change.email.error"), 422);
			}
		}
	}
}
