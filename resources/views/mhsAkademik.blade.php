@extends('header')

@section('title', 'Akademik')

@section('page')
<div class="min-h-screen flex">
    <!-- Sidebar -->
    <x-side-bar :active="request()->route()->getName()"></x-side-bar>

    <!-- Main Content -->
    <div class="flex-1 ml-[350px]">
        <!-- Tabs -->
        <div class="mt-7 flex space-x-4 mb-4 justify-around">
            <button id="tab-irs" class="tab-btn w-[25%] bg-white hover:bg-blue-500 hover:text-white text-gray-700 px-4 py-2 rounded">IRS</button>
            <button id="tab-khs" class="tab-btn w-[25%] bg-white hover:bg-blue-500 hover:text-white text-gray-700 px-4 py-2 rounded">KHS</button>
            <button id="tab-transkrip" class="tab-btn w-[25%] bg-white hover:bg-blue-500 hover:text-white text-gray-700 px-4 py-2 rounded">Transkrip</button>
        </div>

        <div class="border border-gray-300 w-[98%] mb-4"></div>

        <!-- Content Sections -->
        <!-- IRS Section (Original, Unchanged) -->
        <div id="content-irs" class="content-tab bg-white shadow rounded-lg p-6 mr-5">
            <h1 class="text-xl font-bold mb-4">Isian Rencana Semester (IRS)</h1>
            <div class="grid gap-6">
                @foreach ($data['irsData'] as $item)
                <div class="container-irs bg-white border border-gray-300 rounded-xl shadow-lg p-6 hover:shadow-2xl transition-shadow">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800">Semester {{ $item->semester }}</h3>
                            <p class="text-sm text-gray-600">2021/2022 | <span class="font-medium text-blue-500">{{ $item->total_sks }} SKS</span></p>
                        </div>
                        <!-- Arrow Icon -->
                        <svg class="arrow-icon w-6 h-6 cursor-pointer text-gray-600 transition-transform duration-300 ease-in-out" data-semester="{{ $item->semester }}" data-email="{{ $data['email'] }}" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                    <!-- Tabel akan muncul di sini saat arrow diklik -->
                </div>
                @endforeach
            </div>

            <!-- Tombol Buat IRS -->
<!-- Tombol Buat IRS dan Download -->
<div class="mt-6 flex space-x-4">
    <!-- Tombol Buat Rencana Studi -->
    <a href="{{ route('mhsBuatIrs') }}">
        <button class="bg-red-500 text-white px-4 py-2 rounded">Buat Rencana Studi</button>
    </a>

    <!-- Tombol Download IRS -->
    <a 
        href="{{ route('download.irs') }}" 
        class="download-irs-btn bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors flex items-center"
    >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
        </svg>
        Download IRS
    </a>
</div>

            

            
        </div>

        <!-- KHS Section (Modern Design) -->
        <div id="content-khs" class="content-tab bg-white shadow rounded-lg p-6 mr-5 hidden">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Kartu Hasil Studi (KHS)</h1>
                <div class="flex items-center space-x-4">
                    <select id="khs-semester-select" class="bg-white border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option>Semester 1</option>
                        <option>Semester 2</option>
                        <option>Semester 3</option>
                        <option>Semester 4</option>
                    </select>
                    <button class="download-khs-btn bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        Download KHS
                    </button>
                </div>
            </div>

            <!-- KHS Stats Cards -->
            <div class="grid grid-cols-4 gap-4 mb-6">
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-4 rounded-xl text-white">
                    <h3 class="text-sm font-medium opacity-80">IP Semester</h3>
                    <p class="text-2xl font-bold" id="ip-semester">3.89</p>
                </div>
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 p-4 rounded-xl text-white">
                    <h3 class="text-sm font-medium opacity-80">Total SKS</h3>
                    <p class="text-2xl font-bold" id="total-sks">21</p>
                </div>
                <div class="bg-gradient-to-br from-pink-500 to-pink-600 p-4 rounded-xl text-white">
                    <h3 class="text-sm font-medium opacity-80">SKS Kumulatif</h3>
                    <p class="text-2xl font-bold" id="sks-kumulatif">84</p>
                </div>
                <div class="bg-gradient-to-br from-green-500 to-green-600 p-4 rounded-xl text-white">
                    <h3 class="text-sm font-medium opacity-80">IPK</h3>
                    <p class="text-2xl font-bold" id="ipk">3.92</p>
                </div>
            </div>

            <!-- KHS Table -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode MK</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Kuliah</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SKS</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bobot</th>
                        </tr>
                    </thead>
                    <tbody id="khs-table-body" class="bg-white divide-y divide-gray-200">
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">IF2110</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Algoritma & Struktur Data</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">4</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">A</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">4.00</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">IF2130</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Matematika Diskrit</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">3</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">A</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">4.00</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Transkrip Section (Modern Design) -->
        <div id="content-transkrip" class="content-tab bg-white shadow rounded-lg p-6 mr-5 hidden">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Transkrip Akademik</h1>
                    <p class="text-gray-600 mt-1">Program Studi Informatika</p>
                </div>
                <button class="download-transkrip-btn bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition-colors flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    Download Transkrip
                </button>
            </div>

            <!-- Transkrip Summary Card -->
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl p-6 mb-6 text-white">
                <div class="grid grid-cols-4 gap-8">
                    <div>
                        <h3 class="text-sm font-medium opacity-80">Total SKS</h3>
                        <p class="text-3xl font-bold mt-1">144</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium opacity-80">IPK</h3>
                        <p class="text-3xl font-bold mt-1">3.92</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium opacity-80">Total Mata Kuliah</h3>
                        <p class="text-3xl font-bold mt-1">48</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium opacity-80">Semester</h3>
                        <p class="text-3xl font-bold mt-1">8</p>
                    </div>
                </div>
            </div>

            <!-- Transkrip Table -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="p-4 bg-gray-50 border-b border-gray-200">
                    <h3 class="font-semibold text-gray-800">Daftar Mata Kuliah</h3>
                </div>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Semester</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode MK</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Kuliah</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SKS</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">IF2110</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Algoritma & Struktur Data</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">4</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">A</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">IF2130</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Matematika Diskrit</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">3</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">A</td>
                        </tr>
                    </tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

<script>
$(document).ready(function() {
// Tab switching functionality
$('.tab-btn').click(function() {
    $('.tab-btn').removeClass('bg-blue-500 text-white').addClass('bg-white text-gray-700');
    $('.content-tab').addClass('hidden');
    
    $(this).removeClass('bg-white text-gray-700').addClass('bg-blue-500 text-white');
    
    const contentId = 'content-' + $(this).attr('id').split('-')[1];
    $('#' + contentId).removeClass('hidden');
});

// IRS arrow icon functionality (Original)
$('.arrow-icon').on('click', function() {
    const icon = $(this);
    const semester = icon.data('semester');
    const email = icon.data('email');
    const container = icon.closest('.container-irs');
    const tableExists = container.find('.additional-info').length > 0;

    if (!tableExists) {
        icon.css('transform', 'rotate(135deg)');
        
        $.ajax({
            url: `/irs/${semester}/${email}`,
            method: 'GET',
            success: function(response) {
                if (response.data && response.data.length > 0) {
                    let table = `
                        <div class="additional-info dark:text-white">
                            <table class="min-w-full text-sm mt-4 bg-white dark:bg-blek-500 dark:text-white">
                                <thead class="bg-blek-800 rounded-full">
                                    <tr>
                                        <th class="py-2 w-[10%] text-black">Kode</th>
                                        <th class="py-2 w-[20%] text-black">Mata Kuliah</th>
                                        <th class="py-2 w-[15%] text-black">Ruang</th>
                                        <th class="py-2 w-[15%] text-black">SKS</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-blek-700 text-black">`;

                    response.data.forEach(row => {
                        table += `
                            <tr class="text-center">
                                <td class="px-4 py-2">${row.kodemk}</td>
                                <td class="px-4 py-2">${row.mata_kuliah}</td>
                                <td class="px-4 py-2">${row.ruang}</td>
                                <td class="px-4 py-2">${row.sks}</td>
                            </tr>`;
                    });

                    table += `</tbody></table></div>`;
                    container.append(table);
                } else {
                    console.log('Data IRS tidak ditemukan.');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching data:', error);
            }
        });
    } else {
        icon.css('transform', 'rotate(90deg)');
        container.find('.additional-info').remove();
    }
});

// KHS and Transkrip functionality
// KHS Semester Selection
$('#khs-semester-select').change(function() {
    const semester = $(this).val();
    loadKHSData(semester);
});

// KHS Download Button
$('.download-khs-btn').click(function() {
    const semester = $('#khs-semester-select').val();
    downloadKHS(semester);
});

// Transkrip Download Button
$('.download-transkrip-btn').click(function() {
    downloadTranskrip();
});

// Function to load KHS data
function loadKHSData(semester) {
    $('#khs-content').addClass('opacity-50');
    
    $.ajax({
        url: `/khs/${semester}`,
        method: 'GET',
        success: function(response) {
            updateKHSContent(response);
            $('#khs-content').removeClass('opacity-50');
        },
        error: function(error) {
            console.error('Error loading KHS data:', error);
            $('#khs-content').removeClass('opacity-50');
        }
    });
}

// Function to download KHS
function downloadKHS(semester) {
    const button = $('.download-khs-btn');
    button.prop('disabled', true);
    button.html('<svg class="animate-spin h-5 w-5 mr-2" viewBox="0 0 24 24">...</svg> Downloading...');

    $.ajax({
        url: `/khs/download/${semester}`,
        method: 'GET',
        xhrFields: {
            responseType: 'blob'
        },
        success: function(blob) {
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `KHS_Semester_${semester}.pdf`;
            document.body.appendChild(a);
            a.click();
            window.URL.revokeObjectURL(url);
            
            button.prop('disabled', false);
            button.html('<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg> Download KHS');
        },
        error: function(error) {
            console.error('Error downloading KHS:', error);
            button.prop('disabled', false);
            button.html('<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg> Download KHS');
        }
    });
}

// Function to download Transkrip
function downloadTranskrip() {
    const button = $('.download-transkrip-btn');
    button.prop('disabled', true);
    button.html('<svg class="animate-spin h-5 w-5 mr-2" viewBox="0 0 24 24">...</svg> Downloading...');

    $.ajax({
        url: '/transkrip/download',
        method: 'GET',
        xhrFields: {
            responseType: 'blob'
        },
        success: function(blob) {
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'Transkrip_Akademik.pdf';
            document.body.appendChild(a);
            a.click();
            window.URL.revokeObjectURL(url);
            
            button.prop('disabled', false);
            button.html('<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg> Download Transkrip');
        },
        error: function(error) {
            console.error('Error downloading transkrip:', error);
            button.prop('disabled', false);
            button.html('<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg> Download Transkrip');
        }
    });
}

// Function to update KHS content
function updateKHSContent(data) {
    $('#ip-semester').text(data.ip_semester);
    $('#total-sks').text(data.total_sks);
    $('#sks-kumulatif').text(data.sks_kumulatif);
    $('#ipk').text(data.ipk);

    let tableContent = '';
    data.courses.forEach(course => {
        tableContent += `
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${course.kode_mk}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${course.mata_kuliah}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${course.sks}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${course.nilai}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${course.bobot}</td>
            </tr>`;
    });
    $('#khs-table-body').html(tableContent);
}

// Initialize first tab as active
$('#tab-irs').trigger('click');
});

// IRS Download Button
$('.download-irs-btn').click(function() {
    const button = $(this);
    button.prop('disabled', true);
    button.html('<svg class="animate-spin h-5 w-5 mr-2" viewBox="0 0 24 24">...</svg> Downloading...');

    $.ajax({
        url: '/irs/download', // Sesuaikan dengan route Anda
        method: 'GET',
        xhrFields: {
            responseType: 'blob'
        },
        success: function(blob) {
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'IRS_Akademik.pdf';
            document.body.appendChild(a);
            a.click();
            window.URL.revokeObjectURL(url);
            
            button.prop('disabled', false);
            button.html('<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg> Download IRS');
        },
        error: function(error) {
            console.error('Error downloading IRS:', error);
            button.prop('disabled', false);
            button.html('<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg> Download IRS');
        }
    });
});
</script>

@endsection