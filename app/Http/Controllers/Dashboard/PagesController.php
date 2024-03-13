<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\DashboardController as Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{

    // function __construct()
    // {
	// 	 $this->middleware('permission:Melihat_Daftar_Role', ['only' => ['index']]);
    // }
    
    public function index(){

        $data['page_title']   = 'Page List';
		$data['user']    = Auth::user();
		
		$meta	= self::meta();
		$data	= array_merge($meta, $data);
		  
		return view('dashboard.pages.index',compact('data'));
		
    }
	
    public function detail($id){
		$data['page_title']   = 'Detail Page';
		$data['user']    = Auth::user();
		$data['page_id']    = $id;

		 
		$meta	= self::meta();
		$data	= array_merge($meta, $data);

		return view('dashboard.pages.detail',compact('data'));	
	}
	
	public function create(){
		$data['page_title']   = 'Create Page';
		$data['user']    = Auth::user();

		 
		$meta	= self::meta();
		$data	= array_merge($meta, $data);

		return view('dashboard.pages.create',compact('data'));	
	}
	
	public function update($id){
		$data['page_title']   = 'Update Page';
		$data['user']    = Auth::user();
		$data['page_id']    = $id;

		 
		$meta	= self::meta();
		$data	= array_merge($meta, $data);

		return view('dashboard.pages.create',compact('data'));	
	}
    
    
}
