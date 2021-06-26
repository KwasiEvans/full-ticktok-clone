<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyMail;
use Session;

class TwostepController extends Controller
{
	public function index()
	{
		if(Session::has('two_factor'))
		{
			$this->notify();
			Session::forget('two_factor');
		}
		return view('twostep');
	}

	public function verify(Request $request)
	{
		$this->validate($request,[
			'two_factor' => 'required'
		]);

		$user = Auth::User();

		if($user->two_factor == $request->two_factor)
		{
			$user->two_factor = null;
			$user->save();
			return redirect()->route('welcome');
		}else{
			\Session::flash('message', 'Enter Valid Number'); 
			return back();
		}
	}

	public function notify()
	{
		$user = Auth::User();
		Mail::to($user->email)->send(new VerifyMail($user));
		\Session::flash('message', 'Successfully Send 4-digit Code. Please Check Your Email.'); 
		return back();
	}
}