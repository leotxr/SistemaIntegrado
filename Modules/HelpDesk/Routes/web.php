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
use Modules\HelpDesk\Http\Livewire\Reports\ReportIndex;
use Modules\HelpDesk\Http\Livewire\Dashboard\TicketTabs;
use Modules\HelpDesk\Http\Livewire\Tickets\AllTickets;
use Modules\HelpDesk\Notifications\NotifyTicketCreated;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Notifications\NotifyTest;
use Illuminate\Support\Facades\Notification;

Route::middleware('auth')->group(function () {

    Route::prefix('helpdesk')->group(function () {

        Route::group(['middleware' => ['permission:editar chamados']], function () {

            #ROTAS PARA ACESSO AS PAGINAS
            Route::get('/', [TicketController::class, 'index'])->name('helpdesk.index');
            Route::get('/painel', [TicketController::class, 'index'])->name('helpdesk.dashboard');
            Route::get('/painel/chamados', [TicketController::class, 'all'])->name('helpdesk.tickets');
            Route::get('/painel/chamados/novo', [TicketController::class, 'create'])->name('helpdesk.tickets.create');
            Route::get('/painel/chamados/{id}/detalhes', [TicketController::class, 'edit'])->name('helpdesk.tickets.edit');
            Route::get('/painel/configuracoes/categorias', [CategoryController::class, 'index'])->name('helpdesk.settings.category');
            Route::get('/painel/configuracoes/sub-categorias', [SubCategoryController::class, 'index'])->name('helpdesk.settings.sub-category');
            Route::get('/painel/relatorios', '\Modules\HelpDesk\Http\Livewire\Reports\ReportIndex@__invoke')->name('helpdesk.reports');
            Route::get('/painel/relatorios/chamados-por-periodo', function () {
                return view('helpdesk::reports.tickets-by-date');
            })->name('helpdesk.reports.ticket-by-date');
            Route::get('/painel/notificacoes', [TicketController::class, 'notifications'])->name('helpdesk.notifications');

            #ROTAS PARA ACOES E CONTROLLERS LIVEWIRE
            Route::get('reopen/{ticket}', [AllTickets::class, 'confirmReopen'])->name('ticket.reopen');

        });

        Route::group(['middleware' => ['permission:abrir chamado']], function () {


            Route::get('/chamados', [GuestController::class, 'index'])->name('helpdesk.guest.index');
            Route::get('/chamados/novo', [GuestController::class, 'create'])->name('helpdesk.guest.create');
            Route::get('/chamados/{id}', [GuestController::class, 'show'])->name('helpdesk.guest.show');
            Route::post('/chamados/store', [TicketController::class, 'store'])->name('helpdesk.guest.store');
        });
    });
});
