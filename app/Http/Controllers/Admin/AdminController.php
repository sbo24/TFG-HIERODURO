<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Muestra el panel de administración.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    public function showContentForm()
    {
        $content = ''; // Recupera el contenido desde la base de datos o desde un archivo
        return view('admin.content', compact('content'));
    }


  
}
