<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;
use App\Models\Modelo;

class ModeloController extends Controller
{
    public function getmodelbybranchid($marcaId)
    {
        // Busca la marca por su ID 
        $marca = Marca::findOrFail($marcaId);

        // Obtén los modelos asociados a esta marca
        $modelos = $marca->modelos;

        return response()->json($modelos);
    }

    public function totalModelos()
    {
        // Obtén el número total de modelos
        $totalModelos = Modelo::count();

        return response()->json(['total_modelos' => $totalModelos]);
    }

    

    
}
