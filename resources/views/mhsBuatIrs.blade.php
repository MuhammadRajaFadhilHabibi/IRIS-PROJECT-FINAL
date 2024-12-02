@extends('header')

@section('title','Buat IRS')

@section('page')

  <div class="flex pt-12 overflow-hidden bg-white">

      {{-- sidebar --}}
        <x-side-bar :active="request()->route()->getName()">
        </x-side-bar>
      {{-- end sidebar --}}

      <div id="main-content" class="relative w-full h-full font-poppins overflow-y-auto lg:ml-[22rem] bg-white">


        {{-- place this button to right full --}}
        <div class="fixed right-4 bottom-8 z-50">
            <button id="show-irs-button" 
                class="flex items-center gap-2 text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full px-6 py-3 shadow-lg hover:shadow-xl transition-all duration-300"
                type="button" 
                data-drawer-target="drawer-right-example" 
                data-drawer-body-scrolling="true" 
                data-drawer-show="drawer-right-example" 
                data-drawer-placement="right" 
                aria-controls="drawer-right-example">
                
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
                </svg>
                <span class="text-lg">Lihat IRS</span>
                <span id="skscount" class="inline-flex items-center justify-center w-6 h-6 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">
                    {{$total}}
                </span>
            </button>
        </div>
        
        <div class="flex justify-between items-center mx-14 my-8 bg-white">
            <h1 class="text-3xl font-semibold text-gray-900">Buat IRS</h1>
            <div class="flex items-center justify-right">
          </div>
        </div>

        <!-- drawer component -->
        <div id="drawer-right-example" class="fixed top-0 right-0 z-50 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white w-[60vh]" tabindex="-1" aria-labelledby="drawer-right-label">
           <h5 id="drawer-right-label" class="inline-flex items-center mb-4 text-base font-semibold text-gray-500">
           </h5>
           <h1 class="text-lg font-semibold text-black text-center">Daftar IRS</h1>
          <button type="button" data-drawer-hide="drawer-right-example" aria-controls="drawer-right-example" class="text-gray-400 bg-transparent hover:bg-white hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center" >
             <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
             </svg>
             <span class="sr-only">Close menu</span>
          </button>

          <div id="irs-data-container">
            {{-- Menampilkan IRS yang diambil --}}
          </div>

          <!-- Loading Spinner -->
          <div class="text-center mt-5">
            <div role="status" id="loading-spinner" style="display: none;">
                <svg aria-hidden="true" class="inline w-8 h-8 text-gray-200 animate-spin fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                </svg>
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        </div>

        <div> <!-- Add enough padding to account for the height of the fixed header -->
            <div class="relative mx-14 overflow-x-auto shadow-md sm:rounded-lg bg-white">
                @php
                    $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
                    $times = ['07:00', '08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00'];
                @endphp

<table class="w-full text-sm text-left border-collapse">
    <thead>
        <tr class="text-center text-white">
            <th class="p-4 w-[8%] bg-blue-900">Jam</th>
            @foreach($days as $dayIndex => $day)
                <th class="p-4 w-[18.4%]" style="background-color: {{ ['#0077b6', '#0096c7', '#00b4d8', '#48cae4', '#90e0ef'][$dayIndex] }};">
                    {{ $day }}
                </th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($times as $timeIndex => $time)
            <tr>
                <td class="px-4 py-3 text-center font-medium text-gray-700 bg-blue-50 w-[8%]">{{ $time }}</td>
                @foreach($days as $dayIndex => $day)
                    <td class="p-3 w-[18.4%]" style="background-color: {{ $dayIndex % 2 === 0 ? '#caf0f8' : '#ade8f4' }};">
                        @foreach($data as $matkul)
                            @foreach($matkul->kelas as $kelas)
                                @if($kelas->hari == $day && substr($kelas->jam, 0, 2) == substr($time, 0, 2))
                                    <div class="my-2 p-3 rounded-md bg-gradient-to-r from-blue-300 to-blue-200 border border-blue-400 text-blue-900 shadow hover:shadow-lg transition duration-300">
                                        <input 
                                            type="radio" 
                                            name="{{ $matkul->matakuliah }}"
                                            id="kelas-{{ $kelas->id }}"
                                            onclick="submitClass({{ $kelas->id }}, '{{ $email }}', '{{ $matkul->kodemk }}'); handleRadioClick(this)"
                                            data-hari="{{ $kelas->hari }}"
                                            data-jam="{{ $kelas->jam }}"  
                                            {{ $kelas->isselected ? 'checked' : '' }} 
                                            class="hidden peer" 
                                            required
                                        />
                                        <label for="kelas-{{ $kelas->id }}" class="inline-flex items-center justify-between w-full p-5 rounded-lg cursor-pointer peer-checked:bg-green-100 hover:bg-blue-400 transition">
                                            <div class="block">
                                                <div class="mb-2 text-sm font-bold">{{ $matkul->matakuliah }} - {{ $kelas->kelas }}</div>
                                                <div class="text-xs">
                                                    Semester {{ $matkul->semester }} / {{ $matkul->sks }} SKS<br>
                                                    Jam: {{ $kelas->jam }}<br>
                                                    Ruang: {{ $kelas->ruang }}
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        @endforeach
                    </td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>

            </div>
      </div>
  </div>


    <script>
      function submitClass(kodejadwal,email,kodemk) {
          $.ajax({
              url: "/buat-irstest",  // Laravel route
              type: "POST",
              data: {
                  _token: '{{ csrf_token() }}',          // CSRF token
                  email: email,           // Email address
                  kodejadwal: kodejadwal,
                  kodemk: kodemk
              },
              success: function(response) {
                  // Handle success
                  // alert('Success: ' + response.data);
                //   console.log(response.data+response.check);
                  console.log(response.data);
                  //change skscount value to response.sks
                document.getElementById('skscount').innerText = response.data.sks;

              },
              error: function(xhr, status, error) {
                  // Handle error
                  console.log('Error: ' + error);
              }
          });
      }
  </script>

<script>
  let isload = false;
  function fetchIrsData(email) {
    if (isload == false) {
        $("#loading-spinner").show();
    }

    $.ajax({
        url: "/viewirs",
        type: "POST",
        data: {
            _token: '{{ csrf_token() }}',
            email: email
        },
        success: function (response) {
            let irsContainer = $('#irs-data-container');
            irsContainer.empty();
            var tabel = `
                <div class="additional-info dark:text-black">
                    <table class="min-w-full mt-4 border-collapse bg-white shadow-md rounded-lg overflow-hidden">
                        <thead class="bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 text-white">
                            <tr>
                                <th class="px-6 py-3 text-left font-semibold">Mata Kuliah</th>
                                <th class="px-6 py-3 text-left font-semibold">Kelas</th>
                                <th class="px-6 py-3 text-left font-semibold">SKS</th>
                                <th class="px-6 py-3 text-left font-semibold">Antrian</th>
                                <th class="px-6 py-3 text-left font-semibold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>`;

            response.forEach(row => {
                tabel += `
                    <tr class="border-b hover:bg-blue-50 transition">
                        <td class="px-6 py-4 text-gray-700 font-medium">${row.nama}</td>
                        <td class="px-6 py-4 text-gray-600">${row.kelas.kelas}</td>
                        <td class="px-6 py-4 text-gray-600">${row.sks}</td>
                        <td class="px-6 py-4 text-gray-600">${row.position}/${row.kapasitas}</td>
                        <td class="px-6 py-4 text-center">
                            <button type="button" onclick="deleteIrs(${row.id})" class="text-red-500 hover:text-red-700 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </td>
                    </tr>`;
            });

            tabel += `
                        </tbody>
                    </table>
                </div>`;

            isload = true;
            irsContainer.append(tabel);
        },
        error: function (xhr, status, error) {
            console.log('Error: ' + error);
        },
        complete: function () {
            $("#loading-spinner").hide();
        }
    });
}


  $(document).ready(function() {
      // Attach click event to the button
      $('#show-irs-button').click(function() {
          fetchIrsData('{{ $email }}'); // Call the function with the email
      });
  });

</script>

<script>
  function deleteIrs(id) {
    console.log('Deleting IRS with ID: ' + id);
    $.ajax({
        url: "/deleteirs",  // Your Laravel route to delete IRS data
        type: "POST",
        data: {
            _token : '{{ csrf_token() }}', // CSRF token
            id: id // IRS ID
        },
        success: function(response) {
            console.log(response);
            // Uncheck the radio button for the deleted schedule
            let radioId = `#kelas-${response.kodejadwal}`;
            $(radioId).prop('checked', false);

            // Remove conflicts related to the deleted schedule
            removeConflict(document.querySelector(radioId));

            // Update the SKS count
            document.getElementById('skscount').innerText = response.sks;

            // Fetch updated IRS data (if necessary)
            fetchIrsData('{{ $email }}');
        },
        error: function(xhr, status, error) {
            console.log('Error: ' + error);
        }
    });
    }

</script>

<script>

    let conflictArray = []; // Global array to track conflicting schedules

    // Function to extract start and end times from "jam" string (e.g., "07.00 - 09.30")
    function extractTimeRange(jamString) {
        let [startTime, endTime] = jamString.split(' - ');
        console.log(`Extracted time range: Start - ${startTime}, End - ${endTime}`);
        return { startTime, endTime };
    }

    // Function to check for conflicts and update the conflict array
    function checkConflict(selectedRadio) {
        let selectedHari = selectedRadio.getAttribute('data-hari');
        let selectedJam = selectedRadio.getAttribute('data-jam');
        let { startTime: selectedStartTime, endTime: selectedEndTime } = extractTimeRange(selectedJam);

        console.log(`Selected Schedule: ${selectedHari} from ${selectedStartTime} to ${selectedEndTime}`);

        document.querySelectorAll('input[type="radio"]').forEach(radio => {
            let hari = radio.getAttribute('data-hari');
            let jam = radio.getAttribute('data-jam');
            let { startTime, endTime } = extractTimeRange(jam);

            let row = document.querySelector(`label[for="${radio.id}"]`);

            // Reset the specific radio if it's not already in the conflict array
            if (!conflictArray.includes(radio.getAttribute('id'))) {
                radio.disabled = false;
                toggleRowHighlight(row, false);
            }

            // If it's the same day and there's a time conflict
            if (hari === selectedHari && selectedRadio !== radio) {
                console.log(`Same day as selected (${hari}). Checking time conflict...`);

                if (
                    (startTime < selectedEndTime && startTime >= selectedStartTime) ||
                    (selectedStartTime < endTime && selectedStartTime >= startTime)
                ) {
                    console.log(`Conflict found! Disabling radio and adding 'bg-[#E71B1B]' for time: ${startTime} - ${endTime}`);

                    // Disable the conflicting schedule and highlight the row
                    radio.disabled = true;
                    toggleRowClass(row,false);
                    toggleRowHighlight(row, true);

                    // Add the conflicting radio id to the conflict array
                    if (!conflictArray.includes(radio.getAttribute('id'))) {
                        conflictArray.push(radio.getAttribute('id'));
                    }
                }
            }
        });

        console.log('Conflicting radio buttons:', conflictArray);
    }

    // Function to remove conflicts when a schedule is deselected
    function removeConflict(selectedRadio) {
        let selectedHari = selectedRadio.getAttribute('data-hari');
        let selectedJam = selectedRadio.getAttribute('data-jam');
        let { startTime: selectedStartTime, endTime: selectedEndTime } = extractTimeRange(selectedJam);

        console.log(`Removing conflicts for: ${selectedHari} from ${selectedStartTime} to ${selectedEndTime}`);

        // Iterate through conflictArray to remove conflicts associated with the deselected schedule
        conflictArray = conflictArray.filter(radioId => {
            let radio = document.getElementById(radioId);
            let hari = radio.getAttribute('data-hari');
            let jam = radio.getAttribute('data-jam');
            let { startTime, endTime } = extractTimeRange(jam);

            let kode = selectedRadio.name;
            let radios = document.querySelectorAll(`input[type="radio"][name="${kode}"]`);
            radios.forEach(radio => {
                        let row = document.querySelector(`label[for="${radio.id}"]`);
                        if(radio.checked){
                            toggleRowClass(row, true);
                        }else{
                            toggleRowClass(row, false);
                        }
            });
            // Re-enable the radio and remove the bg-red-800 class if it no longer conflicts
            if (hari === selectedHari && (
                (startTime < selectedEndTime && startTime >= selectedStartTime) ||
                (selectedStartTime < endTime && selectedStartTime >= startTime)
            )) {
                console.log(`Enabling ${radioId}, no longer in conflict`);
                radio.disabled = false;
                let row = document.querySelector(`label[for="${radio.id}"]`);
                toggleRowHighlight(row, false);
                return false; // Remove this radioId from the conflict array
            }


            //restore style for same course

            


            return true; // Keep this radioId in the conflict array
        });

        console.log('Updated conflict array after removal:', conflictArray);
    }

    function handleRadioClick(radio) {

            conflictArray.forEach(radioId => {
                let radio = document.getElementById(radioId);
                let row = document.querySelector(`label[for="${radio.id}"]`);
                radio.disabled = false;
                toggleRowHighlight(row, false);
            });

            let selectedRadios = document.querySelectorAll('input[type="radio"]:checked');
            console.log('Selected radio buttons found:', selectedRadios);

            selectedRadios.forEach(selectedRadio => {
                
                checkConflict(selectedRadio);
                // nonSelectedClass(selectedRadio);
            });

            //change style for same course
            nonSelectedClass(radio);

    }

    // Automatically check for conflicts after page reload
    document.addEventListener('DOMContentLoaded', function() {
        // Find all selected radio buttons (if any) and check for conflicts
        let selectedRadios = document.querySelectorAll('input[type="radio"]:checked');
        console.log('Selected radio buttons found:', selectedRadios);

        // Iterate over the selected radio buttons and check conflicts for each one
        selectedRadios.forEach(selectedRadio => {

            checkConflict(selectedRadio); 
            //change style for course class that not selected, for ex : Selected Strukdat A, Strukdat B will change style
            nonSelectedClass(selectedRadio);

            // Check for conflicts

        });
    });

    function nonSelectedClass(radio){

        //change style for same course
        let kode = radio.name;
        let radios = document.querySelectorAll(`input[type="radio"][name="${kode}"]`);
        radios.forEach(radio => {
                    let row = document.querySelector(`label[for="${radio.id}"]`);
                    if(radio.checked){
                        toggleRowClass(row, false);
                    }else{
                        if(radio.disabled){
                            console.log('disabled'); 
                        }else{
                            toggleRowClass(row, true);
                        }
                    }
        });
    }


    function toggleRowHighlight(row, isHighlighted) {
    if (isHighlighted) {
        // Menambahkan class highlight cerah
        row.classList.remove('border-gray-200', 'bg-gray-50', 'text-gray-900', 'hover:bg-gray-100');
        row.classList.add('text-red-800', 'border-l-4', 'border-red-300', 'bg-red-50', 'hover:bg-red-100');
    } else {
        // Mengembalikan class ke warna default cerah
        row.classList.add('border-gray-200', 'bg-gray-50', 'text-gray-900', 'hover:bg-gray-100');
        row.classList.remove('text-red-800', 'border-l-4', 'border-red-300', 'bg-red-50', 'hover:bg-red-100');
    }
}

    function toggleRowClass(row, isHighlighted) {
    if (isHighlighted) {
        // Menambahkan class highlight cerah
        row.classList.remove('border-gray-200', 'bg-gray-50', 'text-gray-900', 'hover:bg-gray-100');
        row.classList.add('bg-red-100', 'text-red-700', 'border-red-500', 'border-l-4'); // Gaya cerah saat highlight
    } else {
        // Mengembalikan class ke warna default cerah
        row.classList.add('border-gray-200', 'bg-gray-50', 'text-gray-900', 'hover:bg-gray-100');
        row.classList.remove('bg-red-100', 'text-red-700', 'border-red-500', 'border-l-4');
    }
}

</script>
@endsection
