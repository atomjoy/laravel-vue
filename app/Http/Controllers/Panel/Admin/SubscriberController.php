<?php

namespace App\Http\Controllers\Panel\Admin;

use Exception;
use App\Models\Panel\Subscriber;
use App\Mail\Page\SubscribeMail;
use App\Http\Requests\Panel\Admin\StoreSubscriberRequest;
use App\Http\Requests\Panel\Admin\UpdateSubscriberRequest;
use App\Http\Resources\Panel\Admin\SubscriberCollection;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class SubscriberController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		Gate::authorize('viewAny', Subscriber::class);

		$perpage = request()->integer('perpage', default: 5);

		return  new SubscriberCollection(Subscriber::latest('id')->paginate($perpage));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreSubscriberRequest $request)
	{
		Gate::authorize('create', Subscriber::class);

		$subscriber = Subscriber::create($request->validated());

		return response()->json([
			'message' => 'Created',
			'data' => $subscriber,
		]);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Subscriber $subscriber)
	{
		Gate::authorize('view', $subscriber);

		return $subscriber;
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Subscriber $subscriber)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateSubscriberRequest $request, Subscriber $subscriber)
	{
		Gate::authorize('update', $subscriber);

		$subscriber->update($request->validated());

		return response()->json([
			'message' => 'Updated',
			'data' => $subscriber,
		]);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Subscriber $subscriber)
	{
		Gate::authorize('delete', $subscriber);

		$subscriber->delete();

		return response()->json(['message' => 'Deleted']);
	}

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
