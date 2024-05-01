<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrivateVehicleController;



Route::middleware('auth:api')->group(function () {
    Route::get('/api/v1/privatevehicles', [PrivateVehicleController::class, 'index']);
});
