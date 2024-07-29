<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jurnal Siswa</title>
    <style>
        /* CSS untuk mengatur style font */
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            /* Ukuran font */
        }

        .judul {
            font-weight: bold;
            /* Style font bold untuk judul */
            font-size: 16px;
            /* Ukuran font judul */
            text-align: center;
        }

        .subjudul {
            font-weight: bold;
            /* Style font bold untuk subjudul */
            font-size: 14px;
            /* Ukuran font subjudul */
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;

        }
    </style>
</head>

<body>
    <p class="judul">Data Jurnal Siswa</p>
    <h4 class="subjudul">SMK NEGERI 2 SUKABUMI</h4>
    <p class="subjudul">Nama Siswa {{ $siswa->nama }} </p>
    <p class="subjudul">Kelas {{ $siswa->kelas }} </p>
    <p class="subjudul">Instansi {{ $menempati->instansi->instansi }}</p>
    <p class="subjudul">Pembimbing {{ $membimbing->pembimbing->nama }}</p>
    <p class="subjudul">Guru Mapel PKL {{ $membimbing->guru_mapel_pkl->nama }}</p>
    <p class="subjudul">Tanggal {{ $startDate }} - {{ $endDate }}</p>

    <table style="font-size: 12px">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Jurnal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jurnal as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->tanggal }}</td>
                    <td style="width: 400px">{{ $item->deskripsi_jurnal }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
