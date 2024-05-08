<?php

namespace App\Http\Controllers;

use App\Models\Detalle;
use Illuminate\Http\Request;

class DetalleController extends Controller
{
    public function getDetails($marcaId, $modeloId, $versionId, $codigoId)
    {
        // Busca los detalles que coincidan con los IDs proporcionados
        $detalles = Detalle::where('marca_id', $marcaId)
            ->where('modelo_id', $modeloId)
            ->where('version_id', $versionId)
            ->where('codigo_id', $codigoId)
            ->get();

        return response()->json($detalles);
    }
}
