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

Route::prefix('autorizacao')->group(function() {
    Route::get('/', function () {
        return view('autorizacao::dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');
});

Route::get('autorizacao/relatorioexames', 'AutorizacaoController@relExams');
Route::any('showtableexams', 'AutorizacaoController@showRelExams')->name('showtableexams');

Route::resource('autorizacao', AutorizacaoController::class);


//Route::resource('protocols', ProtocolController::class);
Route::any('getProtocol', 'AutorizacaoController@getProtocol')->name('getProtocol');
Route::any('storewtprotocol', 'AutorizacaoController@storewtprotocol')->name('storewtprotocol');
Route::any('showlistaut', 'AutorizacaoController@showListAut')->name('showlistaut');
Route::any('destroy_exam/{exam}', 'ExamController@destroy');
Route::any('destroy_protocol/{protocol}', 'ProtocolController@destroy');
Route::any('update_exam/{exam}', 'AutorizacaoController@update');


#Route::GET('createProtocol', 'AutorizacaoController@create')->name('createProtocol');



