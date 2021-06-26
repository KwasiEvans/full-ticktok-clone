<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Page;

class PageController extends Controller
{
    public function show($slug)
    {
    	$slug = decrypt($slug);
    	$page = Page::find($slug);
    	return view('page',compact('page'));
    }
}
