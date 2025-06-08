<?php

use App\Http\Controllers\Page\ContactController;
use App\Http\Controllers\Page\SubscriberController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::prefix('web/api/page')->name('web.api.page')->middleware([
	'web',
	'locales'
])->group(function () {
	// Contact form
	Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

	// Subscribe
	Route::post('/subscribe', [SubscriberController::class, 'subscribe'])->name('subscribe.store');
	Route::get('/subscribe/confirm/{subscriber}', [SubscriberController::class, 'confirm'])->name('subscribe.confirm');
	Route::get('/subscribe/remove/{email}', [SubscriberController::class, 'unsubscribe'])->name('subscribe.remove');
});
