@extends('header')

@section('title','Buat Jadwal')

@section('page')

<style>
    /* Hilangkan outline pada elemen teks dan cegah pemilihan teks */
    p, span, h1, h2, h3, h4, h5, h6, a {
        outline: none;
        user-select: none;
    }
</style>

<div class="flex h-screen">
            {{-- sidebar --}}
  
            <x-side-bar :active="request()->route()->getName()">
              
            </x-side-bar>
          {{-- end sidebar --}}

    {{-- Main Content --}}
    <div id="main-content" class="flex-1 p-8 bg-gray-200 min-h-screen ml-[340px]">
        <div class="bg-white border border-gray-300 rounded-3xl shadow-md p-6">
            <h1 class="text-3xl font-bold mb-6 text-blue-600">Pengajuan Jadwal</h1>
    
            <!-- Input Search -->
            <div class="flex justify-between mb-6">
                <input id="searchRuang" type="text" placeholder="Cari Program Studi" class="bg-gray-100 rounded-lg px-4 py-2 w-2/3">
            </div>
    
            <!-- Table Jadwal -->
            <!-- Table Jadwal -->
<table id="Ruang" class="min-w-full bg-white rounded-lg shadow-md text-center border-collapse border border-gray-300">
    <thead class="bg-blue-500 text-white">
        <tr>
            <th class="py-3 px-4 text-sm font-semibold text-center border border-gray-300">No</th>
            <th class="py-3 px-4 text-sm font-semibold text-center border border-gray-300">Program Studi</th>
            <th class="py-3 px-4 text-sm font-semibold text-center border border-gray-300">Jumlah Jadwal</th>
            <th class="py-3 px-4 text-sm font-semibold text-center border border-gray-300">Aksi</th>
        </tr>
    </thead>
    <tbody class="bg-white-100">
        @foreach ($data as $jadwal)
        <tr class="hover:bg-gray-100 transition duration-200 ease-in-out">
            <td class="py-3 px-4 text-center align-middle border border-gray-300">{{ $loop->iteration }}</td>
            <td class="py-3 px-4 text-center align-middle border border-gray-300">{{ $jadwal->prodi }}</td>
            <td class="py-3 px-4 text-center align-middle border border-gray-300">{{ $jadwal->jadwal_count }}</td>
            <td class="py-3 px-4 text-center align-middle border border-gray-300">
                @if ($jadwal->all_pending)
                    <div class="flex justify-center items-center space-x-3">
                        <!-- Tombol Setuju -->
                        <button id="approve-btn-{{ $loop->iteration }}" type="button" 
                            onclick="approveJadwal('{{ $loop->iteration }}')" 
                            class="flex items-center space-x-2 text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 shadow-lg px-4 py-2 text-sm font-medium rounded-full transform transition duration-300 hover:scale-105">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-2.293-5.707a1 1 0 011.414 0L10 14.586l2.879-2.879a1 1 0 111.414 1.414l-3.586 3.586a1 1 0 01-1.414 0l-3.586-3.586a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            <span>Setuju</span>
                        </button>
            
                        <!-- Tombol Tolak -->
                        <button id="reject-btn-{{ $loop->iteration }}" type="button" 
                            onclick="rejectJadwal('{{ $loop->iteration }}')" 
                            class="flex items-center space-x-2 text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 shadow-lg px-4 py-2 text-sm font-medium rounded-full transform transition duration-300 hover:scale-105">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-2.293-5.707a1 1 0 011.414 0L10 14.586l2.879-2.879a1 1 0 111.414 1.414l-3.586 3.586a1 1 0 01-1.414 0l-3.586-3.586a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            <span>Tolak</span>
                        </button>
            
                        <!-- Tombol Detail -->
                        <a id="detail-btn-{{ $loop->iteration }}" type="button" href="reviewjadwal/{{ $jadwal->prodi }}" 
                            class="flex items-center space-x-2 text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 shadow-lg px-4 py-2 text-sm font-medium rounded-full transform transition duration-300 hover:scale-105">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 3a7 7 0 100 14 7 7 0 000-14zM10 0a10 10 0 110 20A10 10 0 0110 0z"></path></svg>
                            <span>Detail</span>
                        </a>
                    </div>
                @else
                    <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">{{ $jadwal->belumcount }} Jadwal yang Belum Dibuat!</span>
                @endif
            
                <!-- Status untuk Jadwal -->
                <div id="{{ $loop->iteration }}-status"></div>
            </td>
            
        </tr>
        @endforeach
    </tbody>
</table>

        </div>
    </div>
    

    <script>
        function approveJadwal(prodi) {
         Swal.fire({
             title: 'Apakah Anda yakin?',
             text: "Jadwal akan disetujui untuk program studi: " + prodi,
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Ya, Setujui!',
             cancelButtonText: 'Batal'
         }).then((result) => {
             if (result.isConfirmed) {
                 $.ajax({
                     url: "{{ route('jadwal.approve') }}",
                     type: "POST",
                     data: {
                         _token: '{{ csrf_token() }}',
                         prodi: prodi
                     },
                     success: function(response) {
                         Swal.fire(
                             'Berhasil!',
                             response.message,
                             'success'
                         ).then(() => {
                             // Update UI setelah setujui
                             $('#approve-btn-' + prodi).hide();
                             $('#reject-btn-' + prodi).hide();
                             $('#detail-btn-' + prodi).hide();
                             $('#' + prodi + '-status').html('<span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Disetujui</span>');
                         });
                     },
                     error: function(xhr) {
                         Swal.fire(
                             'Gagal!',
                             'Terjadi kesalahan saat menyetujui jadwal.',
                             'error'
                         );
                     }
                 });
             }
         });
     }
     
     function rejectJadwal(prodi) {
         Swal.fire({
             title: 'Apakah Anda yakin?',
             text: "Jadwal akan ditolak untuk program studi: " + prodi,
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Ya, Tolak!',
             cancelButtonText: 'Batal'
         }).then((result) => {
             if (result.isConfirmed) {
                 $.ajax({
                     url: "{{ route('jadwal.reject') }}",
                     type: "POST",
                     data: {
                         _token: '{{ csrf_token() }}',
                         prodi: prodi
                     },
                     success: function(response) {
                         Swal.fire(
                             'Berhasil!',
                             response.message,
                             'success'
                         ).then(() => {
                             // Update UI setelah tolak
                             $('#approve-btn-' + prodi).hide();
                             $('#reject-btn-' + prodi).hide();
                             $('#detail-btn-' + prodi).hide();
                             $('#' + prodi + '-status').html('<span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Ditolak</span>');
                         });
                     },
                     error: function(xhr) {
                         Swal.fire(
                             'Gagal!',
                             'Terjadi kesalahan saat menolak jadwal.',
                             'error'
                         );
                     }
                 });
             }
         });
     }
     </script>
{{-- datatble_end --}}
@endsection
