<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

class AddSlugLang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($lang = Request::segment(1)){
            if(in_array($lang, config('app.locales'))){
                Session::put('locale', $lang);
                App::setLocale($lang);
            }else{
                App::setLocale('en');
            }
        }else{
            if(Session::has('locale')){
                App::setLocale('en');
                /*return redirect(url('/'.Session::get('locale')));*/
            }else App::setLocale('en');
        }
        return $next($request);
    }
}
