<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;
use Auth;
use Session;

class VideoController extends Controller
{
    public function show(Request $request,$slug)
    {
    	$video = Video::where('slug',$slug)->first();
    	if($video)
    	{
    		$video_key = 'video_'.$video->id;
	    	if(!Session::has($video_key))
	    	{
	    		$video->increment('view');
	    		Session::put($video_key,1);
	    	}
    		return view('singlevideo',compact('video'));
    	}else{
    		return abort(404);
    	}
    }

    public function latest(Request $request)
    {

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
						])->latest()->paginate(20);

		if($videos->count() < 15)
		{
			$videos = Video::with('user')->where([
						    ['status','public'],
						])->latest()->paginate(20);
		}

		if($request->data)
		{
            if($videos->isEmpty())
            {
                return "no";
            }
            abort_if($videos->isEmpty(),204);
			return view('layouts.frontend.section.video',compact('videos'));
		}
		$type = "latest";
		return view('video',compact('videos','type'));
    	
    }

    public function popular(Request $request)
    {
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
						])->orderBy('view','desc')
						->paginate(20);

		if($videos->count() < 15)
		{
			$videos = Video::with('user')->where([
						    ['status','public'],
						])->orderBy('view','desc')
						->paginate(20);
		}

		if($request->data)
		{
            if($videos->isEmpty())
            {
                return "no";
            }
            abort_if($videos->isEmpty(),204);
			return view('layouts.frontend.section.video',compact('videos'));
		}
		$type = "popular";
		return view('video',compact('videos','type'));
    	
    }

    public function trending(Request $request)
    {
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
						->paginate(20);

		if($videos->count() < 15)
		{
			$videos = Video::with('user')->where([
						    ['status','public'],
						])->withCount('favourite_to_user')
						->withCount('comments')
						->orderBy('favourite_to_user_count','desc')
						->orderBy('view','desc')
						->orderBy('comments_count','desc')
						->paginate(10);
		}

		if($request->data)
		{
            if($videos->isEmpty())
            {
                return "no";
            }
            abort_if($videos->isEmpty(),204);
			return view('layouts.frontend.section.video',compact('videos'));
		}

		$type = "trending";
		return view('video',compact('videos','type'));
    }
}
