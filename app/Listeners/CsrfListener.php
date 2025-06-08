<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Log;

class CsrfListener
{
    public function handle($payload)
    {
        Log::info('Csrf Listener: ' . $payload);
    }
}
