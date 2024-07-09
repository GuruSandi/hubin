@extends('template.sidebar')
@section('title', 'Home Instansi')

@section('content')
    <div class=" mt-5 mb-5">
       
        <div class="card col-12 shadow mx-auto p-4">
            <h5 class="fw-bold mb-4">Data Instansi</h5>
            <div class="row mb-2">
                <form action="{{ route('importinstansi') }}" method="POST" enctype="multipart/form-data">
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

                            <a href="{{ route('exportDataInstansi') }}" class="btn btn-success  w-100 mb-3"
                                style="width: 110px"> <i class="bi bi-file-earmark-excel"></i> Export</a>
                        </div>
                        <div class="col-4 col-md-2">

                            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal"
                                data-bs-target="#tambahInstansiModal">
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
                                    <th>Instansi</th>
                                    <th>Alamat</th>
                                    <th>Domisili</th>
                                    <th>Latitude</th>
                                    <th>Longitude</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($instansi as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->instansi }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td>{{ $item->domisili }}</td>
                                        <td>{{ $item->latitude }}</td>
                                        <td>{{ $item->longitude }}</td>
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
                                    @include('instansi.detailinstansi')
                                    @include('instansi.editinstansi')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @include('instansi.tambahinstansi')

@endsection
