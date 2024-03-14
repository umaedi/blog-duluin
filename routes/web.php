<?php

use App\Models\Role;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => '/dashboard/filemanager', 'middleware' => ['web', 'auth']], function () {
	\UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::controller(\App\Http\Controllers\Frontend\Home::class)->group(function () {
	Route::get('/', 'index');
	Route::get('/about', 'about')->name('about');
	Route::get('/sejarah', 'sejarah')->name('sejarah');
	Route::get('/contact', 'contact')->name('contact');
	Route::get('/faq', 'faq')->name('faq');
	Route::get('/coming-soon', 'comingSon');
});

Route::prefix('pendanaan')->group(function () {
	Route::controller(\App\Http\Controllers\Frontend\Pendanaan::class)->group(function () {
		Route::get('/', 'index')->name('pendanaan');
		Route::get('/informasi', 'informasi');
		Route::get('/tata_cara', 'tata_cara')->name('tata_cara');
	});
});

Route::prefix('pinjaman')->group(function () {
	Route::controller(\App\Http\Controllers\Frontend\Pinjaman::class)->group(function () {
		Route::get('/', 'index')->name('pinjaman');
		Route::get('/tata_cara', 'tata_cara')->name('tata_cara_meminjam');
	});
});

Route::prefix('blog')->group(function () {
	Route::controller(\App\Http\Controllers\Frontend\Blog::class)->group(function () {
		Route::get('/', 'index');
		Route::get('/read/{id}/{slug}', 'show');
		Route::get('/kategori/{slug}', 'kategori');
		Route::get('/tag/{slug}', 'index');
	});
});

Route::prefix('informasi')->group(function () {
	Route::controller(\App\Http\Controllers\Frontend\Informasi::class)->group(function () {

		Route::get('/keterbukaan_informasi', function () {
			return redirect()->route('tata_cara');
		});
		Route::get('/{slug}', 'index');
		Route::get('/publikasi/risk_disclaimer', 'risk_disclaimer');
		Route::get('/publikasi/statistik', 'statistik');
		Route::get('/publikasi/laporan-keuangan', 'laporan_keuangan')->name('laporan_keuangan');
	});
});

Route::prefix('karir')->group(function () {
	Route::controller(\App\Http\Controllers\Frontend\Karir::class)->group(function () {
		Route::get('/', 'index');
		Route::get('/detail/{id}/{slug}', 'detail');
		Route::get('/apply/{id}/{slug}', 'apply');
		Route::post('/apply/{id}/{slug}', 'store');
		Route::get('/notifikasi/{id}/{slug}', 'notifikasi');
	});
});

Route::prefix('menu_pendana')->group(function () {
	Route::controller(\App\Http\Controllers\Frontend\Pendanaan::class)->group(function () {
		Route::get('/login', 'login');
		//Route::get('/reset_password', 'reset_password');
		//Route::get('/daftar', 'daftar');
		Route::get('/login', function () {
			return redirect()->to('https://pendana.lahansikam.co.id/');
		});
		Route::get('/daftar', function () {
			return redirect()->to('https://pendana.lahansikam.co.id/');
		});
		Route::get('/tata_cara', function () {
			return redirect()->route('tata_cara');
		});
		Route::get('/tata_cara_meminjam', function () {
			return redirect()->route('tata_cara_meminjam');
		});
		Route::get('/laporan_keuangan', function () {
			return redirect()->route('laporan_keuangan');
		});
		Route::get('/tentang_pendanaan', function () {
			return redirect()->route('pendanaan');
		});
		Route::get('/pinjaman', function () {
			return redirect()->route('pinjaman');
		});
		Route::get('/tentang_kami', function () {
			return redirect()->route('about');
		});
	});
});


Route::controller(\App\Http\Controllers\Auth\AuthController::class)->group(function () {

	Route::get('/root', 'login')->name('login');
});

Route::get('/set_cookie', function () {
	$token = request('token');
	setcookie("access_token", $token, time() + 86400);
	return redirect('/dashboard');
});

Route::group(['middleware' => 'auth:sanctum'], function () {
	//Route::get('logout', [\App\Http\Controllers\Api\Auth\AuthDashboardController::class, 'destroy'])->name('logout');

	//Route::prefix('/dashboard')->group(function () {
	//Route::get('/', [\App\Http\Controllers\Dashboard\HomeController::class, 'index']);

	//});

});
