<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Api as Controller;
use App\Models\Dashboard\Banners;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;
use Image;
use Illuminate\Support\Facades\Auth;

class BannersController extends Controller
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
		$columns	= $request->input('columns')[$order]['data'];  if ($columns == ''){$columns = 'position'; };

		$query 	= Banners::query();
		
		
		$query 	= $query->orderBy($columns, $sort);
		if ($search != '') {
		$query	= $query->where('position', 'like', '%'.$search.'%');
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
	
	public function detail(Request $request) {
		$validator = Validator::make($request->all(), [
			'id' => 'required',
		]);
		
		if($validator->fails()){
            return $this->sendResponseError(json_encode($validator->errors()));       
		}
		$query 	= Banners::query();
		
		$query 	= $query->where('id', $request->id);
		$query	= $query->first();
		if(!empty($query->img)){
			$query->path_img	= asset('/assets/images/banners/'.$query->img);
		}
		
		$result['banners'] = $query;
		
		return $this->sendResponseOk($result);
		
    }
	
	public function create(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'position' => 'required',
			'status' => 'required',
		]);
		
		if($validator->fails()){
            return $this->sendResponseError(json_encode($validator->errors()));       
		}
		
		$query = new Banners;
		$query->position = $request->position;
		$query->link = $request->link;
		$query->description = $request->description;
		$query->status = $request->status;
			
		$img = $this->uploadImg($request);
		
		if($img != false){
			$query->img	= $img;
		}
		
		$query->save();
		
		$result = $query->refresh();
		
		return $this->sendResponseCreate($result);
	}
	
	public function update(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'id' => 'required',
			'position' => 'required',
			'status' => 'required',
		]);
		
		if($validator->fails()){
            return $this->sendResponseError(json_encode($validator->errors()));       
		}
		
		$query = Banners::find($request->id);
		$query->position = $request->position;
		$query->link = $request->link;
		$query->description = $request->description;
		$query->status = $request->status;
		
		$img = $this->uploadImg($request);
		
		if($img != false){
			$query->img	= $img;
		}
		$query->save();
		
		$result = $query->refresh();
		return $this->sendResponseUpdate($result);
	}

	private function uploadImg($request){
		if($request->hasfile('userFile')){
			if(!empty($request->id)){
				$query = Banners::find($request->id)->first();
				$this->deleteImg($query->img);
			}
			$originalImage  = $request->file('userFile');
			$extension 		= $originalImage->getClientOriginalExtension();
			
			$imageFile      = Image::make($originalImage);
			$originalPath   = public_path('/assets/images/banners/');
			$time           = time();
			$newName		= Str::slug($request->position).'-'.$time.'.'.$extension;
			
			
			
			if(!is_dir($originalPath)) {
				mkdir($originalPath, 0755, true);
			}
			
	        $imageFile->save($originalPath.$newName);
			
	        return $newName;
		}else{
			return false;
		}	
	}
	
	private function deleteImg($img){
		if($img){
			$originalPath   = public_path('/assets/images/banners/');
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

		$query = Banners::find($request->id);
		$this->deleteImg($query->img);
		$result = $query->delete();
		 
		
		return $this->sendResponseDelete($result);
	}
	

}
