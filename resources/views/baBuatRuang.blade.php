@extends('header')

@section('title', 'Pembuatan Ruang')

@section('page')

<div class="flex h-screen overflow-hidden">
        {{-- sidebar --}}
  
            <x-side-bar :active="request()->route()->getName()">
              
            </x-side-bar>
        {{-- end sidebar --}}

    {{-- Main Content --}}
    <div id="main-content" class="w-4/5 p-8 overflow-y-auto h-screen ml-[20%]">
        <div class="px-8 py-8">
            <div class="bg-white border border-gray-200 rounded-3xl shadow-sm sm:p-6">
                <div class="flex justify-between mb-4">
                    <div class="flex gap-4">
                        <input id="searchRuang" type="text" placeholder="Cari Ruang" class="bg-gray-100 border border-black rounded-lg px-4 py-2">
                        <select id="filterProdi" class="bg-gray-100 border border-black rounded-lg px-4 py-2">
                            <option value="">Semua Prodi</option>
                            <option value="Informatika">Informatika</option>
                            <option value="Fisika">Fisika</option>
                            <option value="Matematika">Matematika</option>
                            <option value="Statistika">Statistika</option>
                            <option value="Biologi">Biologi</option>
                            <option value="Kimia">Kimia</option>
                        </select>
                    </div>
                    <button id="selectAll" data-modal-target="crud-modal" data-modal-toggle="crud-modal" 
                    class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br 
                           focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 
                           font-medium rounded-lg text-base px-8 py-3 inline-flex items-center mt-2">
                Buat Ruang +
            </button>
                </div>

                {{-- Tabel Ruangan --}}
                <table id="Ruang" class="min-w-full bg-white rounded-lg shadow-md overflow-hidden">
                    <thead class="bg-gradient-to-r from-blue-500 to-blue-600 text-white">
                        <tr>
                            <th class="py-3 px-4 text-center text-sm font-semibold">No</th>
                            <th class="py-3 px-4 text-center text-sm font-semibold">No Ruang</th>
                            <th class="py-3 px-4 text-center text-sm font-semibold">Blok Gedung</th>
                            <th class="py-3 px-4 text-center text-sm font-semibold">Lantai</th>
                            <th class="py-3 px-4 text-center text-sm font-semibold">Fungsi</th>
                            <th class="py-3 px-4 text-center text-sm font-semibold">Kapasitas</th>
                            <th class="py-3 px-4 text-center text-sm font-semibold">Prodi</th>
                            <th class="py-3 px-4 text-center text-sm font-semibold">Status</th>
                            <th class="py-3 px-4 text-center text-sm font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-50 divide-y divide-gray-200">
                        @foreach ($data as $ruang)
                        <tr class="hover:bg-gray-100 transition duration-150 ease-in-out" id="row-{{ $ruang->id }}">
                            <td class="py-3 px-4 text-center">{{ $loop->iteration }}</td>
                            <td class="py-3 px-4 text-center">{{ $ruang->noruang }}</td>
                            <td class="py-3 px-4 text-center">{{ $ruang->blokgedung }}</td>
                            <td class="py-3 px-4 text-center">{{ $ruang->lantai }}</td>
                            <td class="py-3 px-4 text-center">{{ $ruang->fungsi }}</td>
                            <td class="py-3 px-4 text-center">{{ $ruang->kapasitas }}</td>
                            <td class="py-3 px-4 text-center">{{ $ruang->prodi }}</td>
                            <td class="py-3 px-4 text-center">
                                <span class="{{ 
                                    $ruang->status == 'Pending' ? 'bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full' : 
                                    ($ruang->status == 'Disetujui' ? ' text-black-800-bold text-xs font-medium px-2.5 py-0.5 rounded-full' : 'bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full') }}">
                                    {{ $ruang->status }}
                                </span>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <!-- Tombol Edit -->
                                <button type="button" data-modal-target="updateModal-{{ $ruang->id }}" data-modal-toggle="updateModal-{{ $ruang->id }}" 
                                        class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 
                                               shadow-lg px-3 py-2 text-xs font-medium text-center rounded-lg">
                                    Edit
                                </button>
                            
                                <button type="button" 
                                data-id="{{ $ruang->id }}" 
                                data-noruang="{{ $ruang->noruang }}" 
                                data-blokgedung="{{ $ruang->blokgedung }}" 
                                data-prodi="{{ $ruang->prodi }}" 
                                data-kapasitas="{{ $ruang->kapasitas }}" 
                                class="delete-btn text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg px-3 py-2 text-xs font-medium text-center rounded-lg">
                                Delete
                            </button>
                            
                            </td>
                        </tr>

                        {{-- Modal Edit Ruang --}}
                        <div id="updateModal-{{ $ruang->id }}" tabindex="-1" class="hidden fixed inset-0 z-50 items-center justify-center bg-gray-900 bg-opacity-50">
                            <div class="bg-white rounded-lg shadow w-full max-w-md p-6 mx-auto">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Edit Ruang</h3>
                                    <button type="button" class="text-gray-400 bg-transparent rounded-lg hover:text-gray-900 dark:hover:text-white" data-modal-toggle="updateModal-{{ $ruang->id }}">
                                        <svg class="w-5 h-5" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                                <form action="{{ route('ruang.update', $ruang->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="grid gap-4">
                                        <div>
                                            <label for="noruang" class="block text-sm font-medium text-gray-700">No Ruang</label>
                                            <input type="text" name="noruang" id="noruang" value="{{ $ruang->noruang }}" class="bg-gray-50 border border-gray-300 rounded-lg block w-full p-2.5" required>
                                        </div>
                                        <div>
                                            <label for="blokgedung" class="block text-sm font-medium text-gray-700">Blok Gedung</label>
                                            <input type="text" name="blokgedung" id="blokgedung" value="{{ $ruang->blokgedung }}" class="bg-gray-50 border border-gray-300 rounded-lg block w-full p-2.5" required>
                                        </div>
                                        <div>
                                            <label for="lantai" class="block text-sm font-medium text-gray-700">Lantai</label>
                                            <select id="lantai" name="lantai" class="bg-gray-50 border border-gray-300 rounded-lg block w-full p-2.5">
                                                <option value="1" {{ ($ruang->lantai == 1) ? 'selected' : '' }}>1</option>
                                                <option value="2" {{ ($ruang->lantai == 2) ? 'selected' : '' }}>2</option>
                                                <option value="3" {{ ($ruang->lantai == 3) ? 'selected' : '' }}>3</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="kapasitas" class="block text-sm font-medium text-gray-700">Kapasitas</label>
                                            <input type="number" name="kapasitas" id="kapasitas" value="{{ $ruang->kapasitas }}" class="bg-gray-50 border border-gray-300 rounded-lg block w-full p-2.5" required>
                                        </div>
                                        <div>
                                            <label for="fungsi" class="block text-sm font-medium text-gray-700">Fungsi</label>
                                            <select id="fungsi" name="fungsi" class="bg-gray-50 border border-gray-300 rounded-lg block w-full p-2.5">
                                                <option value="Ruang Kelas" {{ ($ruang->fungsi == 'Ruang Kelas') ? 'selected' : '' }}>Ruang Kelas</option>
                                                <option value="Lab Komputer" {{ ($ruang->fungsi == 'Lab Komputer') ? 'selected' : '' }}>Lab Komputer</option>
                                                <option value="Ruang Seminar" {{ ($ruang->fungsi == 'Ruang Seminar') ? 'selected' : '' }}>Ruang Seminar</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="prodi" class="block text-sm font-medium text-gray-700">Prodi</label>
                                        <select id="prodi" name="prodi" class="bg-gray-50 border border-gray-300 rounded-lg block w-full p-2.5" required>
                                            <option value="Informatika" {{ ($ruang->prodi == 'Informatika') ? 'selected' : '' }}>Informatika</option>
                                            <option value="Fisika" {{ ($ruang->prodi == 'Fisika') ? 'selected' : '' }}>Fisika</option>
                                            <option value="Matematika" {{ ($ruang->prodi == 'Matematika') ? 'selected' : '' }}>Matematika</option>
                                            <option value="Statistika" {{ ($ruang->prodi == 'Statistika') ? 'selected' : '' }}>Statistika</option>
                                            <option value="Biologi" {{ ($ruang->prodi == 'Biologi') ? 'selected' : '' }}>Biologi</option>
                                            <option value="Kimia" {{ ($ruang->prodi == 'Kimia') ? 'selected' : '' }}>Kimia</option>
                                        </select>
                                    </div>                                    
                                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                        <svg class="w-5 h-5 mr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 010 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                        </svg>
                                        Ubah Ruang
                                    </button>
                                </form>
                            </div>
                        </div>
                        

    {{-- Modal Delete --}}
    <div id="deleteModal" class="hidden fixed inset-0 z-50 items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="bg-white rounded-lg shadow w-full max-w-md p-6 mx-auto">
            <div class="text-center">
                <svg class="w-16 h-16 text-red-600 mx-auto mb-4" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 100 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-black mb-4">Apakah Anda yakin ingin menghapus ruangan ini?</h3>
                <p id="ruangInfo" class="text-sm text-gray-700 dark:text-black-300 mb-4"></p>
                <button type="button" id="cancelDelete" class="text-gray-500 bg-gray-200 hover:bg-gray-300 rounded-lg py-2 px-4">Tidak</button>
                <button type="button" id="confirmDelete" class="text-white bg-red-600 hover:bg-red-700 rounded-lg py-2 px-4">Ya, Hapus</button>
            </div>
        </div>
    </div>
</div>
                        
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Modal Create Ruang --}}
    <div id="crud-modal" tabindex="-1" class="hidden fixed inset-0 z-50 items-center justify-center bg-gray-900 bg-opacity-50">
        <div class="bg-white rounded-lg shadow w-full max-w-md p-6 mx-auto">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-black">Buat Ruang</h3>
                <button type="button" class="text-gray-400 bg-transparent rounded-lg hover:text-gray-900 dark:hover:text-white" data-modal-toggle="crud-modal">
                    <svg class="w-5 h-5" fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form id="form-create-ruang" action="{{ route('ruang.store') }}" method="POST">
                @csrf
                <div class="grid gap-4">
                    <div>
                        <label for="noruang" class="block text-sm font-medium text-gray-700">No Ruang</label>
                        <input type="text" name="noruang" id="noruang" class="bg-gray-50 border border-gray-300 rounded-lg block w-full p-2.5" required>
                    </div>
                    <div>
                        <label for="blokgedung" class="block text-sm font-medium text-gray-700">Blok Gedung</label>
                        <input type="text" name="blokgedung" id="blokgedung" class="bg-gray-50 border border-gray-300 rounded-lg block w-full p-2.5" required>
                    </div>
                    <div>
                        <label for="lantai" class="block text-sm font-medium text-gray-700">Lantai</label>
                        <select id="lantai" name="lantai" class="bg-gray-50 border border-gray-300 rounded-lg block w-full p-2.5">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                    <div>
                        <label for="kapasitas" class="block text-sm font-medium text-gray-700">Kapasitas</label>
                        <input type="number" name="kapasitas" id="kapasitas" class="bg-gray-50 border border-gray-300 rounded-lg block w-full p-2.5" required>
                    </div>
                    <div>
                        <label for="fungsi" class="block text-sm font-medium text-gray-700">Fungsi</label>
                        <select id="fungsi" name="fungsi" class="bg-gray-50 border border-gray-300 rounded-lg block w-full p-2.5">
                            <option value="Ruang Kelas">Ruang Kelas</option>
                            <option value="Lab Komputer">Lab Komputer</option>
                            <option value="Ruang Seminar">Ruang Seminar</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label for="prodi" class="block text-sm font-medium text-gray-700">Prodi</label>
                    <select id="prodi" name="prodi" class="bg-gray-50 border border-gray-300 rounded-lg block w-full p-2.5" required>
                        <option value="Informatika">Informatika</option>
                        <option value="Fisika">Fisika</option>
                        <option value="Matematika">Matematika</option>
                        <option value="Statistika">Statistika</option>
                        <option value="Biologi">Biologi</option>
                        <option value="Biologi">Kimia</option>
                    </select>
                </div>                
                <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 010 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Tambah Ruang
                </button>
            </form>
        </div>
    </div>
    
{{-- DataTables Script --}}
<script>
    $(document).ready( function () {
                    var tableRuang = $('#Ruang').DataTable({
                        pageLength : [10,25,50,100],
                        pageLength: -1, 
                        layout :{
                            topStart: null,
                            topEnd: null,
                            bottomStart: 'pageLength',
                            bottomEnd: 'paging'
                        },
                        ordering: false,
                        "columnDefs": [
                            { className: "dt-head-center", "targets": [0,1,2,3,4,5,6] },
                            { className: "dt-head-right", "targets": [7] },
                            { className: "dt-body-center", "targets": [0,1,2,3,4,5,6] },
                            {className: "dt-body-right", "targets": [7]}
                        ],
                    });

                    setTimeout(() => {
                        tableRuang.page.len(10).draw();
                    }, 10);

                    $('#searchRuang').keyup(function() {
                        tableRuang.search($(this).val()).draw();
                    });

                    // Fungsi Filter Prodi
                    $('#filterProdi').on('change', function () {
                    var selectedProdi = $(this).val();
                    tableRuang.column(6).search(selectedProdi).draw(); // Kolom ke-6 adalah Prodi
                 });


        // Submit Form Tambah Ruang
    $('#form-create-ruang').on('submit', function (e) {
    e.preventDefault();
    
    $.ajax({
        type: 'POST',
        url: $(this).attr('action'),
        data: $(this).serialize(),
        success: function (response) {
            if (response.success) {
                // Reset form dan tutup modal
                $('#form-create-ruang')[0].reset();
                $('#crud-modal').removeClass('flex').addClass('hidden');
                
                // Reload tabel dengan AJAX
                $.get(window.location.href, function(data) {
                    let newTable = $(data).find('#Ruang tbody').html();
                    $('#Ruang tbody').html(newTable);
                    
                    // Reinisialisasi event handlers
                    initializeEventHandlers();
                });
                
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Ruang baru berhasil ditambahkan!',
                    timer: 1500,
                    showConfirmButton: false
                });
            }
        },
        error: function() {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Terjadi kesalahan!'
            });
        }
    });
});
        // Event untuk Edit Ruang
        $(document).on('click', '.edit-btn', function () {
            var id = $(this).data('id');
            var targetModal = `#updateModal-${id}`;
            $(targetModal).removeClass('hidden').addClass('flex');
        });

        // Event untuk Hapus Ruang
        $(document).on('click', '.delete-btn', function () {
            var id = $(this).data('id');
            var noruang = $(this).data('noruang');
            var blokgedung = $(this).data('blokgedung');
            var prodi = $(this).data('prodi');
            var kapasitas = $(this).data('kapasitas');

            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: `Ruang: ${noruang}, Blok: ${blokgedung}, Prodi: ${prodi}, Kapasitas: ${kapasitas}`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/ruang/${id}`,
                        type: 'POST',
                        data: {
                            _method: 'DELETE',
                            _token: '{{ csrf_token() }}',
                        },
                        success: function (response) {
                            tableRuang.row($(`button[data-id="${id}"]`).parents('tr')).remove().draw();
                            Swal.fire('Berhasil!', response.message, 'success');
                        },
                        error: function () {
                            Swal.fire('Oops...', 'Terjadi kesalahan, coba lagi nanti!', 'error');
                        }
                    });
                }
            });
        });
    });
</script>

@endsection
