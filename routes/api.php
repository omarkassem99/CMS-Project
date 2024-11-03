<?php



use App\Http\Controllers\Api\App\AddTo\CartController;
use App\Http\Controllers\Api\App\AddTo\FavoriteController;
use App\Http\Controllers\Api\App\ContactUs\GeneralContactController;
use App\Http\Controllers\Api\App\ContactUs\RequestContactController;
use App\Http\Controllers\Api\App\User\UserController;
use App\Http\Controllers\Api\App\Visitor\VisitorController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("login", [UserController::class, "login"]);
Route::post("register", [UserController::class, "register"]);

Route::group(["middleware" => ['auth:api']], function () {
    Route::controller(UserController::class)->group(function () {
        Route::put('update', 'update');
        Route::get('profile', 'profile');
        Route::put('change_password', 'change_password');
        Route::post('logout', 'logout');
    });

    Route::resource('favorites', FavoriteController::class)->only(['store', 'destroy']);
    Route::resource('carts', CartController::class)->only(['store', 'destroy']);
});

Route::post('contact/general', [GeneralContactController::class, 'store']);
Route::post('contact/requestService', [RequestContactController::class, 'store']);
Route::post('visitor', [VisitorController::class, 'newVisitor']);







