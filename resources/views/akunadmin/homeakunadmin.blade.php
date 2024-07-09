@extends('template.sidebar')
@section('title', 'Akun Admin')

@section('content')

    <div class="container mt-5">
        <div class="card col-12 shadow mx-auto p-4">
            <h5 class="fw-bold mb-3">Data Akun Admin</h5>
            <div class="row d-flex justify-content-end">
                <div class="col-2 mb-3">
                    <a href="{{ route('unduhakunadmin') }}" class="btn btn-success "> <i class="bi bi-cloud-download-fill"></i>
                        Unduh Excel</a>
                </div>
                <div class="col-2 mb-3">
                    <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal"
                        data-bs-target="#tambahakunadminModal">
                        <i class="bi bi-plus-circle"></i> Tambah
                    </button>
                </div>

            </div>
            <table class="table table-bordered" id="example" style="font-size: 11px">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($adminAccounts as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->username }}</td>
                            <td>{{ $item->password }}</td>


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
                                    <a href="{{ route('hapusakunadmin', $item->id) }}"
                                        class="btn btn-danger mx-1 delete-btn" data-id="{{ $item->id }}">
                                        <i class="bi bi-trash"></i>
                                    </a>

                                </div>
                            </td>
                        </tr>
                        @include('akunadmin.detailakunadmin')
                        @include('akunadmin.editakunadmin')
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('akunadmin.tambahakunadmin')

@endsection
