<?php

use App\Http\Controllers\Auth\Admin\EmailChangeRecoverController;
use App\Http\Controllers\Auth\Admin\F2aController as AdminF2aController;
use App\Http\Controllers\Auth\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\Auth\Admin\LogoutController as AdminLogoutController;
use App\Http\Controllers\Auth\Admin\LoggedController as AdminLoggedController;
use App\Http\Controllers\Auth\Admin\PasswordResetController as AdminPasswordResetController;
use Illuminate\Support\Facades\Route;

// Recover email
Route::get('/admin/change/email/recovery/{id}/{code}', [EmailChangeRecoverController::class, 'index'])->name('change.email.recovery');

// Api public routes
Route::prefix('web/api/admin')->name('web.api.admin')->middleware([
	'web',
	'locales'
])->group(function () {
	// Public
	Route::post('/login', [AdminLoginController::class, 'index'])->name('login');
	Route::post('/password', [AdminPasswordResetController::class, 'index'])->name('password');
	Route::get('/logout', [AdminLogoutController::class, 'index'])->name('logout');
	Route::get('/logged', [AdminLoggedController::class, 'index'])->name('logged');
	Route::post('/f2a', [AdminF2aController::class, 'index'])->name('f2a');
});
