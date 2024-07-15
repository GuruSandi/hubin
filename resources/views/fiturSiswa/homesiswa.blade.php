@extends('template.navbar')
@section('title', 'Dashboard')

@section('content')

    <div class="section" id="bghome">
        <div id="user-detail">
            <div class="row">
                <div class="col-10">
                    <div id="user-info">
                        {{-- <h4 style="margin-top: -20px" id="user-role">
                            Selamat Datang
                        </h4> --}}
                        <h3 id="user-name">{{ $siswa->nama }}</h3>
                        <span id="user-role">SMK Negeri 2 Sukabumi
                        </span>
                    </div>
                </div>
                <div class="col-2">
                    <div class="d-flex justify-content-end">
                        <div class="avatar">
                            <!-- Menambahkan margin kiri untuk memberikan jarak dengan teks -->
                            <img src="assets/img/sample/avatar/avatar1.jpg" alt="avatar" class="imaged w64 rounded">
                        </div>

                    </div>

                </div>
            </div>


        </div>
    </div>

    <div class="section" id="menu-section">
        <div class="card" style="border-radius: 10px">
            <div class="card-body ">
                <div class="row">
                    <div class="col-6">
                        <h5 class="fw-bold ">Kehadiran</h5>
                    </div>
                    <div class="col-6">
                        <div class="d-flex justify-content-end">
                            <h4 id="date" class=" mt-1 text-muted "></h4>

                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h1 class="fw-bold text-center mt-1 mb-3" style="color: #080761; font-size: 40px">
                            {{ $jamSekarang }}
                        </h1>

                    </div>
                </div>
                <div class="row">

                    <div class="col-6">
                        <a href="{{ route('absensi') }}" class="btn btnn w-100 "
                            style="background-color: #080761; color: #ffff; border-radius: 20px; transition: background-color 0.3s ease;">
                            Absen Masuk

                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('absensipulang') }}" class="btn btnn w-100 "
                            style="background-color: #080761; color: #ffff; border-radius: 20px; transition: background-color 0.3s ease;">
                            Absen Pulang

                        </a>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <div class="section mt-5" id="presence-section">
        <div class="row">
            <div class="col-6">
                <p class="fw-bold text-white ">Absensi Terbaru</p>
            </div>
            <div class="col-6">
                <div class="d-flex justify-content-end">
                    <p class=" text-white ">Lihat Semua</p>

                </div>

            </div>
        </div>


    </div>
    <div class="section mt-5" id="absensi-section">
        @if ($absensisiswa == null)
            <div class="card" style="border-radius: 10px">
                <div class="card-body ">
                    <div class="row">
                        <h6 class="text-muted text-center">Hi {{ $siswa->nama }}! Selamat datang di SIMAE-2024, aplikasi absensi PKL
                            untuk memudahkan Anda dalam mengelola presensi harian. Kami siap mendukung kegiatan Anda selama
                            PKL dengan teknologi terkini untuk pengalaman yang lebih baik!</h6>

                    </div>
                </div>
            </div>
        @endif


        @foreach ($absensisiswa as $item)
            <div class="card" style="border-radius: 10px">
                <div class="card-body ">

                    <div class="row">

                        <div class="row">
                            <div class="col-12">
                                {{-- <p class="fw-bold">{{ substr($item->deskripsi_jurnal, 0, strpos($item->deskripsi_jurnal, ' ', strpos($item->deskripsi_jurnal, ' ') + 1)) }}</p> --}}
                                <h5 class="fw-bold">{{ $item->tanggal }}</h5>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-4">
                                        <i class="bi bi-geo-alt-fill" style="color: red; font-size: 40px;"></i>

                                    </div>
                                    <div class="col-8">
                                        <h4 class="text-muted"> Jam Masuk</h4>
                                        <p class="text-primary fw-bold">{{ $item->jam_masuk }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-4">
                                        <i class="bi bi-geo-alt-fill" style="color: red; font-size: 40px;"></i>

                                    </div>
                                    <div class="col-8">
                                        <h4 class="text-muted"> Jam Pulang</h4>
                                        <p class="text-primary fw-bold">{{ $item->jam_pulang }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr style="width: 90%">
                        <div class="row">
                            <div class="col-12">
                                <p class="text-muted">Jurnal</p>
                                <p>{{ $item->deskripsi_jurnal }}</p>
                                <div class="row">
                                    <div class="col-7">
                                        <p class="text-muted">Status</p>
                                        @if ($item->validasi == 'belum_tervalidasi')
                                            <p class="text-danger">Belum divalidasi Guru Mapel PKL</p>
                                        @elseif ($item->validasi == 'ditolak')
                                            <p class="text-danger">Di Tolak</p>
                                        @elseif ($item->validasi == 'tervalidasi')
                                            {{ $item->deskripsi_jurnal }}
                                        @endif
                                    </div>
                                    <div class="col-5">
                                        <div class="d-flex justify-content-end">
                                            @if ($item->validasi == 'belum_tervalidasi')
                                                <a href="{{ route('jurnal.edit', $item->id) }}"
                                                    class="btn btn-primary">Ubah
                                                    Jurnal</a>
                                            @elseif ($item->validasi == 'ditolak')
                                                <a href="{{ route('jurnal.edit', $item->id) }}"
                                                    class="btn btn-primary">Ubah
                                                    Jurnal</a>
                                            @elseif ($item->validasi == 'tervalidasi')
                                                <ion-icon class="green" name="checkmark-circle"></ion-icon>
                                            @endif
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        @endforeach

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

    {{-- <div class="todaypresence">
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
    </div> --}}


    {{-- <div class="presencetab mt-2">
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
    </div> --}}
    <script>
        function updateTime() {
            var currentTime = new Date();
            var hours = currentTime.getHours();
            var minutes = currentTime.getMinutes();
            var seconds = currentTime.getSeconds();
            var meridiem = "AM"; // default AM

            // Cek apakah jam lebih dari 12 untuk menentukan AM atau PM
            if (hours >= 12) {
                meridiem = "PM";
            }

            // Ubah format jam dari 24 jam ke 12 jam
            hours = (hours % 12 === 0) ? 12 : hours % 12;

            // Format waktu agar selalu dua digit
            hours = (hours < 10 ? "0" : "") + hours;
            minutes = (minutes < 10 ? "0" : "") + minutes;
            seconds = (seconds < 10 ? "0" : "") + seconds;

            var timeString = hours + ":" + minutes + " " + meridiem;
            document.getElementById('current-time').innerHTML = timeString;
        }

        // Panggil updateTime() setiap detik
        setInterval(updateTime, 1000);
    </script>

    <script>
        function updateDate() {
            var currentDate = new Date();
            var days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            var day = days[currentDate.getDay()];
            var date = currentDate.getDate();
            var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober',
                'November', 'Desember'
            ];
            var month = months[currentDate.getMonth()];
            var year = currentDate.getFullYear();

            var dateString = day + ', ' + date + ' ' + month + ' ' + year;
            document.getElementById('date').innerHTML = dateString;
        }

        // Panggil updateDate() setiap detik (untuk memastikan tanggal diperbarui)
        setInterval(updateDate, 1000);

        // Panggil updateDate() pertama kali saat halaman dimuat
        updateDate();
    </script>
@endsection
