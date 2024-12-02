@extends('header')

@section('title','Ajuan Ruang')

@section('page')

<div class="flex h-screen">
    {{-- sidebar --}}
    <x-side-bar :active="request()->route()->getName()">
    </x-side-bar>
    {{-- end sidebar --}}

    {{-- Main Content --}}
    <div id="main-content" class="flex-1 p-8 bg-gray-200 min-h-screen ml-[340px]">
        <div class="bg-white border border-gray-300 rounded-3xl shadow-md p-6">
            <h1 class="text-3xl font-bold mb-6 text-blue-600">Pengajuan Ruang</h1>

            <!-- Input Search dan Button Setujui Semua -->
            <div class="flex justify-between mb-6">
                <input id="searchRuang" type="text" placeholder="Cari Ruang" class="bg-gray-100 rounded-lg px-4 py-2 w-2/3">
                <button id="selectAll" type="button" onclick="updateStatus('all', 'Disetujui')" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 shadow-lg font-medium rounded-lg text-sm px-5 py-2.5">
                    Setujui Semua
                </button>
            </div>

            <!-- Table Ruang -->
            <table id="Ruang" class="min-w-full bg-white rounded-lg shadow-md border-collapse border border-gray-300">
                <thead class="bg-blue-500 text-white">
                    <tr>
                        <th class="py-3 px-4 text-sm font-semibold text-center border border-gray-300">No</th>
                        <th class="py-3 px-4 text-sm font-semibold text-center border border-gray-300">No Ruang</th>
                        <th class="py-3 px-4 text-sm font-semibold text-center border border-gray-300">Blok Gedung</th>
                        <th class="py-3 px-4 text-sm font-semibold text-center border border-gray-300">Lantai</th>
                        <th class="py-3 px-4 text-sm font-semibold text-center border border-gray-300">Fungsi</th>
                        <th class="py-3 px-4 text-sm font-semibold text-center border border-gray-300">Kapasitas</th>
                        <th class="py-3 px-4 text-sm font-semibold text-center border border-gray-300">Status</th>
                        <th class="py-3 px-4 text-sm font-semibold text-center border border-gray-300">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $ruang)
                    <tr class="hover:bg-gray-100 transition duration-200 ease-in-out">
                        <td class="py-3 px-4 text-center align-middle border border-gray-300">{{ $loop->iteration }}</td>
                        <td class="py-3 px-4 text-center align-middle border border-gray-300">{{ $ruang->noruang }}</td>
                        <td class="py-3 px-4 text-center align-middle border border-gray-300">{{ $ruang->blokgedung }}</td>
                        <td class="py-3 px-4 text-center align-middle border border-gray-300">{{ $ruang->lantai }}</td>
                        <td class="py-3 px-4 text-center align-middle border border-gray-300">{{ $ruang->fungsi }}</td>
                        <td class="py-3 px-4 text-center align-middle border border-gray-300">{{ $ruang->kapasitas }}</td>
                        <td id="statusNow-{{ $ruang->id }}" class="py-3 px-4 text-center align-middle border border-gray-300">
                            <span class="{{ 
                                $ruang->status == 'Pending' ? 'bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full' : 
                                ($ruang->status == 'Disetujui' ? 'bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full' : 'bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full') }}">
                                {{ $ruang->status }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-center align-middle border border-gray-300">
                            <!-- Tombol Setujui dan Tolak jika status Pending -->
                            @if ($ruang->status == 'Pending')
                                <button onclick="approveRuang({{ $ruang->id }})" 
                                        class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 shadow-lg px-3 py-2 text-xs font-medium rounded-lg">
                                    Setujui
                                </button>
                                <button onclick="rejectRuang({{ $ruang->id }})" 
                                        class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 shadow-lg px-3 py-2 text-xs font-medium rounded-lg">
                                    Tolak
                                </button>
                            @endif
                            <!-- Tombol Detail selalu ada -->
                            <button type="button" data-modal-target="detailModal-{{ $ruang->id }}" data-modal-toggle="detailModal-{{ $ruang->id }}" 
                                    class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 shadow-lg px-3 py-2 text-xs font-medium rounded-lg">
                                Detail
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            @foreach ($data as $ruang)
            <!-- Modal Detail -->
            <div id="detailModal-{{ $ruang->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative bg-white rounded-lg shadow">
                        <!-- Modal Header -->
                        <div class="flex items-center justify-between p-4 border-b rounded-t">
                            <h3 class="text-lg font-semibold text-gray-900">
                                Detail Ruang
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="detailModal-{{ $ruang->id }}">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l-6-6M7 7l-6 6"/>
                                </svg>
                            </button>
                        </div>
                        <!-- Modal Content -->
                        <form class="p-4">
                            <div class="grid gap-4 mb-4 grid-cols-1">
                                <div>
                                    <label for="noruang" class="block mb-2 text-sm font-medium text-gray-900">No Ruang</label>
                                    <h1 class="text-sm text-black">{{ $ruang->noruang }}</h1>
                                </div>
                                <div>
                                    <label for="blokgedung" class="block mb-2 text-sm font-medium text-gray-900">Blok Gedung</label>
                                    <h1 class="text-sm text-black">{{ $ruang->blokgedung }}</h1>
                                </div>
                                <div>
                                    <label for="fungsi" class="block mb-2 text-sm font-medium text-gray-900">Fungsi</label>
                                    <h1 class="text-sm text-black">{{ $ruang->fungsi }}</h1>
                                </div>
                                <div>
                                    <label for="kapasitas" class="block mb-2 text-sm font-medium text-gray-900">Kapasitas</label>
                                    <h1 class="text-sm text-black">{{ $ruang->kapasitas }}</h1>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>

    {{-- datatable  --}}
    <script>
        $(document).ready( function () {
            var tableRuang = $('#Ruang').DataTable({
                layout: {
                    topStart: null,
                    topEnd: null,
                    bottomStart: 'pageLength',
                    bottomEnd: 'paging'
                },
                responsive: true
            });
            $('#searchRuang').keyup(function() {
                tableRuang.search($(this).val()).draw();
            });
        });

        function approveRuang(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Ruangan akan disetujui!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Setujui!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/ruang/${id}/update-status`,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            status: 'Disetujui'
                        },
                        success: function (response) {
                            $('#statusNow-' + id + ' span').text('Disetujui')
                                .removeClass('bg-yellow-100 text-yellow-800')
                                .addClass('bg-green-100 text-green-800');
                            
                            Swal.fire(
                                'Disetujui!',
                                'Ruangan berhasil disetujui.',
                                'success'
                            );

                            const detailButton = `
                                <button type="button" data-modal-target="detailModal-${id}" data-modal-toggle="detailModal-${id}" 
                                    class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 shadow-lg px-3 py-2 text-xs font-medium rounded-lg">
                                    Detail
                                </button>`;
                            $('#statusNow-' + id).siblings('td:last').html(detailButton);
                        },
                        error: function () {
                            Swal.fire(
                                'Gagal!',
                                'Terjadi kesalahan saat menyetujui ruangan.',
                                'error'
                            );
                        }
                    });
                }
            });
        }

        function rejectRuang(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Ruangan akan ditolak!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Tolak!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/ruang/${id}/update-status`,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            status: 'Ditolak'
                        },
                        ordering false,
                        success: function (response) {
                            $('#statusNow-' + id + ' span').text('Ditolak')
                                .removeClass('bg-yellow-100 text-yellow-800')
                                .addClass('bg-red-100 text-red-800');
                            
                            Swal.fire(
                                'Ditolak!',
                                'Ruangan berhasil ditolak.',
                                'success'
                            );

                            const detailButton = `
                                <button type="button" data-modal-target="detailModal-${id}" data-modal-toggle="detailModal-${id}" 
                                    class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 shadow-lg px-3 py-2 text-xs font-medium rounded-lg">
                                    Detail
                                </button>`;
                            $('#statusNow-' + id).siblings('td:last').html(detailButton);
                        },
                        error: function () {
                            Swal.fire(
                                'Gagal!',
                                'Terjadi kesalahan saat menolak ruangan.',
                                'error'
                            );
                        }
                    });
                }
            });
        }
    </script>

@endsection
