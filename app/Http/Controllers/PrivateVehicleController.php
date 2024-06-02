<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PrivateVehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Motorizaciones;
use App\Models\Detalle;

use App\Models\CodigoModelo;
use Illuminate\Support\Facades\Log;

class PrivateVehicleController extends Controller
{
    public function index()
    {
        // Obtener el usuario autenticado actualmente
        $user = Auth::user();

        // Verificar si el usuario está autenticado
        if ($user) {
            // Obtener los vehículos privados del usuario autenticado con sus detalles asociados y las relaciones de marca, modelo y motorización cargadas paginados
            $privateVehicles = $user->privateVehicles()->with('detail.marca', 'detail.modelo', 'detail.motorizacion', 'detail.codigoModelo')->paginate(3);

            // Formatear los datos de los vehículos privados
            $formattedData = $privateVehicles->map(function ($vehicle) {
                // Construir la ruta de la imagen
                $imagePath = 'img/' . $vehicle->detail->marca->nombre . '/' . $vehicle->detail->modelo->nombre . '/' . $vehicle->detail->motorizacion->nombre . '/' . $vehicle->detail->codigoModelo->codigo . '/image1.png';

                // Asignar la ruta de la imagen al campo correspondiente
                return [
                    'id' => $vehicle->id,
                    'user_id' => $vehicle->user_id,
                    'details_id' => $vehicle->details_id,
                    'marca' => $vehicle->detail->marca->nombre,
                    'modelo' => $vehicle->detail->modelo->nombre,
                    'version' => $vehicle->detail->motorizacion->nombre,
                    'año_desde' => $vehicle->detail->año_desde,
                    'cambio' => $vehicle->detail->cambio,
                    'c_aceite' => $vehicle->c_aceite,
                    'combustible' => $vehicle->detail->combustible,
                    'año_hasta' => $vehicle->detail->año_hasta,
                    'codigo' => $vehicle->detail->codigoModelo->codigo,
                    'torque' => $vehicle->detail->torque,
                    'proximo_c_aceite' => $vehicle->detail->proximo_c_aceite,
                    'cv' => $vehicle->detail->cv,
                    'descripcion' => $vehicle->detail->descripcion,
                    'image_url' => asset($imagePath), // Ruta completa de la imagen
                ];
            });

            // Obtener la información de paginación
            $paginationData = [
                'current_page' => $privateVehicles->currentPage(),
                'per_page' => $privateVehicles->perPage(),
                'total' => $privateVehicles->total(),
                'last_page' => $privateVehicles->lastPage(),
                'next_page_url' => null,
            ];

            // Obtener la URL para la página siguiente si existe
            if ($privateVehicles->hasMorePages()) {
                $paginationData['next_page_url'] = $privateVehicles->nextPageUrl();
            }

            // Devolver los datos formateados y la información de paginación como una respuesta JSON
            return response()->json([
                'data' => $formattedData,
                'pagination' => $paginationData
            ]);
        } else {
            // Si el usuario no está autenticado, retornar un mensaje de error
            return response()->json(['error' => 'Usuario no autenticado'], 401);
        }
    }


    public function show($id)
    {
        // Buscar el vehículo por su ID en la base de datos, incluyendo sus relaciones
        $vehicle = PrivateVehicle::with('detail.marca', 'detail.modelo', 'detail.motorizacion', 'detail.codigoModelo')->findOrFail($id);

        // Construir la ruta de la imagen
        $imagePath = 'img/' . $vehicle->detail->marca->nombre . '/' . $vehicle->detail->modelo->nombre . '/' . $vehicle->detail->motorizacion->nombre . '/' . $vehicle->detail->codigoModelo->codigo . '/image1.png';

        // Formatear los datos del vehículo
        $formattedData = [
            'id' => $vehicle->id,
            'user_id' => $vehicle->user_id,
            'details_id' => $vehicle->details_id,
            'marca' => $vehicle->detail->marca->nombre,
            'modelo' => $vehicle->detail->modelo->nombre,
            'version' => $vehicle->detail->motorizacion->nombre,
            'año_desde' => $vehicle->detail->año_desde,
            'c_aceite' => $vehicle->c_aceite,
            'cambio' => $vehicle->detail->cambio,
            'combustible' => $vehicle->detail->combustible,
            'año_hasta' => $vehicle->detail->año_hasta,
            'codigo' => $vehicle->detail->codigoModelo->codigo,
            'torque' => $vehicle->detail->torque,
            'proximo_c_aceite' => $vehicle->detail->proximo_c_aceite,
            'cv' => $vehicle->detail->cv,
            'descripcion' => $vehicle->detail->descripcion,
            'image_url' => asset($imagePath), // Ruta completa de la imagen
        ];

        // Devolver los datos formateados como respuesta JSON
        return response()->json($formattedData);
    }


    public function changeMileage(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'mileage_type' => 'required|in:c_aceite,proximo_c_aceite', // Solo permitir cambiar los campos de kilometraje especificados
            'new_mileage' => 'required|integer|min:0', // El nuevo kilometraje debe ser un número entero positivo
        ]);

        try {
            // Obtener el tipo de kilometraje y el nuevo kilometraje de la solicitud
            $mileageType = $request->input('mileage_type');
            $newMileage = $request->input('new_mileage');

            // Obtener el vehículo al que se aplicará el cambio de kilometraje (aquí se asume que se proporciona el ID del vehículo en la solicitud)
            $vehicleId = $request->input('vehicle_id');
            $vehicle = PrivateVehicle::findOrFail($vehicleId);

            // Aplicar el cambio de kilometraje al campo correspondiente
            if ($mileageType === 'c_aceite') {
                $vehicle->c_aceite = $newMileage;
            } elseif ($mileageType === 'proximo_c_aceite') {
                $vehicle->proximo_c_aceite = $newMileage;
            }

            // Guardar el vehículo actualizado en la base de datos
            $vehicle->save();

            // Retornar una respuesta de éxito
            return response()->json(['message' => 'Kilometraje actualizado correctamente'], 200);
        } catch (\Exception $e) {
            // Manejar cualquier error que pueda ocurrir
            return response()->json(['message' => 'Error al actualizar el kilometraje del vehículo'], 500);
        }
    }

    public function store(Request $request)
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            return response()->json(['message' => 'Usuario no autenticado'], 401);
        }

        // Validar la solicitud
        $validatedData = $request->validate([
            'details_id' => 'required|exists:details,id', // Asegurarse de que los detalles del vehículo existan en la base de datos
        ]);

        try {
            Log::info('Datos validados: ', $validatedData);
            // Crear un nuevo vehículo privado con los datos proporcionados en la solicitud y el ID del usuario autenticado
            $privateVehicle = PrivateVehicle::create([
                'details_id' => $request->input('details_id'),
                'user_id' => Auth::id(),
                // Aquí puedes agregar más campos según sea necesario
            ]);

            Log::info('Vehículo creado: ', $privateVehicle->toArray());
            // Retornar el vehículo recién creado como respuesta JSON
            return response()->json($privateVehicle, 201);
        } catch (\Exception $e) {
            Log::error('Error al crear el vehículo: ' . $e->getMessage());
            return response()->json(['message' => 'Error al crear el vehículo', 'error' => $e->getMessage()], 500);
        }
    }

    public function delete(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'id' => 'required|integer|exists:private_vehicles,id',
        ]);

        try {
            // Obtener el ID del cuerpo de la solicitud
            $id = $request->input('id');

            // Buscar el vehículo por su ID
            $vehicle = PrivateVehicle::findOrFail($id);

            // Eliminar el vehículo
            $vehicle->delete();

            // Retornar una respuesta de éxito
            return response()->json(['message' => 'Vehículo eliminado correctamente'], 200);
        } catch (\Exception $e) {
            // Manejar cualquier error que pueda ocurrir
            return response()->json(['message' => 'Error al eliminar el vehículo', 'error' => $e->getMessage()], 500);
        }
    }




}
