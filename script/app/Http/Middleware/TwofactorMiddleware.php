<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use DB;

class TwofactorMiddleware
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
         try {
        DB::connection()->getPdo();
            if(DB::connection()->getDatabaseName()){
                if(Auth::check())
                {
                    $user_data = json_decode(Auth::User()->value);
                    if($user_data->two_step == 'enable')
                    {
                        if(empty(Auth::User()->two_factor))
                        {
                            return $next($request);
                            
                        }else{
                            return redirect()->route('two.step');
                        }
                    }else{
                        return $next($request);
                    }
                }else{
                    return $next($request);
                } 
            }else{
                return $next($request);
            }
        } catch (\Exception $e) {
            return $next($request);
        }
    }
}
