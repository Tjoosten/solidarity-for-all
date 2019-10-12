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

// User management routes
Route::get('/gebruikers', [UsersControllers::class, 'index'])->name('users.index');
