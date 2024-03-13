<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\DashboardController as Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenusController extends Controller
{

    // function __construct()
    // {
	// 	 $this->middleware('permission:Melihat_Daftar_Role', ['only' => ['index']]);
    // }
    
    public function index(){

        $data['page_title']   = 'Menu List';
		$data['user']    = Auth::user();
		
		$meta	= self::meta();
		$data	= array_merge($meta, $data);
		  
		return view('dashboard.menus.index',compact('data'));
		
    }
	
    public function create(){
		$data['page_title']   = 'Create Menu';
		$data['user']    = Auth::user();

		 
		$meta	= self::meta();
		$data	= array_merge($meta, $data);

		return view('dashboard.menus.create',compact('data'));	
	}
	
	public function update(){
		$data['page_title']   = 'Update Menu';
		$data['user']    = Auth::user();

		 
		$meta	= self::meta();
		$data	= array_merge($meta, $data);

		return view('dashboard.manus.create',compact('data'));	
	}
    
    
}
