@extends('header')

@section('title','Maintenance')

@section('page')


  <div class="flex overflow-hidden">

    {{-- sidebar --}}
    <x-side-bar :active="request()->route()->getName()"></x-side-bar>
    {{-- end sidebar --}}

    <div id="main-content" class="relative w-4/5 min-h-screen font-poppins overflow-y-auto ml-[20%] bg-gradient-to-br from-indigo-600 to-purple-800">

      <div class="flex flex-col justify-center items-center px-6 mx-auto h-screen xl:px-0">
        <div class="md:max-w-md">
          <img src="{{ asset('Tutup.png') }}" alt="maintenance illustration" class="w-full h-auto object-cover rounded-lg shadow-xl">
        </div>

        <div class="text-center xl:max-w-4xl mt-8">
          <h1 class="text-xl font-bold leading-tight text-white sm:text-4xl lg:text-3xl mb-4">Periode Pengisian IRS Sudah Ditutup!</h1>
          <p class="mb-5 text-base font-normal text-white/80 md:text-lg">
            Silahkan Mengajukan Perubahan IRS kepada Dosen Wali dengan memencet tombol dibawah ini.
          </p>
          
          <button id="ajuan-button"
            type="button" 
            {{ $aksesirs == 'no' ? '' : 'disabled' }} 
            onclick="Ajuan('{{ $email }}')" 
            class="mt-10 {{ $aksesirs == 'no' ? 'bg-gradient-to-r from-teal-400 to-teal-600 hover:bg-teal-700 focus:ring-4 focus:ring-teal-300 dark:bg-teal-600 dark:hover:bg-teal-700 dark:focus:ring-teal-800' : 'bg-gray-600 cursor-not-allowed' }} text-white font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-3">
            {{ $aksesirs == 'no' ? 'Ajukan Perubahan IRS' : 'Menunggu Pengajuan IRS' }}
          </button>
        </div>
      </div>
    </div>
  </div>


    <script>
        document.addEventListener("DOMContentLoaded", function () {
            function Ajuan(email) {
                console.log(email);
                
                $.ajax({
                    url: "/ajuanperubahan",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        email: email
                    },
                    success: function(data) {
                        console.log(data);

                        //change button to disabled
                        $('#ajuan-button').attr('disabled', true);
                        $('#ajuan-button').text('Menunggu Pengajuan IRS');
                        
                        //change color button to gray
                        $('#ajuan-button').removeClass('bg-primary-700');
                        $('#ajuan-button').removeClass('hover:bg-primary-800');
                        $('#ajuan-button').removeClass('dark:bg-primary-600');
                        $('#ajuan-button').removeClass('dark:hover:bg-primary-700');
                        $('#ajuan-button').addClass('bg-gray-600');
                        $('#ajuan-button').addClass('dark:bg-gray-600');
                        
                    }
                });
            }
    
            window.Ajuan = Ajuan; // Make Ajuan available globally if needed
        });
    </script>
    

@endsection
