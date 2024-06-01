@extends('template.sidebar')
@section('title', 'Edit Siswa')

@section('content')

    <div class="container mt-5 mb-5">
        <div class="card mx-auto p-5 col-md-5 shadow">
            <h4 class="text-center mb-5 fw-bold">Edit Data Siwa</h4>
            <form action="{{ route('posteditsiswa', $siswa->id) }}" class="form-group" enctype="multipart/form-data"
                method="POST">
                @csrf
                <label for="">NIS</label>
                <input type="text" class="form-control" required name="nis" value="{{ $siswa->nis }}">
                <label for="">Nama</label>
                <input type="text" class="form-control" required name="nama" value="{{ $siswa->nama }}">
                <label for="">Jenis Kelamin</label>
                <select name="jenkel" required id="" class="form-control">
                    <option value="L" @if ($siswa->jenkel == 'L') selected @endif>Laki-laki</option>
                    <option value="P" @if ($siswa->jenkel == 'P') selected @endif>Perempuan</option>
                </select>
                <label for="">Kelas</label>
                <input type="text" class="form-control" required name="kelas" value="{{ $siswa->kelas }}">
                <label for="">Tahun Ajar</label>
                <input type="text" class="form-control" required name="tahun_ajar" value="{{ $siswa->tahun_ajar }}">

                <button class="btn btn-primary w-100 mt-2">Submit</button>
            </form>
        </div>
    </div>

@endsection
