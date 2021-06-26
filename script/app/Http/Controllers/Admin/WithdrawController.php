<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Withdraw;
use App\User;

class WithdrawController extends Controller
{
    public function index()
    {
    	$withdraws = Withdraw::where('status','pending')->latest()->paginate(20);
    	return view('admin.withdraw.index',compact('withdraws'));
    }

    public function accept($id)
    {
    	$withdraw = Withdraw::find($id);
    	$withdraw->status = 'approve';
    	$withdraw->save();
        toast('Withdraw request successfully approved','success');
    	return back();
    }

    public function reject($user_id,$withdraw_id)
    {
    	$withdraw = Withdraw::find($withdraw_id);
    	$user = User::find($user_id);
    	$user_data = json_decode($user->value);
    	$user_data->wallet = $user_data->wallet + $withdraw->amount;
    	$user->value = json_encode($user_data);
    	$user->save();
    	$withdraw->status = 'reject';
    	$withdraw->save();
        toast('Withdraw request successfully rejected','success');
    	return back();

    }
}
