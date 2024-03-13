<?php

namespace App\Http\Controllers\Api\Dashboard;
use App\Http\Controllers\Api as Controller;
//use \Spatie\Permission\Models\Permission;
//use \Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Dashboard\Employees;
use App\Models\Dashboard\Companies;
use Spatie\Activitylog\Models\Activity;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
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
		$offset		= $request->input('start'); if ($offset == ''){$offset = 0; };
		$limit		= $request->input('length'); if ($limit == ''){$limit = 25; };
		$search		= $request->input('search')['value']; if ($search == ''){$search = ''; };		
		$order		= $request->input('order')[0]['column']; 
		$sort 		= $request->input('order')[0]['dir']; if ($sort == ''){$sort = 'ASC'; };
		$columns	= $request->input('columns')[$order]['data'];  if ($columns == ''){$columns = 'id'; };

		$query 	= Activity::query();
		$query 	= $query->orderBy($columns, $sort);
		$query 	= $query->where('description', 'like', '%'.$search.'%');
		$total 	= $query->count();
		
		$query 	= $query->offset($offset);
		$query 	= $query->limit($limit);
		$data 	= $query->get();
		$return	= [];
		foreach($data as $key=>$val){
			$return[$key] = $val;
			$causer	= null;
			$subject	= null;
			if($val->causer_type == 'App\Models\User'){
				$causer	= User::where('id', $val->causer_id)->pluck('name');
			}else if($val->causer_type == 'App\Models\Dashboard\Employees'){
				$causer	= Employees::where('id', $val->causer_id)->pluck('name');
			}else if($val->causer_type == 'App\Models\Dashboard\Companies'){
				$causer	= Companies::where('id', $val->causer_id)->pluck('company_name');
			}
			
			 
			 
			$return[$key]->causer = $causer;
			$return[$key]->subject = json_encode(Activity::find($val->id)->subject);
		}			
		 
		$result['draw']           = $draw ;
		$result['recordsTotal']   = count($data);
		$result['recordsFiltered']= $total;
		$result['data'] = $return;
		
		return  $this->sendResponseOk($result);
		
    }
	
	
	public function delete(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'id' => 'required',
			'name' => 'required',
            
		]);
		if($validator->fails()){
            return $this->sendResponseError(json_encode($validator->errors()), $validator->errors());       
		}

		$permission = Permission::find($request->id);
		 
		
		return $this->sendResponseError('NON AUTHORITY');
	}
	

}
