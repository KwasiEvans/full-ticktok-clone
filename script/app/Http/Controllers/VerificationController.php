<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Verification;
use Carbon\Carbon;
use Auth;

class VerificationController extends Controller
{
    public function store(Request $request)
    {
    	$validator = \Validator::make($request->all(), [
            'national_id' => 'image',
        ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()[0]]);
        }

        $file = $request->file('national_id');
        if (isset($file)) {
            $curentdate = Carbon::now()->toDateString();
            $imagename =  $curentdate . '-' . uniqid() . '.' . $file->getClientOriginalExtension();

            $path = 'uploads/';

            $file->move($path, $imagename);

            $image_path = $path.$imagename;

        }else{
            $image_path = 'uploads/nation.png';
        }

    	$verification = new Verification();
    	$verification->user_id = Auth::User()->id;
    	$verification->image = $image_path;
    	$verification->first_name = $request->first_name;
    	$verification->last_name = $request->last_name;
    	$verification->message = $request->message;
    	$verification->status = 'pending';
    	$verification->save();

    	return response()->json('ok');
    }
}
