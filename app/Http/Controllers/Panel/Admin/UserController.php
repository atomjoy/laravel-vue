<?php

namespace App\Http\Controllers\Panel\Admin;

use App\Events\PermissionChange;
use App\Events\PermissionDelete;
use App\Events\RoleChange;
use App\Events\RoleDelete;
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
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		Gate::authorize('viewAny', User::class);

		$perpage = request()->integer('perpage', default: 5);

		$q = User::query()->latest('id');

		if (request()->filled('search')) {
			$q->searchName(request()->input('search'));
		}

		if (request()->filled('search')) {
			$q->searchEmail(request()->input('search'));
		}

		if (request()->filled('search')) {
			$q->searchMobile(request()->input('search'));
		}

		return new UserCollection($q->paginate($perpage));

		// return new UserCollection(User::latest('id')->paginate($perpage));
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

	/**
	 * Add user role
	 *
	 * @param User $user
	 * @return Response
	 */
	public function addRole(User $user)
	{
		Gate::authorize('update', $user);

		try {
			$user = User::find(request()->input('userid'));

			if ($user && request()->input('role') != 'super_admin') {
				$role = Role::findByName(request()->input('role'), 'web');

				if ($role) {
					if (!$user->hasRole($role)) {
						$user->assignRole($role);
						RoleChange::dispatch($user, $role);
					}

					return response()->json([
						'message' => 'Created. Refresh page.',
					], 200);
				}

				return response()->json([
					'message' => 'Invalid role.',
				], 200);
			}

			return response()->json([
				'message' => 'Invalid user.',
			], 200);
		} catch (\Throwable $e) {
			report($e);

			return response()->json([
				'message' => 'Failed',
			], 422);
		}
	}

	/**
	 * Remove user role
	 *
	 * @param User $user
	 * @return Response
	 */
	public function removeRole(User $user)
	{
		Gate::authorize('update', $user);

		try {
			$user = User::find(request()->input('userid'));

			if ($user && request()->input('role') != 'super_admin') {
				$role = Role::findByName(request()->input('role'), 'web');

				if ($role) {
					if ($user->hasRole($role)) {
						$user->removeRole($role);
						RoleDelete::dispatch($user, $role);
					}

					return response()->json([
						'message' => 'Deleted. Refresh page.',
					], 200);
				}

				return response()->json([
					'message' => 'Invalid role.',
				], 200);
			}

			return response()->json([
				'message' => 'Invalid user.',
			], 200);
		} catch (\Throwable $e) {
			report($e);

			return response()->json([
				'message' => 'Failed',
			], 422);
		}
	}

	/**
	 * Add user role
	 *
	 * @param User $user
	 * @return Response
	 */
	public function addPermission(User $user)
	{
		Gate::authorize('update', $user);

		try {
			$user = User::find(request()->input('userid'));

			if ($user) {
				// Allowed only
				if (!in_array(request()->input('role'), [
					'role_view',
					'role_create',
					'role_update',
					'role_delete',
					'user_view',
					'user_create',
					'user_update',
					'user_delete',
				])) {
					$permission = Permission::findByName(request()->input('role'), 'web');

					if ($permission) {
						if (!$user->hasPermissionTo($permission)) {
							$user->givePermissionTo($permission);
							PermissionChange::dispatch($user, $permission);
						}

						return response()->json([
							'message' => 'Created. Refresh page.',
						], 200);
					}
				}

				return response()->json([
					'message' => 'Invalid permission.',
				], 200);
			}

			return response()->json([
				'message' => 'Invalid user.',
			], 200);
		} catch (\Throwable $e) {
			report($e);

			return response()->json([
				'message' => 'Failed',
			], 422);
		}
	}

	/**
	 * Remove user role
	 *
	 * @param User $user
	 * @return Response
	 */
	public function removePermission(User $user)
	{
		Gate::authorize('update', $user);

		try {
			$user = User::find(request()->input('userid'));

			if ($user) {
				// Allowed only
				if (!in_array(request()->input('role'), [
					'role_view',
					'role_create',
					'role_update',
					'role_delete',
					'user_view',
					'user_create',
					'user_update',
					'user_delete',
				])) {
					$permission = Permission::findByName(request()->input('role'), 'web');

					if ($permission) {
						if ($user->hasPermissionTo($permission)) {
							$user->revokePermissionTo($permission);
							PermissionDelete::dispatch($user, $permission);
						}

						return response()->json([
							'message' => 'Deleted. Refresh page.',
						], 200);
					}
				}

				return response()->json([
					'message' => 'Invalid permission.',
				], 200);
			}

			return response()->json([
				'message' => 'Invalid user.',
			], 200);
		} catch (\Throwable $e) {
			report($e);

			return response()->json([
				'message' => 'Failed',
			], 422);
		}
	}
}
