<?php

use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('users', [App\Http\Controllers\UsersController::class, 'index']);
Route::get('users/create', [App\Http\Controllers\UsersController::class, 'create'])->middleware('permission:create user');
Route::post('users/store', [App\Http\Controllers\UsersController::class, 'store']);
Route::get('users/edit/{id}', [App\Http\Controllers\UsersController::class, 'edit'])->middleware('permission:edit user');
Route::patch('users/update/{id}', [App\Http\Controllers\UsersController::class, 'update']);
Route::get('roles', [App\Http\Controllers\RolesController::class, 'index']);
Route::get('roles/create', [App\Http\Controllers\RolesController::class, 'create']);
Route::post('roles/store', [App\Http\Controllers\RolesController::class, 'store']);
Route::get('roles/edit/{id}', [App\Http\Controllers\RolesController::class, 'edit']);
Route::patch('roles/update/{id}', [App\Http\Controllers\RolesController::class, 'update']);


Route::get('permissions', [App\Http\Controllers\PermissionsController::class, 'index']);
Route::get('permissions/create', [App\Http\Controllers\PermissionsController::class, 'create']);
Route::post('permissions/store', [App\Http\Controllers\PermissionsController::class, 'store']);
Route::get('permissions/edit/{id}', [App\Http\Controllers\PermissionsController::class, 'edit']);
Route::patch('permissions/update/{id}', [App\Http\Controllers\PermissionsController::class, 'update']);

Route::get('assign-permissions', [App\Http\Controllers\assignPermissionController::class, 'index']);
Route::post('assign-permissions/store', [App\Http\Controllers\assignPermissionController::class, 'store']);

Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'profile']);
Route::post('/profile', [App\Http\Controllers\ProfileController::class, 'update_profile']);
Route::post('/profile/change_avatar', [App\Http\Controllers\ProfileController::class, 'update_avatar']);

Route::get('/password', [App\Http\Controllers\ProfileController::class, 'password']);
Route::post('/password', [App\Http\Controllers\ProfileController::class, 'update_password']);
