<?php

use Illuminate\Support\Facades\Route;

// Admin guard
require 'web/api/auth/admin/web.php';
require 'web/api/panel/admin/web.php';

// Web guard
require 'web/api/auth/client/web.php';
require 'web/api/panel/client/web.php';

// Page
require 'web/api/page/web.php';

// Storage
include 'storage/img.php';

// Testing
// include 'storage/notifications.php';

// Laravel api
// ...

// Vue
Route::get('/', function () {
	return view('vue');
});

// Vue catchall
if (!app()->runningUnitTests()) {
	Route::fallback(function () {
		return view('vue');
	});
}
