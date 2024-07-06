@extends('template.sidebar')
@section('title', 'Home Siswa')

@section('content')

    <div class=" mt-5">
        <div class="row mb-5">
            <div class="col-12 col-sm-6 col-md-4 mb-3">
                <div class="card p-3 shadow text-white" style="background-color: #685dd8;">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Session</span>
                            <div class="d-flex align-items-center my-2">
                                <h3 class="mb-0 me-2">{{ $totalSiswa }}</h3>

                            </div>
                            <p class="mb-0">Total Siswa</p>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial rounded bg-label-primary">
                                <i class="bi bi-person"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 mb-3">
                <div class="card p-3 shadow text-white " style="background-color: #00cfe8;">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Session</span>
                            <div class="d-flex align-items-center my-2">
                                @if (isset($siswaPerJenkel['L']))
                                    <h3 class="mb-0 me-2">{{ $siswaPerJenkel['L'] }}</h3>
                                @endif

                            </div>
                            <p class="mb-0">Siswa Laki-laki</p>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial rounded bg-label-primary">
                                <i class="bi bi-person bi-xl"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 mb-3">
                <div class="card p-3 shadow text-white" style="background-color: #080761;">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>Session</span>
                            <div class="d-flex align-items-center my-2">
                                @if (isset($siswaPerJenkel['P']))
                                    <h3 class="mb-0 me-2">{{ $siswaPerJenkel['P'] }}</h3>
                                @endif


                            </div>
                            <p class="mb-0">Siswa Perempuan</p>
                        </div>
                        <div class="avatar">
                            <span class="avatar-initial rounded bg-label-primary">
                                <i class="bi bi-person bi-xl"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="card col-12 shadow mx-auto p-4">
            <h5 class="fw-bold mb-5">Data Siswa</h5>
            <div class="row mb-5">
                <form action="{{ route('importsiswa') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6 mb-3">
                            <input type="file" name="file" class="form-control" required>

                        </div>
                        <div class="col-4 col-md-2">
                            <button type="submit" class="btn btn-warning text-white w-100"><i
                                    class="bi bi-cloud-download-fill"></i>
                                Import</button>

                        </div>
                        <div class="col-4 col-md-2">

                            <a href="{{ route('exportDataSiswa') }}" class="btn btn-success  w-100 mb-3"
                                style="width: 110px"> <i class="bi bi-file-earmark-excel"></i> Export</a>
                        </div>
                        <div class="col-4 col-md-2">

                            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal"
                                data-bs-target="#tambahSiswaModal">
                                <i class="bi bi-plus-circle"></i> Tambah
                            </button>
                        </div>
                    </div>
                </form>

            </div>
          
            <div class="row">
                <div class="col-12 col-md-12 col-sm-8">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="example" style="font-size: 12px">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>P/L</th>
                                    <th>Kelas</th>
                                    <th>Tahun Ajar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($siswa as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nis }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->jenkel }}</td>
                                        <td>{{ $item->kelas }}</td>
                                        <td>{{ $item->tahun_ajar }}</td>

                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-info mx-1" data-bs-toggle="modal"
                                                    data-bs-target="#detailModal{{ $item->id }}">
                                                    <i class="bi bi-book " style="color: white"></i>
                                                </button>
                                                <button type="button" style="background-color: #080761" class="btn mx-1" data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{ $item->id }}">
                                                    <i class="bi bi-pencil " style="color: white"></i>
                                                </button>
                                                <a href="{{ route('hapussiswa', $item->id) }}" class="btn btn-danger mx-1 delete-btn" data-id="{{ $item->id }}">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                               
                                            </div>
                                        </td>
                                    </tr>
                                    @include('siswa.detailsiswa')
                                    @include('siswa.editsiswa')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div>
    @include('siswa.tambahsiswa')
@endsection
