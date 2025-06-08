<?php

namespace App\Exceptions;

use Exception;

class JsonException extends Exception
{
    /**
     * Report the exception.
     *
     * @return bool|null
     */
    public function report()
    {
        // Enable default logging
        return false;
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        // Create json response
        return response()->json([
            'message' => $this->message ?? 'Unknown Exception',
        ], ($this->code >= 100 && $this->code < 600) ? $this->code : 422);
    }
}
