<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\Meta as Controller;
use App\Models\Dashboard\Pages;
class Informasi extends Controller
{
    //
	public function index($slug){
		$title = ucwords(str_replace("-"," ",$slug));
		$data['title']  = $title;
		$query = Pages::query();
		$query = $query->where('status', 'publish');
		$query = $query->where('slug', $slug);
		$query = $query->first();
		$data['page']	= $query;
		
		$meta	= self::meta();
		$data	= array_merge($meta, $data) ;
		
		return view('frontend/content/informasi/index',compact('data'));	
	}
	
	public function laporan_keuangan(){			
		$data['title']  = 'Laporan Keuangan';
		
		$meta	= self::meta();
		$data	= array_merge($meta, $data) ;
		
		return view('frontend/content/informasi/laporan_keuangan',compact('data'));	
	}
	
	public function risk_disclaimer(){			
		$data['title']  = 'Risk Disclaimer';
		
		$meta	= self::meta();
		$data	= array_merge($meta, $data) ;
		
		return view('frontend/content/informasi/risk_disclaimer',compact('data'));	
	}
	
	public function statistik(){			
		$data['title']  = 'Statistik Lahan Sikam';
		
		$meta	= self::meta();
		$data	= array_merge($meta, $data) ;
		
		return view('frontend/content/informasi/statistik',compact('data'));	
	}
	

	
 
}
