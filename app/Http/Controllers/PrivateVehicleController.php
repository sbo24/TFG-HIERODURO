<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PrivateVehicle;
use Illuminate\Http\Request;

class PrivateVehicleController extends Controller
{
    public function index()
    {
        $vehicles = PrivateVehicle::all();

        return response()->json([
            'vehicles' => $vehicles,
        ]);
    }
    
}
