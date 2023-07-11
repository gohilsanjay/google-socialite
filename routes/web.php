<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\GoogleAuthControlle;
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
    return view('welcome');
});

Auth::routes();

Route::post('logout',[LoginController::class,'logout'])->name('logout');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('auth/google',[GoogleAuthControlle::class,'redirect'])->name('google-auth');
Route::get('auth/google/call-back',[GoogleAuthControlle::class,'callbackGoogle']);