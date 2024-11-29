<div id="sidebar" class="top-0 px-5 z-20 flex-col hidden w-64 min-h-screen bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700 font-normal duration-75 lg:flex transition-width" aria-label="Sidebar">
    <div class="flex flex-col flex-1 pt-5 pb-4 overflow-y-auto">
        <div class="flex-1 px-3 space-y-1">
            <ul class="pb-2 space-y-2">
                <!-- Profil -->
                <li>
                    <img src="profile.png" class="rounded-full flex mx-auto" width="100" alt="">
                </li>
                <ul class="text-white text-center">
                    <li><p>Mulyono</p></li>
                    <li><p>24060122110001</p></li>
                    <li><p>Informatika S1</p></li>
                </ul>

                <!-- Dashboard -->
                <li>
                    <button type="button" class="flex items-center w-full p-2 text-base text-[#111827] transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">
                        <span class="mx-auto"><a href="/dashboard">Dashboard</a></span>
                    </button>
                </li>

                <!-- Registrasi -->
                <li>
                    <button type="button" class="flex items-center w-full p-2 text-base text-[#111827] transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">
                        <span class="mx-auto"><a href="/registration">Registrasi</a></span>
                    </button>
                </li>

                <!-- Akademik Dropdown -->
                <li>
                    <button id="toggle-akademik" type="button" class="flex items-center justify-between w-full p-2 text-base text-[#111827] transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">
                        <span class="mx-auto">Akademik</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <ul id="dropdown-akademik" class="hidden space-y-2 py-2">
                        <li>
                            <a href="#" class="text-[#111827] rounded-lg flex items-center justify-center p-2 group hover:bg-gray-100 transition duration-75 dark:text-gray-200 dark:hover:bg-gray-700">
                                Buat IRS
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-[#111827] rounded-lg flex items-center justify-center p-2 group hover:bg-gray-100 transition duration-75 dark:text-gray-200 dark:hover:bg-gray-700">
                                IRS
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-[#111827] rounded-lg flex items-center justify-center p-2 group hover:bg-gray-100 transition duration-75 dark:text-gray-200 dark:hover:bg-gray-700">
                                KHS
                            </a>
                        </li>
                        <li>
                            <a href="/transcript" class="text-[#111827] rounded-lg flex items-center justify-center p-2 group hover:bg-gray-100 transition duration-75 dark:text-gray-200 dark:hover:bg-gray-700">
                                Transkrip
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>

<script>
    document.getElementById('toggle-akademik').addEventListener('click', function() {
        var dropdown = document.getElementById('dropdown-akademik');
        dropdown.classList.toggle('hidden');
    });
</script>


{{-- dashbor mhs --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <x-navBar>
        
    </x-navBar>
    <div class="flex">
        <x-sideBar>

        </x-sideBar>
        <div id="content" class=" bg-[#111827] py-7 px-16 z-30 min-h-screen w-full text-white">
            <h1 class="font-bold text-3xl mb-5">Hai Mulyono👋</h1>
            <div class="bg-[#1F2937] p-4 rounded-3xl">
                <div class="grid grid-cols-3 pt-4 py-8">
                    <div class="bg-[#2ACD7F] p-6 rounded-2xl text-right mx-9">
                        <h1 class="text-2xl font-bold">AKTIF</h1>
                        <h1>Status Mahasiswa</h1>
                    </div>
                    <div class="bg-[#2AA6CD] p-6 rounded-2xl text-right mx-9">
                        <h1 class="text-2xl font-bold">3.2</h1>
                        <h1>IP Kumulatif</h1>
                    </div>
                    <div class="bg-[#3478C7] p-6 rounded-2xl text-right mx-9">
                        <h1 class="text-2xl font-bold">86</h1>
                        <h1>SKS</h1>
                    </div>
                </div>
                <h1 class="text-center"><strong>Pembimbing Akademik : </strong>H. Prabowo Subianto</h1>
                <h1 class="text-center"><strong>NIP : </strong>2222222222</h1>
                <div class="grid grid-cols-3 space-x-2 py-8 text-center font-semibold">
                    <div class="px-3">
                        <h1>Semester Akademik Sekarang</h1>
                        <h1 class="text-2xl">2024/2025 Ganjil</h1>
                    </div>
                    <div class="border-x px-3">
                        <h1>Semester Studi</h1>
                        <h1 class="text-2xl">7</h1>
                    </div>
                    <div class="px-3">
                        <h1>IP Semester</h1>
                        <h1 class="text-2xl">2.3</h1>
                    </div>
                </div>
            </div>
            <div class="flex mt-5 space-x-6">
                <div class="w-[70%] ">
                    <h1 class="font-bold text-2xl mb-5">Today's Schedule</h1>
                    <div class="grid grid-cols-3 bg-[#1F2937] p-4 rounded-3xl text-center text-[#9CA3AF]">
                        <div>
                            <h1 class="font-bold pt-1 pb-3">Subject</h1>
                            <h1>Pengembangan Berbasis</h1>
                            <h1>Proyek Perangkat Lunak</h1>
                            <h1>Penambangan Data</h1>
                        </div>
                        <div>
                            <h1 class="font-bold pt-1 pb-3">Room</h1>
                            <h1>E101</h1>
                            <h1>A303</h1>
                            <h1>E102</h1>
                        </div>
                        <div>
                            <h1 class="font-bold pt-1 pb-3">Time</h1>
                            <h1>13.00-15.30</h1>
                            <h1>15.30-18.00</h1>
                            <h1>09.30-12.20</h1>
                        </div>
                    </div>
                </div>
                <div class="w-[30%] h-auto">
                    <h1 class="font-bold text-2xl mb-5">Announcement</h1>
                    <div class="bg-[#1F2937] p-4 rounded-3xl text-[#9CA3AF] h-auto mb-0">
                        <h1>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quod harum quos alias rem nemo dolorum, excepturi eius tenetur inventore</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>