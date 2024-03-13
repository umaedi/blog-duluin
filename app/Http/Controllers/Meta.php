<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;

use App\Models\Dashboard\Setting;

class Meta extends Controller
{
		
	public static function Meta(){
		
		$setting = Setting::firstOrFail();
		if((!empty($setting)) AND ($setting->count() != 0)){
			if($setting->logo == null){
				$setting->logo						= url('assets/images/upload.png');
			}else{
				$setting->logo						= url('assets/images/web/'.$setting->logo);
			}
		}

		foreach($setting->toArray() as $key=>$val){
			$result[$key] = $val;
		}
		
		return $result;

	}

	public function sendResponseOk($result)
    {
    	$response = [
            'success' => true,
            'message' => 'Your request has been found',
        ];
		if(!empty($result)){
            $response['data'] = $result;
        }

        return response()->json($response, 200);
    }	
	
	public function sendResponseCreate($result)
    {
    	$response = [
            'success' => true,
            'message' => 'Your request has been saved',
        ];
		if(!empty($result)){
            $response['data'] = $result;
        }

        return response()->json($response, 201);
    }
	
	public function sendResponseUpdate($result)
    {
    	$response = [
            'success' => true,
            'message' => 'Your request has been updated',
        ];
		if(!empty($result)){
            $response['data'] = $result;
        }

        return response()->json($response, 201);
    }
	
	public function sendResponseDelete($result)
    {
    	$response = [
            'success' => true,
            'message' => 'Your request has been deleted',
        ];
		if(!empty($result)){
            $response['data'] = $result;
        }

        return response()->json($response, 200);
    }

    public function sendResponseError($error, $errorMessages = [], $code = 404)
    {
    	$response = [
            'success' => false,
            'message' => $error,
        ];
        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }


        return response()->json($response, $code);
    }

}
