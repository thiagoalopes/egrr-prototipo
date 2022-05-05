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

Route::prefix('servidor')->group(function(){
    Route::get('', 'App\Http\Controllers\HomeServidores@index')->name('home.servidor');
    Route::get('cadastro', 'App\Http\Controllers\HomeServidores@cadastro')->name('cadastro.servidor');
    Route::post('cadastro', 'App\Http\Controllers\HomeServidores@update')->name('update.servidor');
    Route::get('certificados', 'App\Http\Controllers\Certificados@index')->name('certificados');
    Route::get('certificados/download', 'App\Http\Controllers\Certificados@gerarCertificado')->name('download.certificado');
});

Route::prefix('administrativo')->group(function(){

    Route::get('', 'App\Http\Controllers\Admin\HomeAdministradores@index')->name('home.administrador');

    Route::prefix('professores')->group(function(){
        Route::get('', 'App\Http\Controllers\Admin\Professores@index')->name('listar.professores');
        Route::get('cadastro', 'App\Http\Controllers\Admin\Professores@cadastro')->name('cadastro.professores');
        Route::post('cadastro', 'App\Http\Controllers\Admin\Professores@salvar')->name('salvar.professores');
        Route::get('editar', 'App\Http\Controllers\Admin\Professores@editar')->name('editar.professores');
        Route::post('atualizar', 'App\Http\Controllers\Admin\Professores@atualizar')->name('atualizar.professores');
        Route::get('detalhes', 'App\Http\Controllers\Admin\Professores@detalhes')->name('detalhes.professores');
    });

    Route::prefix('cursos')->group(function(){
        Route::get('', 'App\Http\Controllers\Admin\Cursos@index')->name('listar.cursos');
        Route::get('cadastro', 'App\Http\Controllers\Admin\Cursos@cadastro')->name('cadastro.cursos');
        Route::post('cadastro', 'App\Http\Controllers\Admin\Cursos@salvar')->name('salvar.cursos');
        Route::get('editar', 'App\Http\Controllers\Admin\Cursos@editar')->name('editar.cursos');
        Route::post('atualizar', 'App\Http\Controllers\Admin\Cursos@atualizar')->name('atualizar.cursos');
        Route::get('detalhes', 'App\Http\Controllers\Admin\Cursos@detalhes')->name('detalhes.cursos');
    });

    Route::prefix('turmas')->group(function(){
        Route::get('', 'App\Http\Controllers\Admin\Turmas@index')->name('listar.turmas');
        Route::get('cadastro', 'App\Http\Controllers\Admin\Turmas@cadastro')->name('cadastro.turmas');
        Route::post('cadastro', 'App\Http\Controllers\Admin\Turmas@salvar')->name('salvar.turmas');
        Route::get('editar', 'App\Http\Controllers\Admin\Turmas@editar')->name('editar.turmas');
        Route::post('atualizar', 'App\Http\Controllers\Admin\Turmas@atualizar')->name('atualizar.turmas');
        Route::get('detalhes', 'App\Http\Controllers\Admin\Turmas@detalhes')->name('detalhes.turmas');
    });
});


Route::get('login', 'App\Http\Controllers\Login@index')->name('form.login');
Route::post('login', 'App\Http\Controllers\Login@login')->name('login');
Route::get('logout', 'App\Http\Controllers\Login@logout')->name('logout');

