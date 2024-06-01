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
        @if (Session::has('status'))
            <div class="alert alert-primary">{{ Session::get('status') }}</div>
        @endif
        <div class="card col-12 shadow mx-auto p-4">
            <h5 class="fw-bold mb-5">Data Siswa</h5>
            <div class="row mb-5">
                <form action="{{ route('importsiswa') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-8 mb-3">
                            <input type="file" name="file" class="form-control">
                        </div>
                        <div class="col-6 col-md-2">
                            <button type="submit" class="btn btn-success w-100"><i class="bi bi-cloud-download-fill"></i>
                                Import</button>
                        </div>
                        <div class="col-6 col-md-2">
                            <a href="{{ route('tambahsiswa') }}" class="btn btn-primary w-100"> <i
                                    class="bi bi-plus-circle"></i>
                                Tambah</a>
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
                                                <a href="{{ route('editsiswa', $item->id) }}" class="btn btn-warning mx-1">
                                                    <i class="bi bi-pencil " style="color: white; "></i></a>
                                                <a href="{{ route('hapussiswa', $item->id) }}"
                                                    onclick="return confirm('yakin mau di hapus?')"
                                                    class="btn btn-danger mx-1"><i class="bi bi-trash"></i></a>
                                            </div>
                                        </td>
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
