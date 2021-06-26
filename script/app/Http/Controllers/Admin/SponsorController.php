<?php

namespace App\Http\Controllers\Admin;

use App\Sponsor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
Use Alert;

class SponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sponsors = Sponsor::latest()->paginate(20);
        return view('admin.sponsor.index',compact('sponsors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sponsor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = \Validator::make($request->all(), [
            'title' => 'required',
            'url' => 'required',
            'image' => 'required|image'
        ]);

        if ($validator->fails())
        {
            toast($validator->messages()->all()[0],'error');
            return back();
        }

        $file = $request->file('image');
        if (isset($file)) {
            $curentdate = Carbon::now()->toDateString();
            $imagename =  $curentdate . '-' . uniqid() . '.' . $file->getClientOriginalExtension();

            $path = 'uploads/sponsor/';

            $file->move($path, $imagename);

            $main_image = $path.$imagename;

        }else{
            $main_image = 'uploads/cover.png';
        }

        $sponsor = new Sponsor();
        $sponsor->title = $request->title;
        $sponsor->url = $request->url;
        $sponsor->image = $main_image;
        $sponsor->save();

        toast('Your sponsor successfully created','success');


        return redirect()->route('admin.sponsor.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function show(Sponsor $sponsor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function edit(Sponsor $sponsor)
    {
        return view('admin.sponsor.edit',compact('sponsor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sponsor $sponsor)
    {
        $validator = \Validator::make($request->all(), [
            'title' => 'required',
            'url' => 'required'
        ]);

        if ($validator->fails())
        {
            toast($validator->messages()->all()[0],'error');
            return back();
        }

        $file = $request->file('image');
        if (isset($file)) {
            $curentdate = Carbon::now()->toDateString();
            $imagename =  $curentdate . '-' . uniqid() . '.' . $file->getClientOriginalExtension();

            if(file_exists($sponsor->image))
            {
                unlink($sponsor->image);
            }

            $path = 'uploads/sponsor/';

            $file->move($path, $imagename);

            $main_image = $path.$imagename;

        }else{
            $main_image = $sponsor->image;
        }


        $sponsor->title = $request->title;
        $sponsor->url = $request->url;
        $sponsor->image = $main_image;
        $sponsor->save();

        toast('Your sponsor successfully updated','success');

        return redirect()->route('admin.sponsor.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sponsor = Sponsor::find($id);
        if(file_exists($sponsor->image))
        {
            unlink($sponsor->image);
        }
        $sponsor->delete();
        toast('Your sponsor successfully deleted','success');
        return back();
    }
}
