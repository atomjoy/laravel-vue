<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
	->withRouting(
		web: __DIR__ . '/../routes/web.php',
		commands: __DIR__ . '/../routes/console.php',
		health: '/up',
	)
	->withMiddleware(function (Middleware $middleware) {
		//
	})
	->withExceptions(function (Exceptions $exceptions) {
		// Json response
		$exceptions->shouldRenderJsonWhen(function (Request $request, Throwable $e) {
			if ($request->is('web/api/*')) {
				return true;
			}
			return $request->expectsJson();
		});

		// Route model not found error
		$exceptions->render(function (NotFoundHttpException $e, Request $request) {
			if ($request->is('web/api/*')) {
				return response()->json([
					'message' => 'Record not found.'
				], 404);
			}
		});
	})->create();
