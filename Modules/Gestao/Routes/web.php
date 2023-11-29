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

Route::prefix('gestao')->group(function() {
    Route::get('/', 'GestaoController@index')->name('gestao.index');
    Route::get('test-query', function(){
       return view('gestao::testing.testing');
    })->name('gestao.test-query');

    Route::prefix('laudo')->group(function(){
        Route::get('indicadores/exames-pendentes', function(){
            return view('gestao::laudo.analytics.pending-exams');
        })->name('gestao.exams-without-report');
    });
});
