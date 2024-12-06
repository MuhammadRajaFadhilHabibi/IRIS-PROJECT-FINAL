@extends('header')

@section('title', 'Perwalian')  

@section('page')
<x-side-bar></x-side-bar>

<div class="flex pt-12 overflow-hidden">

    {{-- Sidebar --}}
    <x-side-bar :active="request()->route()->getName()"></x-side-bar>
    {{-- End Sidebar --}}

    <div id="main-content"
        class="relative text-gray-900 dark:text-gray-200 font-poppins w-full min-h-screen overflow-y-auto lg:ml-80 pl-4 pr-8">

        <div class="px-6 py-8">

            <!-- Filter Section -->
            <div class="flex gap-6 mb-6">
                <!-- Dropdown Strata -->
                <div>
                    <div id="dropdownMenu1"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                            <li><a href="#"
                                    class="block px-4 py-2 hover:bg-blue-100 dark:hover:bg-blue-600 dark:hover:text-white">S1</a>
                            </li>
                            <li><a href="#"
                                    class="block px-4 py-2 hover:bg-blue-100 dark:hover:bg-blue-600 dark:hover:text-white">S2</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Dropdown Jurusan -->
                <div>
                    <button id="dropdownButton2" data-dropdown-toggle="dropdownMenu2"
                        class="text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        type="button">
                        Jurusan
                        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <div id="dropdownMenu2"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                            <li><a href="#"
                                    class="block px-4 py-2 hover:bg-blue-100 dark:hover:bg-blue-600 dark:hover:text-white">Informatika</a>
                            </li>
                            <li><a href="#"
                                    class="block px-4 py-2 hover:bg-blue-100 dark:hover:bg-blue-600 dark:hover:text-white">Sistem
                                    Informasi</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Dropdown Angkatan -->
                <div>
                    <button id="dropdownButton3" data-dropdown-toggle="dropdownMenu3"
                        class="text-white bg-gradient-to-r from-blue-500 to-blue-700 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        type="button">
                        Angkatan
                        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <div id="dropdownMenu3"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                            <li><a href="#"
                                    class="block px-4 py-2 hover:bg-blue-100 dark:hover:bg-blue-600 dark:hover:text-white">2020</a>
                            </li>
                            <li><a href="#"
                                    class="block px-4 py-2 hover:bg-blue-100 dark:hover:bg-blue-600 dark:hover:text-white">2021</a>
                            </li>
                            <li><a href="#"
                                    class="block px-4 py-2 hover:bg-blue-100 dark:hover:bg-blue-600 dark:hover:text-white">2024</a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>

            <!-- Card Section -->
            <div
                class="bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 rounded-3xl shadow-2xl overflow-hidden dark:border-blue-700 dark:bg-gradient-to-br dark:from-blue-900 dark:to-blue-900">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead
                            class="text-xs text-white uppercase bg-gradient-to-r from-blue-500 to-blue-600 dark:from-blue-700 dark:to-blue-800">
                            <tr>
                                <th scope="col" class="px-4 py-3">No</th>
                                <th scope="col" class="px-4 py-3">Nama</th>
                                <th scope="col" class="px-4 py-3">Status</th>
                                <th scope="col" class="px-4 py-3">SKS</th>
                                <th scope="col" class="px-4 py-3">Rata-rata IPK</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                class="bg-white border-b dark:bg-blue-800 dark:border-blue-700 hover:bg-blue-50 dark:hover:bg-blue-700 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-[1.02]">
                                <td class="px-4 py-3 text-white">1</td>
                                <td class="px-4 py-3 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                    Muhammad Raja Fadhil Habibi</td>
                                <td class="px-4 py-3 text-white">
                                    <span
                                        class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full dark:bg-green-900 dark:text-green-300 animate-pulse">
                                        Aktif
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-white">87</td>
                                <td class="px-4 py-3 text-white">3.5</td>
                            </tr>
                            <tr
                                class="bg-white border-b dark:bg-blue-800 dark:border-blue-700 hover:bg-blue-50 dark:hover:bg-blue-700 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-[1.02]">
                                <td class="px-4 py-3 text-white">2</td>
                                <td class="px-4 py-3 font-medium text-gray-900 dark:text-white whitespace-nowrap">Riski
                                    Akbar Firmansah</td>
                                <td class="px-4 py-3 text-white">
                                    <span
                                        class="inline-flex items-center px-2 py-1 text-xs font-medium text-red-700 bg-red-100 rounded-full dark:bg-red-900 dark:text-red-300 animate-pulse">
                                        Cuti
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-white">70</td>
                                <td class="px-4 py-3 text-white">3.5</td>
                            </tr>
                            <tr
                                class="bg-white border-b dark:bg-blue-800 dark:border-blue-700 hover:bg-blue-50 dark:hover:bg-blue-700 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-[1.02]">
                                <td class="px-4 py-3 text-white">3</td>
                                <td class="px-4 py-3 font-medium text-gray-900 dark:text-white whitespace-nowrap">gak
                                    tau lah</td>
                                <td class="px-4 py-3 text-white">
                                    <span
                                        class="inline-flex items-center px-2 py-1 text-xs font-medium text-yellow-700 bg-yellow-100 rounded-full dark:bg-yellow-900 dark:text-yellow-300 animate-pulse">
                                        Tidak Aktif
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-white">90</td>
                                <td class="px-4 py-3 text-white">3.8</td>
                            </tr>
                            <tr
                                class="bg-white border-b dark:bg-blue-800 dark:border-blue-700 hover:bg-blue-50 dark:hover:bg-blue-700 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-[1.02]">
                                <td class="px-4 py-3 text-white">4</td>
                                <td class="px-4 py-3 font-medium text-gray-900 dark:text-white whitespace-nowrap">Aryela
                                    Rachma</td>
                                <td class="px-4 py-3 text-white">
                                    <span
                                        class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full dark:bg-green-900 dark:text-green-300 animate-pulse">
                                        Aktif
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-white">85</td>
                                <td class="px-4 py-3 text-white">3.5</td>
                            </tr>
                            <tr
                                class="bg-white border-b dark:bg-blue-800 dark:border-blue-700 hover:bg-blue-50 dark:hover:bg-blue-700 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-[1.02]">
                                <td class="px-4 py-3 text-white">5</td>
                                <td class="px-4 py-3 font-medium text-gray-900 dark:text-white whitespace-nowrap">Indana
                                    Najwa</td>
                                <td class="px-4 py-3 text-white">
                                    <span
                                        class="inline-flex items-center px-2 py-1 text-xs font-medium text-orange-700 bg-orange-100 rounded-full dark:bg-orange-900 dark:text-orange-300 animate-pulse">
                                        Menunggu
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-white">75</td>
                                <td class="px-4 py-3 text-white">3.5</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection