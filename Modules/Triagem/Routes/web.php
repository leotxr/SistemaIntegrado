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
/*
Route::prefix('triagem')->group(function() {
    Route::get('/', 'TriagemController@index');
});
*/

use Modules\Triagem\Http\Controllers\TriagemController;

Route::resource('terms', TermController::class);
Route::resource('triagem', TriagemController::class);