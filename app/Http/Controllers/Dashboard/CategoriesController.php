<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\DashboardController as Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{

    // function __construct()
    // {
	// 	 $this->middleware('permission:Melihat_Daftar_Role', ['only' => ['index']]);
    // }
    
    public function index(){

        $data['page_title']   = 'Categories List';
		$data['user']    = Auth::user();
		
		$meta	= self::meta();
		$data	= array_merge($meta, $data);
		  
		return view('dashboard.categories.index',compact('data'));
		
    }
	
    public function create(){
		$data['page_title']   = 'Create Category';
		$data['user']    = Auth::user();

		 
		$meta	= self::meta();
		$data	= array_merge($meta, $data);

		return view('dashboard.categories.create',compact('data'));	
	}
	
	public function update(){
		$data['page_title']   = 'Update Category';
		$data['user']    = Auth::user();

		 
		$meta	= self::meta();
		$data	= array_merge($meta, $data);

		return view('dashboard.categories.create',compact('data'));	
	}
    
    
}
