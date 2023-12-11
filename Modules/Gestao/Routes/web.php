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
        Route::prefix('indicadores')->group(function(){

            Route::get('/', function(){
                return view('gestao::laudo.analytics.index');
            })->name('gestao.laudo.analytics.index');

            Route::get('exames-pendentes', function(){
                return view('gestao::laudo.analytics.pending-exams');
            })->name('gestao.pending-exams');
        });

        Route::prefix('relatorios')->group(function(){

            Route::get('/', function(){
                return view('gestao::laudo.reports.index');
            })->name('gestao.laudo.reports.index');

            Route::get('exames-sem-laudar', function(){
                return view('gestao::laudo.reports.pending-exams');
            })->name('gestao.laudo.reports.exams-without-report');

            Route::get('exames-sem-assinar', function(){
                return view('gestao::laudo.reports.pending-exams');
            })->name('gestao.laudo.reports.exams-without-signature');

            Route::get('exames-pendentes-de-revisao', function(){
                return view('gestao::laudo.reports.pending-exams');
            })->name('gestao.laudo.reports.exams-to-review');

        });

    });
});
