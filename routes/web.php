<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InstallmentController;
use App\Http\Controllers\RestrictionController;
use App\Http\Middleware\Language;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/roles', [Controller::class, 'roles']);
// Route::get('users/export/', [HomeController::class, 'export']);

Route::middleware(Language::class)->group(function () {

    Route::get('/', function () {
        return view('welcome');
    });

    Auth::routes();

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Route::resource('customer', CustomerController::class);

    Route::prefix('customer')->name('customer.')
        ->controller(CustomerController::class)->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('{id}', 'show')->name('show');
            Route::get('{id}/filter', 'filter')->name('filter');
            Route::post('{id}/delete', 'destroy')->name('delete');
        });

    Route::prefix('installment')->name('installment.')
        ->controller(InstallmentController::class)->group(function () {
            Route::get('{id}', 'show')->name('show');
        });

    // Route::resource('restriction', RestrictionController::class);
    Route::prefix('restriction')->name('restriction.')
        ->controller(RestrictionController::class)->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('/create/{id}', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('{id}', 'show')->name('show');
            Route::put('{id}/edit', 'update')->name('edit');
            Route::post('{id}/delete', 'destroy')->name('delete');
        });

    Route::prefix('admin')->name('admin.')
        ->controller(AdminController::class)->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('{id}', 'show')->name('show');
            Route::post('{id}/edit', 'update')->name('edit');
            Route::post('{id}/delete', 'destroy')->name('delete');
        });
});
