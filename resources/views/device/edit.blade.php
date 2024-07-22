@extends('layout.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Edit Device</h1>
    <form action="{{ route('device      .update', $device->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Nama Device:</label>
            <input type="text" name="name" id="name" value="{{ $device->name }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div>
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Update</button>
        </div>
    </form>
</div>
@endsection
