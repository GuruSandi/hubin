@extends('template.sidebar')
@section('title', 'Edit Penempatan')

@section('content')

<div class="container mt-5 mb-5">
    <div class="card mx-auto p-5 col-md-8 shadow">
        <h4 class="text-center mb-5 fw-bold">Edit Data Penempatan</h4>
        <form action="{{route('posteditmenempati', $menempati->id)}}"  enctype="multipart/form-data" method="POST">
            @csrf
            <label for="">Instansi</label>
            <select class=" form-control" id="instansi" name="instansi_id">
                @foreach ($instansi as $item)
                    <option value="{{ $item->id }}" {{ $selectinstansi == $item->id ? 'selected' : '' }}>{{ $item->instansi }}</option>
                @endforeach
            </select>
        
            <label for="">Pilih Siswa</label>

            <select class=" form-control" id="siswa" name="siswa_id">
                @foreach ($siswa as $item)
                    <option value="{{ $item->id }}" {{ $selectsiswa == $item->id ? 'selected' : '' }}>{{ $item->nama }}</option>
                @endforeach
            </select>
            <button class="btn btn-primary w-100 mt-2">Submit</button>
        </form>
    </div>
</div>

@endsection



