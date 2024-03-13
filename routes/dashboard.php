<?php

 use App\Http\Controllers\Dashboard as Dashboard;
	
	Route::group(['middleware' => 'auth:sanctum', 'dashboard'], function() {
		Route::get('/logout', [App\Http\Controllers\Api\Auth\AuthDashboardController::class, 'destroy'])->name('logout');
		
		Route::prefix('/dashboard')->group(function () {
			Route::get('/', [Dashboard\HomeController::class, 'index']);
			Route::get('/setting', [Dashboard\SettingController::class, 'index']);
			
			// USER MANAGEMENT
			Route::get('/log_activity', [\App\Http\Controllers\Dashboard\ActivityController::class, 'index']);
			
			Route::prefix('/permissions')->group(function () {
				Route::get('/', [\App\Http\Controllers\Dashboard\PermissionsController::class, 'index']);
				Route::get('/create', [\App\Http\Controllers\Dashboard\PermissionsController::class, 'create']);
				 
			});
			
			Route::prefix('/roles')->group(function () {
				Route::get('/', [\App\Http\Controllers\Dashboard\RolesController::class, 'index']);
				Route::get('/view/{id}', [\App\Http\Controllers\Dashboard\RolesController::class, 'view']);
				Route::get('/create', [\App\Http\Controllers\Dashboard\RolesController::class, 'create']);
				Route::get('/update/{id}', [\App\Http\Controllers\Dashboard\RolesController::class, 'update']);
			});
			
			Route::prefix('/users')->group(function () {
				Route::get('/', [\App\Http\Controllers\Dashboard\UsersController::class, 'index']);
				Route::get('/profile', [\App\Http\Controllers\Dashboard\UsersController::class, 'profile']);
				
				Route::get('/view/{id}', [\App\Http\Controllers\Dashboard\UsersController::class, 'view']);
				Route::get('/permission/{id}', [\App\Http\Controllers\Dashboard\UsersController::class, 'permission']);
				Route::get('/register', [\App\Http\Controllers\Dashboard\UsersController::class, 'create']);
				Route::get('/update/{id}', [\App\Http\Controllers\Dashboard\UsersController::class, 'update']);
				
			});
			// END USER MANAGEMENT
			
			Route::prefix('/menus')->group(function () {
				Route::get('/', [\App\Http\Controllers\Dashboard\MenusController::class, 'index']);
				Route::get('/create', [\App\Http\Controllers\Dashboard\MenusController::class, 'create']);
				 
			});
			
			Route::prefix('/todo_list')->group(function () {
				Route::get('/', [\App\Http\Controllers\Dashboard\ArticlesController::class, 'todo_list']);
			});
			
			Route::prefix('/banners')->group(function () {
				Route::get('/', [\App\Http\Controllers\Dashboard\BannersController::class, 'index']);
				Route::get('/create', [\App\Http\Controllers\Dashboard\BannersController::class, 'create']);
				Route::get('/update/{id}', [\App\Http\Controllers\Dashboard\BannersController::class, 'update']);
				 
			});
			
			Route::prefix('/categories')->group(function () {
				Route::get('/', [\App\Http\Controllers\Dashboard\CategoriesController::class, 'index']);
				Route::get('/create', [\App\Http\Controllers\Dashboard\CategoriesController::class, 'create']);
				 
			});
			
			Route::prefix('/tags')->group(function () {
				Route::get('/', [\App\Http\Controllers\Dashboard\TagsController::class, 'index']);
				Route::get('/create', [\App\Http\Controllers\Dashboard\TagsController::class, 'create']);
				 
			});
			
			Route::prefix('/articles')->group(function () {
				Route::get('/', [\App\Http\Controllers\Dashboard\ArticlesController::class, 'index']);
				Route::get('/create', [\App\Http\Controllers\Dashboard\ArticlesController::class, 'create']);
				Route::get('/update/{id}', [\App\Http\Controllers\Dashboard\ArticlesController::class, 'update']);
				Route::get('/detail/{id}', [\App\Http\Controllers\Dashboard\ArticlesController::class, 'detail']);
				 
			});
			
			Route::prefix('/pages')->group(function () {
				Route::get('/', [\App\Http\Controllers\Dashboard\PagesController::class, 'index']);
				Route::get('/create', [\App\Http\Controllers\Dashboard\PagesController::class, 'create']);
				Route::get('/update/{id}', [\App\Http\Controllers\Dashboard\PagesController::class, 'update']);
				Route::get('/detail/{id}', [\App\Http\Controllers\Dashboard\PagesController::class, 'detail']);
				 
			});
			
			Route::prefix('/careers')->group(function () {
				Route::get('/', [\App\Http\Controllers\Dashboard\CareersController::class, 'index']);
				Route::get('/create', [\App\Http\Controllers\Dashboard\CareersController::class, 'create']);
				Route::get('/update/{id}', [\App\Http\Controllers\Dashboard\CareersController::class, 'update']);
				Route::get('/detail/{id}', [\App\Http\Controllers\Dashboard\CareersController::class, 'detail']);
				 
			});
			
			
		});

	});
	