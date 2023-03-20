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

use Modules\Triagem\Http\Controllers\TermController;

Route::middleware('auth')->group(function () {
    Route::prefix('triagem')->group(function () {
        Route::get('/', 'TriagemController@index');
    });
});

Route::middleware('auth')->group(function () {
    Route::resource('triagem/terms', TermController::class);
});

Route::middleware('auth')->group(function () {
    Route::any('show_signature', 'TermController@showSignature')->name('show_signature');
});
