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

Route::get('/', 'App\Http\Controllers\Welcome@index')->name('welcome');
Route::get('/servidor', 'App\Http\Controllers\Welcome@homeServidor')->name('home.servidor');



Route::get('login', 'App\Http\Controllers\Login@index')->name('form.login');
Route::post('login', 'App\Http\Controllers\Login@login')->name('login');
Route::get('logout', 'App\Http\Controllers\Login@logout')->name('logout');


Route::get('certificados', 'App\Http\Controllers\Certificados@index')->name('certificados');
Route::get('certificados/download', 'App\Http\Controllers\Certificados@gerarCertificado')->name('download.certificado');