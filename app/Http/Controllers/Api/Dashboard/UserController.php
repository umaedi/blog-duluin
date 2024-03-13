<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Api as Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Image;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class UserController extends Controller
{
	function __construct()
	{
		$this->middleware(['permission:user-list'], ['only' => ['index']]);
		$this->middleware(['permission:user-create'], ['only' => ['create']]);
		$this->middleware(['permission:user-delete'], ['only' => ['delete']]);
		$this->middleware(['permission:user-direct-permission'], ['only' => ['addPermission', 'deletePermission']]);
	}

	public function index(Request $request)
	{

		$page		= $request->page;
		$perpage	= 8;
		$int		= $page - 1;
		$offset		= ($int * $perpage);
		$limit		= $perpage;

		if ($request->role) {
			$roles	= explode('%2C', $request->role);
			$role	= null;
			foreach ($roles as $item) {
				if ($item != '') {
					$role[] = $item;
				}
			}
			$total		= User::count();
			$user 		= User::join('model_has_roles', function ($join) {
				$join->on('model_id', '=', 'id');
			})
				->whereIn('model_has_roles.role_id', $role)
				->offset($offset)->limit($limit)->get();
		} else {
			$total		= User::count();
			$user 		= User::offset($offset)->limit($limit)->get();
		}
		$pagecount	= ceil($total / $perpage);
		foreach ($user as $key => $val) {
			$users[$key] 	= $val;
			$users[$key]['role']	= $val->getRoleNames();
		}


		$result['user']	= $user;
		$result['_meta']	= array(

			'totalCount' 	=> Role::count(),

			'pageCount'		=> ceil($total / $perpage),

			'currentPage' 	=> (int)$page,

			'perPage' 		=> $perpage,

		);
		return $this->sendResponseOk($result);
	}

	public function account()
	{

		$result = Auth::user();
		if (!is_null($result->avatar)) {
			$result->avatar = asset('/assets/images/users/' . $result->avatar);
		}
		$result['role_name'] = $result->getRoleNames();

		return $this->sendResponseOk($result);
	}

	public function update_account(request $request)
	{

		$result = User::where([
			['id', Auth::user()->id]
		])->first();


		$input = User::where('id', Auth::user()->id)->first();

		$input->name	= $request->name;
		$input->state	= $request->state;
		$input->address	= $request->address;
		$input->phone	= $request->phone;
		$input->phone_2	= $request->phone_2;
		$upload = $this->uploadAvatar($request);

		if ($upload != false) {
			$input->avatar	= $upload;
		}
		$input->save();

		if ($input) {
			return $this->sendResponseCreate($input);
		}
	}

	public function view(request $request)
	{
		$validator = Validator::make($request->all(), [
			'id' => 'required',

		]);
		if ($validator->fails()) {
			return $this->sendResponseError(json_encode($validator->errors()), $validator->errors());
		}

		$result = User::where([
			['id', $request->id]
		])->first();
		$result->avatar = asset('/assets/images/users/' . $result->avatar);
		$result['role_name'] = $result->getRoleNames();

		return $this->sendResponseOk($result);
	}

	public function change_password(Request $request)
	{

		$validator = Validator::make($request->all(), [
			'old_password'     => 'required',
			'password'  => 'required|confirmed|min:6'
		]);

		if ($validator->fails()) {
			return $this->sendResponseError(json_encode($validator->errors()));
		}

		$user = User::where('id', Auth::user()->id)->first();

		if (!Hash::check($request->old_password, $user->password)) {
			$message = 'Sorry your password cannot be identified.';
			return $this->sendResponseCustom($message);
		}

		if ($user) {

			$user->update([
				'password'  => Hash::make($request->password),
				'token_reset'    => sha1(rand()),
			]);

			return $this->sendResponseUpdate('Password berhasil di ubah', true);
		}

		return $this->sendResponseError('Upps. user tidak di temukan!');
	}

	public function create(request $request)
	{
		$validator = Validator::make($request->all(), [
			'name' => 'required',
			'email' => 'required',
			'phone' => 'required',
			'password' => 'confirmed',

		]);
		if ($validator->fails()) {
			return $this->sendResponseError(json_encode($validator->errors()), $validator->errors());
		}

		$input = new User;

		$input->name	= $request->name;
		$input->state	= $request->state;
		$input->address	= $request->address;
		$input->phone	= $request->phone;
		$input->phone_2	= $request->phone_2;
		$upload = $this->uploadAvatar($request);
		$input->password  = Hash::make($request->password);

		if ($upload != false) {
			$input->avatar	= $upload;
		}
		$input->save();

		if ($input) {

			$token = 'xxx';
			//$token = Password::broker()->createToken($input);

			$data = [
				'title' => 'Setting Password',
				'to' => $request->email,
				'url' => url('auth/password/reset?token=' . $token),
				'view' => 'emails.reset-password-user',
			];



			//$mail = $this->SetPasswordUser($data);

			return $this->sendResponseCreate($input);
		}
	}

	private function uploadAvatar($request)
	{
		if ($request->hasfile('userFile')) {
			$user = User::find(Auth::user()->id)->first();

			$originalImage  = $request->file('userFile');
			$extension 		= $originalImage->getClientOriginalExtension();

			$imageFile      = Image::make($originalImage);
			$originalPath   = public_path('/assets/images/users/');
			$time           = time();
			$newName		= Str::slug($request->name) . '-' . $time . '.' . $extension;
			if ($user->avatar) {
				if (file_exists($originalPath . $user->avatar)) {
					@unlink($originalPath . $user->avatarh);
				}
			}

			if (!is_dir($originalPath)) {
				mkdir($originalPath, 0755, true);
			}

			$imageFile->resize(250, null, function ($constraint) {
				$constraint->aspectRatio();
			});
			$imageFile->save($originalPath . $newName);

			return $newName;
		} else {
			return false;
		}
	}

	public function delete(request $request)
	{

		$validator = Validator::make($request->all(), [
			'id' => 'required',

		]);
		if ($validator->fails()) {
			return $this->sendResponseError(json_encode($validator->errors()), $validator->errors());
		}

		$user = User::where('id', $request->id)->first();
		$user->update([
			'banned'   		=> 1,
		]);

		foreach ($user->getDirectPermissions() as $item) {
			$user->revokePermissionTo($item['name']);
		}

		foreach ($user->getPermissionsViaRoles() as $item) {
			$user->revokePermissionTo($item['name']);
		}

		if (count($user->getRoleNames()) > 0) {
			$user->removeRole($user->getRoleNames()[0]);
		}
		if ($user) {

			return $this->sendResponseCreate(null);
		}
	}


	public function check_email(request $request)
	{
		$user = User::where('email', $request->email)->first();

		if (empty($user)) {
			$message 	= 'email is not registered';
			return $this->sendResponseOk($message);
		} else {
			$result['result'] = false;
			return $this->sendResponseOk($result);
		}
	}

	public function permission(Request $request)
	{

		$validator = Validator::make($request->all(), [
			'id' => 'required',

		]);
		if ($validator->fails()) {
			return $this->sendResponseError(json_encode($validator->errors()), $validator->errors());
		}

		$user	= User::find($request->id);

		$result['user'] 				= $user;
		$result['role']   		  		= $user->getPermissionsViaRoles();
		$result['role_name']			= $user->getRoleNames();
		$result['direct_permission']   	= $user->getDirectPermissions();
		$result['all_permission'] 		= Permission::get();
		return $this->sendResponseOk($result);
	}

	public function addPermission(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'permission' => 'required',
			'id' => 'required',

		]);

		if ($validator->fails()) {
			return $this->sendResponseError(json_encode($validator->errors()), $validator->errors());
		}

		$user = User::where('id', $request->id)->first();

		if ($user->hasPermissionTo($request->permission) == false) {
			$user->givePermissionTo($request->permission);
		}



		return $this->sendResponseCreate($user);
	}

	public function deletePermission(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'id' => 'required',
			'permission' => 'required',

		]);
		if ($validator->fails()) {
			return $this->sendResponseError(json_encode($validator->errors()), $validator->errors());
		}
		$user	= User::where('id', $request->id)->first();

		if ($user->hasPermissionTo($request->permission) == true) {
			$user->revokePermissionTo($request->permission);
		}

		return $this->sendResponseDelete(null);
	}

	public function addRole(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'role' => 'required',
			'id' => 'required',

		]);
		if ($validator->fails()) {
			return $this->sendResponseError(json_encode($validator->errors()), $validator->errors());
		}

		$user = User::where('id', $request->id)->first();

		if (isset($user->getRoleNames()[0])) {
			$user->removeRole($user->getRoleNames()[0]);
		}
		$user->assignRole($request->role);


		return $this->sendResponseCreate($user);
	}
}
