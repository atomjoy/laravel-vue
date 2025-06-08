<?php

namespace App\Notifications;

use App\Models\User;
use App\Notifications\Messages\UserMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserNotification extends Notification
{
	use Queueable;

	public function __construct(
		protected UserMessage $message
	) {}

	public function via(object $notifiable): array
	{
		return ['database'];
	}

	public function toArray(object $notifiable): array
	{
		return [
			'title' => $this->message->getTitle(),
			'links' => $this->message->getLinks(),
			'message' => $this->message->getContent(),
			'sender_id' => $this->message->getSenderId(),
			'sender_image' => $this->message->getSenderImage(),
			'sender_name' => $this->message->getSenderName(),
			'user_id' => $notifiable->id,
		];
	}

	/**
	 * Get the notification's database type.
	 *
	 * @return string
	 */
	public function databaseType(object $notifiable): string
	{
		return 'user-notification';
	}
}
