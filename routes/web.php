<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\Configuration\ConfiguracionController;
use App\Http\Controllers\LanguageController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

include_once 'api.php';
Route::middleware([SetLocale::class])->group(function () {
Route::get('/', function () {
    return view('pages.index');
});


Route::get('/get-token', function () {
    // Obtener el token de sesión
    $token = Session::token();
    return response()->json(['token' => $token], 200);
});

Auth::routes();

//INICIO


Route::get('', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//USER_SITE
Route::middleware(['auth'])->get('/zonaPrivada', function () {
    return view('pages.user_site');
})->name('user');



Route::get('/', function () {
    return view('pages.index');
})->name('index');


//CARSITE

Route::get('/vehiculos', function () {
    return view('pages.vehicle');
})->name('vehicle');


//BRANDS


Route::get('/marcas', [MarcaController::class, 'showAllBrands'])->name('brands');
Route::get('/marcas/{nombreMarca}', [MarcaController::class, 'showModelsByBrand']);




//COMPARATION

Route::get('/duelos', function () {
    return view('pages.comparation');
})->name('comparation');

//GOOGLE

Route::get('/auth/google/redirect', [LoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/auth/google/callback', [LoginController::class,  'handleGoogleCallback'])->name('google.callback');



//ADMIN

Route::middleware([AdminMiddleware::class])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
});


//LANG



// routes/web.php


    Route::get('lang/{locale}', [LanguageController::class, 'changeLanguage'])->name('changeLanguage');
});





