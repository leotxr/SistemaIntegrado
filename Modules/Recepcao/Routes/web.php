<?php

use Illuminate\Support\Facades\Route;

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

Route::middleware('auth')->group(function () {

    Route::prefix('recepcao')->group(function () {

        Route::get('/', function () {
            return view('recepcao::index');
        })->name('recepcao.index');

        Route::get('/agendas', function () {
            return view('recepcao::schedules.index');
        })->name('recepcao.schedules');

        Route::prefix('monitoramento')->group(function () {

            Route::get('/', function () {
                return view('recepcao::monitoring.index');
            })->name('recepcao.monitoring');

            Route::get('/fila-de-espera', function () {
                return view('recepcao::monitoring.dashboard.index');
            })->name('recepcao.monitoring.wait-queue');

        });
    });
});
