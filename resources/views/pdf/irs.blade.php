<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>IRS Mahasiswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
            padding: 8px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>IRS Mahasiswa</h2>
    </div>
    <div>
        <p>Nama: {{ $dataForPdf['nama'] }}</p>
        <p>NIM: {{ $dataForPdf['nim'] }}</p>
        <p>Program Studi: {{ $dataForPdf['prodi'] }}</p>
        <p>Semester: {{ $dataForPdf['semester_berjalan'] }}</p>
    </div>
    <table>
        <thead>
            <tr>
                <th>Kode Mata Kuliah</th>
                <th>Nama Mata Kuliah</th>
                <th>SKS</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataForPdf['mataKuliah'] as $mk)
                <tr>
                    <td>{{ $mk->kodemk }}</td>
                    <td>{{ $mk->nama }}</td>
                    <td>{{ $mk->sks }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>