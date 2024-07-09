@extends('template.sidebar')
@section('title', 'Home Penempatan')

@section('content')
    <div class=" mt-5">
        @if (Session::has('status'))
            <div class="alert alert-primary">{{ Session::get('status') }}</div>
        @endif
        <div class="card col-12 shadow mx-auto p-4">
            <h5 class="fw-bold mb-4">Penempatan</h5>
            <div class="row mb-3">
                <form action="{{ route('importmenempati') }}" method="POST" enctype="multipart/form-data">
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

                            <a href="{{ route('exportDataMenempati') }}" class="btn btn-success  w-100 mb-3"
                                style="width: 110px"> <i class="bi bi-file-earmark-excel"></i> Export</a>
                        </div>
                        <div class="col-4 col-md-2">

                            <a href="{{ route('tambahmenempati') }}" class="btn btn-primary  w-100 mb-3"
                                style="width: 110px"> <i class="bi bi-plus-circle"></i> Tambah</a>
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
                                    <th>NIS Siswa</th>
                                    <th>Nama Siswa</th>
                                    <th>Instansi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($menempatis_sorted as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->siswa->nis }}</td>
                                        <td>{{ $item->siswa->nama }}</td>
                                        <td>{{ $item->instansi->instansi }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-info mx-1" data-bs-toggle="modal"
                                                    data-bs-target="#detailModal{{ $item->id }}">
                                                    <i class="bi bi-book " style="color: white"></i>
                                                </button>
                                                <a href="{{ route('editmenempati', $item->id) }}"
                                                    class="btn mx-1" style="background-color: #080761"> <i class="bi bi-pencil "
                                                        style="color: white"></i></a>

                                                <a href="{{ route('hapusmenempati', $item->id) }}"
                                                    class="btn btn-danger mx-1 delete-btn" data-id="{{ $item->id }}">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @include('menempati.detailmenempati')

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>


@endsection
