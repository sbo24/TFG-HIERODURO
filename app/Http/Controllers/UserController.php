<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function totalUsuarios()
    {
        $totalUsuarios = User::count();
        return response()->json(['total_usuarios' => $totalUsuarios]);
    }
}
