
<?php

use Illuminate\Support\Facades\Route;

/**
 * API Routes - System Admin User.
 *
 */
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::apiResource('users', 'App\Http\Controllers\UserController');
    Route::apiResource('roles', 'App\Http\Controllers\RoleController');
    Route::apiResource('user-roles', 'App\Http\Controllers\UserRoleController');
    Route::apiResource('attachments', 'App\Http\Controllers\AttachmentController');
});

/**
 * API Routes - Public Access.
 *
 */
Route::post('register', 'App\Http\Controllers\Auth\RegisterController@index')->name('register');
Route::post('login', 'App\Http\Controllers\Auth\LoginController@index')->name('login');
Route::post('logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');
Route::post('logout-from-all', 'App\Http\Controllers\Auth\LoginController@logout_from_all')->name('logout-from-all');
Route::post('reset-token', 'App\Http\Controllers\PasswordResetController@generateResetToken')->name('reset-token');
Route::put('password-reset', 'App\Http\Controllers\PasswordResetController@resetPassword')->name('password-reset');
