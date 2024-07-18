@extends('template.navbar')
@section('title', 'Ubah Jurnal')

@section('content')
    <div class="sticky-top" id="bgjurnal">
        <div class="container">
            <h4 class="text-white mt-2">Jurnal</h4>

        </div>


    </div>
    <div class="container">
        @foreach ($jurnal as $item)
            <div class="mt-3">
                <div class="card" style="border-radius: 10px;">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-6">
                                <p style="font-size: 16">{{ $item->tanggal }}</p>
                            </div>
                            <div class="col-6">
                                @if ($item->validasi == 'belum_tervalidasi')
                                    <div class="d-flex justify-content-end">
                                        <p class="text-white bg-warning px-1" style="font-size: 11px ; border-radius: 10px">
                                            Belum divalidasi</p>

                                    </div>
                                @elseif ($item->validasi == 'ditolak')
                                    <div class="d-flex justify-content-end">
                                        <p class="text-white bg-danger px-1" style="font-size: 11px ; border-radius: 10px">
                                            Ditolak</p>
                                    </div>
                                @elseif ($item->validasi == 'tervalidasi')
                                    <div class="d-flex justify-content-end">
                                        <p class="text-white bg-success px-1" style="font-size: 11px ; border-radius: 10px">
                                            Sudah divalidasi</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <p class="text-muted">Deskripsi Jurnal :</p>
                                <p>{{ $item->deskripsi_jurnal }}</p>
                                <div class="d-flex justify-content-end">
                                    @if ($item->validasi == 'belum_tervalidasi')
                                        <a href="{{ route('jurnal.edit', $item->id) }}"
                                            class="btn btn-primary">Ubah
                                            Jurnal</a>
                                    @elseif ($item->validasi == 'ditolak')
                                        <a href="{{ route('jurnal.edit', $item->id) }}"
                                            class="btn btn-primary">Ubah
                                            Jurnal</a>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>





@endsection
