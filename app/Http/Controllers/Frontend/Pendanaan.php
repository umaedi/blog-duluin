<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\Meta as Controller;

class Pendanaan extends Controller
{
    
	public function index(){			
		$data['title']  = 'Halaman Pendanaan';
		
		$meta	= self::meta();
		$data	= array_merge($meta, $data) ;
		
		return view('frontend/content/pendanaan/index',compact('data'));	
	}
	
	public function informasi(){			
		$data['title']  = 'Informasi Pendanaan';
		
		$meta	= self::meta();
		$data	= array_merge($meta, $data) ;
		
		return view('frontend/content/pendanaan/keterbukaan_informasi',compact('data'));	
	}
	
	public function tata_cara(){			
		$data['title']  = 'Tahapan Pendanaan';
		
		$meta	= self::meta();
		$data	= array_merge($meta, $data) ;
		
		return view('frontend/content/pendanaan/tata_cara',compact('data'));	
	}
	
	public function Daftar(){			
		$data['title']  = 'Halaman Registrasi Akun Lender';
		
		$meta	= self::meta();
		$data	= array_merge($meta, $data) ;
		
		return view('frontend/content/pendanaan/registrasi',compact('data'));	
	}
	
	public function Login(){			
		$data['title']  = 'Halaman Login Lender';
		
		$meta	= self::meta();
		$data	= array_merge($meta, $data) ;
		
		return view('frontend/content/pendanaan/login',compact('data'));	
	}
	
	public function Reset_password(){			
		$data['title']  = 'Halaman Reset Password';
		
		$meta	= self::meta();
		$data	= array_merge($meta, $data) ;
		
		return view('frontend/content/pendanaan/reset_password',compact('data'));	
	}
	
	public function Registrasi(){			
		$data['title']  = 'Halaman Login Pendanaan';
		
		$meta	= self::meta();
		$data	= array_merge($meta, $data) ;
		
		return view('frontend/content/pendanaan/login',compact('data'));	
	}
 
}
