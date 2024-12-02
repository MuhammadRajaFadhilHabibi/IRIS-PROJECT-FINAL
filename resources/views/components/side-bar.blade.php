{{-- side-bar.blade.php --}}
@props(['active' => ''])

<aside id="sidebar" class="bg-gradient-to-b from-blue-500 to-blue-300 w-1/5 h-screen p-6 flex flex-col items-center fixed top-0 left-0">
    <!-- Logo -->
    <div class="mb-8 transition-transform duration-300 hover:scale-105">
        <img src="{{ asset('iris.png') }}" alt="Logo" class="w-40">
    </div>

    <hr class="w-full border-t border-gray-300 my-4">

    <!-- Sidebar Menu -->
    <ul class="w-full space-y-4">
        <!-- Dashboard Link -->
        <li class="group">
            <a href="{{ route('dashboard') }}" class="flex items-center w-full text-gray-700 bg-white rounded-lg p-3 transition-all duration-300 hover:bg-gray-100 hover:transform hover:translate-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-gray-600 transition-transform duration-300 group-hover:rotate-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span class="font-medium">Dashboard</span>
            </a>
        </li>

        <!-- BA Role Links -->
        @if($user->ba == 1)
        <li class="group">
            <a href="{{ route('ruang') }}" class="flex items-center w-full text-gray-700 bg-white rounded-lg p-3 transition-all duration-300 hover:bg-gray-100 hover:transform hover:translate-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-gray-600 transition-transform duration-300 group-hover:rotate-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                <span class="font-medium">Pembuatan Ruang</span>
            </a>
        </li>
        @endif

        <!-- KP Role Links -->
        @if($user->kp == 1)
        <li class="group">
            <a href="{{ route('matakuliah') }}" class="flex items-center w-full text-gray-700 bg-white rounded-lg p-3 transition-all duration-300 hover:bg-gray-100 hover:transform hover:translate-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-gray-600 transition-transform duration-300 group-hover:rotate-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                <span class="font-medium">Buat Mata Kuliah</span>
            </a>
        </li>
        <li class="group">
            <a href="{{ route('buatjadwal') }}" class="flex items-center w-full text-gray-700 bg-white rounded-lg p-3 transition-all duration-300 hover:bg-gray-100 hover:transform hover:translate-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-gray-600 transition-transform duration-300 group-hover:rotate-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span class="font-medium">Buat Jadwal</span>
            </a>
        </li>
        @endif

        <!-- DK Role Links -->
        @if($user->dk == 1)
        <li class="group">
            <button onclick="location.href='{{ route('ajuanjadwal') }}'" class="flex items-center w-full text-gray-700 bg-white rounded-lg p-3 transition-all duration-300 hover:bg-gray-100 hover:transform hover:translate-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-gray-600 transition-transform duration-300 group-hover:rotate-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="font-medium">Verifikasi Jadwal</span>
            </button>
        </li>
        <li class="group">
            <button onclick="location.href='{{ route('ajuanruang') }}'" class="flex items-center w-full text-gray-700 bg-white rounded-lg p-3 transition-all duration-300 hover:bg-gray-100 hover:transform hover:translate-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-gray-600 transition-transform duration-300 group-hover:rotate-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
                <span class="font-medium">Verifikasi Ruang Kelas</span>
            </button>
        </li>
        @endif

        <!-- MHS Role Links -->

        <!-- Akademik Dropdown -->
        @if($user->mhs == 1)
        <li class="group">
            <a href="{{ route('registration') }}" class="flex items-center w-full text-gray-700 bg-white rounded-lg p-3 transition-all duration-300 hover:bg-gray-100 hover:transform hover:translate-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-gray-600 transition-transform duration-300 group-hover:rotate-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
                <span class="font-medium">Registrasi</span>
            </a>
        </li>
    
        <!-- Akademik Link Tanpa Dropdown -->
        <li>
            <a href="{{ route('mhsAkademik') }}" class="flex items-center w-full text-gray-700 bg-white rounded-lg p-3 transition-all duration-300 hover:bg-gray-100 hover:transform hover:translate-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-gray-600 transition-transform duration-300 group-hover:rotate-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
                <span class="font-medium">Akademik</span>
            </a>
        </li>
    @endif
    
        <!-- PA Role Links -->
        @if($user->pa == 1)
        <li class="group">
            <a href="{{ route('daftarmahasiswa') }}" class="flex items-center w-full text-gray-700 bg-white rounded-lg p-3 transition-all duration-300 hover:bg-gray-100 hover:transform hover:translate-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-gray-600 transition-transform duration-300 group-hover:rotate-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <span class="font-medium">Daftar Mahasiswa</span>
            </a>
        </li>
        <li class="group">
            <a href="{{ route('ajuanIrs') }}" class="flex items-center w-full text-gray-700 bg-white rounded-lg p-3 transition-all duration-300 hover:bg-gray-100 hover:transform hover:translate-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-gray-600 transition-transform duration-300 group-hover:rotate-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span class="font-medium">Ajuan IRS</span>
            </a>
        </li>
        <li class="group">
            <a href="{{ route('perwalian') }}" class="flex items-center w-full text-gray-700 bg-white rounded-lg p-3 transition-all duration-300 hover:bg-gray-100 hover:transform hover:translate-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-gray-600 transition-transform duration-300 group-hover:rotate-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                </svg>
                <span class="font-medium">Perwalian</span>
            </a>
        </li>
        <!-- Mengubah button menjadi tag a -->
        <li class="group">
            <a href="/ajuanPerubahanIrs" class="flex items-center w-full text-gray-700 bg-white rounded-lg p-3 transition-all duration-300 hover:bg-gray-100 hover:transform hover:translate-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-gray-600 transition-transform duration-300 group-hover:rotate-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                <span class="font-medium">Ajuan Perubahan IRS</span>
            </a>
        </li>
    @endif      
    </ul>
</aside>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const dropdownButton = document.getElementById("toggle-akademik");
    const dropdownContent = document.getElementById("dropdown-akademik");
    
    if (dropdownButton && dropdownContent) {
        dropdownButton.addEventListener("click", function() {
            const isExpanded = dropdownButton.getAttribute("aria-expanded") === "true";
            
            // Toggle aria-expanded
            dropdownButton.setAttribute("aria-expanded", !isExpanded);
            
            // Toggle dropdown visibility with smooth animation
            if (isExpanded) {
                // Collapse animation
                dropdownContent.style.maxHeight = dropdownContent.scrollHeight + "px";
                setTimeout(() => {
                    dropdownContent.style.maxHeight = "0px";
                    setTimeout(() => {
                        dropdownContent.classList.add("hidden");
                        dropdownContent.style.maxHeight = "";
                    }, 300);
                }, 10);
            } else {
                // Expand animation
                dropdownContent.classList.remove("hidden");
                dropdownContent.style.maxHeight = "0px";
                setTimeout(() => {
                    dropdownContent.style.maxHeight = dropdownContent.scrollHeight + "px";
                    setTimeout(() => {
                        dropdownContent.style.maxHeight = "";
                    }, 300);
                }, 10);
            }
        });
    }
});
</script>

<style>
/* Smooth transition for dropdown */
#dropdown-akademik {
    max-height: none;
    transition: max-height 0.3s ease-in-out;
}
#dropdown-akademik.hidden {
    display: none;
}
</style>