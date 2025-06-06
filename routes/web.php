<?php

use Illuminate\Support\Facades\Route;

// Laravel api routes
// ...

// Vue routes
Route::get('/', function () {
    return view('vue');
});

// Vue Last route
if (!app()->runningUnitTests()) {
	Route::fallback(function() {
	    return view('vue');
	});
}
