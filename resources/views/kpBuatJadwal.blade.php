@extends('header')

@section('title','Buat Jadwal')

@section('page')

    <div class="flex min-h-screen"> <!-- Pastikan ini adalah min-h-screen agar warna biru penuh sampai bawah -->
                {{-- sidebar --}}
  
                <x-side-bar :active="request()->route()->getName()">
              
                </x-side-bar>
              {{-- end sidebar --}}

              <div id="main-content" class="flex-1 p-8 bg-gray-200 min-h-screen ml-[340px]">
                <div class="flex justify-between items-start">
                    <!-- Bagian Kiri: Header Buat Jadwal -->
                    <div class="w-full">
                        <h1 class="text-3xl font-bold">Buat Jadwal</h1>
                        <div class="mt-4 bg-white p-6 rounded-2xl shadow-md border border-gray-300">
            
                            <!-- Tabel Jadwal -->
                            <table id="Jadwal" class="w-full bg-white rounded-lg shadow-md text-center text-lg">
                                <!-- Header Tabel dengan Warna Biru -->
                                <thead class="bg-blue-500 text-white">
                                    <tr>
                                        <th class="py-4 px-6">No</th>
                                        <th class="py-4 px-6">Kelas</th>
                                        <th class="py-4 px-6">Hari</th>
                                        <th class="py-4 px-6">Jam</th>
                                        <th class="py-4 px-6">Ruang</th>
                                        <th class="py-4 px-6">Kapasitas</th>
                                        <th class="py-4 px-6">Aksi</th>
                                        <th class="py-4 px-6">Status</th>
                                    </tr>
                                </thead>
                                <!-- Body Tabel dengan Warna Biru Muda -->
                                <tbody>
                                    @foreach ($data as $jadwal)
                                        <tr class="hover:bg-blue-100">
                                            <td class="py-4 px-6">{{ $loop->iteration }}</td>
                                            <td class="py-4 px-6">{{ $jadwal->matakuliah }} {{ $jadwal->kelas }}</td>
                                            <td class="py-4 px-6">{{ $jadwal->hari }}</td>
                                            <td class="py-4 px-6">{{ $jadwal->jammulai }} - {{ $jadwal->jamselesai }}</td>
                                            <td class="py-4 px-6">{{ $jadwal->ruang }}</td>
                                            <td class="py-4 px-6">{{ $jadwal->kapasitas }}</td>
                                            <td class="py-4 px-6">
                                                <button type="button" data-modal-target="updateModal-{{ $jadwal->id }}" data-modal-toggle="updateModal-{{ $jadwal->id }}" class="text-white bg-blue-400 hover:bg-grey-700 font-medium rounded-lg text-sm px-5 py-2.5">
                                                    Buat
                                                </button>
                                            </td>
                                            <td class="py-4 px-6">
                                                <span class="{{ 
                                                    $jadwal->status == 'Pending' ? 'bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full' : 
                                                    ($jadwal->status == 'Disetujui' ? ' text-black-800-bold px-3 py-1 rounded-full' : 'bg-red-100 text-red-800 px-3 py-1 rounded-full') 
                                                    }}">{{ $jadwal->status }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            



                @foreach ($data as $jadwal)
                <div id="updateModal-{{ $jadwal->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow border border-gray-300">
                            <!-- Modal header -->
                            <div class="flex items-center justify-between p-4 border-b rounded-t">
                                <h3 class="text-lg font-semibold text-gray-900">
                                    Buat Jadwal
                                </h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="updateModal-{{ $jadwal->id }}">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                </button>
                            </div>
                            <!-- Modal Edit Jadwal -->
                            <form class="p-6" action="buatjadwal/{{ $jadwal->id }}" method="POST">
                                @csrf
                                <div id="alerta-{{ $jadwal->id }}"></div>
                                <div class="grid gap-6 mb-6">
                                    <div>
                                        <label for="hari" class="block mb-2 text-sm font-medium text-gray-900">Hari</label>
                                        <select id="hari-{{ $jadwal->id }}" name="hari" data-id="{{ $jadwal->id }}" class="hari bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                            <option selected="">Plot Hari</option>
                                            <option value="1">Senin</option>
                                            <option value="2">Selasa</option>
                                            <option value="3">Rabu</option>
                                            <option value="4">Kamis</option>
                                            <option value="5">Jumat</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="ruang" class="block mb-2 text-sm font-medium text-gray-900">Ruang</label>
                                        <select id="ruang-{{ $jadwal->id }}" name="ruang" data-id="{{ $jadwal->id }}" class="ruang bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                            <option selected="">Ruang</option>
                                            @foreach ($dataruang as $ruang)
                                                <option value="{{ $ruang->noruang }}">{{ $ruang->noruang }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label for="jam" class="block mb-2 text-sm font-medium text-gray-900">Jam Mulai</label>
                                        <select id="jam-{{ $jadwal->id }}" name="jammulai" data-id="{{ $jadwal->id }}" class="jam bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                            <option selected="">Jam</option>
                                            <option value="0">07.00</option>
                                            <option value="1">07.50</option>
                                            <option value="2">08.40</option>
                                            <option value="3">09.40</option>
                                            <option value="4">10.30</option>
                                            <option value="6">12.10</option>
                                            <option value="7">13.00</option>
                                            <option value="9">14.40</option>
                                            <option value="10">15.40</option>
                                            <option value="11">16.30</option>
                                        </select>
                                    </div>
                                    <div data-sks="{{ $jadwal->sks }}" id="sks-{{ $jadwal->id }}">
                                        <label for="jamselesai" class="block mb-2 text-sm font-medium text-gray-900">Jam Selesai</label>
                                        <input type="text" name="jamselesai" id="jamselesai-{{ $jadwal->id }}" aria-label="disabled input" class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 cursor-not-allowed" value="00:00" disabled>
                                    </div>
                                </div>
                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 w-full">
                                    Buat Jadwal
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                
                {{-- endedilmodal --}} 
                @endforeach

  
            </div>
        </div>
        <script>
            // Event listener untuk tombol Setujui dan Tolak
            document.querySelectorAll('.setujui-btn, .tolak-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const row = this.closest('tr');  // Menemukan baris (tr) tempat tombol berada
        
                    // Menghapus tombol-tombol yang ada
                    row.querySelector('.setujui-btn').style.display = 'none';
                    row.querySelector('.tolak-btn').style.display = 'none';
                    row.querySelector('.detail-btn').style.display = 'none';
        
                    // Menambahkan status "Disetujui" atau "Ditolak"
                    const statusText = this.classList.contains('setujui-btn') ? 'Disetujui' : 'Ditolak';
                    const statusElement = document.createElement('span');
                    statusElement.textContent = statusText;
                    statusElement.classList.add('bg-green-100', 'text-green-800', 'px-3', 'py-1', 'rounded-full');
                    
                    // Menambahkan status ke dalam baris
                    row.querySelector('td:last-child').appendChild(statusElement);  // Menambahkan ke kolom terakhir (misalnya status)
                });
            });
        </script>
        


        <script>
            function toggleDropdown() {
              const dropdown = document.getElementById('dropdown-layouts');
              dropdown.classList.toggle('hidden');
            }
          </script>
        {{-- datatable  --}}
        <script>
            $(document).ready( function () {
                var tableMk = $('#Jadwal').DataTable({
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
                        {className: "dt-head-center", "targets": [0,1,2,3,4,5,6,7] },
                        {className: "dt-body-center", "targets": [0,1,2,3,4,5,6,7] },
                    ],
                    order: [[7, 'asc']]
                });

                setTimeout(() => {
                    tableMk.page.len(10).draw();
                }, 10);



                $('#searchMk').keyup(function() {
                    tableMk.search($(this).val()).draw();
                });



            } );
        </script>
        {{-- datatble_end --}}

        <script>
            const jamEnd = {
                1: '07:50',
                2: '08:40',
                3: '09:30',
                4: '10:30',
                5: '11:20',
                6: '12:10',
                7: '13:00',
                8: '13:50',
                9: '14:40',
                10: '15:30',
                11: '16:30',
                12: '17:20',
                13: '18:10',
            };
            

            $('.jam').on('change', function() {
                let id = $(this).data('id');
                let jamVal = parseInt($(this).val());
                let sks = parseInt($(`#sks-${id}`).data('sks'));
                let jamSelesai = jamEnd[jamVal + sks];
                $(`#jamselesai-${id}`).val(jamSelesai);
                console.log(jamVal+sks);
            });

function checkInputsFilled(id) {
    let hari = $(`#hari-${id}`).val();
    let ruang = $(`#ruang-${id}`).val();
    let jammulai = $(`#jam-${id}`).val();
    let sks = $(`#sks-${id}`).data('sks');
    let kodemk = $('#your-kodemk-element-id').val(); // Pastikan Anda mengakses kodemk yang benar

    if (hari && ruang && jammulai && hari !== 'Plot Hari' && ruang !== 'Ruang' && jammulai !== 'Jam') {
        checkJadwalExist(id, hari, ruang, jammulai, sks, kodemk);
    }
}

            function checkJadwalExist(id, hari, ruang, jammulai, sks) { 
                jamselesai = parseInt(jammulai) + parseInt(sks);
                $.ajax({
                    url: "/checkjadwal",  
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}", 
                        hari: hari,
                        jammulai: jammulai,
                        jamselesai: jamselesai,
                        ruang: ruang
                    },
                    success: function(response) {
                        data = response.data;
                        if (response.bool === true) {
                            //disable button
                            $(`#updateModal-${id} button[type='submit']`).attr('disabled', true);
                            $(`#alerta-${id}`).html(`<div class="flex items-center p-4 mb-4 text-xs text-red-800 border border-red-300 rounded-lg bg-white-50 bg-white dark:text-red-400 dark:border-red-800" role="alert">
  <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
  </svg>
  <span class="sr-only">Info</span>
  <div>
    <span class="font-medium">Jadwal Tabrakan !</span> Jadwal sudah terpakai oleh ${data[0].matakuliah} ${data[0].kelas}
  </div>
</div>`);
                            console.log(alerta);
                            // alert(`Jadwal sudah terpakai oleh ${data[0].matakuliah} ${data[0].kelas}`);
                        }else{
                            $(`#updateModal-${id} button[type='submit']`).attr('disabled', false);
                            $(`#alerta-${id}`).html(`<div class="flex items-center p-4 mb-4 text-xs text-green-800 border border-green-300 rounded-lg bg-green-50 bg-white dark:text-green-400 dark:border-green-800" role="alert">
  <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
  </svg>
  <span class="sr-only">Info</span>
  <div>
    <span class="font-medium"></span> Jadwal tidak tabrakan dengan jadwal manapun
  </div>
</div>`);

                        }
                    },
                    error: function() {
                        
                        console.log('error');
                        alert('Error checking jadwal');
                    }
                });
            }

            $('.hari, .ruang, .jam').on('change', function() {
                let id = $(this).data('id');
                checkInputsFilled(id);
            });

        </script>
@endsection
