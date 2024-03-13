<?php

namespace App\Http\Controllers\Frontend;

use Validator;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Dashboard\Careers;
use App\Models\Dashboard\Applicants;
use App\Http\Controllers\Meta as Controller;

class Karir extends Controller
{
	//
	public function index()
	{

		$data['title']  = 'Karir Lahan Sikam';
		// $query	= Careers::where('status', 'publish')->paginate(6);

		// foreach ($query as $key => $val) {
		// 	$query[$key] = $val;
		// 	$query[$key]->description = Str::words(strip_tags($val->description), 12, '..');
		// 	$query[$key]->url = Carbon::parse($val->created_at)->timestamp . '/' . $val->slug;
		// }
		// $data['careers']	= $query;
		// $meta	= self::meta();
		// $data	= array_merge($meta, $data);

		return view('pages.karir.index', compact('data'));
	}

	public function detail($id, $slug)
	{
		$title = ucwords(str_replace("-", " ", $slug));
		$data['title']  = $title;
		$query	= Careers::where('status', 'publish')
			->where('created_at', Carbon::createFromTimestamp($id)->toDateTimeString())
			->where('slug', $slug)
			->first();
		$query->url	= Carbon::parse($query->created_at)->timestamp . '/' . $query->slug;


		$data['career']	= $query;
		$meta	= self::meta();
		$data	= array_merge($meta, $data);

		return view('frontend/content/karir/detail', compact('data'));
	}

	public function apply($id, $slug)
	{
		$title = ucwords(str_replace("-", " ", $slug));
		$data['title']  = $title;
		$query	= Careers::where('status', 'publish')
			->where('created_at', Carbon::createFromTimestamp($id)->toDateTimeString())
			->where('slug', $slug)
			->first();

		$data['unix_id']	= $id;
		$data['career']	= $query;
		$meta	= self::meta();
		$data	= array_merge($meta, $data);

		return view('frontend/content/karir/form_apply', compact('data'));
	}

	public function store(Request $request, $id, $slug)
	{

		$validator = Validator::make($request->all(), [
			'name' => 'required',
			'email' => 'required',
			'userfile'   => 'required|file|max:20000|mimes:doc,docx,pdf',
		]);

		if ($validator->fails()) {

			return Redirect::back()->withErrors(['msg' => $validator->errors()]);
			//return redirect(url('/karir/detail/'.$id.'/'.$slug.'?msg=error'));    
		}

		$career	= Careers::where('status', 'publish')
			->where('created_at', Carbon::createFromTimestamp($id)->toDateTimeString())
			->where('slug', $slug)
			->first();

		$uploadedFile = $request->file('userfile');
		$desPath      = $uploadedFile->store('documents/file/careers');
		$filename     = basename($desPath);
		$extension 	  = pathinfo($desPath, PATHINFO_EXTENSION);

		$query = new Applicants;
		$query->career_id = $career->id;
		$query->name  = $request->name;
		$query->email = $request->email;
		$query->phone = $request->phone;
		$query->address = $request->address;
		$query->birthday_date = $request->birthday;
		$query->graduated = $request->graduated;
		$query->gender = $request->gender;
		$query->document = $filename;
		$query->status = 'waiting';
		$query->save();

		$result = $query->refresh();

		return redirect(url('/karir/detail/' . $id . '/' . $slug . '?msg=success'));
	}
}
