<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\DashboardController as Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
	function __construct()
    {
		 //$this->middleware('permission:Melihat_Pengaturan_Website', ['only' => ['indexWebsiteGlobal']]);
		//$this->middleware('permission:Merubah Pengaturan', ['only' => ['index']]);
	}

	public function index(){
		
		$data['page_title']   = 'Welcome to Dashboard';
		$data['user']    = Auth::user();

		
		//dd(Auth::user()->getRoleNames());
		$meta	= self::meta();
		$data	= array_merge($meta, $data);
		  
		return view('dashboard.setting',compact('data'));
	}

	
}
