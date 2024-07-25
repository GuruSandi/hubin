@extends('template.sidebar1')
@section('title', 'Rekap Absensi')

@section('content')

    <div class="container mt-4">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <p class="fw-bold mb-4">Rekap Absensi Siswa</p>
                        <div class="row">
                            <div class="col-3">
                                <div id="toggleFilter" class="btn btn-warning text-white" style="font-size: 12px">
                                    <i class="bi bi-funnel"></i> Filter Tanggal
                                </div>
                            </div>
                        </div>
                        <div class="row col-8 mt-3">
                            <div id="filterForm" style="display: none; font-size: 12px">
                                <form action="{{ route('dataabsensi.seachrekapabsen') }}" method="GET">
                                    <div class="row">
                                        <div class="col-5">
                                            <label for="tanggal_mulai">Tanggal Mulai:</label>
                                            <input type="date" required class="form-control form-control-sm mb-3" id="tanggal_mulai"
                                                name="tanggal_mulai">

                                        </div>
                                        <div class="col-5">
                                            <label for="tanggal_akhir">Tanggal Selesai:</label>
                                            <input type="date" required class="form-control form-control-sm mb-3 " id="tanggal_akhir"
                                                name="tanggal_akhir">

                                        </div>
                                        <div class="col-2">
                                            <button type="submit" class="btn mb-3 mt-3 btn-sm btn-primary">Filter</button>
                                        </div>
                                    </div>


                                </form>
                            </div>
                        </div>
                        <div class="table-responsive mt-3">
                            <table class="table table-sm table-striped table-bordered" id="example" style="font-size: 12px">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Instansi</th>
                                        <th>Hadir</th>
                                        <th>Libur</th>
                                        <th>Alpha</th>
                                        <th>Tidak Masuk PKL</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rekapabsen as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><a href="{{ route('dataabsensi.detailrekapabsensi', $item->siswa_id) }}">
                                                    {{ $item->nama_siswa }}

                                                </a>
                                            </td>
                                            <td>{{ $item->kelas_siswa }}</td>
                                            <td>{{ $item->instansi_siswa }}</td>
                                            <td>{{ $item->total_hadir }}</td>
                                            <td>{{ $item->total_libur }}</td>
                                            <td>{{ $item->total_absen }}</td>
                                            <td>{{ $item->total_tidak_hadir_pkl }}</td>
                                            <td>
                                                <a href="{{ route('dataabsensi.detailrekapabsensi', ['siswa_id' => $item->siswa_id, 'tanggal_mulai' => $tanggalMulai, 'tanggal_akhir' => $tanggalAkhir]) }}"
                                                    class="btn btn-sm mx-1 btn-success">
                                                     <i class="fas fa-eye"></i>
                                                 </a>
                                                 

                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                        </div>

                    </div>
                </div>
            </div>
        </div>
       
    </div>

@endsection
