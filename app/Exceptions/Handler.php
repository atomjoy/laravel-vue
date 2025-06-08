<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof \Exception) {
            // Custom error logic
        }

        return parent::render($request, $exception);
    }

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        // Error log
        $this->reportable(function (Throwable $e) {
            //
        });

        // Model not found exception
        $this->renderable(function (NotFoundHttpException $e, Request $request) {
            if ($request->is('web/api/*')) {
                return response()->json([
                    'message' => 'Record not found',
                ], 404);
            }
        });
    }
}
