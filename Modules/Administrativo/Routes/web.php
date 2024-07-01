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
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::prefix('administrativo')->group(function () {

        Route::get('/', function () {
            return view('administrativo::index');
        })->name('administrativo.index');

        Route::prefix('financeiro')->group(function () {

            Route::get('/', function(){
                return view('administrativo::financial.invoices.dashboard');
            })->name('administrativo.financial');

            Route::get('/exames-sirius', function(){
                return view('administrativo::financial.invoices.index');
            })->name('administrativo.financial.invoices');

            Route::get('/exames-sirius/novo', function () {
                return view('administrativo::financial.invoices.create');
            })->name('administrativo.financial.invoices.create');

        });

        Route::prefix('rh')->group(function () {
            Route::get('/', function(){
                return view('administrativo::rh.index');
            })->name('administrativo.rh');
        });



        Route::get('/monitoramento', function () {
            return view('administrativo::monitoramento.index');
        })->name('adm.monitoring');
        Route::prefix('recepcao')->group(function(){
            Route::get('/fila-de-espera', function () {
                return view('administrativo::monitoramento.reception.index');
            })->name('adm.reception');
            Route::get('/fila-de-espera/relatorio', function(){
                return view('administrativo::monitoramento.reception.report');
            })->name('adm.reception.report');
        });


        Route::prefix('servicos-extras')->group(function(){
           Route::get('/', function(){
              return view('administrativo::extra_services.dashboard.index');
           })->name('adm.extra_services.index');
        });


    });

});
