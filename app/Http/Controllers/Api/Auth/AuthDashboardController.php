<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Api as Controller;

class AuthDashboardController extends Controller
{

    public function signin(Request $request){
		
		$validator = Validator::make($request->all(), [
            'email'     => 'required|string|max:255',
            'password'  => 'required|min:6'
        ]);
		
		if ($validator->fails()) {
            return $this->sendResponseError(json_encode($validator->errors()));
			//return back()->with('error', $validator->errors());
        }
		  
		  try {
			$request->validate([
			  'email' => 'email|required',
			  'password' => 'required'
			]);
			
			if(is_numeric($request->email)){
				$credentials = $request->validate([
					'phone'     => $request->email,
					'password'  => $request->password
				]);
			
				if (!Auth::attempt($credentials)) {
					return $this->sendResponseError(['message' => 'wrong username or password']);
				  
				}
				
				$user = User::where('phone', $request->email)->first();
				
			}else{
				$credentials = $request->validate([
					'email'     => 'required',
					'password'  => 'required'
				]);
			
				if (!Auth::attempt($credentials)) {
				  return $this->sendResponseError(['message' => 'wrong username or password']);
				}
				
				$user = User::where('email', $request->email)->first();
			}
			
			
			if ( ! Hash::check($request->password, $user->password, [])) {
			   return $this->sendResponseError(['message' => 'wrong password']);
			}
			
			$tokenResult = $user->createToken('access_token')->plainTextToken;
			
			$response =[
			  'status_code' => 200,
			  'access_token' => $tokenResult,
			  'token_type' => 'Bearer',
			];
			//setcookie("access_token", $tokenResult, time() + 86400);
			
			return $this->sendResponseOk($response);
			
		  } catch (Exception $error) {
			$response =[
			  'status_code' => 500,
			  'message' => 'error in login',
			  'error' => $error,
			];
			
			return $this->sendResponseError($response, 500);
		  }
		}
	

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();
		
        return redirect('/');
    }
}
