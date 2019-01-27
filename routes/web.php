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




Route::get('/',['as'=>'home','uses'=>'HomeController@index']);
Route::post('/create',['as'=>'create','uses'=>'HomeController@create']);
Route::get('/get-movie-listing',['as'=>'getmovielist','uses'=>'HomeController@getmovielist']);
Route::get('/edit/{id}',['as'=>'edit','uses'=>'HomeController@edit']);
Route::get('/delete/{id}',['as'=>'delete','uses'=>'HomeController@delete_rec']);