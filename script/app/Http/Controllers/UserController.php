<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Option;

class UserController extends Controller
{
    public function show(Request $request,$slug)
    {
    	$user = User::with('videos')->where('slug',$slug)->first();
    	if ($user) {
    		$videos = $user->videos()->where('status','public')->latest()->paginate(12);
    		if($request->data)
    		{
                if($videos->isEmpty())
                {
                    return "no";
                }
                abort_if($videos->isEmpty(),204);
    			return view('layouts.frontend.section.video',compact('videos'));
    		}
    		return view('profile',compact('user','videos'));
    	}else{
    		return abort(404);
    	}
    }

    public function find_users(Request $request)
    {
        
        if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
        }else{  
                $ip = $_SERVER['REMOTE_ADDR'];  
        }  

        $address = geoip()->getLocation($ip);

        $user_data = User::where('id','!=',Auth::User()->id)->where('country',$address->country)->latest()->paginate(12);

        if($user_data->count() >= 12)
        {
            $users = User::where('id','!=',Auth::User()->id)->where('country',$address->country)->latest()->paginate(12);
        }else{
            $users = User::where('id','!=',Auth::User()->id)->latest()->paginate(12);
        }

        if($request->data)
        {
            if($users->isEmpty())
            {
                return "no";
            }
            abort_if($users->isEmpty(),204);
            return view('layouts.frontend.section.user',compact('users'));
        }
        return view('users',compact('users'));
        
    }

    public function verification()
    {
       
        return view('verification');
        
    }
}
