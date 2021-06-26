<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Video;
use App\Option;
use DB;

class WelcomeController extends Controller
{
    
	public function index()
	{
		 try {
        DB::connection()->getPdo();
        if(DB::connection()->getDatabaseName()){
            	if(!Auth::check()) {
					$ads_show_per_second = Option::where('key','ads_show_per_second')->first();
			        session_start();
			        if(!isset($_SESSION['last_activity']))
			        {
			            $_SESSION['last_activity'] = time();
					}
				}

				if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
					$ip = $_SERVER['HTTP_CLIENT_IP'];  
				}elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
					$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
				}else{  
					$ip = $_SERVER['REMOTE_ADDR'];  
				}  

				$address = geoip()->getLocation($ip);

				$videos = Video::with('user')->where([
					['status','public'],
					['country',$address->country],
				])->withCount('favourite_to_user')
				->withCount('comments')
				->orderBy('favourite_to_user_count','desc')
				->orderBy('view','desc')
				->orderBy('comments_count','desc')
				->latest()->paginate(20);

				if($videos->count() < 15)
				{
					$videos = Video::with('user')->where('status','public')->latest()->paginate(20);
				}

				abort_if($videos->isEmpty(),204);

				$option = Option::where('key','site_value')->first();
				$site_value = json_decode($option->value);

				return view('welcome',compact('videos','site_value'));
	        }else{
	            return redirect()->route('install');
	        }
	    } catch (\Exception $e) {
	        return redirect()->route('install');
	    }
	}

	public function logout()
	{
		Auth::logout();
		return redirect()->route('welcome');
	}
}
