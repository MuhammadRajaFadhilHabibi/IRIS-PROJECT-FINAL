@extends('header')

@section('title', 'Plot Ruang')

@section('page')

<div class="flex h-screen overflow-hidden">

    <!-- Sidebar -->
    <x-side-bar :active="request()->route()->getName()"></x-side-bar>

    {{-- Main Content --}}
    <div id="main-content" class="w-4/5 p-8 overflow-y-auto h-screen ml-[20%]">
        <div class="px-8 py-8">
            <div class="bg-white border border-gray-200 rounded-3xl shadow-sm sm:p-6">
                <div class="flex justify-between mb-4">
                    
                    {{-- Dropdown Pilih Prodi --}}
                    <button id="dropdownDefaultButton" data-dropdown-toggle="dropdownProdi" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center" type="button">
                        {{ $prodi!=''?$prodi:'Pilih Prodi' }}
                        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>
                    
                    {{-- Dropdown Pilihan Program Studi --}}
                    <div id="dropdownProdi" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" data-prodi="Informatika">Informatika</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" data-prodi="Matematika">Matematika</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" data-prodi="Statistika">Statistika</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" data-prodi="Biologi">Biologi</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" data-prodi="Kimia">Kimia</a></li>
                            <li><a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" data-prodi="Fisika">Fisika</a></li>
                        </ul>
                    </div>

                    {{-- Input Pencarian --}}
                    <input id="searchRuang" type="text" placeholder="Cari Ruang" class="bg-gray-100 border border-black rounded-lg px-4 py-2 w-1/4">
                </div>

                {{-- Tabel Plot Ruang --}}
                <table id="plotRuang" class="min-w-full bg-white rounded-lg shadow-md overflow-hidden">
                    <thead class="bg-gradient-to-r from-blue-500 to-blue-600 text-white">
                        <tr>
                            <th class="py-3 px-4 text-left text-sm font-semibold">No</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold">No Ruang</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold">Blok Gedung</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold">Lantai</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold">Fungsi</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold">Kapasitas</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold">Status</th>
                            <th class="py-3 px-4 text-left text-sm font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-50 divide-y divide-gray-200">
                        @foreach ($data as $ruang)
                        <tr class="hover:bg-gray-100 transition duration-150 ease-in-out">
                            <td class="py-3 px-4">{{ $loop->iteration }}</td>
                            <td class="py-3 px-4">{{ $ruang->noruang }}</td>
                            <td class="py-3 px-4">{{ $ruang->blokgedung }}</td>
                            <td class="py-3 px-4">{{ $ruang->lantai }}</td>
                            <td class="py-3 px-4">{{ $ruang->fungsi }}</td>
                            <td class="py-3 px-4">{{ $ruang->kapasitas }}</td>
                            <td class="py-3 px-4">
                                <span class="{{ 
                                    $ruang->status == 'Pending' ? 'bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full' : 
                                    ($ruang->status == 'Disetujui' ? 'bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full' : 'bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full') }}">
                                    {{ $ruang->status }}
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                <button type="button" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg px-3 py-2 text-xs font-medium text-center rounded-lg delete-btn" data-id="{{ $ruang->id }}">
                                    Delete
                                </button>
                                <form id="delete-form-{{ $ruang->id }}" action="plotruang/{{ $ruang->id }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- DataTables Script --}}
    <script>
        $(document).ready(function () {
            var tableRuang = $('#plotRuang').DataTable({
                pageLength: 10,
                dom: '<"flex justify-between items-center mb-4"l>rt<"flex justify-between"ip>', // Kontrol elemen UI
                language: {
                    lengthMenu: "Tampilkan _MENU_ data per halaman",
                    search: "", // Hilangkan label "Search:"
                },
                ordering: false,
                columnDefs: [
                    { className: "dt-head-center", targets: [0, 1, 2, 3, 4, 5, 6, 7] },
                    { className: "dt-body-center", targets: [0, 1, 2, 3, 4, 5, 6, 7] }
                ]
            });
        
            // Pencarian
            $('#searchRuang').on('keyup', function () {
                tableRuang.search($(this).val()).draw();
            });
        
            // Dropdown Pilihan Program Studi
            $('#dropdownProdi a').click(function (e) {
                e.preventDefault();
                var prodi = $(this).data('prodi'); 
        
                // Perbarui teks tombol dropdown
                $('#dropdownDefaultButton').text(prodi);
                $('#dropdownDefaultButton').append(`
                    <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                `);
        
                // Close dropdown
                const dropdownButton = document.getElementById('dropdownDefaultButton');
                dropdownButton.click();
        
                // Kirim permintaan AJAX ke controller
                $.ajax({
                    url: '/prodi',
                    method: 'GET',
                    data: { prodi: prodi },
                    success: function (response) {
                        tableRuang.clear().draw();
        
                        // Tambahkan data baru ke tabel
                        response.data.forEach(function (ruang, index) {
                            tableRuang.row.add([
                                index + 1, 
                                ruang.noruang,
                                ruang.blokgedung,
                                ruang.lantai,
                                ruang.fungsi,
                                ruang.kapasitas,
                                `<span class="${
                                    ruang.status == 'Pending' ? ' text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full' :
                                    ruang.status == 'Disetujui' ? ' text-Black-800-bold text-xs font-medium me-2 px-2.5 py-0.5 rounded-full' : 'bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full'
                                }">${ruang.status}</span>`,
                                `<button type="button" 
                                        class="text-white bg-red-600 hover:bg-red-700  focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg px-3 py-2 text-xs font-medium text-center rounded-lg delete-btn" 
                                        data-id="${ruang.id}" 
                                        data-noruang="${ruang.noruang}" 
                                        data-blokgedung="${ruang.blokgedung}">
                                    Delete
                                </button>
                                <form id="delete-form-${ruang.id}" action="plotruang/${ruang.id}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>`
                            ]).draw(false);
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error('Error fetching data:', error);
                    }
                });
            });
        
            // Event Delegation untuk Delete
            $(document).on('click', '.delete-btn', function () {
                var id = $(this).data('id');
                var noruang = $(this).data('noruang');
                var blokgedung = $(this).data('blokgedung');
        
                Swal.fire({
                    title: 'Konfirmasi Hapus',
                    html: `<p>Apakah Anda yakin ingin menghapus ruangan ini?</p>
                           <p><strong>No Ruang:</strong> ${noruang}</p>
                           <p><strong>Blok Gedung:</strong> ${blokgedung}</p>`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#delete-form-' + id).submit();
                    }
                });
            });
        });
        </script>
        
@endsection
