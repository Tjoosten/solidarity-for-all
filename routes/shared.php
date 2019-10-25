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
use App\Http\Controllers\Inventory\SharedController;

// Items routes
Route::get('inventory/{item}', [SharedController::class, 'show'])->name('inventory.show');

// Item state routes
Route::get('/inboeken/{item}', [CheckInController::class, 'create'])->name('inventory.checkin');
Route::post('/inboeken/{item}', [CheckInController::class, 'store'])->name('inventory.checkin');
