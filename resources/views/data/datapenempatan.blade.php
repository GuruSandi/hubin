@extends('template.sidebar')
@section('title', 'Home Penempatan')

@section('content')
    <div class=" mt-5">
        @if (Session::has('status'))
            <div class="alert alert-primary">{{ Session::get('status') }}</div>
        @endif
        <div class="card col-12 shadow mx-auto p-4">
            <h5 class="fw-bold mb-5">Data Penempatan</h5>
            <div class="row">
                <!-- Tombol Unduh Excel -->
                <div class="col-12 mb-5">
                    <a href="{{ route('exportDataPenempatan') }}" class="btn btn-success "> <i
                            class="bi bi-cloud-download-fill"></i> Unduh Excel</a>
                </div>

            </div>
            <div class="row">
                <div class="col-12 col-md-12 col-sm-8">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="example" style="font-size: 12px">
                            <thead>
                                <tr>
                                    <th>Nama Instansi</th>
                                    <th>Alamat Instansi</th>
                                    <th>No Urut</th>
                                    <th>NIS Siswa</th>
                                    <th>Nama Siswa</th>
                                    <th>L/P</th>
                                    <th>Kelas</th>
                                    <th>Nama Pembimbing</th>
                                    <th>Nama Guru Mapel PKL</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataPenempatan as $data)
                                    <tr>
                                        <td>{{ $data->nama_instansi }}</td>
                                        <td>{{ $data->alamat }}</td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->nis }}</td>
                                        <td>{{ $data->nama_siswa }}</td>
                                        <td>{{ $data->jenis_kelamin }}</td>
                                        <td>{{ $data->kelas }}</td>
                                        <td>{{ $data->nama_pembimbing }}</td>
                                        <td>{{ $data->nama_gurumapel }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>


@endsection
