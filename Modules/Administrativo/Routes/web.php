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


use Modules\Administrativo\Http\Controllers\AdministrativoController;
use Modules\Administrativo\Http\Livewire\Monitoring\QueueMonitoring;

Route::prefix('administrativo')->group(function () {
    Route::get('/monitoramento', function(){
        return view('administrativo::monitoramento.index');
    })->name('adm.monitoring');
    Route::get('/recepcao/fila-de-espera', function(){
        return view('administrativo::monitoramento.reception');
    })->name('adm.reception');

    Route::get('/', [AdministrativoController::class, 'index'])->name('administrativo.index');
});
