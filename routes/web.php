<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Policies\PermissionController;
use App\Http\Controllers\Policies\RoleController;
use Illuminate\Support\Facades\Route;

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

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/teste', function () {
    return view('teste');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/', function () {
    return view('welcome');
})->middleware(['auth', 'verified'])->name('welcome');





Route::any('/userPassUpdate/{id}', [UserController::class, 'passwordUpdate'])->name('user.password');

Route::group(['middleware' => ['role:Super-Admin|admin|ti']], function () {
    Route::resource('/users', UserController::class);
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/configuracoes/criar', SettingsController::class)->name('settings.create');
    Route::post('role/store', [RoleController::class, 'store'])->name('role.store');
    Route::post('permission/store', [PermissionController::class, 'store'])->name('permission.store');
    Route::post('role/set-permissions', [RoleController::class, 'set_permission'])->name('role.has.permission.store');
});

require __DIR__.'/auth.php';
