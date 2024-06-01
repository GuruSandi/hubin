@extends('template.sidebar')
@section('title', 'Edit Akun Siswa')

@section('content')

<div class="container mt-5 mb-5">
    <div class="card mx-auto p-5 col-md-5 shadow">
        <h4 class="text-center mb-5 fw-bold">Edit Akun Siswa</h4>
        <form action="{{ route('posteditakunsiswa', $user->id) }}" class="form-group mt-5" method="POST">
            @csrf
            <label for="username">Username</label>
            <input type="text" class="form-control form-control-lg mb-3" required name="username" value="{{$user->username}}">
            <label for="password">Password</label>
            <input type="password" class="form-control form-control-lg mb-3" required name="password" value="{{$user->password}}">
            @if (Session::has('status'))
                <div class="alert mt-3 mb-3 alert-primary">{{ Session::get('status') }}</div>
            @endif
            <button class="btn btn-lg form-control form-control-lg mb-3 text-white" style="background-color: #080761;">Simpan</button>
        </form>
    </div>
</div>
   

@endsection
