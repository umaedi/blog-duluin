<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\DashboardController as Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{

    function __construct(){
	// 	 $this->middleware('permission:Melihat_Daftar_Role', ['only' => ['index']]);
    }
    
    public function index(){

        $data['page_title']   = 'Activity List';
		$data['user']    = Auth::user();
		//$role = Role::findByName('Super User', 'sanctum');
		//$data['user']->guard_name = 'sanctum';
		//$data['user']->assignRole($role); 
		$meta	= self::meta();
		$data	= array_merge($meta, $data);
		  
		return view('dashboard.activity.index',compact('data'));
		
    }
	
}
