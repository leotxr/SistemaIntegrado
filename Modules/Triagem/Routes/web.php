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
use Modules\Triagem\Http\Controllers\StoreSignatureController;
use Modules\Triagem\Http\Controllers\TermFileController;

Route::get('teste-sig', function () {
    return view('triagem::teste-sig');
});

Route::group(['middleware' => ['role:radiologia|Super-Admin']], function () {
    Route::prefix('triagem')->group(function () {
        Route::get('painel', [TriagemController::class, 'dashboard'])->name('triagem.dashboard');
    });
});

Route::middleware('auth')->group(function () {
    

        Route::prefix('triagem')->group(function () {
            Route::get('/', [TriagemController::class, 'index'])->name('triagem.index');

            Route::get('setor/ressonancia', [TermController::class, 'indexRessonancia'])->name('triagens.realizadas-ressonancia');
            Route::get('setor/tomografia', [TermController::class, 'indexTomografia'])->name('triagens.realizadas-tomografia');

            Route::get('setor/ressonancia/fila', [GetFilasController::class, 'getRessonancia'])->name('filas.ressonancia');
            Route::get('setor/tomografia/fila', [GetFilasController::class, 'getTomografia'])->name('filas.tomografia');

            Route::get('setor/{setor_id}/pac/{paciente_id}/create', [TermController::class, 'createTriagem'])->name('create.triagem');

            Route::post('ressonancia', [TermController::class, 'storeRessonancia'])->name('store.ressonancia');
            Route::post('tomografia', [TermController::class, 'storeTomografia'])->name('store.tomografia');

            Route::get('{id}/setor/{sector}/contraste/create', [CreateContrastController::class, 'createContrast'])->name('create.contraste');
            Route::post('ressonancia/contraste/store/{id}', [StoreContrastController::class, 'storeContrast'])->name('store.contraste');

            Route::post('{id}/files/create', [TermFileController::class, 'create'])->name('create.term-file');
            Route::post('{id}/files/store', [TermFileController::class, 'store'])->name('store.term-file');


            Route::get('{id}/assinatura/create', [TermController::class, 'createSignature'])->name('create.term-signature');
            Route::post('{id}/assinaturas', [StoreSignatureController::class, 'storeSignature'])->name('store.term-signature');

            Route::get('show_signature/{id}', [TriagemController::class, 'showSignature'])->name('show_signature');
        });
   
});
