<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Option;

class GeneralController extends Controller
{
    public function index()
    {
    	$get_data = Option::where('key','user_value')->first();
    	$info = json_decode($get_data->value);
    	return view('admin.settings.general',compact('info'));
    }

    public function update(Request $request)
    {
    	$get_data = Option::where('key','user_value')->first();
    	$info = json_decode($get_data->value);
    	$info->user_registation = $request->user_registation;
    	$info->email_verification = $request->email_verification;
    	$info->delete_account = $request->delete_account;
    	$info->user_monetization = $request->user_monetization;
    	$info->user_payment_withdraw = $request->user_payment_withdraw;
    	$info->user_verification = $request->user_verification;
    	$get_data->value = json_encode($info);
    	$get_data->save();

    	toast('Your general settings successfully updated','success');
    	return back();
    }
}
