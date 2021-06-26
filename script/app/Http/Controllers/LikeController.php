<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Video;
use App\Comment;
use App\Notification;

class LikeController extends Controller
{
    public function like(Request $request)
    {
    	$video = Video::find($request->id);
    	$user = Auth::User();
    	$isFavourite = $user->favourite_videos()->where('video_id',$request->id)->count();

    	if($isFavourite == 0)
    	{
    		$user->favourite_videos()->attach($video);
            $notification = new Notification();
            $notification->user_id = Auth::User()->id;
            $notification->parent_id = $video->user_id;
            $notification->body = 'Liked Your Video';
            $notification->link = 'video/'.$video->slug;
            $notification->save();
    		return "like";
    	}else{
    		$user->favourite_videos()->detach($video);
    		return "dislike";
    	}
    }

    public function comment_like(Request $request)
    {
        $comment = Comment::find($request->id);
        $user = Auth::User();
        $isFavourite = $user->favourite_comments()->where('comment_id',$request->id)->count();

        if($isFavourite == 0)
        {
            $user->favourite_comments()->attach($comment);
            return $comment->favourite_to_user->count();
        }else{
            $user->favourite_comments()->detach($comment);
            return $comment->favourite_to_user->count();
        }
    }
}
