@extends('layout.app')

@section('title', 'Analytics')
@section('content')
<div class="flex flex-col items-center justify-center min-h-screen container mx-auto">
    <div x-data="sensorChartComponent()" x-init="init()" class="relative z-50" style="height: 90vh; width: 80vw;">
        <canvas id="myChart"></canvas>
    </div>
@yield('scripts')
<script>
    function sensorChartComponent() {
        let chart = null;

        async function fetchDataAndDrawChart() {
            try {
                const response = await fetch('http://tanihub.test/api/data');
                const data = await response.json();
                console.log('Data received from API:', data); // Debugging

                if (!data || !Array.isArray(data)) {
                    console.error('Invalid data format:', data);
                    return;
                }

                const { labels, temperatureData, humidityData, soilMoistureData } = processDataForChart(data);

                // Destroy existing chart if it exists
                if (chart) {
                    chart.destroy();
                }

                // Check if canvas exists
                const ctx = document.getElementById('myChart').getContext('2d');
                if (!ctx) {
                    console.error('Canvas context not found!');
                    return;
                }

                // Create new chart with updated data
                chart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [
                            {
                                label: 'Temperature',
                                data: temperatureData,
                                borderColor: 'rgba(255, 99, 132, 1)',
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                fill: true
                            },
                            {
                                label: 'Humidity',
                                data: humidityData,
                                borderColor: 'rgba(54, 162, 235, 1)',
                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                fill: true
                            },
                            {
                                label: 'Soil Moisture',
                                data: soilMoistureData,
                                borderColor: 'rgba(75, 192, 192, 1)',
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                fill: true
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            x: {
                                type: 'time',
                                time: {
                                    unit: 'minute'
                                },
                                title: {
                                    display: true,
                                    text: 'Time'
                                }
                            },
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Value'
                                }
                            }
                        }
                    }
                });
            } catch (error) {
                console.error('Error updating chart:', error);
            }
        }

        function processDataForChart(data) {
            // Handle null values by filtering them out
            const labels = data.map(sensor => new Date(sensor.created_at)).filter(date => date !== null);
            const temperatureData = data.map(sensor => parseFloat(sensor.average_temperature) || 0); // Replace null with 0
            const humidityData = data.map(sensor => parseFloat(sensor.average_humidity) || 0); // Replace null with 0
            const soilMoistureData = data.map(sensor => parseFloat(sensor.average_soil_moisture) || 0); // Replace null with 0

            return { labels, temperatureData, humidityData, soilMoistureData };
        }

        return {
            init() {
                fetchDataAndDrawChart();
                setInterval(fetchDataAndDrawChart, 60000); // Update every 1 minute (60000 ms)
            }
        };
    }
</script>
@endsection
