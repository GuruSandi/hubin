@extends('template.sidebar')
@section('title', 'Home Siswa')

@section('content')

    <div class="container mt-5">

        @if (Session::has('status'))
            <div class="alert alert-primary">{{ Session::get('status') }}</div>
        @endif
        <div class="card col-12 shadow mx-auto p-4">
            <h5 class="fw-bold mb-5">Data Akun Siswa</h5>

            <table class="table table-bordered" id="example" style="font-size: 12px">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($siswaAccounts as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->user->username }}</td>
                            <td>{{ $item->user->password }}</td>


                            <td>
                                <div class="btn-group">
                                    <a href="{{route('editakunsiswa', $item->user->id)}}" class="btn btn-warning mx-1"> <i class="bi bi-pencil "
                                            style="color: white; "></i></a>
                                    <a href="{{route('hapusakunsiswa', $item->user->id)}}" onclick="return confirm('yakin mau di hapus?')"
                                        class="btn btn-danger mx-1"><i class="bi bi-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
