@extends('template.navbar')
@section('title', 'Dashboard')

@section('content')
    
    <div class="section" id="user-section">
        <div id="user-detail">

            <div style="display: flex; align-items: center;">
                <div id="user-info">
                    <h4 style="margin-top: -20px" id="user-role">
                        SMK Negeri 2 Sukabumi
                    </h4>
                    <h3 id="user-name">{{ $siswa->nama }}</h3>
                    <span id="user-role">Siswa</span>
                </div>
                <div class="avatar" style="margin-left: 10px;">
                    <!-- Menambahkan margin kiri untuk memberikan jarak dengan teks -->
                    <img src="assets/img/sample/avatar/avatar1.jpg" alt="avatar" class="imaged w64 rounded">
                </div>
            </div>

        </div>
    </div>

    <div class="section" id="menu-section">
        <div class="card">
            <div class="card-body text-center">

                <div class="list-menu">
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="" class="green" style="font-size: 40px;">
                                <ion-icon name="person-sharp"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Profil</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="" class="danger" style="font-size: 40px;">
                                <ion-icon name="calendar-number"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Cuti</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="" class="warning" style="font-size: 40px;">
                                <ion-icon name="document-text"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Histori</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="" class="orange" style="font-size: 40px;">
                                <ion-icon name="location"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            Lokasi
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section mt-2" id="presence-section">
        <div class="todaypresence">
            <div class="row">

                <div class="col-12">
                    <div class="card gradasired">
                        <div class="card-body">
                            <div class="presencecontent">

                                <div class="presencedetail">
                                    <h4 class="presencetitle text-center">Waktu</h4>
                                    <span class="text-center">8:00 - 15.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <div class="presencetab mt-2">
            <div class="tab-pane fade show active" id="pilled" role="tabpanel">
                <ul class="nav nav-tabs style1" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#home" role="tab">
                            Kehadiran Minggu Ini
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#profile" role="tab">
                            Leaderboard
                        </a>
                    </li>
                </ul>
            </div>
            <div class="tab-content mt-2" style="margin-bottom:100px;">
                <div class="tab-pane fade show active" id="home" role="tabpanel">
                    <div class="listview image-listview">
                        <table class="table table-bordered text-center" id="example" style="font-size: 12px">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Nama</th>
                                    <th>Waktu</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($absensisiswa as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->updated_at->format('d m Y') }}</td>
                                        <td>{{ $siswa->nama }}</td>
                                        <td>{{ $item->updated_at->format('H:i') }}</td>
                                        <td>
                                            @if ($item->keterangan == 'hadir')
                                                <div class="iconpresence">
                                                    <ion-icon class="green" name="checkmark-circle"></ion-icon>

                                                </div>
                                            @elseif ($item->keterangan == 'libur')
                                                <div class="iconpresence">
                                                    <ion-icon style="color: red;" name="calendar"></ion-icon>

                                                </div>
                                            @else
                                                <div class="iconpresence">
                                                    <ion-icon style="color: red;" name="close-circle"></ion-icon>

                                                </div>
                                            @endif
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
    {{-- <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <h1>Dashboard Siswa</h1>
                <p>Nama Siswa: </p>
                <p>NIS: {{ $siswa->nis }}</p>
                <p>Instansi yang ditempati:</p>


                @foreach ($siswa->menempati as $menempati)
                    <p>{{ $menempati->instansi->instansi }}</p>
                @endforeach
                <a href="{{ route('homeabsen') }}" class="btn btn-primary">Absen</a>
            </div>
        </div>
        <table class="table table-bordered" id="example" style="font-size: 12px">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($absensisiswa as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $siswa->nama }}</td>
                        <td>{{ $item->keterangan }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div> --}}

@endsection
