<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <title>Data Instansi</title>
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
    <p class="subjudul">Data Instansi</p>
    <h4 class="judul">SMK NEGERI 2 SUKABUMI</h4>
    <p class="subjudul">Tahun Pelajaran </p>
    <table class="tabel tabel-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Instansi</th>
                <th>Alamat</th>
                <th>Domisili</th>
                <th>Latitude</th>
                <th>Longitude</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($dataInstansi as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td style=" width: 70px;">{{ $item->instansi }}</td>
                    <td style=" width: 200px;">{{ $item->alamat }}</td>
                    <td style=" width: 200px;">{{ $item->domisili}}</td>
                    <td style=" width: 200px;">{{ $item->latitude }}</td>
                    <td style=" width: 200px;">{{ $item->longitude }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>





</body>

</html>
