<?php

namespace App\Http\Controllers;

use App\Models\Motorizaciones;
use Illuminate\Http\Request;

class CodigoController extends Controller
{
    public function getcpbymotocitation($motorizacionId)
    {

        // Busca la motorización por su ID
        $motorizacion = Motorizaciones::findOrFail($motorizacionId);

        // Obtén los códigos de versión asociados a esta motorización
        $codigosVersion = $motorizacion->codigosVersion;

        return response()->json($codigosVersion);
    }
}
