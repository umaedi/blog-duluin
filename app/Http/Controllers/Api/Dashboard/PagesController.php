<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Api as Controller;
use App\Models\Dashboard\Pages;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;
use Image;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
	function __construct()
    {
		//$this->middleware('permission:Melihat Daftar Role', ['only' => ['index']]);
		//$this->middleware('permission:Melihat Informasi Role', ['only' => ['view']]);
		//$this->middleware('permission:Menambah Informasi Role', ['only' => ['create']]);
		//$this->middleware('permission:Merubah Informasi Role', ['only' => ['update']]);
		//$this->middleware('permission:Menghapus Informasi Role', ['only' => ['delete']]);
	}
	
    public function index(Request $request) {

		 
		$draw 		= $request->input('draw');
		$status		= $request->input('status') ?: $status = ''; 
		$month		= $request->input('month') ?: $month = '';
		$year		= $request->input('year') ?: $year = '';
		$offset		= $request->input('start'); if ($offset == ''){$offset = 0; };
		$limit		= $request->input('length'); if ($limit == ''){$limit = 25; };
		$search		= $request->input('search')['value']; if ($search == ''){$search = ''; };		
		$order		= $request->input('order')[0]['column']; 
		$sort 		= $request->input('order')[0]['dir']; if ($sort == ''){$sort = 'DESC'; };
		$columns	= $request->input('columns')[$order]['data'];  if ($columns == ''){$columns = 'created_at'; };

		$query 	= Pages::query();
		$query = $query->select(
            'pages.*',
            
            'users.id as creator_id',
            'users.name as creator_name',
        );
		
		$query = $query->leftJoin('users', 'pages.created_by', '=', 'users.id');
		
		//$query 	= $query->with('creator');
		//$query 	= $query->with('publisher');
		$query 	= $query->orderBy($columns, $sort);
		if ($search != '') {
		$query	= $query->where('pages.title', 'like', '%'.$search.'%');
		}
		
		if ($status != '') {
		$query	= $query->where('pages.status', $status);
		}
		
		if ($year != '') {
			$query = $query->whereYear('pages.created_at', $year);
			if ($month != '') {
			$query = $query->whereMonth('pages.created_at', $month);
			 
			} 
		}
		
		$total	= $query->count();
		$query	= $query->offset($offset);
		$query	= $query->limit($limit);
		$data	= $query->get();
		
		$result['draw']           = $draw ;
		$result['recordsTotal']   = count($data);
		$result['recordsFiltered']= $total;
		$result['data'] = $data;
		
		return  $this->sendResponseOk($result);
		
    }
	
	public function list() {

		$query 	= Pages::query();
		$query 	= $query->where('status', 'publish');
		
		$result['pages'] = $query->get();
		
		return $this->sendResponseOk($result);
		
    }
	
	public function detail(Request $request) {
		$validator = Validator::make($request->all(), [
			'id' => 'required',
		]);
		
		if($validator->fails()){
            return $this->sendResponseError(json_encode($validator->errors()));       
		}
		$query 	= Pages::query();
		$query 	= $query->with('creator');
		$query 	= $query->where('id', $request->id);
		$query	= $query->first();
		
		$result['pages'] = $query;
		
		return $this->sendResponseOk($result);
		
    }
	
	public function verify(Request $request) {
		$validator = Validator::make($request->all(), [
			'id' => 'required',
			'type' => 'required',
		]);
		
		if($validator->fails()){
            return $this->sendResponseError(json_encode($validator->errors()));       
		}
		
		$query 	= Pages::find($request->id);
		$query->status = $request->type;
		$query->save();
		
		$result = $query->refresh();
		
		return $this->sendResponseOk($result);
		
    }
	
	public function create(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'title' => 'required',
			'content' => 'required',
		]);
		
		if($validator->fails()){
            return $this->sendResponseError(json_encode($validator->errors()));       
		}
		
		$query = new Pages;
		$query->title = $request->title;
		$query->slug = Str::slug($request->title);
		$query->content = $request->content;
		$query->keyword = $request->keyword;
		$query->description = $request->description;
		$query->created_by = Auth::user()->id;
		$query->status = 'unpublish';		
		$query->save();
		
		$result = $query->refresh();
		
		return $this->sendResponseCreate($result);
	}
	
	public function update(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'title' => 'required',
			'content' => 'required',
		]);
		
		if($validator->fails()){
            return $this->sendResponseError(json_encode($validator->errors()));       
		}
		
		$query = Pages::find($request->id);
		$query->title = $request->title;
		$query->slug = Str::slug($request->title);
		$query->content = $request->content;
		$query->keyword = $request->keyword;
		$query->description = $request->description;
		$query->created_by = Auth::user()->id;
		$query->status = 'unpublish';
		$query->save();
		
		$result = $query->refresh();
		
		return $this->sendResponseUpdate($result);
	}
	
	public function delete(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'id' => 'required',
            
		]);
		
		if($validator->fails()){
            return $this->sendResponseError(json_encode($validator->errors()));       
		}

		$query = Pages::find($request->id);
		$result = $query->delete();
		 
		
		return $this->sendResponseDelete($result);
	}
	

}
