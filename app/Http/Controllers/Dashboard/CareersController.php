<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\DashboardController as Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CareersController extends Controller
{

    // function __construct()
    // {
	// 	 $this->middleware('permission:Melihat_Daftar_Role', ['only' => ['index']]);
    // }
    
    public function index(){

        $data['page_title']   = 'Careers List';
		$data['user']    = Auth::user();
		
		$meta	= self::meta();
		$data	= array_merge($meta, $data);
		  
		return view('dashboard.careers.index',compact('data'));
		
    }
	
    public function detail($id){
		$data['page_title']   = 'Detail Career';
		$data['user']    = Auth::user();
		$data['career_id']    = $id;

		 
		$meta	= self::meta();
		$data	= array_merge($meta, $data);

		return view('dashboard.careers.detail',compact('data'));	
	}
	
	public function create(){
		$data['page_title']   = 'Create Career';
		$data['user']    = Auth::user();

		 
		$meta	= self::meta();
		$data	= array_merge($meta, $data);

		return view('dashboard.careers.create',compact('data'));	
	}
	
	public function update($id){
		$data['page_title']   = 'Update Career';
		$data['user']    = Auth::user();
		$data['career_id']    = $id;

		 
		$meta	= self::meta();
		$data	= array_merge($meta, $data);

		return view('dashboard.careers.create',compact('data'));	
	}
    
    
}
