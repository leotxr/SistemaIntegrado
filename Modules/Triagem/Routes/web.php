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
use Modules\Triagem\Http\Controllers\ReportController;
use Modules\Triagem\Http\Controllers\TriagemController;
use Modules\Triagem\Http\Controllers\GetFilasController;
use Modules\Triagem\Http\Controllers\CreateContrastController;
use Modules\Triagem\Http\Controllers\StoreContrastController;
use Modules\Triagem\Http\Controllers\StoreSignatureController;
use Modules\Triagem\Http\Controllers\TermFileController;
use Modules\Triagem\Http\Controllers\MonitoringController;

Route::get('teste-sig', function () {
    return view('triagem::teste-sig');
});


Route::middleware('auth')->group(function () {



        Route::prefix('triagem')->group(function () {
            Route::get('painel', [TriagemController::class, 'dashboard'])->name('triagem.dashboard');
            Route::get('relatorios', [ReportController::class, 'index'])->name('triagem.reports');
            Route::get('relatorios/x-clinic-sigma', function(){
                return view('triagem::painel.relatorios.relatorio-x-clinic-sigma');
            });
            Route::get('monitoramento', [MonitoringController::class, 'index'])->name('triagem.monitoring');
        });



    Route::prefix('triagem')->group(function () {
        Route::get('/', [TriagemController::class, 'index'])->name('triagem.index');

        Route::get('setor/ressonancia', [TermController::class, 'indexRessonancia'])->name('triagens.realizadas-ressonancia');
        Route::get('setor/tomografia', [TermController::class, 'indexTomografia'])->name('triagens.realizadas-tomografia');
        Route::get('setor/ressonanciaSub', [TermController::class, 'indexRessonanciaSub'])->name('triagens.realizadas-ressonancia-sub');

        Route::get('setor/ressonancia/fila', [GetFilasController::class, 'getRessonancia'])->name('filas.ressonancia');
        Route::get('setor/tomografia/fila', [GetFilasController::class, 'getTomografia'])->name('filas.tomografia');
        Route::get('setor/ressonanciaSub/fila', [GetFilasController::class, 'getRessonanciaSub'])->name('filas.ressonanciaSub');

        Route::get('nova-triagem/{setor_id}/{paciente_id}', function($setor_id, $paciente_id){

            if ($setor_id == 1 || $setor_id == 3)
                return view('triagem::ressonancia.create', compact('setor_id', 'paciente_id'));
            elseif($setor_id == 2)
                return view('triagem::tomografia.create', compact('setor_id', 'paciente_id'));
            else
                return redirect()->back();
        })->name('create.triagem');

        //Route::get('setor/{setor_id}/pac/{paciente_id}/create', [TermController::class, 'createTriagem'])->name('create.triagem');

        Route::post('ressonancia', [TermController::class, 'storeRessonancia'])->name('store.ressonancia');
        Route::post('tomografia', [TermController::class, 'storeTomografia'])->name('store.tomografia');

        Route::get('{id}/setor/{sector}/contraste/create', [CreateContrastController::class, 'createContrast'])->name('create.contraste');
        Route::post('ressonancia/contraste/store/{id}', [StoreContrastController::class, 'storeContrast'])->name('store.contraste');

        Route::any('{id}/files/create', [TermFileController::class, 'create'])->name('create.term-file');
        Route::post('{id}/files/store', [TermFileController::class, 'store'])->name('store.term-file');


        Route::get('{id}/assinatura/create', [TermController::class, 'createSignature'])->name('create.term-signature');
        Route::post('{id}/assinaturas', [StoreSignatureController::class, 'storeSignature'])->name('store.term-signature');

        Route::get('show_signature/{id}', [TriagemController::class, 'showSignature'])->name('show_signature');
    });
});
