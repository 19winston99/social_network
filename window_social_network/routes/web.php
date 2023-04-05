<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('/home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::view('/terms&conditions', 'terms');
Route::get('/search', [App\Http\Controllers\UserController::class, 'search']);
Route::resource('/users', App\Http\Controllers\UserController::class);
Route::resource('/posts', App\Http\Controllers\PostController::class);