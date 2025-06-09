<?php

use App\Http\Controllers\Auth\Admin\AccountController as AdminAccountController;
use App\Http\Controllers\Auth\Admin\F2aController as AdminF2aController;
use App\Http\Controllers\Auth\Admin\PasswordChangeController as AdminPasswordChangeController;
use App\Http\Controllers\Auth\Admin\UploadAvatarController as AdminUploadAvatarController;
use App\Http\Controllers\Auth\Admin\NotificationsController as AdminNotificationsController;
use App\Http\Controllers\Panel\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Panel\Admin\ArticleMediaController as AdminArticleMediaController;
use App\Http\Controllers\Panel\Admin\SubscriberController as AdminSubscriberController;
use App\Http\Controllers\Panel\Admin\UserController as AdminUserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Web guard (only admins)
Route::prefix('web/api/admin')->name('web.api.admin')->middleware([
	'web',
	'locales',
	'auth:admin',
])->group(function () {

	// Roles: superadmin, admin, writer
	Route::middleware([
		'role:writer|admin|super_admin,admin',
	])->group(function () {
		// All logged with admin guard
		Route::post('/f2a/enable', [AdminF2aController::class, 'enable'])->name('f2a.enable');
		Route::post('/f2a/disable', [AdminF2aController::class, 'disable'])->name('f2a.disable');
		// Password
		Route::post('/password/change', [AdminPasswordChangeController::class, 'index'])->name('change');
		// Avatar
		Route::post('/upload/avatar', [AdminUploadAvatarController::class, 'index'])->name('upload.avatar');
		Route::post('/remove/avatar', [AdminUploadAvatarController::class, 'remove'])->name('remove.avatar');
		// Account update
		Route::post('/account/update', [AdminAccountController::class, 'update'])->name('account.update');
		// Notifications
		Route::get('/notifications/page/{page}', [AdminNotificationsController::class, 'index'])->name('notifications.page');
		Route::get('/notifications/toggle/{id}', [AdminNotificationsController::class, 'toggle'])->name('notifications.toggle');
		Route::get('/notifications/delete/{id}', [AdminNotificationsController::class, 'delete'])->name('notifications.delete');
		Route::get('/notifications/readall', [AdminNotificationsController::class, 'readall'])->name('notifications.readall');

		// Media
		Route::resource('articlemedia', AdminArticleMediaController::class)->except(['create', 'edit']);
		Route::get('articlemedia/remove/{articlemedia}', [AdminArticleMediaController::class, 'remove']);
	});

	// Roles: superadmin, admin
	Route::middleware([
		'role:admin|super_admin,admin',
	])->group(function () {
		// Contacts
		Route::resource('contacts', AdminContactController::class)->except(['create', 'edit', 'store']);
		Route::get('contacts/export/file', [AdminContactController::class, 'download']);
		// Subscribe
		Route::resource('subscribers', AdminSubscriberController::class)->except(['create', 'edit']);
		Route::get('subscribers/export/csv', [AdminSubscriberController::class, 'csv']);
	});

	// Roles: superadmin
	Route::middleware([
		'role:super_admin,admin',
	])->group(function () {
		// Users
		Route::resource('users', AdminUserController::class)->except(['create', 'edit']);
		Route::get('users/remove/{user}', [AdminUserController::class, 'remove']);

		Route::get('roles', function () {
			return response()->json(['message' => 'Roles']);
		});
	});

	// Test routes
	Route::middleware([
		'role:super_admin,admin',
	])->group(function () {
		Route::get('secret', function () {
			return response()->json(['message' => 'Secret Works']);
		});
	});

	Route::middleware([
		'role:admin|super_admin,admin',
	])->group(function () {
		Route::get('test/users', function () {
			return response()->json(['message' => 'Users Works']);
		});
		Route::get('test/roles', function () {
			return response()->json(['message' => 'Roles Works']);
		});
	});

	Route::middleware([
		'role:writer|admin|super_admin,admin',
	])->group(function () {
		Route::get('test/delete', function () {
			return response()->json(['message' => 'Delete Works']);
		});
	});

	Route::middleware([
		'role:writer|admin|super_admin,admin',
		'permission:article_create|article_update,admin',
	])->group(function () {
		Route::get('test/publish', function () {
			return response()->json(['message' => 'Publish Works']);
		});
	});

	Route::middleware([
		'role:writer|admin|super_admin,admin',
		'permission:article_delete,admin',
	])->group(function () {
		Route::get('test/delete', function () {
			return response()->json(['message' => 'Delete Works']);
		});
	});
});
