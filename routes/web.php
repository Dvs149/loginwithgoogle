<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Auth\SocialiteAuthController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('custom_auth');

Route::get('/logout', function () {
    auth()->logout();
    return redirect()->route('socialite-auth');
})->name('logout')->middleware('custom_auth');

Route::get('/auth/socialite-auth', [SocialiteAuthController::class,'index'])->name('socialite-auth');

 
Route::get('/auth/google/redirect', [SocialiteAuthController::class,'googleRedirect'])->name('googleRedirect');
Route::get('/auth/google/callback', [SocialiteAuthController::class,'googleCallback'])->name('googleCallback');