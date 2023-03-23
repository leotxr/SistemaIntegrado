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

use Modules\Triagem\Http\Controllers\TermController;
use Modules\Triagem\Http\Controllers\TermFileController;
use Modules\Triagem\Http\Controllers\TriagemController;

Route::middleware('auth')->group(function () {
    Route::prefix('triagem')->group(function () {
        Route::get('/', 'TriagemController@index');
        Route::get('filas/ressonancia', [TriagemController::class, 'queue_rm']);
        Route::get('filas/tomografia', [TriagemController::class, 'queue_tc']);
        Route::get('/relatorios', function () {
            return view('triagem::relatorios');
        });
    });
});

Route::middleware('auth')->group(function () {
    Route::resource('triagem/terms', TermController::class);
    Route::get('/triagem/terms/{term}', [TermController::class, 'show'])->name('terms.show');
    Route::get('relatorioTriagem', [TermController::class, 'relatorioTriagem'])->name('relatorioTriagem');
    //Route::resource('triagem/files', FileTriagemController::class);
    Route::get('triagem/terms/files/create/', [TermFileController::class, 'create']);
    Route::resource('triagem/terms/files', TermFileController::class);
});

Route::middleware('auth')->group(function () {
    Route::any('show_signature', 'TermController@showSignature')->name('show_signature');
});
