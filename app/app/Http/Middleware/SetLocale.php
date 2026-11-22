<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->session()->get('locale', config('app.locale'));
        app()->setLocale(in_array($locale, ['it', 'en'], true) ? $locale : 'it');
        Carbon::setLocale(app()->getLocale());

        return $next($request);
    }
}
