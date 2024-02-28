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

Route::middleware('auth')->group(function () {
    Route::prefix('laudo')->group(function () {
        Route::get('/', function () {
            return view('laudo::index');
        })->name('laudo.index');

        Route::prefix('indicadores')->group(function () {

            Route::get('/', function () {
                return view('laudo::analytics.index');
            })->name('laudo.analytics.index');

            Route::get('exames-pendentes', function () {
                return view('laudo::analytics.pending-exams');
            })->name('laudo.analytics.pending-exams');
        });

        Route::prefix('relatorios')->group(function () {

            Route::get('/', function () {
                return view('laudo::reports.index');
            })->name('laudo.reports.index');

            Route::get('exames-sem-laudar', function () {
                return view('laudo::reports.pending-exams');
            })->name('laudo.reports.exams-without-report');

            Route::get('exames-sem-assinar', function () {
                return view('laudo::reports.pending-exams');
            })->name('laudo.reports.exams-without-signature');

            Route::get('exames-pendentes-de-revisao', function () {
                return view('laudo::reports.pending-exams');
            })->name('laudo.reports.exams-to-review');

            Route::get('exames-sem-medico-vinculado', function () {
                return view('laudo::reports.pending-exams');
            })->name('laudo.reports.exams-without-doctor');

        });

    });
});
