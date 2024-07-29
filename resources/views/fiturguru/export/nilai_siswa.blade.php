<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">



    <title>Nilai Siswa</title>
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
            font-size: 20px;
            /* Ukuran font judul */
            text-align: center;
        }

        .subjudul {
            font-weight: bold;
            /* Style font bold untuk subjudul */
            font-size: 16px;
            text-align: center;
            padding-bottom: 50px;


            /* Ukuran font subjudul */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;

        }

        th,
        td {
            border: 1px solid #000000;
            padding: 8px;
            text-align: center;


        }

        thead {
            background-color: rgb(163, 188, 255);
            padding: 5px;

        }
    </style>
</head>

<body>
    <h4 class="judul">Nilai Siswa</h4>
    <p class="subjudul">SMK Negeri 2 Sukabumi</p>
    <p class="subjudul">Guru Mapel PKL {{ $guru_mapel_pkl->nama }}</p>

    <table class="tabel tabel-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Internalisasi dan Penerapan Soft Skills</th>
                <th>Penerapan Hard Skills</th>
                <th>Peningkatan dan Pengembangan Hard Skills</th>
                <th>Penyiapan Kemandirian Berwirausaha</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($nilaisiswa as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->siswa->nama }}</td>
                    <td>{{ $item->siswa->kelas }}</td>
                    <td>{{ $item->nilai1 }}</td>
                    <td>{{ $item->nilai2 }}</td>
                    <td>{{ $item->nilai3 }}</td>
                    <td>{{ $item->nilai4 }}</td>

                </tr>
            @endforeach


        </tbody>
    </table>





</body>

</html>
