<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Option;
use Carbon\Carbon;
use File;
use Illuminate\Support\Str;

class SiteController extends Controller
{
    public function index()
    {
        $per_link = Option::where('key','per_link')->first()->value;
        $per_impression = Option::where('key','per_impression')->first()->value;
        $author_get_per_impression = Option::where('key','author_get_per_impression')->first()->value;
        $author_get_per_link = Option::where('key','author_get_per_link')->first()->value;
        $ads_show_per_second = Option::where('key','ads_show_per_second')->first()->value;
        $languages = file_get_contents(resource_path('json/lang.json'));
        $langs = json_decode($languages);
    	$get_data = Option::where('key','site_value')->first();
    	$info = json_decode($get_data->value);
        $currency_code = Option::where('key','currency')->first();
        $currency_value = json_decode($currency_code->value);
    	return view('admin.settings.sitesetttings',compact('info','langs','currency_value','per_link','per_impression','author_get_per_impression','author_get_per_link','ads_show_per_second'));
    }

    public function update(Request $request)
    {

    	$get_data = Option::where('key','site_value')->first();
    	$info = json_decode($get_data->value);

    	$file = $request->file('dark_logo');
        if (isset($file)) {
            $curentdate = Carbon::now()->toDateString();
            $imagename =  $curentdate . '-' . uniqid() . '.' . $file->getClientOriginalExtension();

            if(file_exists($info->dark_logo))
            {
            	unlink($info->dark_logo);
            }

            $path = 'uploads/logo/';

            $file->move($path, $imagename);

            $darklogoname = $path.$imagename;

        }else{
            $darklogoname = $info->dark_logo;
        }

        $light_file = $request->file('light_logo');
        if (isset($light_file)) {
            $curentdate = Carbon::now()->toDateString();
            $imagename =  $curentdate . '-' . uniqid() . '.' . $light_file->getClientOriginalExtension();

            if(file_exists($info->light_logo))
            {
            	unlink($info->light_logo);
            }

            $path = 'uploads/logo/';

            $light_file->move($path, $imagename);

            $lightlogoname = $path.$imagename;

        }else{
            $lightlogoname = $info->light_logo;
        }


        $favicon_file = $request->file('favicon');
        if (isset($favicon_file)) {
            $curentdate = Carbon::now()->toDateString();
            $imagename =  $curentdate . '-' . uniqid() . '.' . $favicon_file->getClientOriginalExtension();

            if(file_exists($info->favicon))
            {
                unlink($info->favicon);
            }

            $path = 'uploads/favicon/';

            $favicon_file->move($path, $imagename);

            $faviconimage = $path.$imagename;

        }else{
            $faviconimage = $info->favicon;
        }


        $languages = file_get_contents(resource_path('json/lang.json'));
        $langs = json_decode($languages);
        foreach ($langs as $key => $value) {
           if($value->code == $request->default_language)
           {
                $main_lang = $value;
           }
        }
    	
    	$info->site_title = $request->site_title;
    	$info->site_name = $request->site_name;
    	$info->site_email = $request->site_email;
    	$info->site_description = $request->site_description;
    	$info->facebook_url = $request->facebook_url;
    	$info->twitter_url = $request->twitter_url;
    	$info->google_url = $request->google_url;
    	$info->dark_logo = $darklogoname;
    	$info->light_logo = $lightlogoname;
        $info->default_language = $request->default_language;
        $info->active_lang = $main_lang->name;
        $info->favicon = $faviconimage;
    	$get_data->value = json_encode($info);
    	$get_data->save();

        $currency_code = Option::where('key','currency')->first();
        $currency_value = json_decode($currency_code->value);
        $currency_value->code = $request->code;
        $currency_value->symbol = $request->symbol;
        $currency_code->value = json_encode($currency_value);
        $currency_code->save();

        $per_link = Option::where('key','per_link')->first();
        $per_link->value = $request->per_link;
        $per_link->save();

        $per_impression = Option::where('key','per_impression')->first();
        $per_impression->value = $request->per_impression;
        $per_impression->save();

        $ads_show_per_second = Option::where('key','ads_show_per_second')->first();
        $ads_show_per_second->value = $request->ads_show_per_second;
        $ads_show_per_second->save();

        $author_get_per_link = Option::where('key','author_get_per_link')->first();
        $author_get_per_link->value = $request->author_get_per_link;
        $author_get_per_link->save();

        $author_get_per_impression = Option::where('key','author_get_per_impression')->first();
        $author_get_per_impression->value = $request->author_get_per_impression;
        $author_get_per_impression->save();

        $APP_NAME = Str::slug($request->APP_NAME);
        $MAIL_FROM_NAME = Str::slug($request->MAIL_FROM_NAME);
        $txt ="APP_NAME=".$APP_NAME."
APP_ENV=".$request->APP_ENV."
APP_KEY=base64:kZN2g9Tg6+mi1YNc+sSiZAO2ljlQBfLC3ByJLhLAUVc=
APP_DEBUG=true
APP_URL=".$request->APP_URL."
LOG_CHANNEL=stack\n
DB_CONNECTION=mysql
DB_HOST=".$request->DB_HOST."
DB_PORT=3306
DB_DATABASE=".$request->DB_DATABASE."
DB_USERNAME=".$request->DB_USERNAME."
DB_PASSWORD=".$request->DB_PASSWORD."\n
BROADCAST_DRIVER=log
CACHE_DRIVER=array
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120\n
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379\n
MAIL_DRIVER=".$request->MAIL_DRIVER."
MAIL_HOST=".$request->MAIL_HOST."
MAIL_PORT=".$request->MAIL_PORT."
MAIL_USERNAME=".$request->MAIL_USERNAME."
MAIL_PASSWORD=".$request->MAIL_PASSWORD."
MAIL_ENCRYPTION=".$request->MAIL_ENCRYPTION."
MAIL_FROM_ADDRESS=".$request->MAIL_FROM_ADDRESS."
MAIL_FROM_NAME=".$MAIL_FROM_NAME."\n
PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1\n
MIX_PUSHER_APP_KEY=
MIX_PUSHER_APP_CLUSTER=\n
PAYPAL_ID=".$request->PAYPAL_ID."
       ";
       File::put(base_path('.env'),$txt);

    	toast('Your site settings successfully updated','success');
    	return back();
    }
}
