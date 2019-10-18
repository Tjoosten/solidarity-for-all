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
use App\Http\Controllers\Locations\LocationController;
use App\Http\Controllers\Profile\InformationController;
use App\Http\Controllers\Profile\SecurityController;
use App\Http\Controllers\Users\UsersControllers;
use App\Http\Controllers\WelcomeController;

Auth::routes(['register' => false]);

// Index pages
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/home', 'HomeController@index')->name('home');

// Account settings routes
Route::get('/account-informatie', [InformationController::class, 'index'])->name('profile.settings.info');
Route::patch('/account-informatie', [InformationController::class, 'update'])->name('profile.settings.info');
Route::get('/account-beveiliging', [SecurityController::class, 'index'])->name('profile.settings.security');
Route::patch('/account-beveiliging', [SecurityController::class, 'update'])->name('profile.settings.security');

// Item category routes
Route::get('/categorieen', [CategoryController::class, 'index'])->name('tags.overview');
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

// User state routes
Route::get('/gedeactiveerd', [DeactivationController::class, 'show'])->name('user.blocked');
Route::get('/deactiveer/{user}', [DeactivationController::class, 'index'])->name('users.deactivate');
Route::post('/deactiveer/{user}', [DeactivationController::class, 'store'])->name('users.deactivate');
Route::get('/activeer/{user}', [DeactivationController::class, 'destroy'])->name('users.activate');

// Location routes
Route::get('/inzamelpunten', [LocationController::class, 'index'])->name('locations.index');
Route::get('/nieuw-inzamelpunt', [LocationController::class, 'create'])->name('locations.create');
Route::post('/nieuw-inzamelpunt', [LocationController::class, 'store'])->name('locations.store');
