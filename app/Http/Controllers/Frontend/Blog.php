<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Dashboard\Tags;
use App\Models\Dashboard\Articles;
use App\Models\Dashboard\Categories;
use App\Http\Controllers\Meta as Controller;

class Blog extends Controller
{
	//
	public function index(Request $request)
	{

		$tag			= $request->input('tag') ?: $tag = '';
		$category		= $request->input('category') ?: $category = '';
		$keyword		= $request->input('keyword') ?: $keyword = '';

		$data['title']  = 'Blog & News';
		$data['subtitle']   = null;

		$query = Articles::query();
		$query = $query->select(
			'articles.*',

			'categories.id as category_id',
			'categories.name as category_name',

			'users.id as publisher_id',
			'users.name as publisher_name',
		);
		$query = $query->where('articles.status', 'publish');
		$query = $query->join('categories', 'articles.category_id', '=', 'categories.id');
		$query = $query->leftJoin('users', 'articles.publish_by', '=', 'users.id');
		$query = $query->with('creator');

		if ($tag != '') {
			$query	= $query->where('articles.tags', 'like', '%' . $tag . '%');
		}
		if ($category != '') {
			$query	= $query->where('categories.slug', $category);
		}
		if ($keyword != '') {
			$query	= $query->where('articles.title', 'like', '%' . $keyword . '%');
		}
		$query 		= $query->orderBy('articles.created_at', 'DESC');
		$articles	= $query->paginate(4);
		$articles	= $articles->appends(request()->except('page'));

		foreach ($articles as $key => $val) {
			$articles[$key] = $val;
			$articles[$key]->date = Carbon::parse($val->date)->diffForHumans();
			$articles[$key]->title = Str::words(strip_tags($val->title), 5, '..');
			$articles[$key]->content_cover = Str::words(strip_tags($val->content), 25, '..');
			$articles[$key]->url = Carbon::parse($val->created_at)->timestamp . '/' . $val->slug;
		}

		$data['articles']   = $articles;

		$sidebar	= Blog::getSidebar();
		$meta		= Blog::meta();
		$data		= array_merge($sidebar, $data);
		$data		= array_merge($meta, $data);

		// dd($data['articles']);
		return view('blog.index', compact('data'));
	}

	public function show($id, $slug)
	{

		$subtitle = ucwords(str_replace("-", " ", $slug));
		$data['title']  = $subtitle;
		$data['subtitle']   = Str::limit(strip_tags($subtitle), 50, "..");

		$article 	= Articles::query();
		$article  	= $article->where('status', 'publish');
		// $article  	= $article->where('created_at', Carbon::createFromTimestamp($id)->toDateTimeString());
		$article  	= $article->where('slug', $slug);
		$article 	= $article->with('category');
		$article 	= $article->with('creator');
		$article 	= $article->with('publisher');
		$article	= $article->first();

		$article->date	= Carbon::parse($article->date)->isoFormat('dddd, D MMMM Y');
		$article->disableLogging();
		$article->increment('viewer');

		$data['post']   = $article;


		$sidebar	= Blog::getSidebar();
		$meta		= Blog::meta();
		$data		= array_merge($sidebar, $data);
		$data		= array_merge($meta, $data);

		// dd($data['post']);
		return view('blog.show', compact('data'));
	}

	public function kategori($slug)
	{

		$subtitle = ucwords(str_replace("-", " ", $slug));
		$data['title']  = 'Blog & News';
		$data['subtitle']   = 'Kategori ' . Str::limit(strip_tags($subtitle), 50, "..");

		$data['articles']   = [];

		$sidebar	= Blog::getSidebar();
		$meta		= Blog::meta();
		$data		= array_merge($sidebar, $data);
		$data		= array_merge($meta, $data);

		return view('frontend/content/blog/index', compact('data'));
	}

	public function tag($slug)
	{

		$subtitle = ucwords(str_replace("-", " ", $slug));
		$data['title']  = 'Blog & News';
		$data['subtitle']   = 'Tag ' . Str::limit(strip_tags($subtitle), 50, "..");

		$data['articles']   = [];

		$sidebar	= Blog::getSidebar();
		$meta		= Blog::meta();
		$data		= array_merge($sidebar, $data);
		$data		= array_merge($meta, $data);

		return view('frontend/content/blog/list', compact('data'));
	}

	private function getSidebar()
	{

		$query		= Articles::query();
		$query		= $query->where('articles.status', 'publish');
		$populars  	= $query->orderBy('viewer', 'DESC')->limit(4)->get();

		foreach ($populars as $key => $val) {
			$populars[$key] = $val;
			$populars[$key]->date = Carbon::parse($val->date)->diffForHumans();
			$populars[$key]->title = Str::words(strip_tags($val->title), 5, '..');
			$populars[$key]->url = Carbon::parse($val->created_at)->timestamp . '/' . $val->slug;
		}

		$data['categories'] = Categories::where('status', 'publish')->withCount('articles')->get();
		$data['tags']   	= Tags::where('status', 'publish')->get();
		$data['populars']   = $populars;

		return $data;
	}
}
