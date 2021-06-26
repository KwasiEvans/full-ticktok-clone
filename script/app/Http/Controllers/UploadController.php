<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Video;
use Illuminate\Support\Str;
use Auth;
use App\Option;

class UploadController extends Controller
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
    	return view('upload');
    }

    public function upload(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'video' => 'required|mimetypes:video/mp4|max:10240'
        ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()[0]]);
        }

    	$file = $request->file('video');
		if (isset($file)) {
			$curentdate = Carbon::now()->toDateString();
			$imagename =  $curentdate . '-' . uniqid() . '.' . $file->getClientOriginalExtension();


			$path = 'uploads/';
            ini_set("max_execution_time",6000);
            ini_set("max_input_time",5000);
            ini_set("upload_max_filesize","20M");
            ini_set("post_max_size","80M");
			$file->move($path, $imagename);

			$filepath = 'uploads/'.$imagename;
			$data = '';
			$data .= '<input type="hidden" name="video_file" id="video_path" value="'.$filepath.'">';

			 return response()->json($data);

		}else{
			$imagename = 'default.png';
		}

    }

    public function store(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'caption' => 'required',
            'video_file' => 'required'
        ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()[0]]);
        }
        
        if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
            $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
        }else{  
                $ip = $_SERVER['REMOTE_ADDR'];  
         }  

        $address = geoip()->getLocation($ip);

    	$video = new Video();
    	$video->user_id = Auth::User()->id;
    	$video->title = $request->caption;
    	
        if(Video::where('slug',$request->caption)->first())
        {
            $slug = Str::slug($request->caption).Str::random(40);
        }else{
            $slug = Str::slug($request->caption);
        }
        
    	$video->slug = $slug;
    	if($request->status == 1)
    	{
    		$status = "public";
    	}else{
    		$status = "privet";
    	}
    	$video->url = $request->video_file;
    	$video->status = $status;
        $video->country = $address->country;
    	$video->save();
    	return response()->json(Auth::User()->slug);
    }
}
