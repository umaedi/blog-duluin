<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\DashboardController as Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Dashboard\Articles;
use App\Models\Dashboard\Categories;
use App\Models\User;
use App\Models\Dashboard\Careers;

class HomeController extends Controller
{
    
	public function index()
    {
        $data['page_title']   = 'Welcome to Dashboard';
		$data['user']    = Auth::user();
		$data['count_articles']    = Articles::count();
		$data['count_categories']    = Categories::count();
		$data['count_users']    = User::count();
		$data['count_careers']    = Careers::count();
		 
		$meta	= self::meta();
		$data	= array_merge($meta, $data);
		   
		return view('dashboard.index',compact('data'));
		
		
    }
	
	public function setting()
    {
        $data['page_title']   = 'Pengaturan Aplikasi';
		$data['user']    = Auth::user();

		
		$meta	= self::meta();
		$data	= array_merge($meta, $data);
		  
		return view('dashboard.setting',compact('data'));
		
		
    }
	
	public function account()
    {
        $data['page_title']   = 'Pengaturan Akun';
		$data['user']    = Auth::user();

		
		$meta	= self::meta();
		$data	= array_merge($meta, $data);
		  
		return view('dashboard.account',compact('data'));
		
		
    }
	
	public function email()
    {
        $data['page_title']   = 'Welcome to Dashboard';
		$data['user']    = Auth::user();
		
		$data = [
				'title' 			=> 'Notifikasi Transaksi',
				'name' 				=> 'andra',
				'to' 				=> 'ardiandra45@gmail.com',	 
				'transaction_id' 	=> '993847433',	 
				'transaction_name' 	=> 'Penarikan Gaji',	 
				'transaction_to' 		=> 'Penarikan Gaji',	 
				'amount' 			=> 'Rp 1.000.0000',	 
				'charge' 			=> 'Rp 0',	 
				'note' 				=> 'success',	 
				'transaction_date' => '1212-12-12',	 
			];
		

		 
		$meta	= self::meta();
		$data	= array_merge($meta, $data);
		   
		return view('emails.verify-email-user-theme',compact('data'));
		
		
    }
}
