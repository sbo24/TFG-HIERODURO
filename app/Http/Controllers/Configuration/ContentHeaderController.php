<?php

namespace App\Http\Controllers\Configuration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\ContentKey;
use App\Models\ContentValue;
use App\Models\Detalle;

class ContentHeaderController extends Controller
{

    public function showHeaderContent()
    {
        // Obtener todas las claves y valores del contenido del encabezado
        $contentKeys = ContentKey::where('section', 'header')->with('values')->get();
        return view('admin.content.header.header', compact('contentKeys'));
    }

    public function updateHeaderContent(Request $request)
    {
        // Validar los datos de la solicitud
        $data = $request->validate([
            'content' => 'required|array',
            'content.*.id' => 'required|exists:content_values,id',
            'content.*.value' => 'required|string',
        ]);

        // Actualizar los valores en la base de datos
        foreach ($data['content'] as $content) {
            $contentValue = ContentValue::find($content['id']);
            $contentValue->value = $content['value'];
            $contentValue->save();
        }

        // Sincronizar los archivos de idioma
        $this->syncHeaderContent();

        return redirect()->route('content.header.show')->with('success', 'Contenido Actualizado!');
    }



    public function syncHeaderContent()
    {
        // Recuperar las claves de contenido del encabezado
        $contentKeys = ContentKey::where('section', 'detalles')->with('values')->get();

        foreach ($contentKeys as $key) {
            foreach ($key->values as $value) {
                // Obtener la descripción de los detalles desde la tabla details
                $description = Detalle::find($value->detail_id)->descripcion;

                // Obtener el archivo de idioma correspondiente
                $filePath = base_path("lang/{$value->language}/detalles.php");

                // Verificar si el archivo de idioma existe
                if (File::exists($filePath)) {
                    // Obtener contenido actual del archivo de idioma
                    $content = include $filePath;

                    // Agregar o actualizar el valor de contenido
                    $content[$key->key] = $description;

                    // Escribir el contenido actualizado en el archivo de idioma
                    File::put($filePath, "<?php\n\nreturn " . var_export($content, true) . ";");
                } else {
                    // Si el archivo no existe, crear uno nuevo con el contenido
                    File::put($filePath, "<?php\n\nreturn [" . var_export($key->key, true) . " => " . var_export($description, true) . "];");
                }
            }
        }

        return "Contenido Actualizado!";
    }
}
