<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Api as Controller;
use App\Models\Dashboard\Applicants;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;
use Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ApplicantsController extends Controller
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
		$career_id	= $request->input('career_id') ?: $career_id = '';
		$year		= $request->input('year') ?: $year = '';
		$offset		= $request->input('start'); if ($offset == ''){$offset = 0; };
		$limit		= $request->input('length'); if ($limit == ''){$limit = 25; };
		$search		= $request->input('search')['value']; if ($search == ''){$search = ''; };		
		$order		= $request->input('order')[0]['column']; 
		$sort 		= $request->input('order')[0]['dir']; if ($sort == ''){$sort = 'DESC'; };
		$columns	= $request->input('columns')[$order]['data'];  if ($columns == ''){$columns = 'created_at'; };

		$query 	= Applicants::query();
		
		$query 	= $query->orderBy($columns, $sort);
		if ($career_id != '') {
		$query	= $query->with('career');
		$query	= $query->where('career_id', $career_id);
		}
		if ($search != '') {
		$query	= $query->where('name', 'like', '%'.$search.'%');
		}
		
		if ($status != '') {
		$query	= $query->where('status', $status);
		}
		
		if ($year != '') {
			$query = $query->whereYear('created_at', $year);
			if ($month != '') {
			$query = $query->whereMonth('created_at', $month);
			 
			} 
		}
		
		$total	= $query->count();
		$query	= $query->offset($offset);
		$query	= $query->limit($limit);
		$query	= $query->get();
		$data	= [];
		
		foreach($query as $key=>$val){
			$data[$key] = $val;
			$data[$key]->document_url = asset('documents/file/careers/'.$val->document);
			
		}
		
		$result['draw']           = $draw ;
		$result['recordsTotal']   = count($query);
		$result['recordsFiltered']= $total;
		$result['data'] = $data;
		
		return  $this->sendResponseOk($result);
		
    }
	
	public function list_by_career() {

		$validator = Validator::make($request->all(), [
			'career_id' => 'required',
		]);
		
		if($validator->fails()){
            return $this->sendResponseError(json_encode($validator->errors()));       
		}
		
		$draw 		= $request->input('draw');
		$status		= $request->input('status') ?: $status = ''; 
		$career_id		= $request->input('career_id') ?: $career_id = '';
		$offset		= $request->input('start'); if ($offset == ''){$offset = 0; };
		$limit		= $request->input('length'); if ($limit == ''){$limit = 25; };
		$search		= $request->input('search')['value']; if ($search == ''){$search = ''; };		
		$order		= $request->input('order')[0]['column']; 
		$sort 		= $request->input('order')[0]['dir']; if ($sort == ''){$sort = 'DESC'; };
		$columns	= $request->input('columns')[$order]['data'];  if ($columns == ''){$columns = 'created_at'; };

		$query 	= Applicants::query();
		
		$query 	= $query->orderBy($columns, $sort);
		$query 	= $query->where('career_id', $career_id);
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
		
		return $this->sendResponseOk($result);
		
    }
	
	public function detail(Request $request) {
		$validator = Validator::make($request->all(), [
			'id' => 'required',
		]);
		
		if($validator->fails()){
            return $this->sendResponseError(json_encode($validator->errors()));       
		}
		
		$query 	= Applicants::query();
		//$query 	= $query->with('career');
		
		$result['careers'] = $query;
		
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
		
		$query 	= Applicants::find($request->id);
		$query->status = $request->type;
		$query->save();
		
		$result = $query->refresh();
		
		return $this->sendResponseOk($result);
		
    }

}
