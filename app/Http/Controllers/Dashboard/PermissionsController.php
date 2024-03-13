<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\DashboardController as Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class PermissionsController extends Controller
{

    // function __construct()
    // {
	// 	 $this->middleware('permission:Melihat_Daftar_Role', ['only' => ['index']]);
    // }
    
    public function index(){

        $data['page_title']   = 'Permission List';
		$data['user']    = Auth::user();
		//$role = Role::findByName('Super User', 'sanctum');
		//$data['user']->guard_name = 'sanctum';
		//$data['user']->assignRole($role); 
		$meta	= self::meta();
		$data	= array_merge($meta, $data);
		  
		return view('dashboard.permission.index',compact('data'));
		
    }
	
    public function create(){
		$data['page_title']   = 'Create Permission';
		$data['user']    = Auth::user();

		 
		$meta	= self::meta();
		$data	= array_merge($meta, $data);

		return view('dashboard.permission.create',compact('data'));	
	}
    
    public function view($id){
        
        $data['page_title']   = 'Roles has Permission';
		$data['user']    = Auth::user();

		 
		$meta	= self::meta();
		$data	= array_merge($meta, $data);

		return view('dashboard.roles.view',compact('data'));
    }
}
