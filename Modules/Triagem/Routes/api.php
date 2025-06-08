<?php

use Illuminate\Http\Request;
use Modules\Triagem\Http\Controllers\ReportController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/triagem', function (Request $request) {
    return $request->user();
});

Route::post('/triagem/relatorios/triagens-por-data', [ReportController::class, 'getExamsByDate'])->name('triagem.relatorios.triagens-por-data');
Route::post('/triagem/relatorios/excel/triagens-por-data', [ReportController::class, 'exportExamsByDate'])->name('triagem.relatorios.excel.triagens-por-data');