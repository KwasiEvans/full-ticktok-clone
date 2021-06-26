<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Report;
use App\Verification;

class UserController extends Controller
{
    public function index()
    {
    	$users = User::latest()->paginate(20);
    	return view('admin.user.index',compact('users'));
    }

    public function report()
    {
        $reports = Report::where('type','user')->paginate(20);
    	return view('admin.user.report',compact('reports'));
    }

    public function delete($id)
    {
    	User::find($id)->delete();
    	toast('User successfully deleted','success');
    	return back();
    }

    public function verification_request()
    {
        $verifications = Verification::where('status','pending')->latest()->paginate(20);
        return view('admin.user.verification',compact('verifications'));
    }

    public function verify($id)
    {
        $verification = Verification::find($id);
        $verification->status = 'approved';
        $verification->save();
        toast('User successfully verified','success');
        return back();
    }

    public function verify_delete($id)
    {
        Verification::find($id)->delete();
        toast('User verify request successfully deleted','success');
        return back();
    }

    public function pending_users()
    {
        $pending_users = User::orderBy('id','DESC')->get();
        return view('admin.user.pending',compact('pending_users'));
    }

    public function approved($id)
    {
        $user = User::find($id);
        $user_data = json_decode($user->value);
        $user_data->status = 'active';
        $user->value = json_encode($user_data);
        $user->save();
        
        return back();
    }
}
