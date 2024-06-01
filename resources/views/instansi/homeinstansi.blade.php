@extends('template.sidebar')
@section('title', 'Home Instansi')

@section('content')
    <div class=" mt-5 mb-5">
        @if (Session::has('status'))
            <div class="alert alert-primary">{{ Session::get('status') }}</div>
        @endif
        <div class="card col-12 shadow mx-auto p-4">
            <h5 class="fw-bold mb-5">Data Instansi</h5>
            <div class="row mb-5">
                <form action="{{ route('importinstansi') }}" method="POST" enctype="multipart/form-data">
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
                            <a href="{{ route('tambahinstansi') }}" class="btn btn-primary w-100"> <i
                                    class="bi bi-plus-circle"></i> Tambah</a>
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
                                                <a href="{{ route('editinstansi', $item->id) }}"
                                                    class="btn btn-warning mx-1"> <i class="bi bi-pencil "
                                                        style="color: white"></i></a>
                                                <a href="{{ route('hapusinstansi', $item->id) }}"
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
