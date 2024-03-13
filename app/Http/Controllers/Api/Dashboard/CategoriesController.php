<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Api as Controller;
use App\Models\Dashboard\Categories;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
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
		$offset		= $request->input('start'); if ($offset == ''){$offset = 0; };
		$limit		= $request->input('length'); if ($limit == ''){$limit = 25; };
		$search		= $request->input('search')['value']; if ($search == ''){$search = ''; };		
		$order		= $request->input('order')[0]['column']; 
		$sort 		= $request->input('order')[0]['dir']; if ($sort == ''){$sort = 'ASC'; };
		$columns	= $request->input('columns')[$order]['data'];  if ($columns == ''){$columns = 'name'; };

		$query 	= Categories::query();
		
		$query 	= $query->with('user');
		$query 	= $query->orderBy($columns, $sort);
		if ($search != '') {
		$query	= $query->where('name', 'like', '%'.$search.'%');
		}
		if ($status != '') {
		$query	= $query->where('status', $status);
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
	
	public function list_all() {

		$query 	= Categories::query();
		$query 	= $query->where('status', 'publish');
		
		$result['categories'] = $query->get();
		
		return $this->sendResponseOk($result);
		
    }
	
	public function create(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'name' => 'required',
			'status' => 'required',
		]);
		
		if($validator->fails()){
            return $this->sendResponseError(json_encode($validator->errors()));       
		}
		
		$tag = new Categories;
		$tag->name = $request->name;
		$tag->status = $request->status;
		$tag->created_by = Auth::user()->id;
		
		$result = $tag->save();
		
		return $this->sendResponseCreate($result);
	}
	
	public function update(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'id' => 'required',
			'name' => 'required',
			'status' => 'required',
		]);
		
		if($validator->fails()){
            return $this->sendResponseError(json_encode($validator->errors()));       
		}
		
		$tag = Categories::find($request->id);
		$tag->name = $request->name;
		$tag->status = $request->status;
		$tag->created_by = Auth::user()->id;
		
		$result = $tag->save();
		
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

		$query = Categories::find($request->id);
		$result = $query->delete();
		 
		
		return $this->sendResponseDelete($result);
	}
	

}
