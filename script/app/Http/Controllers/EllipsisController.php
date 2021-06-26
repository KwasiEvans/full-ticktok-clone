<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;

class EllipsisController extends Controller
{
    public function ellipsis(Request $request)
    {
    	$video = Video::where('slug',$request->slug)->first();
    	return view('ellipsis',compact('video'));
    }
}
