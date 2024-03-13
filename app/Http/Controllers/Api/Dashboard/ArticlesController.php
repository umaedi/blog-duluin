<?php

namespace App\Http\Controllers\Api\Dashboard;

use App\Http\Controllers\Api as Controller;
use App\Models\Dashboard\Articles;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;
use Image;
use Illuminate\Support\Facades\Auth;

class ArticlesController extends Controller
{
	function __construct()
	{
		// $this->middleware('permission:article-create', ['only' => ['create']]);
		// $this->middleware('permission:article-update', ['only' => ['update']]);
		// $this->middleware('permission:article-publish', ['only' => ['verify']]);
		// $this->middleware('permission:article-delete', ['only' => ['delete']]);
	}

	public function index(Request $request)
	{


		$draw 		= $request->input('draw');
		$status		= $request->input('status') ?: $status = '';
		$month		= $request->input('month') ?: $month = '';
		$year		= $request->input('year') ?: $year = '';
		$offset		= $request->input('start');
		if ($offset == '') {
			$offset = 0;
		};
		$limit		= $request->input('length');
		if ($limit == '') {
			$limit = 25;
		};
		$search		= $request->input('search')['value'];
		if ($search == '') {
			$search = '';
		};
		$order		= $request->input('order')[0]['column'];
		$sort 		= $request->input('order')[0]['dir'];
		if ($sort == '') {
			$sort = 'DESC';
		};
		$columns	= $request->input('columns')[$order]['data'];
		if ($columns == '') {
			$columns = 'created_at';
		};

		$query 	= Articles::query();
		$query = $query->select(
			'articles.*',

			'categories.id as category_id',
			'categories.name as category_name',

			'users.id as publisher_id',
			'users.name as publisher_name',
		);
		$query = $query->join('categories', 'articles.category_id', '=', 'categories.id');
		$query = $query->leftJoin('users', 'articles.publish_by', '=', 'users.id');

		$query 	= $query->with('creator');
		//$query 	= $query->with('publisher');
		$query 	= $query->orderBy($columns, $sort);
		if ($search != '') {
			$query	= $query->where('articles.title', 'like', '%' . $search . '%');
		}

		if ($status != '') {
			$query	= $query->where('articles.status', $status);
		}

		if ($year != '') {
			$query = $query->whereYear('articles.created_at', $year);
			if ($month != '') {
				$query = $query->whereMonth('articles.created_at', $month);
			}
		}

		$total	= $query->count();
		$query	= $query->offset($offset);
		$query	= $query->limit($limit);
		$data	= $query->get();

		$result['draw']           = $draw;
		$result['recordsTotal']   = count($data);
		$result['recordsFiltered'] = $total;
		$result['data'] = $data;

		return  $this->sendResponseOk($result);
	}

	public function list()
	{

		$query 	= Articles::query();
		$query 	= $query->where('status', 'publish');

		$result['articles'] = $query->get();

		return $this->sendResponseOk($result);
	}

	public function detail(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'id' => 'required',
		]);

		if ($validator->fails()) {
			return $this->sendResponseError(json_encode($validator->errors()));
		}

		$query 	= Articles::query();
		$query 	= $query->with('category');
		$query 	= $query->with('creator');
		$query 	= $query->with('publisher');
		$query 	= $query->where('id', $request->id);
		$query	= $query->first();

		$result['articles'] = $query;

		return $this->sendResponseOk($result);
	}

	public function verify(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'id' => 'required',
			'type' => 'required',
		]);

		if ($validator->fails()) {
			return $this->sendResponseError(json_encode($validator->errors()));
		}

		$query 	= Articles::find($request->id);
		$query->status = $request->type;
		if ($request->type == 'publish') {
			$query->publish_by = Auth::user()->id;
		}
		$query->save();

		$result = $query->refresh();

		return $this->sendResponseOk($result);
	}

	public function create(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'title' => 'required',
			'category_id' => 'required',
			'content' => 'required',
		]);

		if ($validator->fails()) {
			return $this->sendResponseError(json_encode($validator->errors()));
		}

		$query = new Articles;
		$query->title = $request->title;
		$query->slug = Str::slug($request->title);
		$query->category_id = $request->category_id;
		$query->tags = $request->tags;
		$query->date = $request->date;
		$query->content = $request->content;
		$query->headline = $request->headline;
		$query->keyword = $request->keyword;
		$query->description = $request->description;
		$query->caption = $request->caption;
		$query->created_by = Auth::user()->id;
		$query->status = 'draft';

		if ($request->filled('embed')) {

			$query->embed = $request->embed;
		} else if ($request->filled('userFile')) {
			$query->img = $request->userFile;
		}

		$query->save();

		$result = $query->refresh();

		return $this->sendResponseCreate($result);
	}

	public function update(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'title' => 'required',
			'category_id' => 'required',
			'content' => 'required',
		]);

		if ($validator->fails()) {
			return $this->sendResponseError(json_encode($validator->errors()));
		}

		$query = Articles::find($request->id);
		$query->title = $request->title;
		$query->slug = Str::slug($request->title);
		$query->category_id = $request->category_id;
		$query->tags = $request->tags;
		$query->date = $request->date;
		$query->content = $request->content;
		$query->headline = $request->headline;
		$query->keyword = $request->keyword;
		$query->description = $request->description;
		$query->caption = $request->caption;
		$query->created_by = Auth::user()->id;
		$query->status = 'draft';

		if ($request->filled('embed')) {

			$query->embed = $request->embed;
		} else if ($request->filled('userFile')) {
			$query->img = $request->userFile;
		}

		$query->save();

		$result = $query->refresh();

		return $this->sendResponseUpdate($result);
	}

	private function uploadImg($request)
	{
		if ($request->hasfile('userFile')) {
			if (!empty($request->id)) {
				$article = Articles::find($request->id)->first();
				$this->deleteImg($article->img);
			}
			$originalImage  = $request->file('userFile');
			$extension 		= $originalImage->getClientOriginalExtension();

			$imageFile      = Image::make($originalImage);
			$originalPath   = public_path('/assets/images/articles/');
			$time           = time();
			$newName		= Str::slug($request->title) . '-' . $time . '.' . $extension;



			if (!is_dir($originalPath)) {
				mkdir($originalPath, 0755, true);
			}

			$imageFile->resize(1000, null, function ($constraint) {
				$constraint->aspectRatio();
			});

			$imageFile->save($originalPath . $newName);

			return $newName;
		} else {
			return false;
		}
	}

	private function deleteImg($img)
	{
		if ($img) {
			$originalPath   = public_path('/assets/images/articles/');
			if (file_exists($originalPath . $img)) {
				@unlink($originalPath . $img);
			}

			return true;
		} else {

			return false;
		}
	}

	public function delete(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'id' => 'required',

		]);

		if ($validator->fails()) {
			return $this->sendResponseError(json_encode($validator->errors()));
		}

		$query = Articles::find($request->id);
		$this->deleteImg($query->img);
		$result = $query->delete();


		return $this->sendResponseDelete($result);
	}
}
