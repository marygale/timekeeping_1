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

Route::get('/', 'HomeController@index');
Route::post('login','Auth\LoginController@login');
Route::get('logout','Auth\LoginController@logout');
Route::get('profile','UserController@profile');

Route::get('user','UserController@index');
Route::get('user/create','UserController@create');
Route::post('user/create','UserController@store');
Route::get('user/{user}/edit','UserController@edit');
Route::post('user/{user}','UserController@update');
Route::get('user/{user}/delete','UserController@destroy');

Route::get('project','ProjectController@index');
Route::get('project/create','ProjectController@create');
Route::post('project/create','ProjectController@store');
Route::get('project/{project}/edit','ProjectController@edit');
Route::post('project/{project}','ProjectController@update');
Route::get('project/{project}/delete','ProjectController@destroy');

Route::post('time/create','TimeController@store');
Route::get('report','HomeController@report');
Route::get('report/users','HomeController@user_report');