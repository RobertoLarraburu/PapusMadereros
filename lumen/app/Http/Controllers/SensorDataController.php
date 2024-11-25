<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SensorData; // Importa el modelo

class SensorDataController extends Controller
{
    // Método para almacenar datos
    public function store(Request $request)
    {
        // Validar que los datos están presentes
        $this->validate($request, [
            'troncos' => 'required|integer',
            'largo' => 'required|numeric'
        ]);

        // Crear el registro en la base de datos usando el modelo
        $sensorData = SensorData::create([
            'troncos' => $request->input('troncos'),
            'largo' => $request->input('largo')
        ]);

        // Devolver una respuesta JSON de confirmación
        return response()->json([
            'status' => 'success',
            'data' => $sensorData
        ]);
    }

    // Método para listar datos
    public function index()
    {
        $sensorData = SensorData::all(); // Obtiene todos los registros de la base de datos
        return response()->json($sensorData);
    }
}
