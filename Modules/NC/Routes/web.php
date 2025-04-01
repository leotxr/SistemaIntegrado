<?php

use Illuminate\Support\Facades\Route;
use Modules\NC\Entities\NonConformity;

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

    Route::prefix('nc')->group(function () {

        Route::get('/', function () {
            return view('nc::user.dashboard');
        })->name('nc.index');

        Route::get('index', function () {
            return view('nc::index');
        });

        Route::get('indicadores', function () {
            return view('nc::analytics.index');
        })->name('nc.analytics');

        Route::prefix('relatorios')->group(function () {
            Route::get('/', function () {
                return view('nc::reports.index');
            })->name('nc.reports');

            Route::get('recebidas-por-setor', function () {
                return view('nc::reports.received_by_sector');
            })->name('nc.reports.received-by-sector');

            Route::get('recebidas-por-funcionario', function () {
                return view('nc::reports.recebidas-por-funcionario');
            })->name('nc.reports.received-by-employee');
        });
    });
});
