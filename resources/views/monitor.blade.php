@extends('layout.app')

@section('title', 'Monitor')
@section('content')

<div class="flex flex-col items-center justify-center min-h-screen container mx-auto">
    {{-- Judul --}}
    <div class="w-full text-center mb-8">
        <h2 class="text-3xl md:text-6xl font-semibold">Monitor</h2>
    </div>
    {{-- Grid --}}
    <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3" x-data="sensorDataComponent()" x-init="init()">
        {{-- Card --}}
        <div class="card">
            <div class="p-5 flex flex-col">
                <div class="rounded-xl overflow-hidden">
                    <img src="{{ asset('image/icons8-temperature-100.png') }}" alt="temp" class="mx-auto">
                </div>
                <h5 class="text-lg md:text-3xl font-medium mt-3">Temperature</h5>
                <p class="text-slate-500 text-lg mt-3" x-text="temperature"></p>
            </div>
        </div>
        {{-- Card --}}
        <div class="card">
            <div class="p-5 flex flex-col">
                <div class="rounded-xl overflow-hidden">
                    <img src="{{ asset('image/icons8-humidity-100.png') }}" alt="humi" class="mx-auto">
                </div>
                <h5 class="text-lg md:text-3xl font-medium mt-3">Humidity</h5>
                <p class="text-slate-500 text-lg mt-3" x-text="humidity"></p>
            </div>
        </div>
        {{-- Card --}}
        <div class="card">
            <div class="p-5 flex flex-col">
                <div class="rounded-xl overflow-hidden">
                    <img src="{{ asset('image/icons8-moisture-100.png') }}" alt="moisture " class="mx-auto">
                </div>
                <h5 class="text-lg md:text-3xl font-medium mt-3">Soil Moisture</h5>
                <p class="text-slate-500 text-lg mt-3" x-text="soilMoisture"></p>
            </div>
        </div>
    </div>
</div>
@yield('scripts')
<script>
    function sensorDataComponent() {
        return {
            temperature: 'Loading...',
            humidity: 'Loading...',
            soilMoisture: 'Loading...',
            isSiramInProgress: false,
            init() {
                this.fetchData();
                setInterval(() => {
                    this.fetchData();
                }, 5000); // Update setiap 5 detik
            },
            fetchData() {
                fetch('http://tanihub.test/api/sensor')
                    .then(response => response.json())
                    .then(data => {
                        console.log('Data received from API:', data); // Debugging
                        if (!data || !Array.isArray(data)) {
                            console.error('Invalid data format:', data);
                            return;
                        }

                        // Assuming data contains an array of sensor readings
                        const latestSensorData = data[data.length - 1];
                        this.temperature = latestSensorData.temperature + ' °C';
                        this.humidity = latestSensorData.humidity + ' %';
                        this.soilMoisture = latestSensorData.soil_moisture + ' %';
                    })
                    .catch(error => console.error('Error fetching sensor data:', error));
            },
        }
    }
</script>
@endsection
