@extends('header')

@section('title','Buat Ruang')

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
<!-- Tabel Ruang -->
<!-- Tabel Ruang -->
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
                @if ($ruang->status == 'Pending')
                    <!-- Tombol Setujui -->
                    <button onclick="approveRuang({{ $ruang->id }})" 
                            class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 shadow-lg px-3 py-2 text-xs font-medium rounded-lg">
                        Setujui
                    </button>
                @else
                    <!-- Tombol Detail -->
                    <button type="button" data-modal-target="detailModal-{{ $ruang->id }}" data-modal-toggle="detailModal-{{ $ruang->id }}" 
                            class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 shadow-lg px-3 py-2 text-xs font-medium rounded-lg">
                        Detail
                    </button>
                @endif
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
                        layout :{
                            topStart: null,
                            topEnd: null,
                            bottomStart: 'pageLength',
                            bottomEnd: 'paging'
                        }
                    });
                    
                    $('#searchRuang').keyup(function() {
                        tableRuang.search($(this).val()).draw();
                    });
                } );
            </script>
        {{-- datatble_end --}}
        <script>

        
        // Update status untuk semua ID yang terpilih
        function approve(id) {
            updateStatus(id, 'Disetujui');
        }
        
        function reject(id) {
            updateStatus(id, 'Ditolak');
        }
        
        function updateStatus(id, status) {
            $.ajax({
                url: `/ruang/${id}/update-status`, // Route untuk update status
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: status
                },
                success: function(response) {
                if (id === 'all') {
                    console.log(response);
                    // Jika mengupdate semua, update status di table untuk semua
                    response.data.forEach(function(ruang) {
                        $('#statusNow-' + ruang.id).text(status);
                        $('#approve-btn-' + ruang.id).hide();
                        $('#reject-btn-' + ruang.id).hide();
                    });
                } 
                else {
                    $('#statusNow-' + id + ' span').text(status);

                    $('#statusNow-' + id + ' span').removeClass();
                    if (status == 'Disetujui') {
                        $('#statusNow-' + id + ' span').attr('class', 'bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300');
                    } else {
                        $('#statusNow-' + id + ' span').attr('class', 'bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300');
                    }
                    $('#approve-btn-' + id).hide();
                    $('#reject-btn-' + id).hide();
                }
                },
                error: function(xhr) {
                    alert('Gagal memperbarui status.');
                }
            });
        }

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
                    // Perbarui status di kolom status
                    $('#statusNow-' + id + ' span').text('Disetujui')
                        .removeClass('bg-yellow-100 text-yellow-800')
                        .addClass('bg-green-100 text-green-800');
                    
                    // Tampilkan notifikasi sukses
                    Swal.fire(
                        'Disetujui!',
                        'Ruangan berhasil disetujui.',
                        'success'
                    );

                    // Ganti tombol "Setujui" dengan tombol "Detail"
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


        </script>

        
        
@endsection
