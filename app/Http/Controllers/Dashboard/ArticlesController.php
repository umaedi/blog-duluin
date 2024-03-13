<?php
namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\DashboardController as Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticlesController extends Controller
{

    // function __construct()
    // {
	// 	 $this->middleware('permission:Melihat_Daftar_Role', ['only' => ['index']]);
    // }
    
    public function index(){

        $data['page_title']   = 'Articles List';
		$data['user']    = Auth::user();
		
		$meta	= self::meta();
		$data	= array_merge($meta, $data);
		  
		return view('dashboard.articles.index',compact('data'));
		
    }
	
	public function todo_list(){

        $data['page_title']   = 'Todo List';
		$data['user']    = Auth::user();
		
		$meta	= self::meta();
		$data	= array_merge($meta, $data);
		  
		return view('dashboard.articles.todo_list',compact('data'));
		
    }
	
    public function detail($id){
		$data['page_title']   = 'Detail Article';
		$data['user']    = Auth::user();
		$data['article_id']    = $id;

		 
		$meta	= self::meta();
		$data	= array_merge($meta, $data);

		return view('dashboard.articles.detail',compact('data'));	
	}
	
	public function create(){
		$data['page_title']   = 'Create Article';
		$data['user']    = Auth::user();

		 
		$meta	= self::meta();
		$data	= array_merge($meta, $data);

		return view('dashboard.articles.create',compact('data'));	
	}
	
	public function update($id){
		$data['page_title']   = 'Update Article';
		$data['user']    = Auth::user();
		$data['article_id']    = $id;

		 
		$meta	= self::meta();
		$data	= array_merge($meta, $data);

		return view('dashboard.articles.create',compact('data'));	
	}
    
    
}
