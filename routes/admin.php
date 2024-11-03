<?php

use App\Http\Controllers\Api\Dashboard\Admin\AdminController;
use App\Http\Controllers\Api\Dashboard\Category\CategoryController;
use App\Http\Controllers\Api\Dashboard\Client\ClientController;
use App\Http\Controllers\Api\Dashboard\Pages\PageController;
use App\Http\Controllers\Api\Dashboard\Product\ProductController;
use App\Http\Controllers\Api\Dashboard\Project\ProjectController;
use App\Http\Controllers\Api\Dashboard\Search\SearchController;
use App\Http\Controllers\Api\Dashboard\Stats\DashboardController;
use App\Http\Controllers\Api\Dashboard\Team\TeamController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::post('login', [AdminController::class, 'login']);
Route::get('insertAdmin', [AdminController::class, 'insertAdmin']);


Route::middleware('auth:admin')->group(function () {

    Route::post('search', [SearchController::class, 'search']);
    Route::get('dashboard', [DashboardController::class, 'index']);

    Route::controller(AdminController::class)->group(function () {
        Route::post('newAdmin', 'store');
        Route::put('update', 'update');
        Route::get('show', 'show');
        Route::post('logout', 'logout');
        Route::put('change_password', 'change_password');
    });

    Route::resource('projects', ProjectController::class)->except('create', 'edit');
    Route::resource('teams', TeamController::class)->except('create', 'edit');
    Route::resource('clients', ClientController::class)->except('create', 'edit');
    Route::resource('categories', CategoryController::class)->except('create', 'edit');
    Route::resource('products', ProductController::class)->except('create', 'edit');
    Route::delete('products/image/{imageId}', [ProductController::class, 'deleteImg']);

    Route::controller(PageController::class)->group(function () {
        Route::get('/pages/{slug}', 'show');
        Route::post('/pages', 'store');
        Route::put('/pages/{id}', 'update');
        Route::delete('/pages/{id}', 'destroy');
    });

});

