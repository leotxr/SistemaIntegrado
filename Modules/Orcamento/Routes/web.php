<?php


use Modules\Orcamento\Http\Livewire\Reports\Index;
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

        Route::get('/painel', function() {
            return view('orcamento::dashboard');
        })->name('orcamento.dashboard');
/*
        Route::get('/relatorio', function() {
            return view('orcamento::report');
        })->name('orcamento.reports');
*/
Route::get('/relatorio', '\Modules\Orcamento\Http\Livewire\Reports\Index@__invoke')->name('orcamento.reports');

        Route::prefix('relatorio')->group(function () {
            Route::get('/solicitacoes-alteradas', function(){
                return view('orcamento::reports.changed-budgets');
            })->name('orcamento.changed-budgets');
            Route::get('/totalizador-solicitacoes-criadas', function(){
                return view('orcamento::reports.totalizer-budgets');
            })->name('orcamento.totalizer-budgets');
            Route::get('/solicitacoes-criadas-x-alteradas', function(){
                return view('orcamento::reports.created-changed-budgets');
            })->name('orcamento.created-changed-budgets');
            Route::get('/totalizador-solicitacoes-alteradas', function(){
                return view('orcamento::reports.totalizer-changed-budgets');
            })->name('orcamento.totalizer-changed-budgets');
        });
    });

});
