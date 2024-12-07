@extends('header')

@section('title', 'Ajuan IRS')

@section('page')

<div class="flex pt-12 bg-white-50 min-h-screen">
    {{-- Sidebar --}}
    <x-side-bar :active="request()->route()->getName()"></x-side-bar>
    {{-- End Sidebar --}}

    {{-- Main Content --}}
    <div id="main-content" class="relative text-gray-900 font-poppins w-full h-full pl-[20%] pt-10">
        <div class="px-10">
          <h1 class="text-transparent bg-clip-text bg-gradient-to-b from-blue-500 to-blue-300 font-bold text-3xl mb-4">
            Ajuan IRS Mahasiswa
        </h1>
            <div class="p-6 bg-white shadow-md rounded-lg border border-blue-300">
                <div class="overflow-x-auto">
                    <table id="ajuan-irs" class="min-w-full border-collapse border border-blue-300 text-center">
                        <thead class="bg-blue-500 text-white">
                            <tr>
                                <th class="border border-blue-300 px-4 py-2 text-white">No</th>
                                <th class="border border-blue-300 px-4 py-2 text-white">NIM</th>
                                <th class="border border-blue-300 px-4 py-2 text-white">Nama</th>
                                <th class="border border-blue-300 px-4 py-2 text-white">Jumlah SKS</th>
                                <th class="border border-blue-300 px-4 py-2 text-white">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $mhs)
                            <tr class="bg-white hover:bg-gray-50">
                                <td class="border border-blue-300 px-4 py-2 text-black">{{ $loop->iteration }}</td>
                                <td class="border border-blue-300 px-4 py-2 text-black">{{ $mhs->nim }}</td>
                                <td class="border border-blue-300 px-4 py-2 text-black">{{ $mhs->nama }}</td>
                                <td class="border border-blue-300 px-4 py-2 text-black">{{ $mhs->total_sks }}</td>
                                <td class="border border-blue-300 px-4 py-2">
                                    <button id="approve-btn-{{ $loop->iteration }}" type="button" 
                                        onclick="approveIrs('{{ $mhs->nama }}', '{{ $mhs->email }}')" 
                                        class="text-white bg-green-500 hover:bg-green-600 px-3 py-1 text-sm rounded-lg">Setuju</button>
                                    <button id="reject-btn-{{ $loop->iteration }}" type="button" 
                                        onclick="rejectIrs('{{ $mhs->nama }}', '{{ $mhs->email }}')" 
                                        class="text-white bg-red-500 hover:bg-red-600 px-3 py-1 text-sm rounded-lg">Tolak</button>
                                    <button data-modal-target="timeline-{{ $loop->iteration }}" data-modal-toggle="timeline-{{ $loop->iteration }}"
                                        class="text-white bg-purple-500 hover:bg-purple-600 px-3 py-1 text-sm rounded-lg">Detail</button>
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
    </div>
    {{-- End Main Content --}}
</div>

{{-- Modal Section --}}
@foreach ($data as $mhs)
<div id="timeline-{{ $loop->iteration }}" tabindex="-1" aria-hidden="true"
    class="hidden fixed top-0 left-0 w-full h-full z-50 flex items-center justify-center bg-gray-800 bg-opacity-50">
    <div class="bg-white rounded-lg shadow-lg max-w-lg w-full p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-700">Detail IRS: {{ $mhs->nama }}</h3>
            <button type="button" class="text-gray-400 hover:text-gray-600" data-modal-toggle="timeline-{{ $loop->iteration }}">
                ✕
            </button>
        </div>
        <div>
            <ol class="list-decimal ml-5 text-gray-700">
                @foreach ($mhs->datairs as $itemirs)
                <li class="mb-4">
                    <strong>{{ $itemirs->matakuliah }} {{ $itemirs->kelas }}</strong>
                    <p>{{ $itemirs->kodemk }} | {{ $itemirs->sks }} SKS</p>
                </li>
                @endforeach
            </ol>
        </div>
    </div>
</div>
@endforeach

        

        <script>
            function approveIrs(nama, email) {
              Swal.fire({
                title: "Apakah yakin untuk menyetujui IRS " + nama + "?",
                text: "Perubahan tidak dapat dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes!"
              }).then((result) => {
                if (result.isConfirmed) {
                  $.ajax({
                    url: "{{ route('irs.approve') }}",
                    type: "POST",
                    data: {
                      _token: '{{ csrf_token() }}',
                      email: email
                    },
                    success: function(response) {
                      Swal.fire({
                        title: "Ditetujui",
                        text: "IRS telah disetujui untuk " + nama,
                        icon: "success"
                      }).then(() => {
                        location.reload();                      });
                    }
                  });
                }
              });
            }

        </script>
        <script>
            function rejectIrs(nama, email) {
                Swal.fire({
                title: "Apakah yakin menolak IRS untuk " + nama + "?",
                text: "Perubahan tidak dapat dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes!"
              }).then((result) => {
                if (result.isConfirmed) {
                  $.ajax({
                    url: "{{ route('irs.reject') }}",
                    type: "POST",
                    data: {
                      _token: '{{ csrf_token() }}',
                      email: email
                    },
                    success: function(response) {
                      Swal.fire({
                        title: "Ditolak!",
                        text: "IRS telah ditolak untuk " + nama,
                        icon: "error"
                      }).then(() => {
                        location.reload();                      });
                    }
                  });
                }
              });
            }
        </script>
        
        {{-- datatable  --}}
        <script>
            $(document).ready( function () {
                var tableRuang = $('#ajuan-irs').DataTable({
                    layout: {
                        topStart: null,
                        topEnd: null,
                        bottomStart: 'pageLength',
                        bottomEnd: 'paging'
                    }
                });
        
                $('#searchRuang').keyup(function() {
                    tableRuang.search($(this).val()).draw();
                });
            });
        </script>
        
    {{-- datatble_end --}}

@endsection