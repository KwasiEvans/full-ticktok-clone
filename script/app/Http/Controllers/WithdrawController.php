<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Withdraw;

class WithdrawController extends Controller
{

	public function index()
	{
		$withdraws = Withdraw::where('user_id',Auth::User()->id)->latest()->paginate(20);
        return view('withdraw',compact('withdraws'));
    }

    public function store(Request $request)
    {
    	$validator = \Validator::make($request->all(), [
            'amount' => 'required|numeric',
            'email' => 'required'
        ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()[0]]);
        }


        $user = Auth::User();
        $user_data = json_decode($user->value);

        if($request->type == 'paypal')
        {
        	if($user_data->wallet >= 50)
            {
                if($user_data->wallet >= $request->amount)
                {
                    $withdraw = new Withdraw();
                    $withdraw->user_id = Auth::User()->id;
                    $withdraw->withdraw_id = rand(1,900000000000);
                    $withdraw->type = $request->type;
                    $withdraw->amount = $request->amount;
                    $withdraw->email = $request->email;
                    $withdraw->save();
                    $author = Auth::User();
                    $author_data = json_decode($author->value);
                    $author_data->wallet = $author_data->wallet - $request->amount; 
                    $author->value = json_encode($author_data);
                    $author->save();

                    return response()->json('ok');
                }else{
                    return response()->json('wallet_error');
                }
            }else{
                return response()->json('wallet_not');
            }
        }

        if($request->type == 'swift')
        {
            if($user_data->wallet >= 50)
            {
                if($user_data->wallet >= $request->amount)
                {

                    $validator = \Validator::make($request->all(), [
                        'amount' => 'required|numeric',
                        'email' => 'required',
                        'account_holder_name' => 'required',
                        'account_number' => 'required',
                        'bank_branch_city' => 'required',
                        'bank_branch_country' => 'required',
                        'bank_full_name' => 'required',
                        'billing_address_1' => 'required',
                        'city' => 'required',
                        'country' => 'required',
                        'name' => 'required',
                        'postal_code' => 'required',
                        'swift_code' => 'required'
                    ]);

                    if ($validator->fails())
                    {
                        return response()->json(['errors'=>$validator->errors()->all()[0]]);
                    }

                    $data = [
                        'account_holder_name' => $request->account_holder_name,
                        'account_number' => $request->account_number,
                        'bank_branch_city' => $request->bank_branch_city,
                        'bank_branch_country' => $request->bank_branch_country,
                        'bank_full_name' => $request->bank_full_name,
                        'billing_address_1' => $request->billing_address_1,
                        'billing_address_2' => $request->billing_address_2,
                        'city' => $request->city,
                        'country' => $request->country,
                        'intermediary_bank_city' => $request->intermediary_bank_city,
                        'intermediary_bank_code' => $request->intermediary_bank_code,
                        'intermediary_bank_country' => $request->intermediary_bank_country,
                        'intermediary_bank_name' => $request->intermediary_bank_name,
                        'name' => $request->name,
                        'postal_code' => $request->postal_code,
                        'state' => $request->state,
                        'swift_code' => $request->swift_code,
                    ];

                    $withdraw = new Withdraw();
                    $withdraw->user_id = Auth::User()->id;
                    $withdraw->withdraw_id = rand(1,900000000000);
                    $withdraw->type = $request->type;
                    $withdraw->amount = $request->amount;
                    $withdraw->email = $request->email;
                    $withdraw->value = json_encode($data);
                    $withdraw->save();
                    $author = Auth::User();
                    $author_data = json_decode($author->value);
                    $author_data->wallet = $author_data->wallet - $request->amount; 
                    $author->value = json_encode($author_data);
                    $author->save();

                    return response()->json('ok');
                }else{
                    return response()->json('wallet_error');
                }
            }else{
                return response()->json('wallet_not');
            }
        }
    }
}
