@extends('template.sidebar')
@section('title', 'Home Absensi Siswa')

@section('content')
<div class=" mt-5 mb-5">
       
    <div class="card col-12 shadow mx-auto p-4">
        <h5 class="fw-bold mb-4">Data Jurnal Siswa</h5>
        <div class="row">
            <div class="col-12 col-md-12 col-sm-8">
                <div class="table-responsive">
                    <table class="table table-sm table-striped table-bordered" id="example"
                        style="font-size: 10px">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Tanggal</th>
                                <th>Deskripsi Jurnal</th>
                                <th>Instansi</th>
                                <th>Pembimbing</th>
                                <th>Guru Mapel PKL</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datajurnal as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td >{{ $item->nama_siswa }}</td>
                                    <td>{{ $item->kelas_siswa }}</td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td style="width: 300px">{{ $item->deskripsi_jurnal }}</td>
                                    <td>{{ $item->instansi }}</td>
                                    <td>{{ $item->nama_pembimbing }}</td>
                                    <td>{{ $item->nama_gurumapel }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-info mx-1" data-bs-toggle="modal"
                                                data-bs-target="#detailModal{{ $item->id }}">
                                                <i class="bi bi-book " style="color: white"></i>
                                            </button>
                                            <button type="button" style="background-color: #080761" class="btn mx-1" data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $item->id }}">
                                                <i class="bi bi-pencil " style="color: white"></i>
                                            </button>
                                            <a href="{{ route('hapusdatajurnalsiswa', $item->id) }}" class="btn btn-danger mx-1 delete-btn" data-id="{{ $item->id }}">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                            
                                        </div>
                                    </td>

                                </tr>
                                @include('datajurnalsiswa.detaildatajurnal')
                                @include('datajurnalsiswa.editdatajurnalsiswa')

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
   
@endsection
