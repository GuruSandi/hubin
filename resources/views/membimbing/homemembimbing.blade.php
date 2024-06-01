@extends('template.sidebar')
@section('title', 'Home Membimbing')

@section('content')
    <div class=" mt-5">
        @if (Session::has('status'))
            <div class="alert alert-primary">{{ Session::get('status') }}</div>
        @endif
        <div class="card col-12 shadow mx-auto p-4">
            <h5 class="fw-bold">Membimbing</h5>
            <div class="row">

            </div>

            <a href="{{ route('tambahmembimbing') }}" class="btn btn-primary mt-3 mb-3" style="width: 110px"> <i
                    class="bi bi-plus-circle"></i> Tambah</a>

            <div class="row">
                <div class="col-12 col-md-12 col-sm-8">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="example" style="font-size: 12px">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Instansi</th>
                                    <th>Alamat</th>
                                    <th>Nama Guru</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($membimbing_sorted as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->instansi->instansi }}</td>
                                        <td>{{ $item->instansi->alamat }}</td>
                                        <td>{{ $item->pembimbing->nama }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('editmembimbing', $item->id) }}"
                                                    class="btn btn-warning mx-1"> <i class="bi bi-pencil "
                                                        style="color: white"></i></a>
                                                <a href="{{ route('hapusmembimbing', $item->id) }}"
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
