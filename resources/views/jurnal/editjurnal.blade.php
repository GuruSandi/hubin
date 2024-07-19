@extends('template.nav')
@section('title', 'Ubah Jurnal')

@section('content')
    <div id="bg">
       <div class="container">
        <div style="width: 40px">
            <a href="{{ route('dashboardsiswa') }}">
                <div style="background-color: #faac05; border-radius: 50px; width: 40px; height: 40px; padding: 2px; font-size: 22px;"
                    class="text-center text-white"> <i class="bi bi-arrow-left bi-lg"></i>
                </div>
            </a>
        </div>
        
        <h4 class="text-white mt-3">Edit Jurnal</h4>
        <p style="font-size: 12px" class="text-white">Silakan periksa kembali jurnal Anda dengan cermat untuk memastikan keseluruhan isi telah disampaikan dengan jelas dan tepat.</p>

       </div>
    </div>
    <div id="menu-form">
        <div class="mt-3">
            <div class="card" style="border-radius: 20px 20px 0 0; box-shadow: none; border: none">
                <div class="container mt-3 ">
                    <form action="{{ route('jurnal.update', ['id' => $jurnal->id]) }}" method="POST" class="form-group"
                        enctype="multipart/form-data">
                        @csrf
                        <label for="">Tanggal:</label>
                        <p>{{ $tanggal }}</p>

                        <div class="form-group">
                            <label for="">Deskripsi Jurnal</label>
                            <div class="form-floating">
                                <textarea id="floatingTextarea" style="height: 150px; padding-top: 10px" name="deskripsi_jurnal" class="form-control mb-3">{{ old('deskripsi_jurnal', $jurnal->deskripsi_jurnal) }}</textarea>
                                @error('deskripsi_jurnal')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>


                        <button type="submit" class="btn w-100 text-white"
                            style="border-radius: 20px; background-color: #080761">Simpan</button>

                    </form>


                </div>
            </div>
        </div>
    </div>





@endsection
