<?php

namespace App\Http\Controllers\Configuration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContentKey;
use App\Models\ContentValue;
use Illuminate\Support\Facades\File;

class ContentCaruselController extends Controller
{
    /**
     * Muestra el contenido del carrusel.
     *
     * @return \Illuminate\View\View
     */
    public function showCarouselContent()
    {
        // Obtener todas las claves y valores del contenido del carrusel
        $contentKeys = ContentKey::where('section', 'carusel')->with('values')->get();
        return view('admin.content.carusel.carusel', compact('contentKeys'));
    }

    /**
     * Muestra el formulario para crear un nuevo carrusel.
     *
     * @return \Illuminate\View\View
     */
    public function createCarouselContent()
    {
        return view('admin.content.carusel.create');
    }

    /**
     * Guarda el nuevo contenido del carrusel.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeCarouselContent(Request $request)
    {
        // Validar los datos de la solicitud
        $data = $request->validate([
            'key' => 'required|string|unique:content_keys,key',
            'values' => 'required|array',
            'values.*.language' => 'required|string',
            'values.*.value' => 'required|string',
        ]);

        // Crear la nueva clave de contenido
        $contentKey = ContentKey::create([
            'section' => 'carusel',
            'key' => $data['key'],
        ]);

        // Crear los valores asociados
        foreach ($data['values'] as $value) {
            ContentValue::create([
                'content_key_id' => $contentKey->id,
                'language' => $value['language'],
                'value' => $value['value'],
            ]);
        }

        // Sincronizar los archivos de idioma
        $this->syncCarouselContent();

        return redirect()->route('content.carusel.show')->with('success', 'Nuevo contenido del carrusel creado!');
    }

    /**
     * Actualiza el contenido del carrusel.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateCarouselContent(Request $request)
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
        $this->syncCarouselContent();

        return redirect()->route('content.carusel.show')->with('success', 'Contenido Actualizado!');
    }

    /**
     * Sincroniza los archivos de idioma del carrusel.
     *
     * @return string
     */
    public function syncCarouselContent()
    {
        // Recuperar los idiomas disponibles
        $languages = ['es', 'en']; // Puedes ampliar esta lista según tus necesidades

        foreach ($languages as $language) {
            // Recuperar las claves de contenido del carrusel para el idioma actual
            $contentKeys = ContentKey::whereHas('values', function ($query) use ($language) {
                $query->where('language', $language);
            })->where('section', 'carusel')->get();

            // Inicializar un array para almacenar el contenido del archivo de idioma
            $content = [];

            foreach ($contentKeys as $key) {
                // Recuperar el valor de la clave de contenido en el idioma actual
                $value = $key->values()->where('language', $language)->value('value');

                // Asignar el valor al array de contenido
                $content[$key->key] = $value;
            }

            // Definir la ruta del archivo de idioma en la carpeta "lang" en la raíz del proyecto
            $filePath = base_path("lang/{$language}/carousel.php");

            // Escribir el contenido en el archivo de idioma
            File::put($filePath, "<?php\n\nreturn " . var_export($content, true) . ";\n");
        }

        return "Contenido Actualizado!";
    }

    
}
