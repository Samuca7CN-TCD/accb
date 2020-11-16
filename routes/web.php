<?php

use Illuminate\Support\Facades\Route;
use App\Mes;
use App\Boletim;

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

Route::get('/sobre', 'SobreController@index');
Route::get('/arquivo', 'ArquivoController@index');
Route::get('/boletim/new', 'HomeController@create');
Route::post('/boletim/store', 'HomeController@store');
Route::get('/{id}', 'HomeController@verPDF');
Route::get('/', 'HomeController@index');