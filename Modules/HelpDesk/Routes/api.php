<?php

use Illuminate\Http\Request;
use Modules\HelpDesk\Http\Controllers\TicketController;

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

Route::middleware('auth:api')->get('/helpdesk', function (Request $request) {
    return $request->user();
});

//Relatorio ticket
Route::get('/chamados/relatorios/tickets-por-data', [TicketController::class, 'getTicketsByDate'])->name('helpdesk.reports.ticket-por-data');
Route::get('/chamados/relatorios/excel/tickets-por-data', [TicketController::class, 'exportTicketsByDate'])->name('helpdesk.reports.excel.ticket-por-data');
