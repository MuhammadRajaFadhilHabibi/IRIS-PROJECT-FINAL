<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi IRIS</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 font-sans">
    <!-- Sidebar -->
    <x-side-bar :active="request()->route()->getName()"></x-side-bar>

    <div class="flex ml-[370px]"> <!-- Margin kiri diperbesar dari [300px] ke [320px] -->
        <!-- Main Content -->
        <div class="flex-1 p-8 mt-12">
            <h1 class="text-2xl font-bold mb-8">Status Akademik</h1>
            <h1>Pilih salah satu status akademik :</h1>
            <div class="flex flex-row">
                <div class="mt-3 bg-gray-300 p-6 w-[450px] rounded-lg flex justify-between hover:bg-gray-400">
                    <img src="../read.png" alt="Read Icon">
                    <div class="flex flex-col">
                        <p class="ml-2 mt-7 text-3xl font-bold border-b-2 border-black">Aktif</p>
                        <div class="ml-1">
                            <p>Mahasiswa mengikuti perkuliahan
                                semester ini dan mengisi Isian
                                Rencana Studi (IRS)</p>
                        </div>
                    </div>
                </div>
                <div
                    class="mt-3 ml-10 bg-gray-300 p-6 w-[470px] rounded-lg flex items-center justify-between hover:bg-gray-400">
                    <img src="../cuti.svg" alt="Cuti Icon">
                    <div class="flex flex-col">
                        <p class="ml-3 text-3xl font-bold border-b-2 border-black">Cuti</p>
                        <div class="ml-3">
                            <p>Mahasiswa menghentikan kuliah
                                sementara tanpa kehilangan
                                status sebagai mahasiswa
                                Universitas Diponegoro</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-10 bg-gray-300 p-6 w-[940px] rounded-lg flex justify-between">
                <div class="flex flex-row items-center">
                    <p>Status Akademik :</p>
                    <div
                        class="ml-2 flex flex-row border justify-center items-center border-black bg-red-600 rounded-lg h-10 w-[150px]">
                        <p class="font-bold text-center">Belum Registrasi</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
