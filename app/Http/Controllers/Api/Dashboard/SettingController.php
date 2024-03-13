<?php

namespace App\Http\Controllers\Api\Dashboard;
use App\Http\Controllers\Api as Controller;
use Illuminate\Http\Request;
use \App\Models\Dashboard\Setting;
use Image;
use Illuminate\Support\Facades\Auth;
use Validator;

class SettingController extends Controller {

	
	function __construct()
    {
		
		$this->middleware(['permission:setting-detail'], ['only' => ['index']]);
		$this->middleware(['permission:setting-update'], ['only' => ['update']]);
	}

    public function index() {
		
		$result = Setting::first();
		
		if (!empty($result->logo)) {
			$result->logo = url('/assets/images/web/'.$result->logo);
		}else{
			$result->logo = url('/assets/images/upload.png');
		};
		
		return $this->sendResponseOk($result);
    }
    
    public function update(request $request) {

		 

		$result = Setting::first();
		if($request->file('userfile')){
			
			$originalImage  = $request->file('userfile');
			$imageFile      = Image::make($originalImage);
			$originalPath   = public_path('/assets/images/web/');
			$time           = time();
			$image_path     = $originalPath.$result->logo;

			if(!is_dir($originalPath)) {
				mkdir($originalPath, 0755, true);
			}
			
			if(file_exists($image_path)) {
				@unlink($image_path);
			}
			$imageFile->resize(250, null, function ($constraint) {
				$constraint->aspectRatio();
			});
	        $imageFile->save($originalPath.$time.$originalImage->getClientOriginalName());
	        $image = $time.$originalImage->getClientOriginalName();
		}else{
			$image = $result->logo;
		}		
		$input = $request->except(['id', 'userfile']);
		$input['logo'] = $image;
		
		$return = Setting::where('id', '1')->update($input);
		
		return $this->sendResponseUpdate($return);
	}
	
};