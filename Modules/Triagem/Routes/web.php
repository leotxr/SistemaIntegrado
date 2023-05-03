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
use Modules\Triagem\Http\Controllers\StoreContrastController;
use Modules\Triagem\Http\Controllers\TermFileController;

Route::get('teste-sig', function () {
    return view('triagem::teste-sig');
});

Route::middleware('auth')->group(function () {

    Route::prefix('triagem')->group(function () {
        Route::get('/', 'TriagemController@index')->name('index');

        Route::get('realizadas', [TermController::class, 'index'])->name('triagens.realizadas');

        Route::get('filas/ressonancia', [GetFilasController::class, 'getRessonancia'])->name('filas.ressonancia');
        Route::get('filas/tomografia', [GetFilasController::class, 'getTomografia'])->name('filas.tomografia');

        Route::post('ressonancia/create', [TermController::class, 'createRessonancia'])->name('create.ressonancia');
        Route::get('tomografia/create', [TermController::class, 'createTomografia'])->name('create.tomografia');

        Route::post('ressonancia', [TermController::class, 'storeRessonancia'])->name('store.ressonancia');
        Route::post('tomografia', [TermController::class, 'storeTomografia'])->name('store.tomografia');

        /*
        Route::post('termos/ressonancia/{id}', [StoreTermFileController::class, 'storeTermoRessonancia'])->name('store.termo-ressonancia');
        Route::post('termos/ressonancia/tele-laudo/{id}', [StoreTermFileController::class, 'storeTermoTeleLaudo'])->name('store.termo-tele-laudo');
*/
        Route::get('ressonancia/{id}/contraste/create', [CreateContrastController::class, 'createContrastRessonancia'])->name('create.contraste-ressonancia');
        Route::post('ressonancia/contraste/store/{id}', [StoreContrastController::class, 'storeContrastRessonancia'])->name('store.contraste-ressonancia');

        Route::post('{id}/files/create', [TermFileController::class, 'create'])->name('create.term-file');
        Route::post('{id}/files/store', [TermFileController::class, 'store'])->name('store.term-file');

        
        Route::post('{id}/assinatura/create', [TermController::class, 'createSignature'])->name('create.term-signature');
        Route::post('{id}/assinaturas', [TermController::class, 'storeSignature'])->name('store.term-signature');

        Route::get('show_signature/{id}', [TriagemController::class, 'showSignature'])->name('show_signature');
    });
});
