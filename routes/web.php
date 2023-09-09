<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\RestrictionController;
use App\Http\Middleware\Language;
use App\Models\Restriction;

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

    Route::resource('customer', CustomerController::class);
    // Route::resource('restriction', RestrictionController::class);
    Route::prefix('restriction')->name('restriction.')
        ->controller(RestrictionController::class)->group(function () {
            Route::get('', 'index')->name('index');
            Route::get('{id}', 'show')->name('show');
            Route::get('/create/{id}', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::put('{id}/edit', 'update')->name('edit');
        });
});
