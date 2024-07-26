@extends('template.sidebar')
@section('title', 'Tambah Membimbing')

@section('content')

    <div class="card p-3 col-12 shadow">
        <div class="card-body">
            <form action="{{ route('posttambahmembimbing') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <h5 class="text-center fw-bold mb-5" style="color: rgb(19, 19, 59)">Form Tambah Data Membimbing</h5>
                <div class="row">
                    <div class="col-6">
                        <label for="" class="mb-2 fw-bold" style="color: rgb(19, 19, 59)">Nama Guru Pembimbing</label>
                        <select class=" form-control form-control-lg mb-3" id="pembimbing" name="pembimbing_id">
                            @foreach ($pembimbing as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6">
                        <label for="" class="mb-2 fw-bold" style="color: rgb(19, 19, 59)"> Nama Guru Mapel PKL</label>
                        <select class="form-control form-control-lg mb-3" id="gurumapel" name="guru_mapel_pkl_id">
                            @foreach ($gurumapel as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>



                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <label for="" class="mb-2 fw-bold" style="color: rgb(19, 19, 59)">Pilih Siswa</label>
                        <select style="width: 99.7%"  class="form-control form-control-lg mb-3 " id="siswas" name="siswa_ids[]"
                            multiple="multiple" required>
                            @foreach ($siswa_tersedia as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
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
