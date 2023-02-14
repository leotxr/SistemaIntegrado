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

/*
Route::prefix('administrativo')->group(function() {
    Route::get('/', function () {
        return view('administrativo::dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');
});
*/

Route::resource('extratimes', ExtraTimeController::class);
Route::resource('missedtimes', MissedTimeController::class);
Route::resource('administrativo', AdministrativoController::class);
