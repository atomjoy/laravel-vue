<?php

use App\Http\Controllers\Auth\Client\AccountDeleteController;
use App\Http\Controllers\Auth\Client\EmailChangeController;
use App\Http\Controllers\Auth\Client\EmailChangeConfirmController;
use App\Http\Controllers\Auth\Client\F2aController;
use App\Http\Controllers\Auth\Client\NotificationsController;
use App\Http\Controllers\Auth\Client\PasswordConfirmController;
use App\Http\Controllers\Auth\Client\PasswordChangeController;
use App\Http\Controllers\Auth\Client\UploadAvatarController;
use App\Http\Controllers\Auth\Client\AccountController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Web guard (all users)
Route::prefix('web/api')->name('web.api')->middleware([
	'web',
	'locales',
	'auth:web',
])->group(function () {
	// 2FA auth on/off
	Route::post('/f2a/enable', [F2aController::class, 'enable'])->name('f2a.enable');
	Route::post('/f2a/disable', [F2aController::class, 'disable'])->name('f2a.disable');
	// Password
	Route::post('/password/change', [PasswordChangeController::class, 'index'])->name('change');
	Route::post('/password/confirm', [PasswordConfirmController::class, 'index'])->name('confirm');
	// Avatar
	Route::post('/upload/avatar', [UploadAvatarController::class, 'index'])->name('upload.avatar');
	Route::post('/remove/avatar', [UploadAvatarController::class, 'remove'])->name('remove.avatar');
	// Change email
	Route::post('/change/email', [EmailChangeController::class, 'index'])->name('change.email');
	Route::get('/change/email/{id}/{code}', [EmailChangeConfirmController::class, 'index'])->name('change.email.confirm');
	// Account
	Route::singleton('/account/delete', AccountDeleteController::class, ['except' => ['edit', 'show']]);
	Route::post('/account/update', [AccountController::class, 'update'])->name('account.update');
	// Notifications
	Route::get('/notifications/page/{page}', [NotificationsController::class, 'index'])->name('notifications.page');
	Route::get('/notifications/toggle/{id}', [NotificationsController::class, 'toggle'])->name('notifications.toggle');
	Route::get('/notifications/delete/{id}', [NotificationsController::class, 'delete'])->name('notifications.delete');
	Route::get('/notifications/readall', [NotificationsController::class, 'readall'])->name('notifications.readall');

	// Only logged user
	Route::get('/only-user', function () {
		return response()->json([
			'message' => 'User logged.',
			'guard' => 'web',
			'user' => Auth::guard('web')->user() ?? null,
		]);
	});
});
