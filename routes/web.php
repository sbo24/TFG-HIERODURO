<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

include_once 'api.php';

Route::get('/', function () {
    return view('pages.index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//INICIO

Route::get('/home/userSite', function () {
    return view('pages.user_site');
})->name('user');

//USER_SITE

Route::get('/home', function () {
    return view('pages.index');
})->name('index');
