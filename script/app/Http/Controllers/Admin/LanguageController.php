<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Language;

class LanguageController extends Controller
{
    public function index()
    {
        $languages = Language::orderBy('id','DESC')->get();
    	return view('admin.language.index',compact('languages'));
    }

    public function create()
    {
        $get_lang_file = file_get_contents(resource_path('json/lang.json'));
        $languages = json_decode($get_lang_file);
    	return view('admin.language.create',compact('languages'));
    }

    public function show($value='')
    {
    	# code...
    }

    public function edit($id)
    {
        $lang_file_get = file_get_contents(resource_path('lang/'.$id.'.json'));
        $language_values = json_decode($lang_file_get,true);
    	return view('admin.language.edit',compact('language_values','id'));
    }

    public function store(Request $request)
    {
        $get_lang_file = file_get_contents(resource_path('json/lang.json'));
        $languages = json_decode($get_lang_file);
        foreach($languages as $lang)
        {
            if($lang->code == $request->language)
            {
                $main_lang = $lang;
            }
        }
        $en_file_get = file_get_contents(resource_path('lang/en.json'));
        $en_data = json_decode($en_file_get);
        if(!file_exists(resource_path('lang/'.$request->language.'.json')))
        {
            file_put_contents(resource_path('lang/'.$request->language.'.json'), json_encode($en_data,JSON_PRETTY_PRINT));
            $language = new Language();
            $language->name = $main_lang->name;
            $language->code = $request->language;
            $language->save();
            toast('Language successfully created','success');
            return redirect()->route('admin.language.index');
        }else{
            toast('It already exists!','error');
            return back();
        }
    }

    public function update(Request $request,$id)
    {
        $lang_file_get = file_get_contents(resource_path('lang/'.$id.'.json'));
        $values = json_decode($lang_file_get,true);

        foreach($values as $key=>$value)
        {
            if($key == $request->key)
            {
                $values[$key] = $request->value;
            }
        }

        file_put_contents(resource_path('lang/'.$id.'.json'), json_encode($values,JSON_PRETTY_PRINT));
        toast('Value successfully updated','success');
        return "ok";
    }

    public function delete($code)
    {
        if(file_exists(resource_path('lang/'.$code.'.json')))
        {
            unlink(resource_path('lang/'.$code.'.json'));
        }

        Language::where('code',$code)->first()->delete();
        toast('Language successfully deleted','success');
        return back();
    }

    public function active(Request $request)
    {
        if(!$request->lang_code)
        {
            toast('Please select language','error');
            return back();
        }
        $languages = Language::all();
        foreach($languages as $value)
        {
            $language = Language::find($value->id);
            $language->status = 'deactive';
            $language->save();
        }
        foreach ($request->lang_code as $key => $value) {
            $lang = Language::where('code',$value)->first();
            $lang->status = 'active';
            $lang->save();
        }

        toast('Language successfully actived','success');
        return back();

    }
}
