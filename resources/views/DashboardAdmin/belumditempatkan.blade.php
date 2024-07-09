@extends('template.sidebar')
@section('title', 'Belum di Tempatkan')

@section('content')

    <div class="row mt-3">

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table  " style="font-size: 13px" id="example">
                        <thead style="background-color: #f4e1fd;">
                            <tr>
                                <th scope="col" style="color: #db50f7">#</th>
                                <th scope="col" style="color: #db50f7">NIS</th>
                                <th scope="col" style="color: #db50f7">Nama Siswa</th>
                                <th scope="col" style="color: #db50f7">Kelas</th>
                                <th scope="col" style="color: #db50f7">Tahun Ajar</th>
                                {{-- <th scope="col" style="color: #db50f7">Aksi</th> --}}

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($belumditempatkan as $placement)
                                <tr>
                                    <th scope="row" class="text-muted">{{ $loop->iteration }}</th>
                                    <td style="color: #080761">{{ $placement->nis }}</td>
                                    <td style="color: #080761">{{ $placement->nama }}</td>
                                    <td style="color: #080761">{{ $placement->kelas }}</td>
                                    <td style="color: #080761">{{ $placement->tahun_ajar }}</td>
                                    {{-- <td style="color: #080761">
                                        <a href="{{ route('tempatkan',$placement->id ) }}" class="btn"
                                            style="background-color: #db50f7; color:#f4e1fd" style="width: 110px"> <i
                                                class="bi bi-plus-circle"></i> Tempatkan</a>

                                    </td> --}}
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>


    </div>

@endsection
