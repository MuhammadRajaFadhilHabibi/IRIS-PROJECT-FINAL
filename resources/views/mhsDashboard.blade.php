<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-50 font-sans">

    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        <x-side-bar :active="request()->route()->getName()"></x-side-bar>
        {{-- End Sidebar --}}
        
        <!-- Main Content with padding-left to compensate for sidebar width -->
        <div class="flex-1 pl-[20%] p-10 space-y-8">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-4xl font-semibold text-gray-900">Dashboard</h1>
                <div class="relative">
                    <button onclick="toggleDropdown()" class="flex items-center space-x-2 focus:outline-none">
                        <span class="font-semibold text-gray-800">{{ $data['userName'] }}</span>
                        <span class="material-icons text-gray-600">account_circle</span>
                    </button>
                    <!-- Dropdown Menu -->
                    <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-md py-2 z-20">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- User Information with max-width -->
            <div class="bg-gradient-to-r from-blue-500 to-teal-400 p-6 rounded-lg flex items-center justify-between shadow-lg relative max-w-4xl mx-auto">
                <div class="text-white">
                    <h2 class="text-3xl font-semibold mb-1">{{ $data['userName'] }}</h2>
                    <p class="text-sm">NIM: <span class="font-semibold">{{ $data['nim'] }}</span></p>
                    <p class="text-sm">Prodi: <span class="font-semibold">S1 {{ $data['prodi'] }}</span></p>
                </div>
                <div class="absolute right-6 -top-8 w-40 h-40 bg-black rounded-full border-4 border-gray-300 overflow-hidden">
                    <img src="alip.jpg" alt="Profile Picture" class="w-full h-full object-cover">
                </div>
                
            </div>

            <!-- Academic Status and Performance Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto">
                <!-- Academic Status -->
                <div class="bg-white p-6 rounded-lg shadow-md border-t-4 border-blue-500">
                    <h3 class="font-semibold text-lg mb-4 flex items-center text-gray-800">
                        <span class="material-icons text-gray-600 mr-2">school</span>
                        Status Akademik
                    </h3>
                    <p class="text-sm text-gray-700 mb-2">Dosen Wali: Dr. Robert Downey JR, S.T., M.Cs.<br><span class="text-xs">(NIP: 2031023012031)</span></p>
                    <div class="flex justify-between mt-4">
                        <div class="text-center">
                            <p class="text-xs text-gray-500">Semester Akademik</p>
                            <p class="font-semibold text-base text-gray-800">2024/2025 Ganjil</p>
                        </div>
                        <div class="text-center">
                            <p class="text-xs text-gray-500">Semester Studi</p>
                            <p class="font-semibold text-base text-gray-800">{{ $data['semester_berjalan'] }}</p>
                        </div>
                        <div class="text-center">
                            <p class="text-xs text-gray-500">Status Akademik</p>
                            <p class="font-semibold text-base text-gray-800">{{ $data['status'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Academic Performance -->
                <div class="bg-white p-6 rounded-lg shadow-md border-t-4 border-blue-500">
                    <h3 class="font-semibold text-lg mb-4 flex items-center text-gray-800">
                        <span class="material-icons text-gray-600 mr-2">emoji_events</span>
                        Prestasi Akademik
                    </h3>
                    <div class="flex justify-between">
                        <div class="text-center">
                            <p class="text-xs text-gray-500">IPK</p>
                            <p class="font-semibold text-base text-gray-800">{{ $data['ipk'] }}</p>
                        </div>
                        <div class="text-center">
                            <p class="text-xs text-gray-500">SKS</p>
                            <p class="font-semibold text-base text-gray-800">90</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- IPK Chart Section -->
            <div class="max-w-4xl mx-auto mt-8 bg-white p-6 rounded-lg shadow-md">
                <h3 class="font-semibold text-lg mb-4 text-gray-800">Grafik IPK</h3>
                <canvas id="ipkChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('ipkChart');

            if (!ctx) {
                console.error('Canvas element not found');
                return;
            }

            const ipkChart = new Chart(ctx, {
                type: 'line',  // Type of chart
                data: {
                    labels: ['Semester 1', 'Semester 2', 'Semester 3', 'Semester 4', 'Semester 5'],  // Semester labels
                    datasets: [{
                        label: 'IPK',
                        data: [3.2, 3.4, 3.5, 3.7, 3.8],  // IPK data points
                        borderColor: 'rgba(29, 78, 216, 1)',
                        backgroundColor: 'rgba(29, 78, 216, 0.2)',
                        borderWidth: 3,
                        pointRadius: 6,
                        pointBackgroundColor: 'rgba(29, 78, 216, 1)',
                        pointBorderWidth: 2,
                        pointBorderColor: 'white',
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: false,
                            max: 4.0,
                            ticks: {
                                stepSize: 0.2,
                                font: {
                                    size: 14
                                }
                            },
                            grid: {
                                color: 'rgba(0, 0, 0, 0.1)'
                            }
                        },
                        x: {
                            ticks: {
                                font: {
                                    size: 14
                                }
                            },
                            grid: {
                                display: false
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleFont: {
                                size: 16,
                                weight: 'bold'
                            },
                            bodyFont: {
                                size: 14
                            },
                            callbacks: {
                                label: function(tooltipItem) {
                                    return 'IPK: ' + tooltipItem.raw;
                                }
                            }
                        },
                        legend: {
                            labels: {
                                font: {
                                    size: 16
                                }
                            }
                        }
                    }
                }
            });
        });

        function toggleDropdown() {
            const dropdownMenu = document.getElementById('dropdownMenu');
            dropdownMenu.classList.toggle('hidden');
        }

        // Close dropdown if clicked outside
        document.addEventListener('click', function(event) {
            const dropdownMenu = document.getElementById('dropdownMenu');
            const button = event.target.closest('button');
            if (!button || button.getAttribute('onclick') !== 'toggleDropdown()') {
                dropdownMenu.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
