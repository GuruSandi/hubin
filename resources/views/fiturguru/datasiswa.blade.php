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
                    <th>Instansi</th>
                    <th>Pembimbing</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($siswa as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_siswa }}</td>
                        <td>{{ $item->kelas_siswa }}</td>
                        <td>{{ $item->instansi }}</td>
                        <td>{{ $item->nama_pembimbing }}</td>
                        
                    </tr>
                    
                @endforeach
            </tbody>
        </table>
    </div>
    </div>

@endsection
