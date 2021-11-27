
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
});

Route::post('login', 'App\Http\Controllers\Auth\LoginController@index')->name('login');
Route::post('logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');
Route::post('logout-from-all', 'App\Http\Controllers\Auth\LoginController@logout_from_all')->name('logout-from-all');
