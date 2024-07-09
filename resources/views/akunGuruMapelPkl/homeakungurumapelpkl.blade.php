@extends('template.sidebar')
@section('title', 'Akun Guru Mapel PKL')

@section('content')

    <div class="container mt-5">
        <div class="card col-12 shadow mx-auto p-4">
            <h5 class="fw-bold mb-3">Data Akun Guru Mapel PKL</h5>
            <div class="row">

                <div class="col-12 mb-3">

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('unduhGuruMapelPkl') }}" class="btn btn-success "> <i
                                class="bi bi-cloud-download-fill"></i>
                            Unduh Excel</a>
                    </div>
                </div>

            </div>
            <table class="table table-bordered" id="example" style="font-size: 11px">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>No HP</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($GuruMapelPklAccounts as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->no_hp }}</td>
                            <td>{{ $item->user->username }}</td>
                            <td>{{ $item->user->password }}</td>


                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-info mx-1" data-bs-toggle="modal"
                                        data-bs-target="#detailModal{{ $item->id }}">
                                        <i class="bi bi-book " style="color: white"></i>
                                    </button>
                                    <button type="button" style="background-color: #080761" class="btn mx-1"
                                        data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                        <i class="bi bi-pencil " style="color: white"></i>
                                    </button>
                                    <a href="{{ route('hapusakunGuruMapelPkl', $item->id) }}"
                                        class="btn btn-danger mx-1 delete-btn" data-id="{{ $item->id }}">
                                        <i class="bi bi-trash"></i>
                                    </a>

                                </div>
                            </td>
                        </tr>
                        @include('akunGuruMapelPkl.detailgurumapelpkl')
                        @include('akunGuruMapelPkl.editakunGuruMapelPkl')
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
