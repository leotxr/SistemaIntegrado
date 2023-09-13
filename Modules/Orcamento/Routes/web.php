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
    Route::prefix('orcamento')->group(function () {
        Route::get('/', function () {
            return view('orcamento::index');
        })->name('orcamento.index');

        Route::get('/relatorio', function() {
            return view('orcamento::report');
        });
    });
});
