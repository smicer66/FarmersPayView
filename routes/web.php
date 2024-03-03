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
Route::get('/home', function () {
    return view('core.guest.login');
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
    Route::get('/add-farm', 'App\Http\Controllers\FarmController@getAddFarm');
    Route::get('/update-farm/{farmId}', 'App\Http\Controllers\FarmController@getUpdateFarm');
    Route::get('/list-farms', 'App\Http\Controllers\FarmController@index');
	
	
    Route::get('/administrator/user/user-types', 'App\Http\Controllers\UserController@getUserTypes');
    Route::get('/administrator/user/new-user-type', 'App\Http\Controllers\UserController@getAddNewUserType');
	
    Route::get('/administrator/user/all-users', 'App\Http\Controllers\UserController@getAllUsers');
    Route::get('/administrator/user/new-admin-user', 'App\Http\Controllers\UserController@getAddNewAdminUser');
	Route::get('/administrator/update-user-status/{status}/{userId}', 'App\Http\Controllers\UserController@getUpdateUserStatus');
	
	Route::get('/administrator/workflow/my-items', 'App\Http\Controllers\WorkflowController@getMyItems');
	Route::get('/administrator/workflow/history', 'App\Http\Controllers\WorkflowController@getItemsHistory');
	Route::get('/administrator/workflow/settings', 'App\Http\Controllers\WorkflowController@getSettings');
	Route::get('/administrator/workflow/view-users', 'App\Http\Controllers\WorkflowController@getWorkflowUsers');
	
	
	Route::get('/administrator/payment-schedule/new-payment-schedule', 'App\Http\Controllers\PaymentScheduleController@create');
	Route::get('/administrator/payment-schedule/payment-schedules', 'App\Http\Controllers\PaymentScheduleController@index');
	Route::get('/administrator/payment-schedule/payment-schedule-breakdown/{id}/{scheduleName}', 'App\Http\Controllers\PaymentScheduleController@getPaymentScheduleBreakdown');
	
});


Route::group([
    'middleware' => ['api']
], function () {
    Route::get('/list-farms-api', 'App\Http\Controllers\FarmController@getListFarmsApi');
    Route::post('/add-farm', 'App\Http\Controllers\FarmController@store');
    Route::post('/update-farm/{farmId}', 'App\Http\Controllers\FarmController@edit');
    Route::get('/list-user-types-api', 'App\Http\Controllers\UserController@getListUserTypesApi');
	
    Route::get('/list-users-api', 'App\Http\Controllers\UserController@getListUsersApi');
	
	
	
    Route::post('/add-user-type', 'App\Http\Controllers\UserController@postAddUserType');
    Route::post('/add-admin-user-api', 'App\Http\Controllers\UserController@postAddAdminUserApi');
	
    Route::get('/list-workflow-users-api', 'App\Http\Controllers\WorkflowController@getWorkflowUsersApi');
    Route::post('/create-new-workflow-api', 'App\Http\Controllers\WorkflowController@createNewWorkflowApi');
    Route::post('/create-new-payment-schedule-api', 'App\Http\Controllers\PaymentScheduleController@createNewPaymentScheduleApi');
    Route::get('/list-payment-schedule-api', 'App\Http\Controllers\PaymentScheduleController@getPaymentScheduleApi');
    Route::get('/list-payment-schedule-breakdown-api/{id}', 'App\Http\Controllers\PaymentScheduleController@getPaymentScheduleBreakdownApi');
	
	
});