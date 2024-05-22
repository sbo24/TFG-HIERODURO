<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function changeLanguage($locale)
    {
        // Verificar si el idioma está permitido
        if (in_array($locale, ['en', 'es'])) {
            Session::put('locale', $locale);
        }

        return redirect()->back();
    }
}