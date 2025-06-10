<?php

namespace App\Http\Controllers\Panel\Admin;

use App\Models\User;
use App\Exceptions\JsonException;
use App\Http\Requests\Panel\Admin\StoreUserRequest;
use App\Http\Requests\Panel\Admin\UpdateUserRequest;
use App\Http\Resources\Panel\Admin\UserCollection;
use App\Http\Resources\Panel\Admin\UserResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class UserController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		Gate::authorize('viewAny', User::class);

		$perpage = request()->integer('perpage', default: 5);

		return new UserCollection(User::latest('id')->paginate($perpage));
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
	public function store(StoreUserRequest $request)
	{
		Gate::authorize('create', User::class);

		// $valid = $request->validated();

		return response()->json([
			'message' => 'Disabled',
			'data' => null,
		]);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(User $user)
	{
		Gate::authorize('view', $user);

		return $user;
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(User $user)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateUserRequest $request, User $user)
	{
		Gate::authorize('update', $user);

		$user->update($request->validated());

		$this->upload($user);

		return response()->json([
			'message' => 'Updated',
			'data' => $user,
		]);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(User $user)
	{
		Gate::authorize('delete', $user);

		try {
			// Disable
			return response()->json(['message' => 'Disabled']);

			if (Storage::exists($user->avatar)) {
				Storage::delete($user->avatar);
				$user->avatar = null;
				$user->save();
			}
		} catch (\Throwable $e) {
			report($e->getMessage());
		}

		return response()->json(['message' => 'Deleted']);
	}

	/**
	 * Remove user image
	 *
	 * @param User $user
	 * @return void
	 */
	function remove(User $user)
	{
		Gate::authorize('update', $user);

		try {
			if (Storage::exists($user->avatar)) {
				Storage::delete($user->avatar);
				$user->avatar = null;
				$user->save();
			}

			return response()->json([
				'message' => __('remove.image.success'),
			], 200);
		} catch (\Throwable $e) {
			report($e);
			throw new JsonException(__('remove.image.error'), 422);
		}
	}

	/**
	 * Upload user image
	 *
	 * @param User $user
	 * @return void
	 */
	function upload($user)
	{
		try {
			if (request()->file('file')) {
				$path = 'avatars/' . $user->id . '.webp';

				$image = (new ImageManager(new Driver()))
					->read(request()->file('file'))
					->resize(
						config('default.avatar_resize_pixels', 256),
						config('default.avatar_resize_pixels', 256)
					)->toWebp();

				Storage::put($path, (string) $image);

				$user->avatar = $path;
				$user->save();
			}
		} catch (\Throwable $e) {
			report($e->getMessage());
		}
	}
}
