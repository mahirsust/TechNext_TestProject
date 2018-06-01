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
    //return redirect('/marksheet'); // Why redirect? single page to
    // single project hoile ki api er link ei kaj korte hbe naki. view single, so sei vie page ta to lagbe
	return view('welcome');
});
Route::get('/marksheet', 'DatasetController@index');

Route::post('/add', 'DatasetController@store');
Route::post('/delete_data/{id}', 'DatasetController@destroy');
Route::post('/edit/{id}', 'DatasetController@edit_data');
