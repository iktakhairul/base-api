<?php

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

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::apiResource('users', 'App\Http\Controllers\UserController');
    Route::apiResource('user-roles', 'App\Http\Controllers\UserRoleController');
    Route::apiResource('roles', 'App\Http\Controllers\RoleController');
});

Route::post('users', 'App\Http\Controllers\UserController@store');

Route::post('login', 'App\Http\Controllers\Auth\LoginController@index');
Route::get('logout', 'App\Http\Controllers\Auth\LoginController@logout');
Route::apiResource('password-reset', 'PasswordResetController');
