<?php

namespace App\Notifications\Messages;

/**
 * User notification message class
 *
 * $msg = new UserMessage();
 * $msg->setSenderId(123);
 * $msg->setTitle('Alex ask for permissions.');
 * $msg->setContent('Allow access to space.webp file.');
 * $msg->setLink('/access/hash-123', 'Allow', 'notification-allow');
 * $msg->setLink('/deny/hash-123', 'Deny', 'notification-deny');
 * $user->notifyNow(new UserNotification($msg));
 * $user->notify(new UserNotification($msg));
 */
class UserMessage
{
	protected array $links = [];

	protected string $title = '';

	protected string $content = '';

	protected int $sender_id = 0;

	protected $sender_image = '/default/avatar.webp';

	protected $sender_name = 'Office Bot';

	function setSenderId($id)
	{
		return $this->sender_id = $id;
	}

	function setSenderImage($path)
	{
		return $this->sender_image = $path;
	}

	function setSenderName($str)
	{
		return $this->sender_name = $str;
	}

	function setTitle($str)
	{
		return $this->title = $str;
	}

	function setContent($str)
	{
		return $this->content = $str;
	}

	function setLink($url, $text, $class = 'notification-link')
	{
		if (!empty($url) && !empty($text)) {
			$this->links[] = [
				'url' => $url,
				'text' => $text,
				'class' => $class,
			];
		}
	}

	function getSenderId()
	{
		return $this->sender_id;
	}

	function getSenderImage()
	{
		return $this->sender_image;
	}

	function getSenderName()
	{
		return $this->sender_name;
	}

	function getTitle()
	{
		return $this->title;
	}

	function getContent()
	{
		return $this->content;
	}

	function getLinks()
	{
		return $this->links;
	}
}
