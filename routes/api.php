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

Route::group(['middleware' => 'api','namespace' => 'App\Http\Controllers\API','prefix' => 'auth'], function ($router) {

    Route::post('/register', [App\Http\Controllers\API\AuthController::class, 'register']);
    Route::post('login', [App\Http\Controllers\API\AuthController::class, 'login']);
    Route::post('logout', [App\Http\Controllers\API\AuthController::class, 'logout']);
    Route::post('refresh', [App\Http\Controllers\API\AuthController::class, 'refresh']);
    Route::post('me', [App\Http\Controllers\API\AuthController::class, 'me']);
    Route::get('email/verify/{id}', 'VerificationController@verify')->name('verification.verify'); // Make sure to keep this as your route name

    Route::get('email/resend', 'VerificationController@resend')->name('verification.resend');
});

Route::group(['middleware' => ['auth:api']], function () {
Route::get('users', [App\Http\Controllers\API\UsersController::class,'index']);
Route::get('users/create', [App\Http\Controllers\API\UsersController::class,'create'])->middleware('role:admin');
Route::post('users/store', [App\Http\Controllers\API\UsersController::class,'store'])->middleware('role:admin');
Route::get('users/edit/{id}', [App\Http\Controllers\API\UsersController::class,'edit']);
Route::patch('users/update/{id}', [App\Http\Controllers\API\UsersController::class,'update']);
Route::delete('users/delete/{id}', [App\Http\Controllers\API\UsersController::class,'destroy']);


    Route::get('/profile', [App\Http\Controllers\API\ProfileController::class, 'profile']);
    Route::patch('/profile', [App\Http\Controllers\API\ProfileController::class, 'update_profile']);
    Route::post('/profile/change_avatar', [App\Http\Controllers\API\ProfileController::class, 'update_avatar']);

    Route::get('/password', [App\Http\Controllers\API\ProfileController::class, 'password']);
    Route::post('/password', [App\Http\Controllers\API\ProfileController::class, 'update_password']);



Route::group(['middleware' => ['role:admin']], function () {
    Route::get('roles',[App\Http\Controllers\API\RolesController::class, 'index']);
    Route::post('roles/store',[App\Http\Controllers\API\RolesController::class, 'store']);
    // Route::get('roles/edit/{id}',[App\Http\Controllers\API\RolesController::class, 'edit']);
    Route::delete('roles/delete/{id}',[App\Http\Controllers\API\RolesController::class, 'destroy']);
    Route::get('permissions',[App\Http\Controllers\API\PermissionsController::class, 'index']);
    Route::post('permissions/store',[App\Http\Controllers\API\PermissionsController::class, 'store']);
    // Route::get('permissions/edit/{id}',[App\Http\Controllers\API\PermissionsController::class, 'edit']);
    Route::delete('permissions/delete/{id}',[App\Http\Controllers\API\PermissionsController::class, 'destroy']);


    Route::get('role-permissions',[App\Http\Controllers\API\AssignPermissionRoleController::class, 'create']);
    Route::post('role-permissions/assign',[App\Http\Controllers\API\AssignPermissionRoleController::class, 'store']);
});

});


Route::group(['prefix' => 'agency'], function ($router) {

    Route::post('/register', [App\Http\Controllers\API\Agency\AuthController::class, 'register']);
    Route::post('login',  [App\Http\Controllers\API\Agency\AuthController::class, 'login']);
    Route::group( ['middleware' => ['auth:agency']], function () {
        Route::get('me', [App\Http\Controllers\API\Agency\AuthController::class, 'me']);

        Route::post('logout',  [App\Http\Controllers\API\Agency\AuthController::class, 'logout']);

        Route::get('agencies',[\App\Http\Controllers\API\Agency\AgeciesController::class,'index']);
        Route::get('agencies/{id}/show',[\App\Http\Controllers\API\Agency\AgeciesController::class,'show']);
        Route::get('agencies/create',[\App\Http\Controllers\API\Agency\AgeciesController::class,'create']);
        Route::post('agencies/store',[\App\Http\Controllers\API\Agency\AgeciesController::class,'store']);
        Route::delete('agencies/{id}/delete',[\App\Http\Controllers\API\Agency\AgeciesController::class,'destroy']);


    });


});
