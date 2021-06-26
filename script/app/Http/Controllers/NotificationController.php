<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notification;
use Auth;
use Carbon\Carbon;

class NotificationController extends Controller
{
    public function notification(Request $request)
    {
    	$notifications = Notification::with('user')->where([
    		['parent_id',Auth::User()->id],
    	])->orderBy('id','DESC')->get();

        if($request->ajax())
        {
            return view('layouts.frontend.section.notification',compact('notifications'));
        }else{
            return redirect('/');
        }
    	
    }

    public function notification_count(Request $request)
    {
    	if($request->ajax())
        {
            $notifications = Notification::where([
                ['parent_id',Auth::User()->id],
                ['status','unread']
            ])->count();

            Notification::where([
                ['created_at', '<', Carbon::now()->subHours(24)],
                ['parent_id',Auth::User()->id],
            ])->delete();

            return $notifications;
        }else{
            return redirect()->route('welcome');
        }
    }

    public function notification_unread()
    {
    	$notifications = Notification::where('parent_id',Auth::User()->id)->get();

    	foreach($notifications as $value)
    	{
    		$notification = Notification::find($value->id);
    		$notification->status = 'read';
    		$notification->save();
    	}

    	return "ok";
    }
}
