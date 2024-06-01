<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap-icon/bootstrap-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">


    <title>Data Penempatan</title>
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
    <p class="subjudul">Daftar Penempatan PKL Siswa Wilayah Sukabumi</p>
    <h4 class="judul">SMK NEGERI 2 SUKABUMI</h4>
    <p class="subjudul">Tahun Pelajaran </p>
    <table class="tabel tabel-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th style=" width: 200px;">Nama Instansi</th>
                <th style=" width: 300px;">Alamat Instansi</th>
                <th>No Urut</th>
                <th style=" width: 70px;">NIS Siswa</th>
                <th style=" width: 200px;">Nama Siswa</th>
                <th style=" width: 50px;">L/P</th>
                <th style=" width: 60px;">Kelas</th>
                <th style=" width: 200px;">Nama Pembimbing</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($dataPenempatan as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td style=" width: 200px;">{{ $data->nama_instansi }}</td>
                    <td style=" width: 300px;">{{ $data->alamat }}</td>
                    <td>{{ $loop->iteration }}</td>
                    <td style=" width: 70px;">{{ $data->nis }}</td>
                    <td style=" width: 200px;">{{ $data->nama_siswa }}</td>
                    <td style=" width: 70px;">{{ $data->jenis_kelamin }}</td>
                    <td style=" width: 60px;">{{ $data->kelas }}</td>
                    <td style=" width: 200px;">{{ $data->nama_pembimbing }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>



    <script src="{{ asset('/js/jquery-3.7.0.js') }}"></script>
    <script src="{{ asset('/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/js/dataTables.bootstrap5.min.js') }}"></script>

    <script>
        new DataTable('#example');
    </script>

</body>

</html>
