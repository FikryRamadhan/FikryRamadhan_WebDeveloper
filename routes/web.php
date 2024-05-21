<?php

use App\Http\Controllers\InvoiseController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MenuController;
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

Route::group(['middleware' => 'guest'], function() {
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'authenticate'])->name('proses.login');

    Route::get('register', [LoginController::class, 'register'])->name('register.index');
    Route::post('register', [LoginController::class, 'daftar'])->name('register.daftar');
});


Route::group(['middleware' => 'auth'], function() {
    // Dashboard
    Route::redirect('/', 'dashboard');
    Route::get('dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('import-templates/{filename}', [\App\Http\Controllers\DashboardController::class, 'templateImport'])->name('import_templates');
    Route::get('logout', [\App\Http\Controllers\LoginController::class, 'logout'])->name('logout');

    // Setting Action
    Route::prefix('setiing')->group(function(){
        Route::get('change_pasword', [\App\Http\Controllers\SettingController::class, 'viewChangePassword'])->name('setting.change_password');
        Route::put('{user}/change_pasword', [\App\Http\Controllers\SettingController::class, 'actionChangePassword'])->name('setting.save_password');
        Route::get('profile', [\App\Http\Controllers\SettingController::class, 'viewProfile'])->name('setting.profile');
        Route::put('{user}/profile', [\App\Http\Controllers\SettingController::class, 'actionProfile'])->name('setting.save_profile');
    });

    // Menu Action
    Route::prefix('menu')->group(function(){
        Route::get('', [MenuController::class, 'index'])->name('menu.index');
        Route::get('create', [MenuController::class, 'create'])->name('menu.create');
        Route::post('store', [MenuController::class, 'store'])->name('menu.store');
        Route::get('{menu}/edit', [MenuController::class, 'edit'])->name('menu.edit');
        Route::put('{menu}/update', [MenuController::class, 'update'])->name('menu.update');
        Route::delete('{menu}/delete', [MenuController::class, 'destroy'])->name('menu.destroy');
    });

    // Invoces Action
    Route::prefix('invoices')->group(function(){
        Route::get('', [InvoiseController::class, 'index'])->name('invoices.index');
        Route::get('/merchant', [InvoiseController::class, 'indexForMerchant'])->name('invoices.get');
        Route::get('create', [InvoiseController::class, 'create'])->name('invoices.create');
        Route::get('{invoice}/detail', [InvoiseController::class, 'detail'])->name('invoices.detail');
        Route::post('store', [InvoiseController::class, 'store'])->name('invoices.store');
    });

        // food Action
        Route::prefix('food')->group(function(){
            Route::get('', [MenuController::class, 'forCustomer'])->name('food.index');
        });
});