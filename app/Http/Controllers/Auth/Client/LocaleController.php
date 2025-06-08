<?php

namespace App\Http\Controllers\Auth\Client;

use App\Http\Controllers\Controller;

class LocaleController extends Controller
{
	function index($locale)
	{
		if (strlen($locale) == 2) {
			app()->setLocale($locale);

			session(['locale' => app()->getLocale()]);

			return response()->json([
				'message' => __('locale.success'),
				'locale' => app()->getLocale(),
			], 200);
		}

		return response()->json([
			'message' => __('locale.error'),
			'locale' => app()->getLocale(),
		], 422);
	}
}
