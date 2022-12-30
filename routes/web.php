<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\IndexController;
use App\Http\Controllers\GlobalController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\PersistirController;
use App\Http\Controllers\SetorController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\FerramentasController;

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

#Route::get('/', function () {
#    return view('welcome');
#});

Route::resource('/', IndexController::class);

Route::get('global/{tipo}/{data}', [GlobalController::class, '_index']);
Route::get('listagem/{tipo}/{pagina}/{idempresa}', [GlobalController::class, '_listagem']);
Route::get('setor/{id}/{data}', [SetorController::class, '_setor' ]);
Route::get('setor_layout/{id}', [SetorController::class, '_layout' ]);
Route::get('setor_layout_delete/{arquivo}/{id}', [SetorController::class, '_layout_delete']);
Route::get('matrizbcg', [FerramentasController::class,'_matrizbcg']);
Route::get('fluxograma', [FerramentasController::class,'_fluxograma']);
Route::get('fluxo_delete/{arquivo}', [FerramentasController::class,'_fluxo_delete']);
Route::get('folhas_observacoes', [FerramentasController::class,'_folhas_observacoes']);
Route::get('folha_observacoes/{id}/{alteracao}', [FerramentasController::class,'_folha_observacoes']);
Route::get('pops', [FerramentasController::class,'_pops']);
Route::get('pop/{id}/{alteracao}', [FerramentasController::class,'_pop']);
Route::get('pontocontrole/{id}/{idponto}/{data}', [SetorController::class,'_pontocontrole']);
Route::get('pontocontrole_lista/{id}/{data}', [SetorController::class,'_listagem']);
Route::post('pontocontrole_lista_pesquisa', [SetorController::class,'_listagem_pesquisa']);

Route::get('admin', [AdminController::class,'_index']);
Route::get('admin/{tipo}', [AdminController::class,'_pagina']);
Route::get('cargadados', [AdminController::class, '_cargadados' ]);

Route::get('/form/{tipo}/{pagina}', [FormController::class, '_novo']);
Route::get('/update/{tipo}/{pagina}/{id}', [FormController::class, '_update']);
Route::get('/delete/{tipo}/{id}', [PersistirController::class, '_delete']);

Route::get('/cargabruta/{tipo}', [PersistirController::class, '_cargaBruta' ]);

Route::post('store', [PersistirController::class, '_store' ]);

Route::get('image-upload', [ ImageUploadController::class, 'imageUpload' ])->name('image.upload');
Route::post('image-upload', [ ImageUploadController::class, 'imageUploadPost' ])->name('image.upload.post');

