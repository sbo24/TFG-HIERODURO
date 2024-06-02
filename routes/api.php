<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrivateVehicleController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ModeloController;
use App\Http\Controllers\MotorizacionController;
use App\Http\Controllers\CodigoController;
use App\Http\Controllers\DetalleController;


Route::middleware(['auth'])->group(function () {
    Route::get('/api/v1/privatevehicles', [PrivateVehicleController::class, 'index']);
    Route::get('/api/v1/privatevehicles/{id}', [PrivateVehicleController::class, 'show']);
    Route::post('/api/v1/privatevehicles/store', [PrivateVehicleController::class, 'store']);
    Route::delete('/api/v1/privatevehicles/delete', [PrivateVehicleController::class, 'delete']);
    Route::post('/api/v1/vehicles/change-mileage', [PrivateVehicleController::class, 'changeMileage']);
});

Route::get('/api/v1/brands', [MarcaController::class, 'getAllBrands']);
Route::get('/api/v1/models/{marcaId}', [ModeloController::class, 'getmodelbybranchid']);
Route::get('/api/v1/motorization/{modelId}', [MotorizacionController::class, 'getmotoriacionbymodelid']);
Route::get('/api/v1/cp/{motorizacionId}', [CodigoController::class, 'getcpbymotocitation']);
Route::get('/api/v1/detalles/{marcaId}/{modeloId}/{versionId}/{codigoId}', [DetalleController::class, 'getDetails']);

