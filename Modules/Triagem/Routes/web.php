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
use Illuminate\Support\Facades\Route;
use Modules\Triagem\Http\Controllers\TermController;
use Modules\Triagem\Http\Controllers\StoreTermFileController;
use Modules\Triagem\Http\Controllers\TriagemController;
use Modules\Triagem\Http\Controllers\GetFilasController;
use Modules\Triagem\Http\Controllers\CreateContrastController;

Route::middleware('auth')->group(function () {

Route::prefix('triagem')->group(function() {
    Route::get('/', 'TriagemController@index');

    Route::get('realizadas', [TriagemController::class, 'index'])->name('triagens.realizadas');

    Route::get('filas/ressonancia', [GetFilasController::class, 'getRessonancia'])->name('filas.ressonancia');
    Route::get('filas/tomografia', [GetFilasController::class, 'getTomografia'])->name('filas.tomografia');

    Route::get('termos/ressonancia/create', [TermController::class, 'createRessonancia'])->name('create.ressonancia');
    Route::get('termos/tomografia/create', [TermController::class, 'createTomografia'])->name('create.tomografia');

    Route::post('termos/ressonancia', [TermController::class, 'storeRessonancia'])->name('store.ressonancia');
    Route::post('termos/tomografia', [TermController::class, 'storeTomografia'])->name('store.tomografia');

    Route::post('termos/ressonancia/{id}', [StoreTermFileController::class, 'storeTermoRessonancia'])->name('store.termo-ressonancia');
    Route::post('termos/ressonancia/tele-laudo/{id}', [StoreTermFileController::class, 'storeTermoTeleLaudo'])->name('store.termo-tele-laudo');

    Route::get('termos/ressonancia/{id}/contraste/create', [CreateContrastController::class, 'createContrastRessonancia'])->name('create.contraste-ressonancia');
    Route::post('termos/ressonancia/contraste/store{id}', [StoreContrastController::class, 'storeContrastRessonancia'])->name('store.contraste-ressonancia');

    Route::get('show_signature/{id}', [TriagemController::class, 'showSignature'])->name('show_signature');
});

});