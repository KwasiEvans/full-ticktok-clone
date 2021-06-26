<?php

namespace App\Http\Middleware;

use Closure;
use App\Option;
use DB;

class LanguageMiddleware
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
        if(\Session::has('locale'))
        {
           \App::setlocale(\Session::get('locale'));
        }else{
            try {
                DB::connection()->getPdo();

                $option = Option::where('key','site_value')->first();
                if($option){
                    $site_value = json_decode($option->value);
                    \App::setlocale($site_value->default_language);
                }else{
                    \App::setlocale('en');
                }

            } catch (\Exception $e) {
                \App::setlocale('en');
            }
            
        }
        return $next($request);
    }
}
