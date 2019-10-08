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

use App\Http\Controllers\WelcomeController;

Auth::routes(['register' => false]);

// Index pages
Route::get('/',[WelcomeController::class, 'index'])->name('welcome');
Route::get('/home', 'HomeController@index')->name('home');
