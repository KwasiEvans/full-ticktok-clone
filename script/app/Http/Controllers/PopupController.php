<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;
use Session;
use App\Monetization;
use App\Advertising;
use Auth;
use App\User;
use App\Option;

class PopupController extends Controller
{
    public function popup(Request $request)
    {
    	$video = Video::with('user')->where('slug',$request->slug)->first();
    	$video_key = 'video_'.$video->id;
    	if(!Session::has($video_key))
    	{
    		$video->increment('view');
    		Session::put($video_key,1);
    	}
    	return view('modal',compact('video'));
    }

    public function ads(Request $request)
    {
        $ads_show_per_second = Option::where('key','ads_show_per_second')->first();
        session_start();
        if((time() - $_SESSION['last_activity']) > $ads_show_per_second->value)
        {
            $_SESSION['last_activity'] = time();
            $video = Video::where('slug',$request->slug)->first();
            $user = $video->user;
            $monetization = Monetization::where('user_id',$user->id)->first();

            if($monetization && $monetization->status == 'approved')
            {
                $login_user = User::find($user->id);
                
                if(Auth::check())
                {
                    $advertising = Advertising::where([
                                    ['status','publish'],
                                    ['country',Auth::User()->country],
                                ])->orWhere('country','select_all')->inRandomOrder()->first();
                }else{
                    $advertising = Advertising::where([
                                    ['status','publish'],
                                ])->orWhere('country','select_all')->inRandomOrder()->first();
                }
                
                if($advertising)
                {
                    if($advertising->pricing == 'per_impression')
                    {

                        $per_impression = Option::where('key','per_impression')->first();
                        $author_get_per_impression = Option::where('key','author_get_per_impression')->first();
                        $advertising_user = User::where('id',$advertising->user_id)->first();
                        $advertising_user_data = json_decode($advertising_user->value);
                        if($advertising_user_data->wallet >= $per_impression->value)
                        {
                            if($advertising->total_limit == $advertising->result)
                            {
                                 $advertising->status = "complete";
                                $advertising->save();
                            }else{
                                $advertising_user_data->wallet = $advertising_user_data->wallet - $per_impression->value;
                                $advertising_user->value = json_encode($advertising_user_data);
                                $advertising_user->save();

                                $advertising->increment('result');
                                $advertising->total_spent = $advertising->total_spent + $per_impression->value;
                                $advertising->save();

                                $video_user = User::find($user->id);
                                $user_data = json_decode($video_user->value);
                                $user_data->wallet = $user_data->wallet + $author_get_per_impression->value;
                                $video_user->value = json_encode($user_data);
                                $video_user->save();
                               
                                
                                return view('advertising.show',compact('advertising','login_user'));
                            }

                        }else{
                            $advertising->status = "rejected";
                            $advertising->save();
                        }
                    }

                    if($advertising->pricing == 'per_link')
                    {
                        return view('advertising.show',compact('advertising','login_user'));
                    }
                }
            }else{
                return null;
            }
        }else{
            return null;
        }
        
    }


    public function ads_redirect($ads_id,$user_id)
    {

        $advertising = Advertising::where('id',$ads_id)->first();
      
        if($advertising)
        {
            if($advertising->pricing == 'per_link')
            {
                $per_link = Option::where('key','per_link')->first();
                $author_get_per_link = Option::where('key','author_get_per_link')->first();
                $advertising_user = User::where('id',$advertising->user_id)->first();
                $advertising_user_data = json_decode($advertising_user->value);
                if($advertising_user_data->wallet >= $per_link->value)
                {
                    if($advertising->total_limit == $advertising->result)
                    {
                        $advertising->status = "complete";
                        $advertising->save();
                    }else{
                        $advertising_user_data->wallet = $advertising_user_data->wallet - $per_link->value;
                        $advertising_user->value = json_encode($advertising_user_data);
                        $advertising_user->save();

                        $advertising->increment('result');
                        $advertising->total_spent = $advertising->total_spent + $per_link->value;
                        $advertising->save();

                        $login_user = User::find($user_id);
                        $user_data = json_decode($login_user->value);
                        $user_data->wallet = $user_data->wallet + $author_get_per_link->value;
                        $login_user->value = json_encode($user_data);
                        $login_user->save();
                      
                        return \Redirect::to($advertising->url);
                        
                    }

                }else{
                    $advertising->status = "rejected";
                    $advertising->save();
                }
            }

            if($advertising->pricing == 'per_impression')
            {
                return \Redirect::to($advertising->url);
            }
        }
        
    }
}
