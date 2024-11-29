@extends('header')

@section('title', 'IRS')

@section('page')

<div class="flex pt-12 bg-gray-100 min-h-screen">
    {{-- Sidebar --}}
    <x-side-bar :active="request()->route()->getName()"></x-side-bar>
    {{-- End Sidebar --}}

    {{-- Main Content --}}
    <div id="main-content" class="flex-1 ml-[20%] p-6">
        {{-- Header --}}
        <h1 class="text-3xl font-bold text-gray-700 mb-6">Isian Rencana Studi (IRS)</h1>

        {{-- IRS Cards --}}
        <div class="grid gap-6">
            @foreach ($data as $item)
                <div class="container-irs bg-white border border-gray-300 rounded-xl shadow-lg p-6 hover:shadow-2xl transition-shadow">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800">Semester {{ $item->semester }}</h3>
                            <p class="text-sm text-gray-600">2021/2022 | <span class="font-medium text-blue-500">{{ $item->total_sks }} SKS</span></p>
                        </div>
                        <button class="flex items-center px-4 py-2 text-sm font-medium text-blue-600 bg-blue-100 rounded-lg hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-300 transition-transform"
                            data-semester="{{ $item->semester }}" data-email="{{ $email }}">
                            Lihat Detail
                            <svg class="ml-2 w-4 h-4 transform transition-transform rotate-90" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                    {{-- Tabel akan muncul di sini saat tombol Lihat Detail diklik --}}
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('button[data-semester]').on('click', function () {
            const button = $(this);
            const semester = button.data('semester');
            const email = button.data('email');

            // Check if the table already exists
            const tableExists = button.closest('.container-irs').find('.additional-info').length > 0;

            if (!tableExists) {
                button.find('svg').addClass('rotate-180'); // Rotate the arrow down

                // AJAX request to fetch data
                $.ajax({
                    url: `/irs/${semester}/${email}`,
                    method: 'GET',
                    success: function (response) {
                        let table = `
                        <div class="additional-info mt-4 text-sm">
                            <table class="w-full table-auto rounded-lg shadow-md bg-gray-200 text-gray-700">
                                <thead class="bg-gray-400">
                                    <tr>
                                        <th class="px-4 py-2 text-left">Kode</th>
                                        <th class="px-4 py-2 text-left">Mata Kuliah</th>
                                        <th class="px-4 py-2 text-left">Ruang</th>
                                        <th class="px-4 py-2 text-left">SKS</th>
                                    </tr>
                                </thead>
                                <tbody>`;

                        response.data.forEach(row => {
                            table += `
                                <tr class="border-b hover:bg-gray-300">
                                    <td class="px-4 py-2">${row.kodemk}</td>
                                    <td class="px-4 py-2">${row.mata_kuliah}</td>
                                    <td class="px-4 py-2">${row.ruang}</td>
                                    <td class="px-4 py-2">${row.sks}</td>
                                </tr>`;
                        });

                        table += `
                                </tbody>
                            </table>
                        </div>`;

                        // Append the table to the container
                        button.closest('.container-irs').append(table);
                    },
                    error: function (xhr, status, error) {
                        console.error('Error fetching data:', error);
                    }
                });
            } else {
                button.find('svg').removeClass('rotate-180'); // Rotate the arrow back up
                button.closest('.container-irs').find('.additional-info').remove(); // Remove the existing table
            }
        });
    });
</script>

@endsection
