@extends('template.sidebar')
@section('title', 'PKL Dalam Kota')

@section('content')
    
    <div class="row mt-3">

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table  " style="font-size: 13px" id="example">
                        <thead style="background-color: #d3f0f8;">
                            <tr>
                                <th scope="col" style="color: #3cb2da">#</th>
                                <th scope="col" style="color: #3cb2da">NIS</th>
                                <th scope="col" style="color: #3cb2da">Nama Siswa</th>
                                <th scope="col" style="color: #3cb2da">Kelas</th>
                                <th scope="col" style="color: #3cb2da">Instansi</th>
                                <th scope="col" style="color: #3cb2da">Domisili</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dalamkota as $placement)
                                <tr>
                                    <th scope="row" class="text-muted">{{ $loop->iteration }}</th>
                                    <td style="color: #080761">{{ $placement->nis }}</td>
                                    <td style="color: #080761">{{ $placement->nama }}</td>
                                    <td style="color: #080761">{{ $placement->kelas }}</td>
                                    <td style="color: #080761">{{ $placement->instansi }}</td>
                                    <td style="color: #080761">{{ $placement->domisili }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
       
       
    </div>
    
@endsection
