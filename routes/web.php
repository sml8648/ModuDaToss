<?php

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

Route::get('home', [
    'as' => 'home',
    'uses' => 'HomeController@index',
]);

//
// 사용자 가입
Route::get('auth/register', [
    'as' => 'users.create',
    'uses' => 'UsersController@create'
]);

Route::post('auth/register', [
    'as' => 'users.store',
    'uses' => 'UsersController@store'
]);

Route::get('auth/confirm/{code}', [
    'as' => 'users.confirm',
    'uses' => 'UsersController@confirm',
])->where('code', '[\pL-\pN]{60}');

/* 사용자 인증 */
Route::get('auth/login', [
    'as' => 'sessions.create',
    'uses' => 'SessionsController@create',
]);
Route::post('auth/login', [
    'as' => 'sessions.store',
    'uses' => 'SessionsController@store',
]);
Route::get('auth/logout', [
    'as' => 'sessions.destroy',
    'uses' => 'SessionsController@destroy',
]);

/* 비밀번호 초기화 */
Route::get('auth/remind', [
    'as' => 'remind.create',
    'uses' => 'PasswordsController@getRemind',
]);
Route::post('auth/remind', [
    'as' => 'remind.store',
    'uses' => 'PasswordsController@postRemind',
]);
Route::get('auth/reset/{token}', [
    'as' => 'reset.create',
    'uses' => 'PasswordsController@getReset',
])->where('token', '[\pL-\pN]{64}');
Route::post('auth/reset', [
    'as' => 'reset.store',
    'uses' => 'PasswordsController@postReset',
]);

//일반 영업사원
Route::resource('SalesInfo','SalesController');

Route::get('/mypage/{id}', 'SalesController@mypage');
Route::get('/profit/{id}', 'SalesController@profit');
Route::get('/Recommender/{id}', 'SalesController@Recommender');
Route::get('/withdrawal/{id}' ,'SalesController@withdrawal');
Route::post('/withdrawal/{id}' ,'SalesController@withdrawalrequest');
Route::get('/SalesInfo/{id}/{state}','SalesController@showstate');
Route::get('/detail/{SIid}','SalesController@showdetail');

//파트너
Route::resource('Partner','PartnerController');
Route::get('/Partner/{Category}/{SalesPerson_id}','PartnerController@show3');

//test
Route::post('/test','PartnerController@show2');
