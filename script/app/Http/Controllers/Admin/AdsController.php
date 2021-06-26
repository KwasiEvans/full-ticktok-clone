<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Advertising;
use App\Option;
use Auth;
use Carbon\Carbon;

class AdsController extends Controller
{
    public function index()
    {
    	$ads = Advertising::latest()->paginate(20);
    	return view('admin.ads',compact('ads'));
    }

    public function create()
    {
        $per_link = Option::where('key','per_link')->first();
        $per_impression = Option::where('key','per_impression')->first();
        $user = Auth::User();
        $user_data = json_decode($user->value);
        $country_json_file = file_get_contents(resource_path('json/country.json'));
        $countries = json_decode($country_json_file);
        return view('admin.ads.create',compact('countries','user_data','per_link','per_impression'));
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'title' => 'required',
            'url' => 'required',
            'media' => 'required|image',
            'country' => 'required',
            'total_limit' => 'required'
        ]);

        if ($validator->fails())
        {
            toast($validator->messages()->all()[0],'error');
            return back();
        }

        $file = $request->file('media');
        if (isset($file)) {
            $curentdate = Carbon::now()->toDateString();
            $imagename =  $curentdate . '-' . uniqid() . '.' . $file->getClientOriginalExtension();

            $path = 'uploads/ads/';

            $file->move($path, $imagename);

            $main_image = $path.$imagename;

        }else{
            $main_image = 'default.png';
        }

        $ads = new Advertising();
        $ads->user_id = Auth::User()->id;
        $ads->title = $request->title;
        $ads->url = $request->url;
        $ads->media = $main_image;
        $ads->country = $request->country;
        $ads->total_limit = $request->total_limit;
        $ads->status = $request->status;
        $ads->pricing = $request->pricing;
        $ads->save();

        toast('Ads Successfully Created','success');
        return redirect()->route('admin.ads.index');
    }

    public function edit($id)
    {
        $per_link = Option::where('key','per_link')->first();
        $per_impression = Option::where('key','per_impression')->first();
        $user = Auth::User();
        $user_data = json_decode($user->value);
        $country_json_file = file_get_contents(resource_path('json/country.json'));
        $countries = json_decode($country_json_file);
        $ads = Advertising::find($id);
        return view('admin.ads.edit',compact('ads','countries','user_data','per_link','per_impression'));
    }

    public function update(Request $request,$id)
    {
        $validator = \Validator::make($request->all(), [
            'title' => 'required',
            'url' => 'required',
            'country' => 'required',
            'total_limit' => 'required'
        ]);

        if ($validator->fails())
        {
            toast($validator->messages()->all()[0],'error');
            return back();
        }

        $ads = Advertising::find($id);

        $file = $request->file('media');
        if (isset($file)) {
            $curentdate = Carbon::now()->toDateString();
            $imagename =  $curentdate . '-' . uniqid() . '.' . $file->getClientOriginalExtension();

            $path = 'uploads/ads/';

            $file->move($path, $imagename);

            $main_image = $path.$imagename;

        }else{
            $main_image = $ads->media;
        }

        $ads->user_id = Auth::User()->id;
        $ads->title = $request->title;
        $ads->url = $request->url;
        $ads->media = $main_image;
        $ads->country = $request->country;
        $ads->total_limit = $request->total_limit;
        $ads->pricing = $request->pricing;
        $ads->status = $request->status;
        $ads->save();

        toast('Ads Successfully Updated','success');
        return redirect()->route('admin.ads.index');
    }

    public function delete($id)
    {
    	Advertising::find($id)->delete();
    	toast('Your ads successfully deleted','success');
    	return back();
    }
}
