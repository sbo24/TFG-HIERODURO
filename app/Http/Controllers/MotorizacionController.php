<?php

namespace App\Http\Controllers;

use App\Models\Modelo;
use Illuminate\Http\Request;

class MotorizacionController extends Controller
{
    public function getmotoriacionbymodelid($modelId)
    {
        // Busca la marca por su ID
        $modelo = Modelo::findOrFail($modelId);

        // Obtén los modelos asociados a esta marca
        $modelos = $modelo->motorizaciones;

        return response()->json($modelos);
    }
}
