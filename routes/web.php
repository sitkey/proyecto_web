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
Route::get('/name/{name}', function ($name) {
    return 'Hola '.$name;
});
Route::post('poke', 'pokeController@comparar');
Route::post('editarpokes', 'pokeController@editar');
Route::post('cargarpokes', 'pokeController@cargar');
Route::resource('trainer', 'entrenadorController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
