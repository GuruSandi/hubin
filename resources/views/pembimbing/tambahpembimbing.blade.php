@extends('template.sidebar')
@section('title', 'Tambah Pembimbing')

@section('content')

    <div class="container mt-5 mb-5">
        <div class="card mx-auto p-5 col-md-5 shadow">
            <h4 class="text-center mb-5 fw-bold">Tambah Data Pembimbing</h4>
            <form action="{{ route('posttambahpembimbing') }}" class="form-group" enctype="multipart/form-data" method="POST">
                @csrf
                <label for="">Nama Guru</label>
                <input type="text" class="form-control" required name="nama">
                <button class="btn btn-primary w-100 mt-3">Submit</button>
            </form>
        </div>
    </div>

@endsection
