<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Option;

class ModeController extends Controller
{
    public function mode()
    {
    	if(Session::has('mode'))
    	{
    		if(Session::get('mode')['id'] == 'night')
    		{
    			Session::put('mode',[
	    			'id' => 'day'
	    		]);
    			return "day";
    		}else{
    			Session::put('mode',[
	    			'id' => 'night'
	    		]);
    			return "night";
    		}
    	}else{
    		Session::put('mode',[
    			'id' => 'night'
    		]);
    		return "night";
    	}
    }

    public function logo_change()
    {
        if(Session::get('mode')['id'] == 'night')
        {
            $option = Option::where('key','site_value')->first();
            $option_value = json_decode($option->value);
            return $option_value->light_logo;
        }

        if(Session::get('mode')['id'] == 'day')
        {
            $option = Option::where('key','site_value')->first();
            $option_value = json_decode($option->value);
            return $option_value->dark_logo;
        }
    }
}
