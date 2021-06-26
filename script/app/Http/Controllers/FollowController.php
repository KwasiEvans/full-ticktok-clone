<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Notification;
use App\Option;

class FollowController extends Controller
{
    public function follow(Request $request,$id)
    {
        $option = Option::where('key','user_value')->first();

        $user_value = json_decode($option->value);

        if($user_value->user_verification == 'enabled')
        {
            $user_data = json_decode(Auth::User()->value);
            if($user_data->status == 'deactive')
            {
                return view('verification');
            }
        }

    	$user = User::find($id);
    	Auth::User()->follow($user);
        $notification = new Notification();
        $notification->user_id = Auth::User()->id;
        $notification->parent_id = $user->id;
        $notification->body = 'Followed You';
        $notification->link = 'user/'.Auth::User()->slug;
        $notification->save();
        if($request->data)
        {
            return "oh";
        }else{
            return back();
        }
    }

    public function unfollow(Request $request,$id)
    {

        $option = Option::where('key','user_value')->first();

        $user_value = json_decode($option->value);

        if($user_value->user_verification == 'enabled')
        {
            $user_data = json_decode(Auth::User()->value);
            if($user_data->status == 'deactive')
            {
                return view('verification');
            }
        }
        
    	$user = User::find($id);
    	Auth::User()->unfollow($user);
    	if($request->data)
        {
            return "oh";
        }else{
            return back();
        }
    }
}
