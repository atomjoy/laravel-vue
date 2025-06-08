<?php

namespace App\Http\Controllers\Page;

use Exception;
use App\Models\Panel\Subscriber;
use App\Mail\Page\SubscribeMail;
use App\Http\Requests\Page\StoreSubscriberRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class SubscriberController extends Controller
{
	/**
	 * Subscribe client.
	 */
	public function subscribe(StoreSubscriberRequest $request)
	{
		$valid = $request->validated();

		$valid['is_approved'] = 0;

		try {
			$subscriber = Subscriber::create($valid);

			Mail::to($subscriber->email)
				->locale(app()->getLocale())
				->send(
					new SubscribeMail($subscriber)
				);
		} catch (Exception $e) {
			report($e);

			return response()->json([
				'message' => 'Failed',
			]);
		}

		return response()->json([
			'message' => 'Subscribed. Check your email address.',
		]);
	}

	/**
	 * Confirm subscriber email.
	 */
	public function confirm(Subscriber $subscriber)
	{
		try {
			$subscriber->is_approved = 1;
			$subscriber->save();
		} catch (Exception $e) {
			report($e);

			return response()->json([
				'message' => 'Failed',
			]);
		}

		return response()->json([
			'message' => 'Subscribed',
		]);
	}

	/**
	 * UnSubscribe client email.
	 */
	public function unsubscribe($email)
	{
		try {
			$user = Subscriber::where('email', $email)->first();

			if ($user) {
				$user->delete();

				return response()->json([
					'message' => 'Email has been removed.',
				]);
			} else {
				throw new Exception("Error");
			}
		} catch (Exception $e) {
			report($e);

			return response()->json([
				'message' => 'Invalid email addres.',
			], 422);
		}
	}

	/**
	 * Export subscribers to csv file and download
	 *
	 * @return void
	 */
	public function csv()
	{
		try {
			$all = Subscriber::all();

			$csv = "email,name,id\n";

			foreach ($all as $i) {
				$email = str_replace(',', '', $i->email);
				$name = str_replace(',', '', $i->name);
				$id = (int) $i->id;

				$csv .= "{$email},{$name},{$id}\n";
			}

			Storage::disk('local')->put('subscribe/subscribers.csv', $csv);

			return Storage::disk('local')->download('subscribe/subscribers.csv');
		} catch (Exception $e) {
			report($e);

			return response()->json([
				'message' => 'Failed',
			]);
		}
	}
}
