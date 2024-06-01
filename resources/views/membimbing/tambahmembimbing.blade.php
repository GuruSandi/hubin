@extends('template.sidebar')
@section('title', 'Tambah Membimbing')

@section('content')

    <div class="container mt-5 mb-5">
        <div class="card mx-auto p-5 col-md-8 shadow">
            <h4 class="text-center mb-5 fw-bold">Tambah Data Membimbing</h4>
            <form action="{{ route('posttambahmembimbing') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <label for="">Nama Guru</label>
                <select class=" form-control" id="pembimbing" name="pembimbing_id">
                    @foreach ($pembimbing as $item)
                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                    @endforeach
                </select>

                <label for="">Pilih Instansi</label>

                <select class=" form-control" id="instansi" name="instansi_ids[]" multiple="multiple">
                    @foreach ($instansi_tersedia as $item)
                        <option value="{{ $item->id }}">{{ $item->instansi }}</option>
                    @endforeach
                </select>
                <button class="btn btn-primary w-100 mt-2">Submit</button>
            </form>
        </div>
    </div>

@endsection
