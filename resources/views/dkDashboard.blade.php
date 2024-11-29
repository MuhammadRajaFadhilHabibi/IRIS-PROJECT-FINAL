<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css','resources/js/app.js', 'resources/js/darkmode.js'])
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@600&family=Poppins:wght@200;400&display=swap"
    rel="stylesheet">
    <title>Dashboard Dekan</title>
</head>

<body class="bg-gray-200 dark:bg-blek-900">
    
        {{-- sidebar --}}
  
        <x-side-bar :active="request()->route()->getName()">
            
        </x-side-bar>
      {{-- end sidebar --}}

        {{-- Main Content --}}
        <div id="main-content" class="flex-1 p-8 bg-gray-200 min-h-screen ml-[340px]">
            <div class="flex justify-between items-start">
                <!-- Bagian Kiri: Dashboard DEKAN -->
                <div>
                    <h1 class="text-3xl font-bold">Dashboard DEKAN</h1>
                    <div class="mt-4 bg-white p-6 rounded-2xl shadow-md border border-gray-300 w-[600px] relative">
                        <!-- Profil Information -->
                        <div class="flex">
                            <div class="ml-4">
                                <h2 class="text-xl font-bold text-blue-600">PROFIL</h2>
                                <p>alipxander</p>
                                <p>akualip.com</p>
                            </div>
                        </div>
                        <!-- Informasi Fakultas -->
                        <div class="mt-4 bg-gray-300 text-center rounded-2xl p-4">
                            <h3 class="text-lg font-bold">Fakultas Sains dan Matematika</h3>
                        </div>
                        <!-- Foto Besar Lingkaran -->
                        <div class="absolute right-[-50px] bottom-[-50px] rounded-full w-[150px] h-[150px] bg-black overflow-hidden">
                            <img src="alip.jpg" alt="Profile Image" class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>

                <!-- Tombol Logout -->
                <div class="flex flex-col items-end">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-red-500 font-bold bg-white py-2 px-4 rounded-full shadow hover:bg-red-100">
                            LOGOUT
                        </button>
                    </form>
                </div>
            </div>

            <!-- News Section -->
            <div class="mt-8 bg-white p-6 rounded-2xl shadow-md border border-gray-300">
                <h2 class="text-2xl font-bold">NEWS</h2>
                <div class="mt-4 bg-gray-100 rounded-2xl p-4">
                    <!-- Konten News bisa di sini -->
                </div>
            </div>

            <!-- Pengajuan Jadwal dan Ruangan -->
            <div class="mt-8 bg-white p-6 rounded-2xl shadow-md border border-gray-300">
                <h2 class="text-2xl font-bold">Pengajuan Jadwal dan Ruangan</h2>
                <div class="flex justify-center gap-10 mt-4">
                    <div onclick="location.href='{{ route('ajuanruang') }}'" class="bg-[#38A6D6] px-4 py-6 w-[40%] rounded-2xl text-right cursor-pointer">
                        <h1 class="text-2xl font-bold">40</h1>
                        <h1>Pengajuan Ruangan</h1>
                    </div>
                    <div onclick="location.href='{{ route('ajuanjadwal') }}'" class="bg-[#2ACD7F] px-4 py-6 w-[40%] rounded-2xl text-right cursor-pointer">
                        <h1 class="text-2xl font-bold">30</h1>
                        <h1>Pengajuan Jadwal</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
