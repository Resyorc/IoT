<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Sensor;
use App\Models\Relay;                       
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index()
    {
        $devices = Device::all();
        return view('device', compact('devices'));
    }

    public function create()
    {
        return view('device.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $device = Device::create([
            'name' => $request->name,
        ]);

         // Buat sensor dengan nilai default 0
         Sensor::create([
            'device_id' => $device->id,
            'soil_moisture' => 0,
            'humidity' => 0,
            'temperature' => 0
        ]);

        // Buat relay dengan status default 'off'
        Relay::create(['device_id' => $device->id, 'status' => 'off']);

        return redirect()->route('page.device');
    }

    public function edit(Device $device)
    {
        return view('device.edit', compact('device'));
    }

    public function update(Request $request, Device $device)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $device->update([
            'name' => $request->name,
        ]);

        return redirect()->route('page.device');
    }

    public function destroy(Device $device)
    {
        $device->delete();
        return redirect()->route('page.device');
    }
}
