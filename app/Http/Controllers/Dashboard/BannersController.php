<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\DashboardController as Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BannersController extends Controller
{

    // function __construct()
    // {
	// 	 $this->middleware('permission:Melihat_Daftar_Role', ['only' => ['index']]);
    // }
    
    public function index(){

        $data['page_title']   = 'Banner List';
		$data['user']    = Auth::user();
		
		$meta	= self::meta();
		$data	= array_merge($meta, $data);
		  
		return view('dashboard.banners.index',compact('data'));
		
    }
	
    public function create(){
		$data['page_title']   = 'Create Banner';
		$data['user']    = Auth::user();

		 
		$meta	= self::meta();
		$data	= array_merge($meta, $data);

		return view('dashboard.banners.create',compact('data'));	
	}
	
	public function update($id){
		$data['page_title']   = 'Update Banner';
		$data['user']    = Auth::user();
		$data['banner_id']    = $id;

		 
		$meta	= self::meta();
		$data	= array_merge($meta, $data);

		return view('dashboard.banners.create',compact('data'));	
	}
    
    
}
