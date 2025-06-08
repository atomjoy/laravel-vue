<?php

namespace App\Http\Controllers\Auth\Client;

use Exception;
use App\Events\UploadAvatar;
use App\Exceptions\JsonException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Client\UploadAvatarRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class UploadAvatarController extends Controller
{
	function index(UploadAvatarRequest $request)
	{
		try {
			$user =  Auth::user();
			$file = $user->id . '.webp';
			$path = 'avatars/' . $file;

			$image = (new ImageManager(new Driver()))
				->read($request->file('avatar'))
				->resize(
					config('default.avatar_resize_pixels', 256),
					config('default.avatar_resize_pixels', 256)
				)->toWebp();

			Storage::put($path, (string) $image);

			$user->avatar = $path;
			$user->save();

			UploadAvatar::dispatch(Auth::user(), $path);

			return response()->json([
				'message' => __('upload.avatar.success'),
				'avatar' => $path,
			], 200);
		} catch (Exception $e) {
			report($e->getMessage());
			throw new JsonException(__('upload.avatar.error'), 422);
		}
	}

	function remove(Request $request)
	{
		try {
			$user = Auth::user();
			$path = 'avatars/' . $user->id . '.webp';
			if (Storage::exists($path)) {
				Storage::delete($path);
				$user->avatar = '/default/avatar.webp';
				$user->save();
			}
			return response()->json([
				'message' => __('remove.avatar.success'),
			], 200);
		} catch (Exception $e) {
			report($e);
			throw new JsonException(__('remove.avatar.error'), 422);
		}
	}

	/**
	 *	Get storage file content.
	 */
	public function show()
	{
		$default = public_path('/default/avatar.webp');
		try {
			$id = Auth::id() ?? 'error';
			$path = '/avatars/' . $id . '.webp';
			if (Storage::exists($path)) {
				return Storage::response($path);
			}
			return response()->file($default);
		} catch (\Exception $e) {
			return response()->file($default);
			// throw new JsonException(__('show.avatar.error'), 422);
		}
	}

	/**
	 *	Get storage file url.
	 */
	public function getUrl()
	{
		$default = config('default.error_file_placeholder', rtrim(config('app.url'), '/') . '/default/avatar.webp');
		try {
			$path = trim(strip_tags(stripslashes(request('path'))));
			if (Storage::exists($path)) {
				return Storage::url($path);
			}
			return $default;
		} catch (\Exception $e) {
			return $default;
		}
	}
}
