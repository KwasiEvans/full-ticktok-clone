<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Video;
use Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
    	
    	$video = $video = Video::with('user')->where('id',$request->video_id)->first();
    	$comment = new Comment();
    	$comment->user_id = Auth::User()->id;
    	$comment->video_id = $request->video_id;
    	if($request->parent_id != null)
    	{
    		$comment->parent_id = $request->parent_id;
    	}
        if($request->mention_id != null)
        {
            $comment->mention_id = $request->mention_id;
        }
    	$comment->message = $request->comment;
    	$comment->save();
    	return view('comment',compact('video'));
    }
}
