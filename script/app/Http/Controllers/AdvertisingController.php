<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Advertising;
use Auth;
use Carbon\Carbon;
use App\Option;

class AdvertisingController extends Controller
{
     public function __construct()
    {
        $option = Option::where('key','user_value')->first();
        $user_value = json_decode($option->value);
        if($user_value->email_verification == 'enabled')
        {
            $this->middleware('verified');
        }
    }

    public function index()
    {
        $option = Option::where('key','user_value')->first();

        $user_value = json_decode($option->value);

        if($user_value->user_verification == 'enabled')
        {
            $user_data = json_decode(Auth::User()->value);
            if($user_data->status == 'deactive')
            {
                return view('verification');
            }
        }

        $user = Auth::User();
        $user_data = json_decode($user->value);
        $advertising = Advertising::where('user_id',Auth::User()->id)->paginate(20);
        return view('advertising.index',compact('advertising','user_data'));
    }

    public function create()
    {
        $per_link = Option::where('key','per_link')->first();
        $per_impression = Option::where('key','per_impression')->first();
        $user = Auth::User();
        $user_data = json_decode($user->value);
        $country_json_file = file_get_contents(resource_path('json/country.json'));
        $countries = json_decode($country_json_file);
        return view('advertising.create',compact('countries','user_data','per_link','per_impression'));
    }

    public function store(Request $request)
    {
    	$validator = \Validator::make($request->all(), [
            'media' => 'required|image',
            'title' => 'required',
            'url' => 'required',
            'country' => 'required',
            'pricing' => 'required',
            'total_limit' => 'required'
        ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()[0]]);
        }

        $per_link = Option::where('key','per_link')->first();
        $per_impression = Option::where('key','per_impression')->first();

        $user = Auth::User();
        $user_data = json_decode($user->value);

        if($request->pricing == 'per_link')
        {
            $total_spent = $request->total_limit * $per_link->value;
        }else{ 
            $total_spent = $request->total_limit * $per_impression->value;
        }

        
        
        if($user_data->wallet >= $total_spent)
        {

        	$file = $request->file('media');
            if (isset($file)) {
                $curentdate = Carbon::now()->toDateString();
                $imagename =  $curentdate . '-' . uniqid() . '.' . $file->getClientOriginalExtension();

                $path = 'uploads/ads/';

                $file->move($path, $imagename);

                $mediapath = $path.$imagename;

            }else{
                $mediapath = 'uploads/ads/cover.png';
            }

            $advertising = new Advertising();
            $advertising->user_id = Auth::User()->id;
            $advertising->title = $request->title;
            $advertising->url = $request->url;
            $advertising->media = $mediapath;
            $advertising->country = $request->country;
            $advertising->pricing = $request->pricing;
            $advertising->total_limit = $request->total_limit;
            $advertising->save();

            return response()->json('ok');

        }else{
            return response()->json('wallet_error');
        }
    }

    public function edit(Request $request,$id)
    {
        $per_link = Option::where('key','per_link')->first();
        $per_impression = Option::where('key','per_impression')->first();
        $user = Auth::User();
        $user_data = json_decode($user->value);
        $country_json_file = file_get_contents(resource_path('json/country.json'));
        $countries = json_decode($country_json_file);
        $advertising = Advertising::find($request->id);
        return view('advertising.edit',compact('advertising','countries','user_data','per_link','per_impression'));
    }

    public function update(Request $request,$id)
    {
        $validator = \Validator::make($request->all(), [
            'title' => 'required',
            'url' => 'required',
            'country' => 'required',
            'pricing' => 'required',
            'total_limit' => 'required'
        ]);
        
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()[0]]);
        }

        $per_link = Option::where('key','per_link')->first();
        $per_impression = Option::where('key','per_impression')->first();

        $user = Auth::User();
        $user_data = json_decode($user->value);

        if($request->pricing == 'per_link')
        {
            $total_spent = $request->total_limit * $per_link->value;
        }else{ 
            $total_spent = $request->total_limit * $per_impression->value;
        }

        if($user_data->wallet >= $total_spent)
        {
            $advertising = Advertising::find($id);

            $file = $request->file('media');
            if (isset($file)) {
                $curentdate = Carbon::now()->toDateString();
                $imagename =  $curentdate . '-' . uniqid() . '.' . $file->getClientOriginalExtension();

                $path = 'uploads/ads/';

                if(file_exists('uploads/ads/'.$advertising->media))
                {
                    unlink('uploads/ads/'.$advertising->media);
                }

                $file->move($path, $imagename);

                $mediapath = $path.$imagename;

            }else{
                $mediapath = $advertising->media;
            }

            $advertising->title = $request->title;
            $advertising->media = $mediapath;
            $advertising->url = $request->url;
            $advertising->country = $request->country;
            $advertising->pricing = $request->pricing;
            $advertising->total_limit = $request->total_limit;
            $advertising->save();

            return response()->json('ok');
            
        }else{
            return response()->json('wallet_error');
        }

        
    }


    public function pending($id)
    {
        $advertising = Advertising::find($id);
        $advertising->status = 'pending';
        $advertising->save();

        return back();
    }

    public function approved($id)
    {
        $advertising = Advertising::find($id);
        $advertising->status = 'publish';
        $advertising->save();

        return back();
    }

    public function delete(Request $request)
    {
        $advertising = Advertising::find($request->id);
        $advertising->delete();
        return "ok";
    }

    public function payment(Request $request)
    {
        $user = Auth::User();
        $user_data = json_decode($user->value);
        $user_data->wallet = $user_data->wallet + $request->amount;
        $user->value = json_encode($user_data);
        $user->save();

        return "ok";
    }
}
