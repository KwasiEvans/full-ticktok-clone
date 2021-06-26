<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Str;
use App\User;
use Carbon\Carbon;
use App\Verification;
use Illuminate\Support\Facades\Hash;
use App\Video;
use App\Monetization;
use App\Option;

class SettingsController extends Controller
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

        $country_json_file = file_get_contents(resource_path('json/country.json'));
        $countries = json_decode($country_json_file);
        $monetization = Monetization::where('user_id',Auth::User()->id)->first();
        $total_followers = Auth::User()->followers()->count();
        $video_total_view = Video::where('user_id',Auth::User()->id)->sum('view');
        $verification = Verification::where('user_id',Auth::User()->id)->first();
        $user_data = json_decode(Auth::User()->value);
        return view('settings',compact('verification','user_data','total_followers','video_total_view','monetization','countries'));
    }


    public function edit()
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

    	if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
            $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
           $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
       }else{  
           $ip = $_SERVER['REMOTE_ADDR'];  
       }  

       $address = geoip()->getLocation($ip);
       
       $country_json_file = file_get_contents(resource_path('json/country.json'));
       $countries = json_decode($country_json_file);

       return view('usersetting',compact('address','countries'));
   }

   public function update(Request $request)
   {
        $user = Auth::User();

        if($request->username)
        {
            $validator = \Validator::make($request->all(), [
                'username' => 'required|unique:users,username,' . $user->id
            ]);

            if ($validator->fails())
            {
                return response()->json(['errors'=>$validator->errors()->all()[0]]);
            }

            $user->username = $request->username;
            $user->save();

        }

        if($request->email)
        {
            $validator = \Validator::make($request->all(), [
                'email' => 'required|unique:users,email,'.$user->id,
            ]);

            if ($validator->fails())
            {
                return response()->json(['errors'=>$validator->errors()->all()[0]]);
            }

            $user->email = $request->email;
            $user_data = $user->value;
            $data = json_decode($user_data);
            $data->gender = $request->gender;
            $data->country = $request->country;
            $data->age = $request->age;
            $data->relation = $request->relation;
            $user->value = json_encode($data);
            $user->save();

            return response()->json('ok');
        }

        if($request->first_name)
        {
           $validator = \Validator::make($request->all(), [
            'first_name' => 'required'
        ]);

           if ($validator->fails())
           {
            return response()->json(['errors'=>$validator->errors()->all()[0]]);
        }

        $user->first_name = $request->first_name;
        $user->save();
    }

    if($request->last_name)
    {
        $validator = \Validator::make($request->all(), [
            'last_name' => 'required'
        ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()[0]]);
        }

        $slug = Str::slug($request->first_name.$request->last_name);
        if(User::where('slug',$slug)->first())
        {
            $slug = $slug.Str::random(5);
        }


        $user->last_name = $request->last_name;
        $user->slug = $slug;
        $user_data = $user->value;
        $data = json_decode($user_data);
        $data->bio = $request->bio;
        $data->facebook = $request->facebook;
        $data->twitter = $request->twitter;
        $data->instagram = $request->instagram;
        $data->pinterest = $request->pinterest;
        $user->value = json_encode($data);
        $user->save();
        return response()->json('ok');
    }

    if($request->current_password)
    {
        $validator = \Validator::make($request->all(), [
            'current_password' => 'password',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()[0]]);
        }


        $user->password = \Hash::make($request->password);
        $user->save();
        return response()->json('ok');

    } 
}

public function cover(Request $request)
{
    $validator = \Validator::make($request->all(), [
        'cover' => 'image',
    ]);

    if ($validator->fails())
    {
        return response()->json(['errors'=>$validator->errors()->all()[0]]);
    }

    $user = Auth::User();
    $user_data = json_decode($user->value);

    $file = $request->file('cover');
    if (isset($file)) {
        $curentdate = Carbon::now()->toDateString();
        $imagename =  $curentdate . '-' . uniqid() . '.' . $file->getClientOriginalExtension();

        if(file_exists($user_data->cover))
        {
            unlink($user_data->cover);
        }

        $path = 'uploads/';

        $file->move($path, $imagename);

        $coverimg = $path.$imagename;

    }else{
        $coverimg = 'uploads/cover.png';
    }


    $user_data->cover = $coverimg;
    $user->value = json_encode($user_data);
    $user->save();

    return response()->json('ok');
}

public function profile(Request $request)
{
    $validator = \Validator::make($request->all(), [
        'profile' => 'image',
    ]);

    if ($validator->fails())
    {
        return response()->json(['errors'=>$validator->errors()->all()[0]]);
    }

    $user = Auth::User();

    $file = $request->file('profile');
    if (isset($file)) {
        $curentdate = Carbon::now()->toDateString();
        $imagename =  $curentdate . '-' . uniqid() . '.' . $file->getClientOriginalExtension();

        if(file_exists($user->image))
        {
            unlink($user->image);
        }

        $path = 'uploads/';

        $file->move($path, $imagename);

        $profileimg = $path.$imagename;

    }else{
        $profileimg = 'uploads/default.png';
    }


    $user->image = $profileimg;
    $user->save();

    return response()->json('ok');
}


public function two_step(Request $request)
{
    $user = Auth::User();
    $user_data = json_decode($user->value);
    $user_data->two_step = $request->two_step;
    $user->value = json_encode($user_data);
    $user->save();
    return response()->json('ok');
}

public function account_delete(Request $request)
{
    $user = Auth::User();
    if (Hash::check($request->password, $user->password)) {
        $user->delete();
        return route('welcome');
    }else{
        return "error";
    }
}

public function delete_session(Request $request)
{
    Auth::logout();
    return route('welcome');
}

public function monetization_request(Request $request)
{
    $monetization = new Monetization();
    $monetization->user_id = Auth::User()->id;
    $monetization->save();
    return 'ok';
}
}
