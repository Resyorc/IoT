<style>
    #moistureChart {
        width: 100%;
        height: 400px; /* Atur tinggi sesuai kebutuhan */
    }
</style>
@extends('layout.app')

@section('title', 'Dashboard')
@section('content')
<div class="flex flex-col items-center justify-center min-h-screen container mx-auto" x-data="sensorDataComponent()" x-init="init()">
    <div class="p-6 space-y-6 w-full">
        <div class="w-full text-center mb-8">
            <h2 class="text-3xl md:text-6xl font-semibold">Dashboard</h2>
        </div>
        <div class="flex flex-wrap justify-center space-x-6">
            <!-- Card Ringkasan -->
            <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full mb-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-semibold text-gray-800">Ringkasan</h2>
                        <p class="text-sm text-gray-600" x-text="currentDate"></p>
                    </div>
                    <img src="{{ asset('svg/animated/cloudy.svg') }}" alt="Weather icon" class="w-24 h-24">
                </div>
                <div class="flex items-center justify-between mt-4">
                    <div>
                        <h3 class="text-4xl font-semibold text-gray-800" x-text="temperature"></h3>
                        <p class="text-sm text-gray-600">Partly Cloudy</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Humidity: </p>
                        <p class="text-sm text-gray-600" x-text="humidity"></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Button to Control Water Pump -->
        <div class="flex justify-center mt-4">
            <button class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75"
                @click="siramTanaman" :disabled="isSiramInProgress">
                <span x-show="!isSiramInProgress">Siram Tanaman</span>
                <span x-show="isSiramInProgress">Sedang Menyiram...</span>
            </button>
        </div>
    </div>
</div>
@yield('scripts')
<script>
    function sensorDataComponent() {
        return {
            currentDate: '',
            temperature: 'Loading...',
            humidity: 'Loading...',
            soilMoisture: 'Loading...',
            isSiramInProgress: false,
            init() {
                this.updateDate();
                this.fetchData();
                setInterval(() => {
                    this.fetchData();
                }, 5000); // Update setiap 5 detik
            },
            updateDate() {
                const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                const today = new Date();
                this.currentDate = today.toLocaleDateString('id-ID', options);
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
            siramTanaman() {
                this.isSiramInProgress = true;
                fetch('/api/relay/ON', { method: 'POST' })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Relay status: ON');
                        setTimeout(() => {
                            fetch('/api/relay/OFF', { method: 'POST' })
                                .then(response => response.json())
                                .then(data => {
                                    console.log('Relay status: OFF');
                                    this.isSiramInProgress = false;
                                })
                                .catch(error => {
                                    console.error('Error turning off relay:', error);
                                    this.isSiramInProgress = false;
                                });
                        }, 10000); // 10 detik
                    })
                    .catch(error => {
                        console.error('Error turning on relay:', error);
                        this.isSiramInProgress = false;
                    });
            },
        }
    }
</script>
@endsection
