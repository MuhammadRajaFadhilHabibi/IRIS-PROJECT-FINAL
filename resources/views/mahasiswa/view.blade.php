@extends('header')

@section('title', 'View Recap')

@section('page')
<head>
    <!-- Link ke jsPDF dan plugin autoTable -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.22/jspdf.plugin.autotable.min.js"></script>
</head>
<body>
    <div class="container mx-auto px-8 py-4">
        <!-- Judul berada di atas -->
        <div class="text-center mb-4">
            <h1 class="text-2xl font-bold">Isian Rencana Studi (IRS) {{ $mahasiswa->nama }}</h1>
        </div>

        <!-- Profile Mahasiswa dan Informasi -->
        <div class="flex items-center bg-gray-100 p-5 rounded-lg shadow-md mb-4">
            <img src="{{ asset('alip.jpg') }}" alt="Profile Image" class="w-24 h-24 rounded-full object-cover mr-4 ml-4">
            <div class="p-6">
                <h2 class="font-bold text-lg">{{ $mahasiswa->nama }}</h2>
                <p class="text-gray-600">NIM: {{ $mahasiswa->nim }}</p>
                <p class="text-gray-600">Semester: {{ $mahasiswa->semester_berjalan }}</p>
                <p class="text-gray-600">Status: {{ $mahasiswa->status }}</p>
            </div>
        </div>

        <!-- IRS Table -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden mb-4">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="text-[#264A5D] text-center" style="background-color: #ECEFF6;">
                        <th class="py-3 px-4 border">No</th>
                        <th class="py-3 px-4 border">Kode MK</th>
                        <th class="py-3 px-4 border">Nama MK</th>
                        <th class="py-3 px-4 border">SKS</th>
                        <th class="py-3 px-4 border">Semester</th>
                        <th class="py-3 px-4 border">Kelas</th>
                        <th class="py-3 px-4 border">Ruang</th>
                        <th class="py-3 px-4 border">Tanggal Pengambilan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($matakuliah as $item)
                    <tr>
                        <td class="py-3 px-4 text-center border">{{ $loop->iteration }}</td>
                        <td class="py-3 px-4 border">{{ $item->kodemk }}</td>
                        <td class="py-3 px-4 border">{{ $item->nama_mk }}</td>
                        <td class="py-3 px-4 text-center border">{{ $item->sks }}</td>
                        <td class="py-3 px-4 text-center border">{{ $item->semester }}</td>
                        <td class="py-3 px-4 text-center border">{{ $item->kelas }}</td>
                        <td class="py-3 px-4 text-center border">{{ $item->ruang }}</td>
                        <td class="py-3 px-4 text-center border">{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr style="background-color: #ECEFF6;">
                        <td colspan="8" class="py-3 px-4 text-center font-semibold border">Total SKS: {{ $total_sks }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- <div class="flex justify-end mt-4"> -->
        <div class="flex justify-between mt-4">
            <!-- Tombol Back -->
            <a href="{{ route('perwalian') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 focus:outline-none">
                Back to Perwalian
            </a>
            <button id="exportPdf" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none">
                Download IRS PDF
            </button>
        </div>
    </div>


    <!-- Script jsPDF -->
    <script>
        document.getElementById('exportPdf').addEventListener('click', function () {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();

            // Header PDF
            doc.setFontSize(16);
            doc.text("IRS Mahasiswa", 105, 15, { align: "center" });

            // Informasi Mahasiswa
            doc.setFontSize(12);
            doc.text(`Nama: {{ $mahasiswa->nama }}`, 15, 30);
            doc.text(`NIM: {{ $mahasiswa->nim }}`, 15, 38);
            doc.text(`Program Studi: Informatika`, 15, 46);
            doc.text(`Semester: {{ $mahasiswa->semester_berjalan }}`, 15, 54);

            // Tabel dengan autoTable
            doc.autoTable({
                startY: 60,
                head: [['Kode Mata Kuliah', 'Nama Mata Kuliah', 'SKS']],
                body: [
                    @foreach ($matakuliah as $item)
                    [
                        "{{ $item->kodemk }}",
                        "{{ $item->nama_mk }}",
                        "{{ $item->prioritas }}"
                    ],
                    @endforeach
                ],
                theme: 'grid', // Tabel dengan border
                styles: {
                    font: 'helvetica', // Font Arial/Helvetica
                    fontSize: 10, // Ukuran font
                    cellPadding: 4, // Jarak padding di sel
                },
                headStyles: {
                    fillColor: [236, 239, 246], // Warna abu-abu header
                    textColor: [0, 0, 0], // Warna teks header (hitam)
                    halign: 'center', // Posisi teks header (tengah)
                },
                bodyStyles: {
                    textColor: [0, 0, 0], // Warna teks isi tabel
                    halign: 'left', // Posisi teks isi tabel
                },
                columnStyles: {
                    2: { halign: 'center' }, // Kolom SKS teksnya rata tengah
                },
            });

            // Simpan PDF
            doc.save('IRS_{{ $mahasiswa->nim }}.pdf');
        });

    </script>
</body>

@endsection
