<?php

namespace App\Http\Controllers\Admin;

use App\Page;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::latest()->paginate(20);
        return view('admin.page.index',compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.page.create');
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
            'description' => 'required'
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

            $path = 'uploads/page/';

            $file->move($path, $imagename);

            $main_image = $path.$imagename;

        }else{
            $main_image = 'default.png';
        }

        $page = new Page();
        $page->title = $request->title;
        $page->description = $request->description;
        $page->image = $main_image;
        $page->save();

        toast('Your page successfully created','success');


        return redirect()->route('admin.page.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        return view('admin.page.edit',compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        $validator = \Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required'
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

            if(file_exists($page->image))
            {
                unlink($page->image);
            }

            $path = 'uploads/page/';

            $file->move($path, $imagename);

            $main_image = $path.$imagename;

        }else{
            $main_image = $page->image;
        }

        $page->title = $request->title;
        $page->description = $request->description;
        $page->image = $main_image;
        $page->save();

        toast('Your page successfully updated','success');


        return redirect()->route('admin.page.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::find($id);
        if(file_exists($page->image))
        {
            unlink($page->image);
        }
        $page->delete();
        toast('Your page successfully deleted','success');
        return back();
    }
}
