@extends('template.navbar')
@section('title', 'Ubah Jurnal')

@section('content')
    <div class="section" id="bg">
        <h4 class="text-white">Ubah Jurnal</h4>

    </div>
    <div class="section">
        <div class="mt-3">
            <div class="card" style="border-radius: 10px">
                <div class="card-body ">
                    <form action="{{ route('jurnal.update', ['id' => $jurnal->id]) }}" method="POST" class="form-group"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <textarea id="deskripsi_jurnal" name="deskripsi_jurnal" class="form-control">{{ old('deskripsi_jurnal', $jurnal->deskripsi_jurnal) }}</textarea>
                            @error('deskripsi_jurnal')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <button type="submit" class="btn btn-primary">simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection
