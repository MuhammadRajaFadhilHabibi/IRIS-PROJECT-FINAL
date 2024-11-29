@extends('header')

@section('title', 'Dashboard Kaprodi')

@section('page')

<div class="flex h-screen">
    {{-- Sidebar --}}
    <x-side-bar :active="request()->route()->getName()"></x-side-bar>
    {{-- End Sidebar --}}

    {{-- Main Content --}}
    <div id="main-content" class="flex-1 p-8 bg-gray-200 min-h-screen ml-[350px]">
        <div class="flex justify-between items-start mb-8">
            <!-- Bagian Kiri: Dashboard Kaprodi -->
            <div>
                <h1 class="text-3xl font-bold ">Dashboard Kaprodi</h1>
                <div class="mt-4 bg-white p-6 rounded-2xl shadow-md border border-gray-300 w-[650px] relative">
                    <!-- Profil Information -->
                    <div class="flex items-center">
                        <div class="ml-4">
                            <h2 class="text-xl font-bold text-blue-600">PROFIL</h2>
                            <p>Akbar</p>
                            <p>akbar@gmail.com</p>
                        </div>
                    </div>
                    <!-- Informasi Fakultas -->
                    <div class="mt-4 bg-gray-300 text-center rounded-2xl p-4">
                        <h3 class="text-lg font-bold">Fakultas Teknologi Informasi</h3>
                    </div>
                    <!-- Foto Besar Lingkaran -->
                    <div class="absolute right-[-50px] bottom-[-50px] rounded-full w-[150px] h-[150px] bg-black overflow-hidden">
                        <img src="{{ asset('alip.jpg') }}" alt="Profile Image" class="w-full h-full object-cover">
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

        <!-- Informasi Mahasiswa -->
        <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-300">
            <h2 class="text-2xl font-bold mb-4">Informasi Mahasiswa</h2>
            <div class="flex justify-between mb-8 px-4">
                <div class="bg-[#38A6D6] p-6 rounded-2xl text-center w-[30%]">
                    <h1 class="text-2xl font-bold">312</h1>
                    <p>Total Mahasiswa</p>
                </div>
                <div class="bg-[#2ACD7F] p-6 rounded-2xl text-center w-[30%]">
                    <h1 class="text-2xl font-bold">218</h1>
                    <p>Mahasiswa Aktif</p>
                </div>
                <div class="bg-[#C34444] p-6 rounded-2xl text-center w-[30%]">
                    <h1 class="text-2xl font-bold">100</h1>
                    <p>Mahasiswa Cuti</p>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
