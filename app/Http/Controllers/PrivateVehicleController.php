<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PrivateVehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrivateVehicleController extends Controller
{

    public function index()
    {
        // Obtenemos el usuario autenticado
        $user = Auth::user();

        // Obtenemos los vehículos privados pertenecientes al usuario autenticado, paginados con 3 por página
        $vehicles = $user->privateVehicles()->paginate(3);

        // Retornamos los vehículos privados paginados en formato JSON
        return response()->json([
            'vehicles' => $vehicles,
        ]);
    }

    public function show($id)
    {
        // Buscar el vehículo por su ID en la base de datos
        $vehicle = PrivateVehicle::findOrFail($id);

        // Devolver los detalles del vehículo como respuesta JSON
        return response()->json($vehicle);
    }
}
