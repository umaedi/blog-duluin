<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Api as Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RoleController extends Controller
{
	function __construct()
	{
		//$this->middleware(['permission:role-list'], ['only' => ['index']]);
		$this->middleware(['permission:role-create'], ['only' => ['create']]);
		$this->middleware(['permission:role-update'], ['only' => ['update']]);
		$this->middleware(['permission:role-delete'], ['only' => ['delete']]);
		//$this->middleware(['permission:role-add-permission'], ['only' => ['addPermission']]);
		//$this->middleware(['permission:role-delete-permission'], ['only' => ['deletePermission']]);
	}

	public function index(Request $request)
	{
		if ($request->perpage) {
			$perpage = $perpage = $request->perpage;
		} else {
			$perpage = 8;
		};
		$page		= $request->page;
		$perpage	= $perpage;
		$int		= $page - 1;
		$offset		= ($int * $perpage);
		$limit		= $perpage;
		$roles		= array();
		$total		= Role::count();
		$pagecount	= ceil($total / $perpage);
		$role 		= Role::offset($offset)->limit($limit)->get();
		foreach ($role as $key => $val) {
			$roles[$key] 	= $val;
			$roles[$key]['user']	= User::role($val['name'])->count();
		}

		$result['role']	= $roles;
		$result['_meta']	= array(

			'totalCount' 	=> Role::count(),

			'pageCount'		=> ceil($total / $perpage),

			'currentPage' 	=> (int)$page,

			'perPage' 		=> $perpage,

		);
		return $this->sendResponseOk($result);
	}

	public function roleHasPermission(Request $request)
	{

		$validator = Validator::make($request->all(), [
			'id' => 'required',

		]);

		if ($validator->fails()) {
			return $this->sendResponseError(json_encode($validator->errors()), $validator->errors());
		}

		$role = Role::find($request->id);
		$role->getAllPermissions();

		$result['role']   	= $role;
		$result['all_permission'] 		= Permission::all();
		return $this->sendResponseOk($result);
	}

	public function create(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'name' => 'required',

		]);

		if ($validator->fails()) {
			return $this->sendResponseError(json_encode($validator->errors()), $validator->errors());
		}
		$input = Role::create([
			'name'   		=> $request->name,
			'guard_name'   		=> 'web',
		]);


		return $this->sendResponseCreate($input);
	}

	public function update(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'id' => 'required',
			'name' => 'required',

		]);

		if ($validator->fails()) {
			return $this->sendResponseError(json_encode($validator->errors()), $validator->errors());
		}
		$input = Role::where('id', $request->id)->update([
			'name'   		=> $request->name,
		]);


		return $this->sendResponseUpdate($input);
	}

	public function delete(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'id' => 'required',

		]);

		if ($validator->fails()) {
			return $this->sendResponseError(json_encode($validator->errors()), $validator->errors());
		}

		$role = Role::find($request->id);
		$role->getAllPermissions();
		foreach ($role['permissions'] as $item) {
			$role->revokePermissionTo($item['name']);
		}
		$role->delete();
		return $this->sendResponseDelete(null);
	}

	public function addPermission(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'name' => 'required',
			'id' => 'required',

		]);
		if ($validator->fails()) {
			return $this->sendResponseError(json_encode($validator->errors()), $validator->errors());
		}

		$role = Role::find($request->id);

		if ($role->hasPermissionTo($request->name) == false) {
			$role->givePermissionTo($request->name);
		}

		return $this->sendResponseCreate(null);
	}

	public function deletePermission(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'name' => 'required',
			'id' => 'required',

		]);
		if ($validator->fails()) {
			return $this->sendResponseError(json_encode($validator->errors()), $validator->errors());
		}

		$role = Role::find($request->id);

		if ($role->hasPermissionTo($request->name) == true) {
			$role->revokePermissionTo($request->name);
		}

		return $this->sendResponseDelete(null);
	}
}
