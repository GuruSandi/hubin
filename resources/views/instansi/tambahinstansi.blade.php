@extends('template.sidebar')
@section('title', 'Tambah Instansi')

@section('content')

    <div class="container mt-5 mb-5">
        <div class="card mx-auto p-5 col-md-5 shadow">
            <h4 class="text-center mb-5 fw-bold">Tambah Data Instansi</h4>
            <form action="{{ route('posttambahinstansi') }}" class="form-group" enctype="multipart/form-data" method="POST">
                @csrf
                <label for="">Instansi</label>
                <input type="text" class="form-control" required name="instansi">
                <label for="">alamat</label>
                <input type="text" class="form-control" required name="alamat">
                <label for="">Domisili</label>
                <input type="text" class="form-control" required name="domisili">
                <button class="btn btn-primary w-100 mt-2">Submit</button>
            </form>
        </div>
    </div>

@endsection
