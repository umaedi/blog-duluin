<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\DashboardController as Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
	function __construct()
    {
		//$this->middleware('permission:Melihat Daftar User', ['only' => ['index']]);
		//$this->middleware('permission:Membuat User', ['only' => ['create']]);
		//  $this->middleware('permission:Mengubah_Data_Diri', ['only' => ['profile']]);
		//  $this->middleware('permission:Melihat_Daftar_User', ['only' => ['index']]);
	}
    //
	public function index(){
		
		$data['page_title']   = 'Users List';
		$data['user']    = Auth::user();
		
		$meta	= self::meta();
		$data	= array_merge($meta, $data) ;

		return view('dashboard.users.index',compact('data'));
	}
	
	public function view(){
		
		$data['page_title']   = 'Detail User';
		$data['user']    = Auth::user();
		
		$meta	= self::meta();
		$data	= array_merge($meta, $data) ;

		return view('dashboard.users.view',compact('data'));
	}

	public function permission(){
		
		$data['page_title']   = 'Permission User';
		$data['user']    = Auth::user();
		
		$meta	= self::meta();
		$data	= array_merge($meta, $data) ;

		return view('dashboard.users.permission',compact('data'));
	}
	
	public function create(){
		$data['page_title']   = 'Register New User';
		$data['user']    = Auth::user();
		
		$meta	= self::meta();
		$data	= array_merge($meta, $data) ;

		return view('dashboard.users.create',compact('data'));	
	}
	
	public function profile(){
		
		$data['page_title']   = 'Account Setting';
		$data['user']    = Auth::user();
		
		$meta	= self::meta();
		$data	= array_merge($meta, $data) ;

		return view('dashboard.users.profile',compact('data'));	
	}

	public function update(){
		$data['page_title']   = 'Update User';
		$data['user']    = Auth::user();
		
		$meta	= self::meta();
		$data	= array_merge($meta, $data) ;

		return view('dashboard.users.create',compact('data'));
	}

}