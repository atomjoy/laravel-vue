<?php

namespace App\Http\Controllers\Panel\Admin;

use App\Enums\Spatie\Permissions\Model\ArticleEnum;
use App\Enums\Spatie\RolesEnum;
use App\Events\PermissionChange;
use App\Events\PermissionDelete;
use App\Events\RoleChange;
use App\Events\RoleDelete;
use App\Models\Admin;
use App\Exceptions\JsonException;
use App\Http\Requests\Panel\Admin\StoreAdminRequest;
use App\Http\Requests\Panel\Admin\UpdateAdminRequest;
use App\Http\Resources\Panel\Admin\AdminCollection;
use App\Http\Resources\Panel\Admin\AdminResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		Gate::authorize('viewAny', Admin::class);

		$perpage = request()->integer('perpage', default: 5);

		$q = Admin::query()->latest('id');

		if (request()->filled('search')) {
			$q->searchName(request()->input('search'));
		}

		if (request()->filled('search')) {
			$q->searchEmail(request()->input('search'));
		}

		if (request()->filled('search')) {
			$q->searchMobile(request()->input('search'));
		}

		return new AdminCollection($q->paginate($perpage));

		// return new AdminCollection(Admin::latest('id')->paginate($perpage));
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
	public function store(StoreAdminRequest $request)
	{
		Gate::authorize('create', Admin::class);

		try {
			$valid = $request->validated();
			$valid['password'] = md5(time());
			$admin = Admin::create($valid);

			$admin->assignRole(RolesEnum::WRITER->value);

			$admin->givePermissionTo(ArticleEnum::ARTICLE_VIEW->value);
			$admin->givePermissionTo(ArticleEnum::ARTICLE_CREATE->value);
			$admin->givePermissionTo(ArticleEnum::ARTICLE_UPDATE->value);
			$admin->givePermissionTo(ArticleEnum::ARTICLE_DELETE->value);

			$this->upload($admin);

			return response()->json([
				'message' => 'Created',
				'data' => $admin,
			]);
		} catch (\Throwable $e) {
			report($e);
			throw new JsonException(__('Failed'), 422);
		}
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Admin $admin)
	{
		Gate::authorize('view', $admin);

		return $admin;
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Admin $admin)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateAdminRequest $request, Admin $admin)
	{
		Gate::authorize('update', $admin);

		$admin->update($request->validated());

		$this->upload($admin);

		return response()->json([
			'message' => 'Updated',
			'data' => $admin,
		]);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Admin $admin)
	{
		Gate::authorize('delete', $admin);

		try {
			// Disabled
			return response()->json(['message' => 'Disabled']);

			if (Storage::exists($admin->avatar)) {
				Storage::delete($admin->avatar);
				$admin->avatar = null;
				$admin->save();
			}
		} catch (\Throwable $e) {
			report($e->getMessage());
		}

		return response()->json(['message' => 'Deleted']);
	}

	/**
	 * Upload admin image
	 *
	 * @param Admin $admin
	 * @return void
	 */
	function upload($admin)
	{
		try {
			if (request()->file('file')) {
				$path = '/avatars/admin/' . $admin->id . '.webp';

				$image = (new ImageManager(new Driver()))
					->read(request()->file('file'))
					->resize(
						config('default.avatar_resize_pixels', 256),
						config('default.avatar_resize_pixels', 256)
					)->toWebp();

				Storage::put($path, (string) $image);

				$admin->avatar = $path;
				$admin->save();
			}
		} catch (\Throwable $e) {
			report($e->getMessage());
		}
	}

	/**
	 * Remove admin image
	 *
	 * @param Admin $admin
	 * @return void
	 */
	function remove(Admin $admin)
	{
		Gate::authorize('update', $admin);

		try {
			if (Storage::exists($admin->avatar)) {
				Storage::delete($admin->avatar);
				$admin->avatar = null;
				$admin->save();
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
	 * Add user role
	 *
	 * @param Admin $admin
	 * @return Response
	 */
	public function addRole(Admin $admin)
	{
		Gate::authorize('update', $admin);

		try {
			$user = Admin::find(request()->input('userid'));

			if ($user && request()->input('role') != 'super_admin') {
				$role = Role::findByName(request()->input('role'), 'admin');

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
	 * @param Admin $admin
	 * @return Response
	 */
	public function removeRole(Admin $admin)
	{
		Gate::authorize('update', $admin);

		try {
			$user = Admin::find(request()->input('userid'));

			if ($user && request()->input('role') != 'super_admin') {
				$role = Role::findByName(request()->input('role'), 'admin');

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
	 * @param Admin $admin
	 * @return Response
	 */
	public function addPermission(Admin $admin)
	{
		Gate::authorize('update', $admin);

		try {
			$user = Admin::find(request()->input('userid'));

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
					$permission = Permission::findByName(request()->input('role'), 'admin');

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
	 * @param Admin $admin
	 * @return Response
	 */
	public function removePermission(Admin $admin)
	{
		Gate::authorize('update', $admin);

		try {
			$user = Admin::find(request()->input('userid'));

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
					$permission = Permission::findByName(request()->input('role'), 'admin');

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
