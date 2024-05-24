<?php

namespace App\Http\Controllers\Configuration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContentKey;
use App\Models\ContentValue;
use Illuminate\Support\Facades\File;

class ContentHeaderController extends Controller
{
    /**
     * Muestra el contenido del encabezado.
     *
     * @return \Illuminate\View\View
     */
    public function showHeaderContent()
    {
        // Obtener todas las claves y valores del contenido del encabezado
        $contentKeys = ContentKey::where('section', 'header')->with('values')->get();
        return view('admin.content.header.header', compact('contentKeys'));
    }

    /**
     * Actualiza el contenido del encabezado.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
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
            $contentValue = ContentValue::findOrFail($content['id']);
            $contentValue->update(['value' => $content['value']]);
        }

        // Sincronizar los archivos de idioma
        $this->syncHeaderContent();

        return redirect()->route('content.header.show')->with('success', 'Contenido Actualizado!');
    }

    /**
     * Sincroniza los archivos de idioma del encabezado.
     *
     * @return string
     */





    public function syncHeaderContent()
    {
        // Recuperar los idiomas disponibles
        $languages = ['es', 'en']; // Puedes ampliar esta lista según tus necesidades

        foreach ($languages as $language) {
            // Recuperar las claves de contenido del encabezado para el idioma actual
            $contentKeys = ContentKey::whereHas('values', function ($query) use ($language) {
                $query->where('language', $language);
            })->where('section', 'header')->get();

            // Inicializar un array para almacenar el contenido del archivo de idioma
            $content = [];

            foreach ($contentKeys as $key) {
                // Recuperar el valor de la clave de contenido en el idioma actual
                $value = $key->values()->where('language', $language)->value('value');

                // Asignar el valor al array de contenido
                $content[$key->key] = $value;
            }

            // Definir la ruta del archivo de idioma en la carpeta "lang" en la raíz del proyecto
            $filePath = base_path("lang/{$language}/header.php");

            // Escribir el contenido en el archivo de idioma
            File::put($filePath, "<?php\n\nreturn " . var_export($content, true) . ";\n");
        }

        return "Contenido Actualizado!";
    }


}
