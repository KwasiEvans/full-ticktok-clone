<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Video;
use App\User;
use App\Advertising;
use App\Sponsor;

class DashboardController extends Controller
{
    public function index()
    {
    	$video_count = Video::count();
    	$user_count = User::where('role_id',2)->count();
    	$ads_count = Advertising::count();
    	$sponsor_count = Sponsor::count();
    	$videos = Video::latest()->paginate(20);
    	return view('admin.dashboard',compact('video_count','user_count','ads_count','sponsor_count','videos'));
    }

    public function logout()
    {
    	Auth::logout();

    	return back();
    }
}
