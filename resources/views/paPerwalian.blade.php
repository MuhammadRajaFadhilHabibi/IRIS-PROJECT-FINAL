{{-- paPerwalian.blade.php --}}
@extends('header')

@section('title', 'Perwalian')  

@section('page')
<div class="flex pt-12 bg-white-50 min-h-screen">
        {{-- Sidebar --}}
        <x-side-bar :active="request()->route()->getName()"></x-side-bar>
        {{-- End Sidebar --}}

        {{-- Main Content --}}    
            <div id="main-content" class="relative text-gray-900 dark:text-gray-200 font-poppins w-full min-h-screen overflow-y-auto lg:ml-80 pl-4 pr-8">
                <div class="flex flex-col items-start space-y-8">
                    <!-- Header Daftar Mahasiswa -->
                    <h1 class="text-3xl font-bold text-[#264A5D] mb-4">Data Perwalian</h1>
                </div>
                <div class="bg-white rounded-lg shadow-lg p-4 flex items-center space-x-4 mb-4">
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
            
                <!-- Filter Section -->
                <div class="flex gap-4 mb-1">
                    <!-- Dropdown Jurusan -->
                    <div>
                        <button id="dropdownButton2" data-dropdown-toggle="dropdownMenu2" class="text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                            Jurusan 
                            <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                            </svg>
                        </button>
                        <div id="dropdownMenu2" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                                <li><a href="#" class="block px-4 py-2 hover:bg-blue-100 dark:hover:bg-blue-600 dark:hover:text-white">Informatika</a></li>
                                <li><a href="#" class="block px-4 py-2 hover:bg-blue-100 dark:hover:bg-blue-600 dark:hover:text-white">Sistem Informasi</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Dropdown Angkatan -->
                    <div>
                        <button id="dropdownButton3" data-dropdown-toggle="dropdownMenu3" class="text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                            Angkatan 
                            <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                            </svg>
                        </button>
                        <div id="dropdownMenu3" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                                <li><a href="#" class="block px-4 py-2 hover:bg-blue-100 dark:hover:bg-blue-600 dark:hover:text-white">2020</a></li>
                                <li><a href="#" class="block px-4 py-2 hover:bg-blue-100 dark:hover:bg-blue-600 dark:hover:text-white">2021</a></li>
                                <li><a href="#" class="block px-4 py-2 hover:bg-blue-100 dark:hover:bg-blue-600 dark:hover:text-white">2024</a></li>
                            </ul>
                        </div>
                    </div>

                    <input id="searchMahasiswa" type="text" placeholder="Search..." class="sans border rounded p-2 w-1/2 mb-4 shadow-lg rounded-lg text-sm px-5 py-2.5">

                </div>

                <!-- Card Section -->
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 rounded-xl shadow-2xl overflow-hidden dark:border-blue-700 dark:bg-gradient-to-br dark:from-blue-900 dark:to-blue-900">
                    <div class="overflow-x-auto">
                        <table id="Mahasiswa" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead>
                                <tr class="min-w-full text-center text-xs text-white uppercase bg-gradient-to-r from-blue-500 to-blue-600 dark:from-blue-700 dark:to-blue-800">
                                    <th scope="col" class="px-4 py-3">No</th>
                                    <th scope="col" class="px-4 py-3">Nama</th>
                                    <th scope="col" class="px-4 py-3">Status</th>
                                    <th scope="col" class="px-4 py-3">SKS</th>
                                    <th scope="col" class="px-4 py-3">Rata-rata IPK</th>
                                    <th scope="col" class="px-4 py-3">Status IRS</th>
                                    <th scope="col" class="px-4 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mahasiswa as $index => $mhs)
                                <tr class="bg-white border-b dark:bg-blue-800 dark:border-blue-700 hover:bg-blue-50 dark:hover:bg-blue-700 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-[1.02]">
                                    <td class="px-4 py-3 text-white text-center">{{ $index + 1 }}</td>
                                    <td class="px-4 py-3 font-medium text-gray-900 dark:text-white whitespace-nowrap">{{ $mhs->nama }}</td>
                                    <td class="px-4 py-3 text-white">
                                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium 
                                            @if($mhs->status === 'Aktif') text-green-700 bg-green-100 @elseif($mhs->status === 'Cuti') text-red-700 bg-red-100 @else text-yellow-700 bg-yellow-100 @endif
                                            rounded-full dark:bg-green-900 dark:text-green-300 animate-pulse">
                                            {{ $mhs->status }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-white">{{ $mhs->total_sks }}</td>
                                    <td class="px-4 py-3 text-white">{{ $mhs->ipk }}</td>
                                    <td class="px-4 py-3 text-white">
                                        <span class="px-2 py-1 text-xs font-medium rounded-full 
                                            @if($mhs->status_irs === 'Disetujui') text-green-700 bg-green-100 
                                            @elseif($mhs->status_irs === 'Ditolak') text-red-700 bg-red-100 
                                            @else text-yellow-700 bg-yellow-100 
                                            @endif">
                                            {{ $mhs->status_irs }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        <a href="{{ route('view-mahasiswa', $mhs->nim) }}" class="text-white hover:text-white-700">View</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- datatable  --}}
        <script>
            $(document).ready( function () {
                var tableMahasiswa = $('#Mahasiswa').DataTable({
                    layout :{
                        topStart: null,
                        topEnd: null,
                        bottomStart: 'pageLength',
                        bottomEnd: 'paging'
                    }
                });

                $('#searchMahasiswa').keyup(function() {
                    tableMahasiswa.search($(this).val()).draw();
                });
            });
        </script>
    {{-- datatble_end --}}
@endsection
