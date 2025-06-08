<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

// Js onerror fetch url for img.src
Route::get('/img/url', function () {
	try {
		$path = request('path');
		// Check is path null or use Throwable nor Exception
		if ($path != null && Storage::exists($path)) {
			return Storage::url($path);
		}
		return config('default.error_file_placeholder', rtrim(config('app.url'), '/') . '/default/avatar.webp');
	} catch (\Exception $e) {
		return config('default.error_file_placeholder', rtrim(config('app.url'), '/') . '/default/avatar.webp');
	}
});

// Image response
Route::get('/img/show', function () {
	try {
		$path = request('path');
		if (Storage::exists($path)) {
			return Storage::response($path);
		}
		// return '';
		return response()->file(public_path('/default/default.webp'));
	} catch (\Throwable $e) {
		return response()->file(public_path('/default/default.webp'));
	}
});

// Image response no default image
Route::get('/img/get', function () {
	try {
		$path = request('path');
		if (Storage::exists($path)) {
			return Storage::response($path);
		}
		return '';
	} catch (\Throwable $e) {
		return '';
	}
});

// Image response
Route::get('/img/resize', function () {
	try {
		$path = request('path');
		if (Storage::exists($path)) {

			$image = (new ImageManager(new Driver()))->read(Storage::get($path));

			if (in_array(request('size'), ['s', 'm', 'l', 'xl'])) {
				if (request('size') == 's') {
					$image->scale(width: 360);
				}

				if (request('size') == 'm') {
					$image->scale(width: 480);
				}

				if (request('size') == 'l') {
					$image->scale(width: 768);
				}

				if (request('size') == 'xl') {
					$image->scale(width: 1024);
				}
			}

			$encoded = $image->toWebp();

			return response($encoded)->header('Content-Type', 'image/webp');
		}

		return response()->file(public_path('/default/default.webp'));
	} catch (\Throwable $e) {
		return response()->file(public_path('/default/default.webp'));
	}
});

// Image response
Route::get('/img/avatar', function () {
	try {
		$path = request('path');
		if (Storage::exists($path)) {
			return Storage::response($path);
		}
		return response()->file(public_path('/default/avatar.webp'));
	} catch (\Throwable $e) {
		return response()->file(public_path('/default/avatar.webp'));
	}
});

/*
// Display image response, resize on the fly
Route::get('/img', function () {
	return '<img src="/img/show?path=avatars/1.webp>';
	return '<img src="/img/resize?path=avatars/1.webp&size=s">';
});

<picture>
  <source media="(min-width:1024px)" srcset="/img/resize?path=media/images/111.webp">
  <source media="(min-width:800px)" srcset="/img/resize?path=media/images/111.webp&size=xl">
  <source media="(min-width:600px)" srcset="/img/resize?path=media/images/111.webp&size=l">
  <source media="(min-width:400px)" srcset="/img/resize?path=media/images/111.webp&size=m">
  <img src="/img/resize?path=media/images/111.webp&size=s" alt="Flowers" style="width:auto;">
</picture>
*/
