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

use App\Http\Controllers\Categories\CategoryController;
use App\Http\Controllers\DeactivationController;
use App\Http\Controllers\Inventory\AdminController;
use App\Http\Controllers\Locations\LocationController;
use App\Http\Controllers\Profile\InformationController;
use App\Http\Controllers\Profile\SecurityController;
use App\Http\Controllers\Users\UsersControllers;
use App\Http\Controllers\WelcomeController;

Auth::routes(['register' => false]);

// Index pages
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/home', 'HomeController@index')->name('home');

// Item category routes
Route::get('/categorieen', [CategoryController::class, 'index'])->name('tags.overview');
route::post('/categorieen/zoeken', [CategoryController::class, 'search'])->name('tags.search');
Route::get('/nieuwe-categorie', [CategoryController::class, 'create'])->name('tags.create');
Route::post('/nieuwe-categorie', [CategoryController::class, 'store'])->name('tags.create');
Route::match(['get', 'delete'], '/categories/verwijder/{category}', [CategoryController::class, 'delete'])->name('tags.delete');
Route::get('/categorie/{category}', [CategoryController::class, 'show'])->name('tags.show');
Route::patch('/categorie/{category}', [CategoryController::class, 'update'])->name('tags.update');

// User management routes
Route::get('/gebruikers', [UsersControllers::class, 'index'])->name('users.index');
Route::get('/gebruiker/{user}', [UsersControllers::class, 'show'])->name('users.show');
Route::patch('/gebruikers/{userEntity}', [UsersControllers::class, 'update'])->name('users.update');
Route::get('/nieuwe-gebruiker', [UsersControllers::class, 'create'])->name('users.create');
Route::post('nieuwe-gebruiker', [UsersControllers::class, 'store'])->name('users.store');
Route::match(['get', 'delete'], '/gebruiker/{user}/verwijderen', [UsersControllers::class, 'destroy'])->name('users.destroy');

// User state routes
Route::get('/gedeactiveerd', [DeactivationController::class, 'show'])->name('user.blocked');
Route::get('/deactiveer/{user}', [DeactivationController::class, 'index'])->name('users.deactivate');
Route::post('/deactiveer/{user}', [DeactivationController::class, 'store'])->name('users.deactivate');
Route::get('/activeer/{user}', [DeactivationController::class, 'destroy'])->name('users.activate');

// Location routes
Route::get('/inzamelpunten', [LocationController::class, 'index'])->name('locations.index');
Route::post('/inzamelpunten/zoeken', [LocationController::class, 'search'])->name('locations.search');
Route::get('/inzamelpunt/{location}', [LocationController::class, 'show'])->name('locations.show');
Route::patch('/inzamelpunt/{location}', [LocationController::class, 'update'])->name('locations.update');
Route::get('/nieuw-inzamelpunt', [LocationController::class, 'create'])->name('locations.create');
Route::post('/nieuw-inzamelpunt', [LocationController::class, 'store'])->name('locations.store');
Route::match(['delete', 'get'], 'inzamelpunt/verwijder/{location}', [LocationController::class, 'destroy'])->name('locations.destroy');

// Inventory routes
Route::get('/inventaris', [AdminController::class, 'index'])->name('inventory.admin.index');
Route::get('/item/activiteit/{item}', [AdminController::class, 'interactionLog'])->name('inventory.admin.actions');
Route::get('/nieuw-item', [AdminController::class, 'create'])->name('inventory.admin.create');
Route::post('/nieuw-item', [AdminController::class, 'store'])->name('inventory.admin.store');
