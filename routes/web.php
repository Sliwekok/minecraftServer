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

Auth::routes();

Route::get('/', 'HomeController@index');


Route::middleware(['auth'])->prefix('settings')->group(function () {
    Route::get('/', 'ServerMenagmentController@index');
    Route::get('/menagment', 'ServerMenagmentController@menagment');
    Route::get('/mods', 'ServerMenagmentController@mods');
    Route::get('/players', 'ServerMenagmentController@players');
    Route::get('/create', 'ServerMenagmentController@create');
    Route::get('/files', 'ServerMenagmentController@files');
    Route::get('/console', 'ServerMenagmentController@console');
    Route::get('/logs', 'ServerMenagmentController@logs');
    
    Route::post('/action', 'ServerMenagmentController@action');
    Route::post('/create', 'ServerMenagmentController@createPOST');
    Route::post('/sendCommand', 'ServerMenagmentController@sendCommand');
});

Route::middleware(['auth'])->prefix('account')->group(function () {
    Route::get('/', 'AccountController@index');
});


Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
