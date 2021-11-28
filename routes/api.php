
<?php

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
    Route::apiResource('roles', 'App\Http\Controllers\RoleController');
    Route::apiResource('user-roles', 'App\Http\Controllers\UserRoleController');
    Route::apiResource('attachments', 'App\Http\Controllers\AttachmentController');
});

Route::post('login', 'App\Http\Controllers\Auth\LoginController@index')->name('login');
Route::post('logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');
Route::post('logout-from-all', 'App\Http\Controllers\Auth\LoginController@logout_from_all')->name('logout-from-all');
Route::post('reset-token', 'PasswordResetController@generateResetToken')->name('reset-token');
Route::put('password-reset', 'PasswordResetController@resetPassword')->name('password-reset');
