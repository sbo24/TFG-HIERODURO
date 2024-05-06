<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrivateVehicleController;




Route::middleware(['auth'])->group(function () {
    Route::get('/api/v1/privatevehicles', [PrivateVehicleController::class, 'index']);
    Route::get('/api/v1/privatevehicles/{id}', [PrivateVehicleController::class, 'show']);
    Route::post('/api/v1/vehicles/change-mileage', [PrivateVehicleController::class, 'changeMileage']);
});

