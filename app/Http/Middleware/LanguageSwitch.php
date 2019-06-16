<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;

class LanguageSwitch
{

    protected $languages = ['en','pl'];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        app()->setLocale(Session::has('locale') ? Session::get('locale') : Config::get('app.locale'));
        Carbon::setLocale(Session::has('locale') ? Session::get('locale') : Config::get('app.locale'));
        return $next($request);
    }
}
