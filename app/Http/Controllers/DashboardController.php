<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dashboard\Setting;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
	public function User()
    {
        return Auth::user();
    }
	
	public static function Meta(){
		
		$setting = Setting::first();
		$setting->url_logo						= asset('/assets/images/web/'.$setting->logo);
		 

		foreach($setting->toArray() as $key=>$val){
			$result[$key] = $val;
		}
		
		return $result;

	}
	
	
}
