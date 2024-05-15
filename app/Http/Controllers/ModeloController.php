<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;

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

    

    
}
