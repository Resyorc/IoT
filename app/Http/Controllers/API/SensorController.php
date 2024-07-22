<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Sensor;
use App\Models\SensorData;
use Illuminate\Http\Request;
use App\Http\Resources\SensorResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class SensorController extends Controller
{
    public function index()
    {
        // Mengambil semua data Sensor
        $sensors = Sensor::all();

        // Mengembalikan data dalam bentuk resource collection
        return response()->json(SensorResource::collection($sensors));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'device_id' => 'required|integer',
            'soil_moisture' => 'required|numeric|min:0|max:100',
            'humidity' => 'required|numeric|min:0|max:100',
            'temperature' => 'required|numeric',
        ]);

        Log::info('Data yang divalidasi: ', $validated);

        // Simpan data ke tabel sensors
        $sensor = Sensor::create($validated);

        // Simpan data ke tabel sensor_data
        SensorData::create([
            'sensor_id' => $sensor->id,
            'average_temperature' => $validated['temperature'],
            'average_humidity' => $validated['humidity'],
            'average_soil_moisture' => $validated['soil_moisture'],
        ]);

        return response()->json(['message' => 'Sensor data stored and processed successfully'], 201);
    }

    public function show($id)
    {
        $sensor = Sensor::find($id);

        if (is_null($sensor)) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        return response()->json(new SensorResource($sensor));
    }

    public function showSensorData($id)
    {
        $sensorData = SensorData::find($id);

        if (is_null($sensorData)) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        return response()->json(new SensorDataResource($sensorData));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'soil_moisture' => 'numeric',
            'humidity' => 'numeric',
            'temperature' => 'numeric',
            'device_id' => 'integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $sensor = Sensor::find($id);

        if (is_null($sensor)) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        $sensor->update($request->all());

        return response()->json(new SensorResource($sensor), 200);
    }

    public function destroy($id)
    {
        $sensor = Sensor::find($id);

        if (is_null($sensor)) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        $sensor->delete();

        return response()->json(null, 204);
    }
}
