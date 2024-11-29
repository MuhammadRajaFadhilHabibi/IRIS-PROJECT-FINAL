{{-- side-bar.blade.php --}}
@props(['active' => ''])

<aside id="sidebar" class="bg-gradient-to-b from-blue-500 to-blue-300 w-1/5 h-screen p-6 flex flex-col items-center fixed top-0 left-0">
    <!-- Logo -->
    <!-- Logo -->
    <div class="mb-8">
        <img src="{{ asset('iris.png') }}" alt="Logo" class="w-40">
    </div>

    <hr class="w-full border-t border-gray-300 my-4">

    <!-- Sidebar Menu -->
    <ul class="w-full space-y-4">
        <!-- Dashboard Link -->
        <li>
            <a href="{{ route('dashboard') }}" class="flex items-center w-full text-gray-700 bg-gray-100 rounded-lg p-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2z" />
                </svg>
                Dashboard
            </a>
        </li>

        <!-- Role-Based Links -->
        @if($user->ba == 1)
            <!-- BA Role: Pembuatan Ruang -->
            <li>
                <a href="{{ route('ruang') }}" class="flex items-center w-full text-gray-700 bg-white rounded-lg p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-10S17.523 2 12 2z" />
                    </svg>
                    Pembuatan Ruang
                </a>
            </li>
            <li>
                <a href="{{ route('plotruang') }}" class="flex items-center w-full text-gray-700 bg-white rounded-lg p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-10S17.523 2 12 2z" />
                    </svg>
                    Daftar Ruang
                </a>
            </li>
        @endif

        @if($user->kp == 1)
            <!-- KP Role: Kaprodi Links -->
            <li>
                <a href="{{ route('matakuliah') }}" class="flex items-center w-full text-gray-700 bg-gray-300 rounded-lg p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-10S17.523 2 12 2z" />
                    </svg>
                    Buat Mata Kuliah
                </a>
            </li>
            <li>
                <a href="{{ route('buatjadwal') }}" class="flex items-center w-full text-gray-700 bg-white rounded-lg p-3 hover:bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-10S17.523 2 12 2z" />
                    </svg>
                    Buat Jadwal
                </a>
            </li>
        @endif

        @if($user->dk == 1)
            <!-- DK Role: Dekan Links -->
            <li>
                <button onclick="location.href='{{ route('ajuanjadwal') }}'" class="flex items-center w-full text-gray-700 bg-white rounded-lg p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-10S17.523 2 12 2z" />
                    </svg>
                    Verifikasi Jadwal
                </button>
            </li>
            <li>
                <button onclick="location.href='{{ route('ajuanruang') }}'" class="flex items-center w-full text-gray-700 bg-white rounded-lg p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-10S17.523 2 12 2z" />
                    </svg>
                    Verifikasi Ruang Kelas
                </button>
            </li>
        @endif

        @if($user->mhs == 1)
        <!-- MHS Role: Mahasiswa Links -->
        <li>
            <a href="{{ route('registration') }}" class="flex items-center w-full text-gray-700 bg-gray-100 rounded-lg p-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-10S17.523 2 12 2z" />
                </svg>
                Registrasi
            </a>
        </li>
        <!-- Dropdown for Akademik -->
        <li>
            <button type="button" id="toggle-akademik" class="flex items-center w-full p-3 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-400 transition" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M11 4.717c-2.286-.58-4.16-.756-7.045-.71A1.99 1.99 0 0 0 2 6v11c0 1.133.934 2.022 2.044 2.007 2.759-.038 4.5.16 6.956.791V4.717Zm2 15.081c2.456-.631 4.198-.829 6.956-.791A2.013 2.013 0 0 0 22 16.999V6a1.99 1.99 0 0 0-1.955-1.993c-2.885-.046-4.76.13-7.045.71v15.081Z" clip-rule="evenodd"/>
                </svg>
                <span class="flex-1 text-left">Akademik</span>
                <svg class="w-5 h-5 ml-auto text-gray-500 transition duration-75 transform group-hover:rotate-180" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </button>
            
            <!-- Dropdown Menu Content -->
            <ul id="dropdown-akademik" class="hidden pl-6 py-2 space-y-1">
                <li>
                    <a href="/buat-irs" class="block px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-300 transition">
                        Buat IRS
                    </a>
                </li>
                <li>
                    <a href="/irs" class="block px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-300 transition">
                        IRS
                    </a>
                </li>
                <li>
                    <a href="/khs" class="block px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-300 transition">
                        KHS
                    </a>
                </li>
                <li>
                    <a href="/m/transkrip" class="block px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-300 transition">
                        Transkrip
                    </a>
                </li>
            </ul>
        </li>
        @endif
              <!-- Dekan Menu (DK role) -->
              @if($user->pa == 1)
              <ul>
                  <li class="mb-4">
                      <button onclick="location.href='{{ route('daftarmahasiswa') }}'" class="flex items-center w-full text-gray-700 bg-white rounded-lg p-3">
                          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="currentColor">
                              <path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-10S17.523 2 12 2z" />
                          </svg>
                          Daftar Mahasiswa
                      </button>
                  </li>
                  <li class="mb-4">
                      <button onclick="location.href='/ajuanIrs'" class="flex items-center w-full text-gray-700 bg-white rounded-lg p-3">
                          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="currentColor">
                              <path clip-rule="evenodd" fill-rule="evenodd" d="M8.34 1.804A1 1 0 019.32 1h1.36a1 1 0 01.98.804l.295 1.473c.497.144.971.342 1.416.587l1.25-.834a1 1 0 011.262.125l.962.962a1 1 0 01.125 1.262l-.834 1.25c.245.445.443.919.587 1.416l1.473.294a1 1 0 01.804.98v1.361a1 1 0 01-.804.98l-1.473.295a6.95 6.95 0 01-.587 1.416l.834 1.25a1 1 0 01-.125 1.262l-.962.962a1 1 0 01-1.262.125l-1.25-.834a6.953 6.953 0 01-1.416.587l-.294 1.473a1 1 0 01-.98.804H9.32a1 1 0 01-.98-.804l-.295-1.473a6.957 6.957 0 01-1.416-.587l-1.25.834a1 1 0 01-1.262-.125l-.962-.962a1 1 0 01-.125-1.262l.834-1.25a6.957 6.957 0 01-.587-1.416l-1.473-.294A1 1 0 011 10.68V9.32a1 1 0 01.804-.98l1.473-.295c.144-.497.342-.971.587-1.416l-.834-1.25a1 1 0 01.125-1.262l.962-.962A1 1 0 015.38 3.03l1.25.834a6.957 6.957 0 011.416-.587l.294-1.473zM13 10a3 3 0 11-6 0 3 3 0 016 0z"></path>
                          </svg>
                          Ajuan IRS
                      </button>
                  </li>
                  <li class="mb-4">
                      <button onclick="location.href='/p/perwalian'" class="flex items-center w-full text-gray-700 bg-white rounded-lg p-3">
                          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="currentColor">
                              <path clip-rule="evenodd" fill-rule="evenodd" d="M8.34 1.804A1 1 0 019.32 1h1.36a1 1 0 01.98.804l.295 1.473c.497.144.971.342 1.416.587l1.25-.834a1 1 0 011.262.125l.962.962a1 1 0 01.125 1.262l-.834 1.25c.245.445.443.919.587 1.416l1.473.294a1 1 0 01.804.98v1.361a1 1 0 01-.804.98l-1.473.295a6.95 6.95 0 01-.587 1.416l.834 1.25a1 1 0 01-.125 1.262l-.962.962a1 1 0 01-1.262.125l-1.25-.834a6.953 6.953 0 01-1.416.587l-.294 1.473a1 1 0 01-.98.804H9.32a1 1 0 01-.98-.804l-.295-1.473a6.957 6.957 0 01-1.416-.587l-1.25.834a1 1 0 01-1.262-.125l-.962-.962a1 1 0 01-.125-1.262l.834-1.25a6.957 6.957 0 01-.587-1.416l-1.473-.294A1 1 0 011 10.68V9.32a1 1 0 01.804-.98l1.473-.295c.144-.497.342-.971.587-1.416l-.834-1.25a1 1 0 01.125-1.262l.962-.962A1 1 0 015.38 3.03l1.25.834a6.957 6.957 0 011.416-.587l.294-1.473zM13 10a3 3 0 11-6 0 3 3 0 016 0z"></path>
                          </svg>
                          Perwalian
                      </button>
                  </li>
                  <li class="mb-4">
                      <button onclick="location.href='/ajuanPerubahanIrs'" class="flex items-center w-full text-gray-700 bg-white rounded-lg p-3">
                          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="currentColor">
                              <path clip-rule="evenodd" fill-rule="evenodd" d="M8.34 1.804A1 1 0 019.32 1h1.36a1 1 0 01.98.804l.295 1.473c.497.144.971.342 1.416.587l1.25-.834a1 1 0 011.262.125l.962.962a1 1 0 01.125 1.262l-.834 1.25c.245.445.443.919.587 1.416l1.473.294a1 1 0 01.804.98v1.361a1 1 0 01-.804.98l-1.473.295a6.95 6.95 0 01-.587 1.416l.834 1.25a1 1 0 01-.125 1.262l-.962.962a1 1 0 01-1.262.125l-1.25-.834a6.953 6.953 0 01-1.416.587l-.294 1.473a1 1 0 01-.98.804H9.32a1 1 0 01-.98-.804l-.295-1.473a6.957 6.957 0 01-1.416-.587l-1.25.834a1 1 0 01-1.262-.125l-.962-.962a1 1 0 01-.125-1.262l.834-1.25a6.957 6.957 0 01-.587-1.416l-1.473-.294A1 1 0 011 10.68V9.32a1 1 0 01.804-.98l1.473-.295c.144-.497.342-.971.587-1.416l-.834-1.25a1 1 0 01.125-1.262l.962-.962A1 1 0 015.38 3.03l1.25.834a6.957 6.957 0 011.416-.587l.294-1.473zM13 10a3 3 0 11-6 0 3 3 0 016 0z"></path>
                          </svg>
                          Ajuan Perubahan IRS
                      </button>
                  </li>
              </ul>
              @endif 
    </ul>
</aside>

<script>
    // Fungsi untuk toggle dropdown
    function toggleDropdown() {
        const dropdown = document.getElementById("dropdown-akademik");
        dropdown.classList.toggle("hidden");
    }

    // Menambahkan event listener setelah DOM selesai dimuat
    document.addEventListener("DOMContentLoaded", function() {
        const dropdownButton = document.getElementById("toggle-akademik");
        
        // Pastikan tombol dropdown ditemukan sebelum menambahkan event listener
        if (dropdownButton) {
            dropdownButton.addEventListener("click", toggleDropdown);
        }
    });
</script>
