@extends('template.sidebar1')
@section('title', 'Dashboard')

@section('content')

    <div class="container mt-5">

        <table class="table table-bordered" id="example">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Tanggal</th>
                    <th>Deskripsi Jurnal</th>
                    <th>Instansi</th>
                    <th>Pembimbing</th>
                    <th>Aksi</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($siswa as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_siswa }}</td>
                        <td>{{ $item->kelas_siswa }}</td>
                        <td>{{ $item->tanggal }}</td>
                        <td>{{ $item->deskripsi_jurnal }}</td>
                        <td>{{ $item->instansi }}</td>
                        <td>{{ $item->nama_pembimbing }}</td>
                        <td>
                            @if ($item->validasi == 'tervalidasi')
                            <button type="button" class="btn mx-1 btn-primary" data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $item->id }}">
                                disetujui
                            </button>
                        @elseif($item->validasi == 'ditolak')
                            <button type="button" class="btn mx-1 btn-danger" data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $item->id }}">
                                ditolak
                            </button>
                        @else
                            <a href="{{ route('validasisetuju', $item->id) }}"
                                onclick="return confirm('apakah anda yakin?')" class="btn btn-primary">setujui</a>
                            <a href="{{ route('validasiditolak', $item->id) }}"
                                onclick="return confirm('apakah anda yakin?')" class="btn btn-danger">tolak</a>
                        @endif
                        </td>
                    </tr>
                    @include('fiturguru.validasi')
                    
                @endforeach
            </tbody>
        </table>
    </div>
    </div>

@endsection
