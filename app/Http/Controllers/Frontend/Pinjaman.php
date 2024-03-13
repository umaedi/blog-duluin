<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\Meta as Controller;
use App\Models\Setting as model_setting;
class Pinjaman extends Controller
{
    //
	public function index(){	
	
		$data['title']  = 'Halaman Pinjaman';
		$meta	= self::meta();
		
		$data	= array_merge($meta, $data) ;
		
		return view('frontend/content/pinjaman/index',compact('data'));	
	}
	
	public function tata_cara(){			
		$data['title']  = 'Tahapan Peminjaman';
		
		$meta	= self::meta();
		$data	= array_merge($meta, $data) ;
		
		return view('frontend/content/pinjaman/tata_cara',compact('data'));	
	}
	
 
}
