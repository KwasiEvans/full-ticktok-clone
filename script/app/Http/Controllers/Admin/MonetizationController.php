<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Monetization;

class MonetizationController extends Controller
{
    public function index()
    {
    	$monetizations = Monetization::where('status','pending')->paginate(20);
    	return view('admin.monetization.index',compact('monetizations'));
    }

    public function verify($id)
    {
    	$monetization = Monetization::find($id);
    	$monetization->status = 'approved';
    	$monetization->save();
        toast('Monetization request successfully approved','success');
    	return back();
    	
    }

    public function delete($id)
    {
    	Monetization::find($id)->delete();
        toast('Monetization request successfully deleted','success');
    	return back();
    }
}
