<?php

namespace App\Notifications\Examples;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvoicePaid extends Notification
{
	use Queueable;

	/**
	 * Create a new notification instance.
	 */
	public function __construct(
		public object $invoice,
	) {
		// $this->onConnection('redis');
		$this->afterCommit();
	}

	/**
	 * Get the notification's delivery channels.
	 *
	 * @return array<int, string>
	 */
	public function via(object $notifiable): array
	{
		return ['mail'];
		// If User::class prefer_sms
		return $notifiable->prefers_sms ? ['vonage'] : ['mail', 'database'];
	}

	/**
	 * Get the mail representation of the notification.
	 */
	public function toMail(object $notifiable): MailMessage
	{
		$url = url('/invoice/' . $this->invoice->id);

		return (new MailMessage)
			// ->error()
			->greeting('Hello!')
			->line('One of your invoices has been paid!')
			->lineIf($this->invoice->amount > 0, "Amount paid: {$this->invoice->amount}")
			->action('View Invoice', $url)
			->line('Thank you for using our application!');

		// return (new MailMessage)->view(
		// 	'mail.invoice.paid',
		// 	['invoice' => $this->invoice]
		// )->from('bla@example.com', 'Bla Bla');
	}

	/**
	 * Get the array representation of the notification.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(object $notifiable): array
	{
		return [
			'invoice_id' => $this->invoice->id,
			'amount' => $this->invoice->amount,
		];
	}

	/**
	 * Get the notification's database type.
	 *
	 * @return string
	 */
	public function databaseType(object $notifiable): string
	{
		return 'invoice-paid';
	}
}
