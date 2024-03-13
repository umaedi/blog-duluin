<?php

namespace App\Http\Controllers\Api\Dashboard;
use App\Http\Controllers\Api as Controller;

use \App\Models\Dashboard\Companies;
use \App\Models\Dashboard\Employees;
use \App\Models\Dashboard\Leads;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;

class CompaniesController extends Controller
{
	function __construct()
    {
		//$this->middleware(['permission:company-approval'], ['only' => ['verify']]);
	}
	
    public function index(Request $request) {

		 
		$draw 		= $request->input('draw');
		$is_approved= $request->input('is_approved'); if ($is_approved == ''){$is_approved = ''; };
		$offset		= $request->input('start'); if ($offset == ''){$offset = 0; };
		$limit		= $request->input('length'); if ($limit == ''){$limit = 25; };
		$search		= $request->input('search')['value']; if ($search == ''){$search = ''; };		
		$order		= $request->input('order')[0]['column']; 
		$sort 		= $request->input('order')[0]['dir']; if ($sort == ''){$sort = 'DESC'; };
		$columns	= $request->input('columns')[$order]['data'];  if ($columns == ''){$columns = 'id'; };
		
		$query = Companies::query();
		if ($search != '') {
			$query = $query->where('company_name', 'like', '%'.$search.'%');
		}
		if ($is_approved != '') {
			$query = $query->where('is_approved', $is_approved);
		}else{
			$query = $query->where('is_approved', '!=', 'rejected');
			$query = $query->orderBy('is_approved');
		}
			$query = $query->offset($offset);
			$query = $query->limit($limit);
			$query = $query->get();
		
		$data = [];
		foreach($query as $key=>$val){
			$data[$key] = $val;
			$data[$key]->leeds_total = Leads::where('company_id', $val->id)->count();
			$data[$key]->loan_employees_total = Employees::where('company_id', $val->id)->where('is_approved', 'borrower')->count();
			 
		}
			
		$count = Companies::query();
		if ($search != '') {
			$count = $count->where('company_name', 'like', '%'.$search.'%');
		}
		if ($is_approved != '') {
			$count = $count->where('is_approved', $is_approved);
		}	
			$count = $count->count();		
		
		
		$result['draw']           = $draw ;
		$result['recordsTotal']   = $count;
		$result['recordsFiltered']= count($data);
		$result['data'] = $data;
		
		return  $this->sendResponseOk($result);
		
    }
	
	public function detail(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'id' => 'required',
		]);
		
		if($validator->fails()){
            return $this->sendResponseError(json_encode($validator->errors()), $validator->errors());       
		}
		
		$Companies = Companies::find($request->id);
		
		return $this->sendResponseOk($Companies);
	}
	
	public function verify(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'id' => 'required',
			'type' => 'required',
		]);
		
		if($validator->fails()){
            return $this->sendResponseError(json_encode($validator->errors()), $validator->errors());       
		}
		
		//$input = Companies::find($request->id)->query();
		$query = Companies::query();
		if($request->type == 'approved'){
			
		$company	= $query->where('id', $request->id)->first();
		if($company->is_approved == 'signup'){
			return $this->sendResponseError('Verifikasi tidak dapat dilakukan, menunggu perusahaan melengkapi data', $validator->errors()); 
	
		}
		$input = $query->where('id', $request->id)->update([
			'is_approved'     => $request->type,
			'cash_loan_max'     => $request->cash_loan_max,
			'cash_loan_min'     => $request->cash_loan_min,
			'max_loan_percent'     => $request->max_loan_percent,
			'admin_fee'     => $request->admin_fee,
			'platform_fee'     => $request->platform_fee/100,
			'approved_by'     => Auth::user()->id,
			 
			]);
			
			
			
		}elseif($request->type == 'rejected'){
		$input = $query->where('id', $request->id)->update([
			'is_approved'     => $request->type,
			'approved_by'     => Auth::user()->id,
			'reason'   		  => $request->reason,
			]);
		}elseif($request->type == 'disabled'){
		$input = $query->where('id', $request->id)->update([
			'banned'   		  => $request->type,
			'banned_reason'   => $request->reason,
			]);
		}
		
		return $this->sendResponseUpdate($input);
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

		$permission = Companies::find($request->id);
		 
		
		return $this->sendResponseError('NON AUTHORITY');
	}
	
	public function companies_list()
	{
		 
		$Companies = Companies::select(
				'id',
				'company_name')
			->groupBy('id')
			->groupBy('company_name')
			->get();
		
		return $this->sendResponseOk($Companies);
	}

}
