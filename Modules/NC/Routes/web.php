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

        Route::get('relatorios', function () {
            return view('nc::reports.index');
        })->name('nc.reports');
    });

});
