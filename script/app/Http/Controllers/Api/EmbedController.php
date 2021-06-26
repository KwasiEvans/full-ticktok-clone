<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Video;

class EmbedController extends Controller
{
    public function embed($slug)
    {
    	$video = Video::where('slug',$slug)->first();
    	if($video)
    	{
    		return view('embed/video',compact('video'));
    	}else{
    		abort(404);
    	}
    }
}
