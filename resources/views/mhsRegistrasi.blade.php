<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi IRIS</title>
    @vite('resources/css/app.css')
    <script>
        // JavaScript function to handle status change
        function updateStatus(status) {
            const statusElement = document.getElementById('status-akademik');
            const statusText = document.getElementById('status-text');

            if (status === 'aktif') {
                statusElement.classList.remove('bg-red-600', 'text-white');
                statusElement.classList.add('bg-green-600', 'text-white');
                statusText.textContent = 'Aktif';
            } else if (status === 'cuti') {
                statusElement.classList.remove('bg-red-600', 'text-white');
                statusElement.classList.add('bg-yellow-600', 'text-white');
                statusText.textContent = 'Cuti';
            }
        }
    </script>
    <style>
        /* Additional Styles for More Aesthetic Appearance */
        .card {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        .status-card {
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .status-card:hover {
            background-color: #f1f1f1;
        }
        .status-button {
            transition: transform 0.2s ease, background-color 0.3s ease;
        }
        .status-button:hover {
            transform: scale(1.05);
            background-color: #e0e0e0;
        }
    </style>
</head>

<body class="bg-gray-100 font-sans">
    <!-- Sidebar -->
    <x-side-bar :active="request()->route()->getName()"></x-side-bar>

    <div class="flex ml-[370px]">
        <!-- Main Content -->
        <div class="flex-1 p-8 mt-12">
            <h1 class="text-3xl font-bold text-gray-800 mb-8">Status Akademik</h1>
            <h2 class="text-xl text-gray-600 mb-6">Pilih salah satu status akademik :</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Tombol Aktif -->
                <div class="card bg-gradient-to-r from-green-400 via-green-500 to-green-600 p-6 rounded-lg flex items-center justify-between shadow-lg cursor-pointer status-button" onclick="updateStatus('aktif')">
                    <img src="../read.svg" alt="Read Icon" class="w-12 h-12">
                    <div class="flex flex-col text-white">
                        <p class="ml-2 mt-4 text-2xl font-bold border-b-2 border-white">Aktif</p>
                        <p class="ml-1 mt-2">Mahasiswa mengikuti perkuliahan semester ini dan mengisi Isian Rencana Studi (IRS)</p>
                    </div>
                </div>
                <!-- Tombol Cuti -->
                <div class="card bg-gradient-to-r from-yellow-400 via-yellow-500 to-yellow-600 p-6 rounded-lg flex items-center justify-between shadow-lg cursor-pointer status-button" onclick="updateStatus('cuti')">
                    <img src="../cuti.svg" alt="Cuti Icon" class="w-12 h-12">
                    <div class="flex flex-col text-white">
                        <p class="ml-3 text-2xl font-bold border-b-2 border-white">Cuti</p>
                        <p class="ml-3 mt-2">Mahasiswa menghentikan kuliah sementara tanpa kehilangan status sebagai mahasiswa Universitas Diponegoro</p>
                    </div>
                </div>
            </div>

            <!-- Status Akademik -->
            <div class="mt-10 p-6 bg-white rounded-lg shadow-md flex justify-between status-card">
                <div class="flex items-center text-gray-800">
                    <p class="text-xl">Status Akademik :</p>
                    <div id="status-akademik" class="ml-4 flex items-center justify-center h-12 w-40 rounded-lg border border-black bg-red-600">
                        <p id="status-text" class="font-bold text-white text-center">Belum Registrasi</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
