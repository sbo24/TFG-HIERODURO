<?php

namespace App\Http\Controllers\Configuration;

use App\Http\Controllers\Controller;
use App\Models\ContentKey;
use Illuminate\Http\Request;
use App\Models\ContentValue;
use App\Models\Detalle;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CarDetailController extends Controller
{
    public function editar($id)
    {
        $detail = Detalle::findOrFail($id);
        return view('admin.content.header.details', compact('detail'));
    }

    public function index()
    {
        $details = Detalle::all();
        return view('admin.content.details', compact('details'));
    }

    public function update(Request $request, $id)
    {
        $detail = Detalle::findOrFail($id);

        // Verifica el idioma actual y guarda la descripción en el campo correspondiente
        if (app()->getLocale() == 'en') {
            $detail->descripcion_en = $request->input('descripcion');
        } else {
            $detail->descripcion = $request->input('descripcion');
        }

        $detail->save();

        return redirect()->back()->with('success', 'La descripción se ha actualizado correctamente.');
    }

}
