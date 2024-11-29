@extends('header')

@section('title', 'Dashboard Pembimbing Akademik')

@section('page')

<div class="flex h-screen">
    {{-- Sidebar --}}
    <x-side-bar :active="request()->route()->getName()"></x-side-bar>
    {{-- End Sidebar --}}

    {{-- Main Content --}}
    <div id="main-content" class="flex-1 p-8 bg-white min-h-screen ml-[340px]">
        <div class="flex flex-col items-start space-y-8">
            <!-- Header Daftar Mahasiswa -->
            <h1 class="text-3xl font-bold text-[#264A5D] mb-8">Dashboard Pembimbing Akademik</h1>
        </div>
        <div class="flex justify-between items-start mb-8">
            <div class="w-full">
                <!-- Header -->
                <header class="bg-blue-500 text-white py-2 px-4 rounded-lg focus:outline-none shadow w-full mb-4" style="background-color: #4D8CC4;">
                    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
                        <div>
                            <h1 class="text-2xl font-bold">Halo, (Nama)</h1>
                            <p>Selamat datang di IRIS</p>
                        </div>
                        <div>
                            <!-- Tombol Logout -->
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-medium rounded-lg px-4 py-2 text-sm">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </header>                

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-white rounded-lg shadow-lg p-4 flex items-center space-x-4">
                        <div class="bg-blue-100 text-blue-500 rounded-full p-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m9 2a9 9 0 11-6-16.28"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Periode Semester</p>
                            <p class="text-lg font-bold text-gray-800">2021/2022 Ganjil</p>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow-lg p-4 flex items-center space-x-4">
                        <div class="bg-blue-100 text-blue-500 rounded-full p-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A1 1 0 015 17V7a1 1 0 01.879-.993l9-2a1 1 0 011.122.993v10a1 1 0 01-.879.993l-9 2a1 1 0 01-.122.007z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11v1a3 3 0 01-3 3H5.879a1 1 0 01-.879-.993l-1.879-.507m8.879.507h2a2 2 0 002-2v-1a1 1 0 011-1h3.293a1 1 0 01.707.293l.293.293"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Jumlah Mahasiswa</p>
                            <p class="text-lg font-bold text-gray-800">1785</p>
                        </div>
                    </div>

                <div class="bg-gray-100 flex text-center py-4 px-6">
                    <div>
                        <h1 class="text-xl font-medium text-white[#264A5D] bg-blue-500 text-white py-2 px-4 rounded-full">Informasi Akademik</h1>
                    </div>
                </div>

            <!-- Main Content -->
            <div class="container mx-auto px-4 py-4">
                <!-- Form Content -->
                <div class="mb-4">
                    <form action="#" method="GET" class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-4">
                        <!-- Select Year -->
                        <div class="flex-1">
                            <label for="tahun-periode" class="block text-sm font-medium text-gray-700 mb-1">Tahun Periode</label>
                            <select id="tahun-periode" name="tahun-periode" class="block w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                                <option value="">Pilih Tahun</option>
                                <option value="2021/2022 Ganjil">2021/2022 Ganjil</option>
                                <option value="2021/2022 Genap">2021/2022 Genap</option>
                                <option value="2022/2023 Ganjil">2022/2023 Ganjil</option>
                                <option value="2022/2023 Genap">2022/2023 Genap</option>
                            </select>
                        </div>
                        <!-- Search Input -->
                        <div class="flex-1">
                            <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari</label>
                            <input type="text" id="search" name="search" placeholder="Masukkan kata kunci" class="block w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                        </div>
                        <!-- Submit Button -->
                        <div>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-lg px-4 py-2 text-sm flex items-center p-2.5 mb-1">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 21l2-2m0 0l5-5m-5 5L3 8m7 7l9-9"></path>
                                </svg>
                                Cari
                            </button>
                        </div>
                    </form>
                </div>
                <!-- Cards -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Card 1 -->
                    <div class="bg-white rounded-lg shadow-lg p-4">
                        <h2 class="text-lg font-bold text-gray-800">Kelas </h2>
                        <p class="text-sm text-gray-600">Prodi: </p>
                        <p class="text-sm text-gray-600">Mahasiswa: </p>
                        <a href="#" class="text-blue-500 text-sm mt-2 inline-flex items-center">
                            Lebih Detil
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                    <!-- Card 2 -->
                    <div class="bg-white rounded-lg shadow-lg p-4">
                        <h2 class="text-lg font-bold text-gray-800">Kelas </h2>
                        <p class="text-sm text-gray-600">Prodi: </p>
                        <p class="text-sm text-gray-600">Mahasiswa: </p>
                        <a href="#" class="text-blue-500 text-sm mt-2 inline-flex items-center">
                            Lebih Detil
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

