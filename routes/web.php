<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Policies\PermissionController;
use App\Http\Controllers\Policies\RoleController;
use Illuminate\Support\Facades\Route;
use App\Models\Device;

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
    $devices = Device::all();
    return view('dashboard', compact('devices'));
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/', function () {
    return view('welcome');
})->middleware(['auth', 'verified'])->name('welcome');



Route::middleware('auth')->group(function () {

    Route::any('/userPassUpdate/{id}', [UserController::class, 'passwordUpdate'])->name('user.password');

    Route::group(['middleware' => ['role:Super-Admin|admin|ti']], function () {
        Route::resource('/users', UserController::class);
        Route::patch('/userSetRole/{id}', [UserController::class, 'setUserRole'])->name('setUserRole');
        Route::patch('/users/update_group/{id}', [UserController::class, 'setUserGroup'])->name('user.group_update');

        Route::get('/configuracoes', function () {
            return view('settings.index');
        });
        Route::get('/configuracoes/cargos-e-permissoes', SettingsController::class)->name('settings.roles-and-permissions');
        Route::get('/configuracoes/grupos-de-usuarios', function () {
            return view('settings.user-groups');
        })->name('settings.user-groups');

        Route::post('role/store', [RoleController::class, 'store'])->name('role.store');
        Route::post('permission/store', [PermissionController::class, 'store'])->name('permission.store');
        Route::post('role/set-permissions', [RoleController::class, 'set_permission'])->name('role.has.permission.store');
        /*
        Route::get('/dispositivos', function(){
            $devices = Device::all();
            return view('devices.index', compact('devices'));
        })->name('devices.devices');
        */
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
