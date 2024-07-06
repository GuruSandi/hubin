@extends('template.sidebar')
@section('title', 'Edit Penempatan')

@section('content')
<div class="card p-3 col-12 shadow">
    <div class="card-body">
        <form action="{{route('posteditmenempati', $menempati->id)}}" enctype="multipart/form-data" method="POST">
            @csrf
            <h5 class="text-center fw-bold mb-5" style="color: rgb(19, 19, 59)">Form Tambah Data Penempatan</h5>
           
            <div class="row mt-3">
                <div class="col-12">
                    <label for="" class="mb-2 fw-bold" style="color: rgb(19, 19, 59)">Instansi</label>
                    <select  style="width: 99.7%" class="form-control form-control-lg mb-3 " id="instansi" name="instansi_id">
                        @foreach ($instansi as $item)
                        <option value="{{ $item->id }}" {{ $selectinstansi == $item->id ? 'selected' : '' }}>{{ $item->instansi }}</option>
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <label for="" class="mb-2 fw-bold" style="color: rgb(19, 19, 59)">Pilih Siswa</label>
                    <select style="width: 99.7%"  class="form-control form-control-lg mb-3 " id="siswa" name="siswa_id"
                        >
                        @foreach ($siswa as $item)
                    <option value="{{ $item->id }}" {{ $selectsiswa == $item->id ? 'selected' : '' }}>{{ $item->nama }}</option>
                @endforeach
                    </select>
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <button class="btn btn-primary mt-3">Submit</button>
            </div>

        </form>
    </div>
</div>



@endsection



