<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Video;
use App\Report;

class VideoController extends Controller
{
    public function index()
    {
    	$videos = Video::latest()->paginate(20);
    	return view('admin.video.index',compact('videos'));
    }

    public function report()
    {
        $reports = Report::where('type','video')->latest()->paginate(20);
    	return view('admin.video.report',compact('reports'));
    }

    public function view(Request $request,$id)
    {
    	$video = Video::find($id);
    	$video->view = $video->view + $request->view;
    	$video->save();
    	toast('Your video fake view successfully generated','success');
    	return back();
    }

    public function delete($id)
    {
    	Video::find($id)->delete();
    	toast('Your video successfully deleted','success');
    	return back();
    }

    public function report_delete($id)
    {
        Report::find($id)->delete();
        toast('Your report successfully deleted','success');
        return back();
    }
}
