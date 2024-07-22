@extends('layout.app')

@section('title', 'Device')
@section('content')
<h1>Device</h1>

@section('content')
<div class="container mx-auto p-4">
    <div class="mt-6">
        <h2 class="text-xl font-semibold mb-4">Data Devices</h2>
        <a href="{{ route('device.create') }}" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600 mb-3 inline-block">Tambah</a>
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="w-1/4 py-2">ID</th>
                    <th class="w-1/2 py-2">Nama Device</th>
                    <th class="w-1/4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($devices as $device)
                    <tr>
                        <td class="border px-4 py-2">{{ $device->id }}</td>
                        <td class="border px-4 py-2">{{ $device->name }}</td>
                        <td class="border px-4 py-2 flex">
                            <a href="{{ route('device.edit', $device->id) }}" class="bg-blue-500 text-white py-1 px-3 rounded hover:bg-blue-600 mr-2">Edit</a>
                            <form action="{{ route('device.destroy', $device->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@endsection
