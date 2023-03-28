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

use Modules\HelpDesk\Http\Controllers\TicketController;
use Modules\HelpDesk\Http\Controllers\CategoryController;
use Modules\HelpDesk\Http\Controllers\SubCategoryController;
use Modules\HelpDesk\Http\Controllers\StatusController;

Route::middleware('auth')->group(function () {
Route::prefix('helpdesk')->group(function () {
    Route::get('/', 'HelpDeskController@index');
    Route::get('/configuracoes', 'HelpDeskController@create');
});
});

Route::middleware('auth')->group(function () {
    Route::get('helpdesk/chamados/{id}/edit', 'TicketController@edit')->name('ticket.edit');
    Route::get('helpdesk/chamados/{id}/{novo_status}', 'TicketController@update')->name('ticket.status_update');
    Route::resource('helpdesk/chamados', TicketController::class);
    Route::resource('helpdesk/setores', SectorController::class);
    Route::get('helpdesk/categorias', [CategoryController::class, 'store'])->name('categorias.store');
    Route::get('helpdesk/sub_categorias', [SubCategoryController::class, 'store'])->name('sub_categorias.store');
    Route::get('helpdesk/statuses', [StatusController::class, 'store'])->name('statuses.store');

});
