<?php

use App\Http\Controllers\Auth\Client\ActivateController;
use App\Http\Controllers\Auth\Client\CsrfController;
use App\Http\Controllers\Auth\Client\EmailChangeRecoverController;
use App\Http\Controllers\Auth\Client\F2aController;
use App\Http\Controllers\Auth\Client\LocaleController;
use App\Http\Controllers\Auth\Client\LoggedController;
use App\Http\Controllers\Auth\Client\LoginController;
use App\Http\Controllers\Auth\Client\LogoutController;
use App\Http\Controllers\Auth\Client\PasswordResetController;
use App\Http\Controllers\Auth\Client\RegisterController;
use Illuminate\Support\Facades\Route;

// Recover email
Route::get('/change/email/recovery/{id}/{code}', [EmailChangeRecoverController::class, 'index'])->name('change.email.recovery');

// Api public routes
Route::prefix('web/api')->name('web.api')->middleware([
	'web',
	'locales'
])->group(function () {
	// Public
	Route::get('/activate/{id}/{code}', [ActivateController::class, 'index'])->name('activate');
	Route::post('/login', [LoginController::class, 'index'])->name('login');
	Route::post('/register', [RegisterController::class, 'index'])->name('register');
	Route::post('/password', [PasswordResetController::class, 'index'])->name('password');
	Route::post('/f2a', [F2aController::class, 'index'])->name('f2a');
	Route::get('/logout', [LogoutController::class, 'index'])->name('logout');
	Route::get('/logged', [LoggedController::class, 'index'])->name('logged');
	Route::get('/csrf', [CsrfController::class, 'index'])->name('csrf');
	Route::get('/locale/{locale}', [LocaleController::class, 'index'])->name('locale');
});
