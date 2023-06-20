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
use Modules\HelpDesk\Http\Controllers\GuestController;

Route::middleware('auth')->group(function () {

    Route::prefix('helpdesk')->group(function () {

        Route::group(['middleware' => ['permission:editar chamados']], function () {
            
                Route::get('/', [TicketController::class, 'index'])->name('helpdesk.index');
                Route::get('/painel', [TicketController::class, 'index'])->name('helpdesk.dashboard');
                Route::get('/configuracoes/categorias', [CategoryController::class, 'index'])->name('helpdesk.settings.category');
                Route::get('/configuracoes/sub-categorias', [SubCategoryController::class, 'index'])->name('helpdesk.settings.sub-category');
            
        });

        Route::group(['middleware' => ['permission:abrir chamado']], function () {
            
                
                Route::get('/chamados', [GuestController::class, 'index'])->name('helpdesk.guest.index');
                Route::get('/chamados/novo', [GuestController::class, 'create'])->name('helpdesk.guest.create');
                Route::get('/chamados/{id}', [GuestController::class, 'show'])->name('helpdesk.guest.show');
                Route::post('/chamados/store', [TicketController::class, 'store'])->name('helpdesk.guest.store');
                
        });
    });
});
