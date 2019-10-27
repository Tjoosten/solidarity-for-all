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
use App\Http\Controllers\Inventory\SharedController;

// Items routes
Route::get('inventory/{item}', [SharedController::class, 'show'])->name('inventory.show');
Route::patch('inventory/{item}', [SharedController::class, 'update'])->name('inventory.item.update');
Route::match(['get', 'delete'], 'inventory/{item}/verwijderen', [SharedController::class, 'destroy'])->name('inventory.item.destroy');

// Item state routes
Route::get('/inboeken/{item}', [CheckInController::class, 'create'])->name('inventory.checkin');
Route::post('/inboeken/{item}', [CheckInController::class, 'store'])->name('inventory.checkin');

Route::get('/uitboeken/{item}', [CheckoutController::class, 'create'])->name('inventory.checkout');
Route::post('/uitboeken/{item}', [CheckoutController::class, 'store'])->name('inventory.checkout');
