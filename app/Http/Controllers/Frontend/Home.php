<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Dashboard\Pages;
use App\Models\Dashboard\Banners;
use App\Models\Dashboard\Articles;
use App\Http\Controllers\Meta as Controller;

class Home extends Controller
{
	//
	public function index()
	{
		$data['title']  = 'Selamat Datang';
		// $data['slider'] = Banners::where('position', 'slider')->orderBy('id', 'ASC')->get();

		// $articles = Articles::query();
		// $articles = $articles->select(
		// 	'articles.*',
		// 	'categories.id as category_id',
		// 	'categories.name as category_name',
		// 	'users.id as creator_id',
		// 	'users.name as creator_name',
		// 	'users.avatar as creator_avatar',
		// );
		// $articles = $articles->join('categories', 'articles.category_id', '=', 'categories.id');
		// $articles = $articles->leftJoin('users', 'articles.created_by', '=', 'users.id');
		// $articles = $articles->orderBy('created_at', 'DESC')->limit(4)->get();
		// foreach ($articles as $key => $val) {
		// 	$articles[$key] = $val;
		// 	$articles[$key]->img = Home::ImgThums($val->img);
		// 	$articles[$key]->date = Carbon::parse($val->date)->isoFormat('D MMMM Y');
		// 	$articles[$key]->title = Str::words(strip_tags($val->title), 5, '..');
		// 	$articles[$key]->url = Carbon::parse($val->created_at)->timestamp . '/' . $val->slug;
		// }
		// $data['articles']  = $articles;

		// $meta	= self::meta();
		// $data	= array_merge($meta, $data);

		return view('home.index');
	}
	public function about()
	{

		// $meta	= self::meta();
		// $data	= array_merge($meta, $data);

		$data = [
			'title' => 'Tentang Duluin',
			'descTitle' => 'Tentang ' . env('APP_NAME'),
			'breadcrumb' => [
				['url' => '/', 'name' => 'Beranda'],
			],
			'bread_current'	=> 'Tentang Duluin'
		];
		return view('pages.about.index', compact('data'));
	}
	public function sejarah()
	{
		$data['title']  = 'Sejarah Lahan Sikam';

		$meta	= self::meta();
		$data	= array_merge($meta, $data);

		return view('frontend/content/sejarah', compact('data'));
	}
	public function faq()
	{
		$data['title']  = 'Frequently Asked Questions';

		$meta	= self::meta();
		$data	= array_merge($meta, $data);

		return view('frontend/content/faq', compact('data'));
	}

	private function ImgThums($url)
	{
		$base = basename($url);
		if (strpos($url, 'https://') !== false or strpos($url, 'http://') !== false) {
			return str_replace($base, "thumbs/" . $base, $url);
		} else {
			$preUrl = "storage/";
			$beforeBase = str_replace($base, "", $url);
			return $preUrl . $beforeBase . 'thumbs/' . $base;
		}
	}

	public function comingSon()
	{
		return view('pages.comingsoon.index');
	}

	public function karir()
	{
		return view('pages.karir.index');
	}
}
