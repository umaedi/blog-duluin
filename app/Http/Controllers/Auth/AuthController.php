<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\DashboardController as Controller;
use App\Providers\RouteServiceProvider;
 

class AuthController extends Controller
{

	 
	protected $redirectTo = RouteServiceProvider::HOME;
	
    public function login()
    {
        $data['page_title']   = 'Login Administrator';
		//$data['user']    = Auth::user();

		
		$meta	= self::meta();
		$data	= array_merge($meta, $data);
		  
		return view('auth.login',compact('data'));
		
    }
	
	public function forgot_password()
    {
        $data['page_title']   = 'Lupa Password';
		//$data['user']    = Auth::user();

		
		$meta	= self::meta();
		$data	= array_merge($meta, $data);
		  
		return view('auth.lupa-password',compact('data'));
		 
    }
	
	public function reset_password()
    {
        $data['page_title']   = 'Reset Password';
		//$data['user']    = Auth::user();

		
		$meta	= self::meta();
		$data	= array_merge($meta, $data);
		  
		return view('auth.reset-password',compact('data'));
		 
    }
	
	public function signout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
		
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}

