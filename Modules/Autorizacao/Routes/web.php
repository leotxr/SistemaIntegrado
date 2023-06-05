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

use Modules\Autorizacao\Http\Controllers\AutorizacaoController;
use Modules\Autorizacao\Http\Controllers\SolicitationController;

Route::middleware('auth')->group(function () {


    Route::prefix('autorizacao')->group(function(){
        Route::get('nova-solicitacao', [SolicitationController::class, 'create'])->name('autorizacao.create');
        Route::any('buscar-dados', [GetProtocolController::class])->name('getProtocol');
        Route::post('salvar-solicitacao', [AutorizacaoController::class, 'store'])->name('autorizacao.store');
        Route::get('minhas-solicitacoes', [AutorizacaoController::class, 'myProtocols'])->name('autorizacao.myprotocols');
        Route::get('relatorios', [AutorizacaoController::class, 'reports'])->name('autorizacao.reports');
        Route::get('/', [AutorizacaoController::class, 'index'])->name('autorizacao.index');
    });
});

