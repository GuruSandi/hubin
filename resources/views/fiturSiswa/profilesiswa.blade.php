@extends('template.navbar')
@section('title', 'Profile Siswa')

@section('content')

    <div id="bgprofile">
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <h4 class="text-white text-center mt-3">Profile</h4>
                    <div class="d-flex justify-content-center mt-4">
                        <div class="avatar">
                            <!-- Menambahkan margin kiri untuk memberikan jarak dengan teks -->
                            <img src="{{ asset('assets/img/sample/avatar/avatar1.jpg') }}" alt="avatar"
                                class="imaged w100 rounded">
                        </div>
                    </div>
                    <h3 id="user-name" class="text-center mt-3">{{ $siswa->nama }}</h3>
                    <p class="text-center text-white mt-2">{{ $siswa->kelas }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-3" style="margin-bottom: 90px">

        <div class="row mb-3">
            <div class="col-2">
                <div class="d-flex justify-content-end">
                    <i class="bi bi-person-badge text-muted" style="font-size: 20px"></i>

                </div>
            </div>
            <div class="col-10">
                <label for="" class="text-muted fw-bold" style="font-size: 12px">Nomor Induk Siswa</label>
                <p>{{ $siswa->nis }}</p>
            </div>

        </div>
        
        <hr>
        <div class="row mb-3">
            <div class="col-2">
                <div class="d-flex justify-content-end">
                    <i class="bi bi-building text-muted" style="font-size: 20px"></i>

                </div>
            </div>
            <div class="col-10">
                <label for="" class="text-muted fw-bold" style="font-size: 12px">Nama Instansi</label>
                <p>{{ $menempati->instansi->instansi }}</p>
            </div>
        </div>
        <hr>
        <div class="row mb-3">
            <div class="col-2">
                <div class="d-flex justify-content-end">
                    <i class="bi bi-person text-muted" style="font-size: 20px"></i>

                </div>
            </div>
            <div class="col-10">
                <label for="" class="text-muted fw-bold" style="font-size: 12px">Nama Pembimbing</label>
                <a href="{{ route('profilepembimbing') }}">
                    <p>{{ $membimbing->pembimbing->nama }}</p>
                </a>
            </div>
        </div>
        <hr>
        <div class="row mb-3">
            <div class="col-2">
                <div class="d-flex justify-content-end">
                    <i class="bi bi-person-fill text-muted" style="font-size: 20px"></i>

                </div>
            </div>
            <div class="col-10">
                <label for="" class="text-muted fw-bold" style="font-size: 12px">Nama Guru Mapel PKL</label>
                <a href="{{ route('profilegurumapel') }}">
                    <p>{{ $membimbing->guru_mapel_pkl->nama }} </p>
                </a>
            </div>
        </div>
        <hr>
       

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   
@endsection
