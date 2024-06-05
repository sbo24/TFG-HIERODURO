<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;
use App\Models\Modelo;

class MarcaController extends Controller
{
    public function getAllBrands()
    {
        $marcas = Marca::all();
        return response()->json($marcas);
    }


    public function showAllBrands()
    {
        $marcas = Marca::all();
        return view('pages.brands', ['marcas' => $marcas]);
    }

    public function showModelsByBrand($nombreMarca)
    {
        $marca = Marca::where('nombre', $nombreMarca)->firstOrFail();
        $modelos = Modelo::where('marca_id', $marca->id)
            ->with('motorizaciones', 'motorizaciones.codigosVersion')
            ->get();
        return view('pages.brandsModel', ['marca' => $marca, 'modelos' => $modelos]);
    }


    public function totalMarcas()
    {
        // Obtén el número total de modelos
        $totalModelos = Marca::count();

        return response()->json(['total_marcas' => $totalModelos]);
    }

}
