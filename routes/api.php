<?php

use App\Http\Controllers\API\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([

    'middleware' => 'api',
    // 'namespace' => 'App\Http\Controllers\API',
    'prefix' => 'auth'

], function ($router) {

    Route::post('/register', [App\Http\Controllers\API\AuthController::class, 'register']);
    Route::post('login', [App\Http\Controllers\API\AuthController::class, 'login']);
    Route::post('logout', [App\Http\Controllers\API\AuthController::class, 'logout']);
    Route::post('refresh', [App\Http\Controllers\API\AuthController::class, 'refresh']);
    Route::post('me', [App\Http\Controllers\API\AuthController::class, 'me']);
});

Route::group(['middleware' => ['auth:api']], function () {
Route::get('users', [App\Http\Controllers\API\UsersController::class,'index']);
Route::get('users/create', [App\Http\Controllers\API\UsersController::class,'create'])->middleware('permission:create user');
Route::post('users/store', [App\Http\Controllers\API\UsersController::class,'store'])->middleware('permission:create user');
Route::get('users/edit/{id}', [App\Http\Controllers\API\UsersController::class,'edit']);
Route::patch('users/update/{id}', [App\Http\Controllers\API\UsersController::class,'update']);
});

