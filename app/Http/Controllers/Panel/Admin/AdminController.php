<?php

namespace App\Http\Controllers\Panel\Admin;

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

class AdminController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		Gate::authorize('viewAny', Admin::class);

		$perpage = request()->integer('perpage', default: 5);

		return new AdminCollection(Admin::latest('id')->paginate($perpage));
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

		// $valid = $request->validated();

		return response()->json([
			'message' => 'Disabled',
			'data' => null,
		]);
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
			// Disable
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
}
