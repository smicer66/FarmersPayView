<?php

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
    return view('welcome');
});

Route::get('login', [ 'as' => 'login', 'uses' => 'App\Http\Controllers\Auth\AuthController@getLogin']);
Route::post('login', [ 'as' => 'login', 'uses' => 'App\Http\Controllers\Auth\AuthController@postLogin']);
Route::get('logout', [ 'as' => 'logout', 'uses' => 'App\Http\Controllers\Auth\AuthController@getLogout']);

Route::group([
    'middleware' => ['guest']
], function () {
    Route::get('/login', 'App\Http\Controllers\Auth\AuthController@getLogin');
    Route::get('/register', 'App\Http\Controllers\UserController@getRegister');
	
});

Route::group([
    'middleware' => ['auth']
], function () {
    Route::get('/dashboard', 'App\Http\Controllers\UserController@getDashboard');
    Route::get('/add-farm', 'App\Http\Controllers\UserController@getAddFarm');
    Route::get('/list-farms', 'App\Http\Controllers\UserController@getListFarms');
	
});


Route::group([
    'middleware' => ['api']
], function () {
    Route::get('/list-farms-api', 'App\Http\Controllers\UserController@getListFarmsApi');
    Route::post('/add-farm', 'App\Http\Controllers\FarmController@store');
	
});