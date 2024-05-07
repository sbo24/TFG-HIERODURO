<?php

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
