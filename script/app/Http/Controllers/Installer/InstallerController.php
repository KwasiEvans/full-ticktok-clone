<?php

namespace App\Http\Controllers\Installer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Str;
use DB;
use Illuminate\Support\Facades\Http;

class InstallerController extends Controller
{
    public function index()
    {
        try {
          DB::connection()->getPdo();
          if(DB::connection()->getDatabaseName()){
            return redirect()->route(404);
          }else{
            return view('installer.index');
          }
        } catch (\Exception $e) {
            return view('installer.index');
        }
    }

    public function configuration()
    {
        try {
          DB::connection()->getPdo();
          if(DB::connection()->getDatabaseName()){
            return redirect()->route(404);
          }else{
            return view('installer.configuration');
          }
        } catch (\Exception $e) {
            return view('installer.configuration');
        }
    }

    public function complete()
    {
    	return view('installer.complete');
    }


     public function send(Request $request)
    {

        $APP_NAME = Str::slug($request->app_name);
        $PUSHER_APP_KEY = $request->PUSHER_APP_KEY;
        $PUSHER_APP_CLUSTER = $request->PUSHER_APP_CLUSTER;
        $txt ="APP_NAME=".$APP_NAME."
APP_ENV=local
APP_KEY=base64:kZN2g9Tg6+mi1YNc+sSiZAO2ljlQBfLC3ByJLhLAUVc=
APP_DEBUG=true
APP_URL=".$request->app_url."
LOG_CHANNEL=stack\n
DB_CONNECTION=mysql
DB_HOST=".$request->db_host."
DB_PORT=3306
DB_DATABASE=".$request->db_name."
DB_USERNAME=".$request->db_user."
DB_PASSWORD=".$request->db_pass."\n
BROADCAST_DRIVER=log
CACHE_DRIVER=array
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120\n
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379\n
MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=
MAIL_FROM_NAME=\n
PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1\n
MIX_PUSHER_APP_KEY=
MIX_PUSHER_APP_CLUSTER=\n
PAYPAL_ID=
       ";
       File::put(base_path('.env'),$txt);
       return "Sending Credentials";
    }


    public function check()
    {
        try {
          DB::connection()->getPdo();
            if(DB::connection()->getDatabaseName()){
                return "Database Installing";
            }else{
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
        
    }

    public function verify_check(Request $request)
    {
		return redirect()->route('install.configuration');
    }

    public function verify()
    {
        return view('installer.verify');
    }

    public function migrate()
    {
        ini_set('max_execution_time', '0');
        \Artisan::call('migrate:fresh');
        return "Demo Importing";
    }

    public function seed()
    {
        ini_set('max_execution_time', '0');
        \Artisan::call('db:seed');
        return "Congratulations! Your site is ready";
    }
}
