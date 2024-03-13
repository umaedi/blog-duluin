<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth;
use App\Http\Controllers\Api\Dashboard AS Api;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['prefix' => 'auth'], function () {
	//Auth User Administrator
	Route::controller(Auth\AuthDashboardController::class)->group(function () {
		Route::post('/signin', 'signin')->name('signin');
	});
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
	$user	= $request->user();
	$user->avatar	= asset('/assets/images/users/'.$user->avatar);
    return $user;
});

Route::prefix('v1/dashboard')->group(function () { 
        Route::get('/', [Api\DashboardController::class, 'index']);
		Route::get('/metaData', [App\Http\Controllers\Api\MetaDataController::class, 'index']);
        Route::get('/notif', [Api\DashboardController::class, 'notif']);
		
        Route::get('/user', function (Request $request) {
            return $request->user();
        });
		
		Route::prefix('/activity')->group(function () {
            Route::get('/', [Api\ActivityController::class, 'index']);
        });

        // PermissionController
        Route::prefix('/permission')->group(function () {
            Route::get('/list', [Api\PermissionController::class, 'index']);
            Route::get('/list_all', [Api\PermissionController::class, 'list']);
            Route::post('/create', [Api\PermissionController::class, 'create']);
            Route::delete('/delete', [Api\PermissionController::class, 'delete']);
        });
		
		// Roles
        Route::prefix('/role')->group(function () {
            Route::get('/list', [Api\RoleController::class, 'index']);
            Route::delete('/delete', [Api\RoleController::class, 'delete']);
            Route::post('/create', [Api\RoleController::class, 'create']);
            Route::post('/update', [Api\RoleController::class, 'update']);

            Route::get('/role_has_permission', [Api\RoleController::class, 'roleHasPermission']);
            Route::post('/permission/add', [Api\RoleController::class, 'addPermission']);
            Route::delete('/permission/delete', [Api\RoleController::class, 'deletePermission']);
        });
		
		// User
        Route::prefix('/user')->group(function () {
           
            Route::get('/', [Api\UserController::class, 'view']);
            Route::post('/', [Api\UserController::class, 'create']);
            Route::delete('/', [Api\UserController::class, 'delete']);
			Route::get('/list', [Api\UserController::class, 'index']);
            Route::post('/update', [Api\UserController::class, 'update']);

            Route::get('/account', [Api\UserController::class, 'account']);
            Route::post('/update_account', [Api\UserController::class, 'update_account']);
            Route::post('/change_password', [Api\UserController::class, 'change_password']);

            Route::post('/check_email', [Api\UserController::class, 'check_email']);

            Route::get('/permission', [Api\UserController::class, 'permission']);
            Route::post('/permission', [Api\UserController::class, 'addPermission']);
            Route::delete('/permission', [Api\UserController::class, 'deletePermission']);

            Route::post('/role', [Api\UserController::class, 'addRole']);
        });
		
		// Global Setting
        Route::prefix('/setting')->group(function () {
		    Route::get('/app', [Api\SettingController::class, 'index']);
            Route::post('/update', [Api\SettingController::class, 'update']);
        });
		
		// Tags Controller
        Route::prefix('/tags')->group(function () {
            Route::get('/', [Api\TagsController::class, 'index']);
			Route::get('/list_all', [Api\TagsController::class, 'list_all']);
            Route::post('/create', [Api\TagsController::class, 'create']);
            Route::post('/update', [Api\TagsController::class, 'update']);
            Route::delete('/delete', [Api\TagsController::class, 'delete']);
        });
		
		// Categories Controller
        Route::prefix('/categories')->group(function () {
            Route::get('/', [Api\CategoriesController::class, 'index']);
            Route::get('/list_all', [Api\CategoriesController::class, 'list_all']);
            Route::post('/create', [Api\CategoriesController::class, 'create']);
            Route::post('/update', [Api\CategoriesController::class, 'update']);
            Route::delete('/delete', [Api\CategoriesController::class, 'delete']);
        });
		
		// Articles Controller
        Route::prefix('/articles')->group(function () {
            Route::post('/', [Api\ArticlesController::class, 'index']);
            Route::get('/detail', [Api\ArticlesController::class, 'detail']);
            Route::post('/create', [Api\ArticlesController::class, 'create']);
            Route::post('/update', [Api\ArticlesController::class, 'update']);
			Route::post('/verify', [Api\ArticlesController::class, 'verify']);
            Route::delete('/delete', [Api\ArticlesController::class, 'delete']);
        });

		// Pages Controller
        Route::prefix('/pages')->group(function () {
            Route::post('/', [Api\PagesController::class, 'index']);
            Route::get('/detail', [Api\PagesController::class, 'detail']);
            Route::post('/create', [Api\PagesController::class, 'create']);
            Route::post('/update', [Api\PagesController::class, 'update']);
			Route::post('/verify', [Api\PagesController::class, 'verify']);
            Route::delete('/delete', [Api\PagesController::class, 'delete']);
        });
		
		// Banners Controller
        Route::prefix('/banners')->group(function () {
            Route::post('/', [Api\BannersController::class, 'index']);
            Route::get('/detail', [Api\BannersController::class, 'detail']);
            Route::post('/create', [Api\BannersController::class, 'create']);
            Route::post('/update', [Api\BannersController::class, 'update']);
            Route::delete('/delete', [Api\BannersController::class, 'delete']);
        });
		
		// Careers Controller
        Route::prefix('/careers')->group(function () {
            Route::post('/', [Api\CareersController::class, 'index']);
            Route::get('/detail', [Api\CareersController::class, 'detail']);
            Route::post('/create', [Api\CareersController::class, 'create']);
            Route::post('/update', [Api\CareersController::class, 'update']);
            Route::post('/uploadEditor', [Api\CareersController::class, 'uploadEditor']);
			Route::post('/verify', [Api\CareersController::class, 'verify']);
            Route::delete('/delete', [Api\CareersController::class, 'delete']);
        });
		
		// Apllicants Controller
        Route::prefix('/applicants')->group(function () {
            Route::post('/', [Api\ApplicantsController::class, 'index']);
            Route::post('/list_by_career', [Api\ApplicantsController::class, 'list_by_career']);
            Route::get('/detail', [Api\ApplicantsController::class, 'detail']);
			Route::post('/verify', [Api\ApplicantssController::class, 'verify']);
        });
    });