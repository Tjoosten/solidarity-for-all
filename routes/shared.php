<?php

/*
|--------------------------------------------------------------------------
| Shared Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register shared web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\Inventory\CheckInController;
use App\Http\Controllers\Inventory\CheckoutController;
use App\Http\Controllers\Profile\InformationController;
use App\Http\Controllers\Profile\SecurityController;
use App\Http\Controllers\Inventory\SharedController;

// Account settings routes
Route::get('/account-informatie', [InformationController::class, 'index'])->name('profile.settings.info');
Route::patch('/account-informatie', [InformationController::class, 'update'])->name('profile.settings.info');
Route::get('/account-beveiliging', [SecurityController::class, 'index'])->name('profile.settings.security');
Route::patch('/account-beveiliging', [SecurityController::class, 'update'])->name('profile.settings.security');

// Items routes
Route::get('inventory/{item}', [SharedController::class, 'show'])->name('inventory.show');
Route::patch('inventory/{item}', [SharedController::class, 'update'])->name('inventory.item.update');
Route::match(['get', 'delete'], 'inventory/{item}/verwijderen', [SharedController::class, 'destroy'])->name('inventory.item.destroy');
Route::post('/inventory/zoeken', [SharedController::class, 'search'])->name('inventory.search');

// Item state routes
Route::get('/inboeken/{item}', [CheckInController::class, 'create'])->name('inventory.checkin');
Route::post('/inboeken/{item}', [CheckInController::class, 'store'])->name('inventory.checkin');

Route::get('/uitboeken/{item}', [CheckoutController::class, 'create'])->name('inventory.checkout');
Route::post('/uitboeken/{item}', [CheckoutController::class, 'store'])->name('inventory.checkout');
