<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Api as Controller;
use App\Models\Dashboard\Careers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;
use Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CareersController extends Controller
{
	function __construct()
    {
		$this->middleware('permission:career-create', ['only' => ['create']]);
		$this->middleware('permission:career-update', ['only' => ['update']]);
		$this->middleware('permission:career-publish', ['only' => ['verify']]);
		$this->middleware('permission:career-delete', ['only' => ['delete']]);
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

		$query 	= Careers::query();
		
		$query 	= $query->orderBy($columns, $sort);
		if ($search != '') {
		$query	= $query->where('position', 'like', '%'.$search.'%');
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
		$data	= $query->get();
		
		$result['draw']           = $draw ;
		$result['recordsTotal']   = count($data);
		$result['recordsFiltered']= $total;
		$result['data'] = $data;
		
		return  $this->sendResponseOk($result);
		
    }
	
	public function list() {

		$query 	= Careers::query();
		$query 	= $query->where('status', 'publish');
		
		$result['careers'] = $query->get();
		
		return $this->sendResponseOk($result);
		
    }
	
	public function detail(Request $request) {
		$validator = Validator::make($request->all(), [
			'id' => 'required',
		]);
		
		if($validator->fails()){
            return $this->sendResponseError(json_encode($validator->errors()));       
		}
		$query 	= Careers::query();
		//$query 	= $query->with('creator');
		$query 	= $query->where('id', $request->id);
		$query	= $query->first();
		$query->expired_at	= Carbon::parse($query->expired_at)->format('Y-m-d');
		
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
		
		$query 	= Careers::find($request->id);
		$query->status = $request->type;
		$query->save();
		
		$result = $query->refresh();
		
		return $this->sendResponseOk($result);
		
    }
	
	public function create(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'position' => 'required',
			'description' => 'required',
		]);
		
		if($validator->fails()){
            return $this->sendResponseError(json_encode($validator->errors()));       
		}
		
		$query = new Careers;
		$query->position = $request->position;
		$query->slug = Str::slug($request->position);
		$query->description = $request->description;
		$query->type = $request->type;
		$query->experience = $request->experience;
		$query->img = $request->userFile;
		$query->expired_at = $request->expired_at;
		$query->status = 'unpublish';		
		$query->save();
		
		$result = $query->refresh();
		
		return $this->sendResponseCreate($result);
	}
	
	public function update(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'position' => 'required',
			'description' => 'required',
		]);
		
		if($validator->fails()){
            return $this->sendResponseError(json_encode($validator->errors()));       
		}
		
		$query = Careers::find($request->id);
		$query->position = $request->position;
		$query->slug = Str::slug($request->position);
		$query->description = $request->description;
		$query->type = $request->type;
		$query->experience = $request->experience;
		$query->img = $request->userFile;
		$query->expired_at = $request->expired_at;
		
		$query->save();
		
		$result = $query->refresh();
		
		return $this->sendResponseUpdate($result);
	}
	
	private function uploadImg($request){
		if($request->hasfile('userFile')){
			if(!empty($request->id)){
				$query = Careers::find($request->id)->first();
				$this->deleteImg($query->img);
			}
			$originalImage  = $request->file('userFile');
			$extension 		= $originalImage->getClientOriginalExtension();
			
			$imageFile      = Image::make($originalImage);
			$originalPath   = public_path('/assets/images/careers/');
			$time           = time();
			$newName		= Str::slug($request->position).'-'.$time.'.'.$extension;
			
			
			
			if(!is_dir($originalPath)) {
				mkdir($originalPath, 0755, true);
			}
			
			$imageFile->resize(1000, null, function ($constraint) {
				$constraint->aspectRatio();
			});
			
	        $imageFile->save($originalPath.$newName);
			
	        return $newName;
		}else{
			return false;
		}	
	}
	
	private function uploadEditor(Request $request){
		if($request->hasfile('upload')){
			 
			$originalImage  = $request->file('upload');
			$extension 		= $originalImage->getClientOriginalExtension();
			
			$imageFile      = Image::make($originalImage);
			$originalPath   = public_path('/assets/images/careers/');
			$time           = time();
			$newName		= Str::slug($request->position).'-'.$time.'.'.$extension;
			
			
			
			if(!is_dir($originalPath)) {
				mkdir($originalPath, 0755, true);
			}
			
			$imageFile->resize(1000, null, function ($constraint) {
				$constraint->aspectRatio();
			});
			
	        ;
			$response['url']	= $imageFile->save($originalPath.$newName);
	        return response()->json($response, 200);
		}else{
			return response()->json(['upload error'], 400);
		}	
	}
	
	
	
	private function deleteImg($img){
		if($img){
			$originalPath   = public_path('/assets/images/careers/');
			if(file_exists($originalPath.$img)){
				@unlink($originalPath.$img);
			}
			
	        return true;
		}else{
			
			return false;
		}	
	}

	public function delete(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'id' => 'required',
            
		]);
		
		if($validator->fails()){
            return $this->sendResponseError(json_encode($validator->errors()));       
		}

		$query = Careers::find($request->id);
		$result = $query->delete();
		 
		
		return $this->sendResponseDelete($result);
	}
	

}
