<?php

namespace App\Http\Controllers\Auth\Admin;

use Exception;
use App\Http\Controllers\Controller;
use App\Exceptions\JsonException;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
	function index($page)
	{
		Auth::shouldUse('admin');

		try {
			$perpage = config('default.notifications_perpage', 6);
			$page < 1 ? $page = 1 : $page = (int) $page;
			$offset = ($page - 1) * $perpage;
			if ($offset < 0) $offset = 0;

			$list = Auth::user()->notifications()
				->where('type', 'user-notification')
				->latest()->offset($offset)
				->limit($perpage)->get()->each(function ($n) {
					$n->formatted_created_at = $n->created_at->format('Y-m-d H:i:s');
				});

			$unread = Auth::user()->unreadNotifications()
				->where('type', 'user-notification')
				->count();

			return response()->json([
				'message' => 'Notifications.',
				'notifications' => $list,
				'unread' => $unread,
			]);
		} catch (Exception $e) {
			report($e);
			throw new JsonException(__('notifications.error'), 422);
		}
	}

	function toggle($id)
	{
		Auth::shouldUse('admin');

		try {
			$item = Auth::user()->notifications()
				->where('type', 'user-notification')
				->find($id);

			if ($item != null) {
				$item->read_at != null ? $item->markAsUnread() : $item->markAsRead();
			}

			return response()->json([
				'message' => __('notifications.success')
			]);
		} catch (Exception $e) {
			report($e);
			throw new JsonException(__('notifications.error'), 422);
		}
	}

	function readall()
	{
		Auth::shouldUse('admin');

		try {
			Auth::user()->notifications()
				->where('type', 'user-notification')
				->whereNull('read_at')
				->update(['read_at' => now()]);

			// Auth::user()->unreadNotifications()->update(['read_at' => now()]);
			// Auth::user()->unreadNotifications->map(function ($n) { $n->markAsRead(); });

			return response()->json([
				'message' => __('notifications.success')
			]);
		} catch (Exception $e) {
			report($e);
			throw new JsonException(__('notifications.error'), 422);
		}
	}

	function delete($id)
	{
		Auth::shouldUse('admin');

		try {
			$item = Auth::user()
				->notifications()
				->where('type', 'user-notification')
				->find($id);

			if ($item != null) {
				$item->delete();
			}

			return response()->json([
				'message' => __('notifications.success')
			]);
		} catch (Exception $e) {
			report($e);
			throw new JsonException(__('notifications.error'), 422);
		}
	}
}
