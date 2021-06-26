<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Video;
use Auth;
use App\Report;
use App\User;

class ReportController extends Controller
{
    public function report(Request $request)
    {
    	$validator = \Validator::make($request->all(), [
            'body' => 'required',
        ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()[0]]);
        }

    	$video = Video::where('id',$request->video_id)->first();
    	$report = new Report();
    	$report->user_id = Auth::User()->id;
    	$report->body = $request->body;
    	$report->type = "video";
    	$report->parent_id = $video->user_id;
    	$report->video_id = $request->video_id;
    	$report->save();

    	return response()->json('ok');
    }

    public function show(Request $request)
    {
    	$video = Video::where('slug',$request->slug)->first();
    	return view('layouts.frontend.section.report',compact('video'));
    }


    public function report_user(Request $request)
    {
        $user = User::where('slug',$request->slug)->first();
        return view('layouts.frontend.section.reportuser',compact('user'));
    }

    public function report_user_store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'body' => 'required',
        ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()[0]]);
        }

        $video = User::find($request->user_id);
        $report = new Report();
        $report->user_id = Auth::User()->id;
        $report->body = $request->body;
        $report->type = "user";
        $report->parent_id = $request->user_id;
        $report->save();

        return response()->json('ok');
    }
}
