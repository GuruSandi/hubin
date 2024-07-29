<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    

    <title>Data Membimbing</title>
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
    <p class="subjudul">Data Membimbing</p>
    <h4 class="judul">SMK NEGERI 2 SUKABUMI</h4>
    <p class="subjudul">Tahun Pelajaran </p>
    <table class="tabel tabel-bordered">
        <thead>
            <tr>
                <th>membimbing_id</th>
                <th>siswa_id</th>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Pembimbing_id</th>
                <th>Nama Guru Pembimbing</th>
                <th>Guru_Mapel_PKL_id</th>
                <th>Nama Guru Mapel PKL</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($dataMembimbing as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td style=" width: 70px;">{{ $item->siswa->id }}</td>
                    <td style=" width: 70px;">{{ $item->siswa->nis }}</td>
                    <td style=" width: 200px;">{{ $item->siswa->nama }}</td>
                    <td style=" width: 200px;">{{ $item->pembimbing->id }}</td>
                    <td style=" width: 200px;">{{ $item->pembimbing->nama }}</td>
                    <td style=" width: 200px;">{{ $item->guru_mapel_pkl->id }}</td>
                    <td style=" width: 200px;">{{ $item->guru_mapel_pkl->nama }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>



    

</body>

</html>
