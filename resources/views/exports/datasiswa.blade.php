<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <title>Data Siswa</title>
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
    <p class="subjudul">Data Siswa</p>
    <h4 class="judul">SMK NEGERI 2 SUKABUMI</h4>
    <p class="subjudul">Tahun Pelajaran </p>
    <table class="tabel tabel-bordered">
        <thead>
            <tr>
                <th>siswa_id</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>P/L</th>
                <th>Kelas</th>
                <th>Tahun Ajar</th>
               
            </tr>
        </thead>
        <tbody>
            @foreach ($dataSiswa as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td style=" width: 70px;">{{ $item->nis }}</td>
                    <td style=" width: 200px;">{{ $item->nama }}</td>
                    <td style=" width: 200px;">{{ $item->jenkel }}</td>
                    <td style=" width: 200px;">{{ $item->kelas }}</td>
                    <td style=" width: 200px;">{{ $item->tahun_ajar }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>





</body>

</html>
