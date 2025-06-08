<?php

namespace App\Http\Middleware;

use Closure;

/**
 *  Only json response allowed
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  \Closure  $next
 * @return mixed
 *
 */
class LocalesMiddleware
{
    public function handle($request, Closure $next)
    {
        $lang =  session('locale', config('app.locale'));

        app()->setLocale($lang);

        if ($request->has('locale')) {
            app()->setLocale($request->query('locale'));
        }

        return $next($request);
    }
}
