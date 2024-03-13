<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\DashboardController as Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RolesController extends Controller
{

    // function __construct()
    // {
	// 	 $this->middleware('permission:Melihat_Daftar_Role', ['only' => ['index']]);
    // }
    
    public function index(){

        $data['page_title']   = 'Roles List';
		$data['user']    = Auth::user();

		 
		$meta	= self::meta();
		$data	= array_merge($meta, $data);
		  
		return view('dashboard.roles.index',compact('data'));
		
    }

    public function create(){
		$data['page_title']   = 'Create Roles';
		$data['user']    = Auth::user();

		 
		$meta	= self::meta();
		$data	= array_merge($meta, $data);

		return view('dashboard.roles.create',compact('data'));	
	}
    
    public function view($id){
        
        $data['page_title']   = 'Roles has Permission';
		$data['user']    = Auth::user();

		 
		$meta	= self::meta();
		$data	= array_merge($meta, $data);

		return view('dashboard.roles.view',compact('data'));
    }
}
