<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

include_once 'api.php';

Route::get('/', function () {
    return view('pages.index');
});

Auth::routes();

//INICIO


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//USER_SITE
Route::middleware(['auth'])->get('/home/userSite', function () {
    return view('pages.user_site');
})->name('user');



Route::get('/home', function () {
    return view('pages.index');
})->name('index');


//CARSITE

Route::get('/home/vehicles', function () {
    return view('pages.vehicle');
})->name('vehicle');


//COMPARATION

Route::get('/home/comparation', function () {
    return view('pages.comparation');
})->name('comparation');

//GOOGLE

Route::get('/auth/google/redirect', [LoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/auth/google/callback', [LoginController::class,  'handleGoogleCallback'])->name('google.callback');



