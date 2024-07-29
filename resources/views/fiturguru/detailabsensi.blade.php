@extends('template.sidebar1')
@section('title', 'Rekap Absensi')

@section('content')

    <div class="container mt-4">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <p class="fw-bold mb-4">Detail Rekap Absensi Siswa</p>
                        <dl class="row">
                            @foreach ($rekapabsen as $item)
                                <dt class="col-sm-4">Nama Siswa</dt>
                                <dd class="col-sm-8">{{ $item->nama_siswa }}</dd>
                                <dt class="col-sm-4">Kelas</dt>
                                <dd class="col-sm-8">{{ $item->kelas_siswa }}</dd>
                                <dt class="col-sm-4">Instansi</dt>
                                <dd class="col-sm-8">{{ $item->instansi_siswa }}</dd>
                                <dt class="col-sm-4">Hadir</dt>
                                <dd class="col-sm-8">{{ $item->total_hadir }}</dd>
                                <dt class="col-sm-4">Libur</dt>
                                <dd class="col-sm-8">{{ $item->total_libur }}</dd>
                                <dt class="col-sm-4">Alpa</dt>
                                <dd class="col-sm-8">{{ $item->total_absen }}</dd>
                                <dt class="col-sm-4">Tidak Hadir PKL</dt>
                                <dd class="col-sm-8">{{ $item->total_tidak_hadir_pkl }}</dd>
                                <hr>
                            @endforeach

                            <div class="table-responsive">
                                <table class="table table-sm table-striped table-bordered" id="example"
                                    style="font-size: 12px">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($detailAbsensi as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->tanggal }}</td>
                                                <td>
                                                    @if ($item->keterangan == 'hadir')
                                                        Hadir
                                                    @elseif ($item->keterangan == 'libur')
                                                        Libur
                                                    @elseif ($item->keterangan == 'tidak_masuk_pkl')
                                                        Tidak Masuk PKL
                                                    @elseif ($item->keterangan == 'absen')
                                                        Alpa
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </dl>
                    </div>
                </div>
            </div>
        </div>



    </div>

@endsection
