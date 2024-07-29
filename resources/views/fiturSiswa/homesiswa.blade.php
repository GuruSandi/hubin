@extends('template.navbar')
@section('title', 'Dashboard')

@section('content')

    <div id="bghome">
        <div class="container">
            <div id="user-detail">
                <div class="row">
                    <div class="col-10">
                        <div id="user-info">

                            <h3 id="user-name">{{ $siswa->nama }}</h3>
                            <span id="user-role">{{ $siswa->kelas }}
                            </span>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="d-flex justify-content-end">

                            <a href="#" id="dropdownToggle" data-bs-toggle="dropdown"
                                class="nav-icon pe-md-0 text-dark dropdown-toggle-start">
                                <img src="assets/img/sample/avatar/avatar1.jpg" alt="avatar" class="imaged w64 rounded">

                            </a>
                            <div class="dropdown-menu dropdown-menu-center rounded" id="dropdownMenu">

                                <a href="{{ route('editpassword') }}" class="dropdown-item1 " style="font-size: 14px;">
                                    <i class="bi bi-lock-fill"></i>
                                    <span>Edit Password</span>
                                </a>

                                <a href="{{ route('logout') }}" class="dropdown-item1 " style="font-size: 14px;">
                                    <i class="bi bi-box-arrow-right"></i>
                                    <span>Logout</span>
                                </a>
                            </div>


                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>

    <div id="menu-section">
        <div class="container">
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
                            <h1 class="fw-bold text-center mt-1 mb-3" style="color: #003366; font-size: 40px">
                                {{ $jamSekarang }}
                            </h1>

                        </div>
                    </div>
                    <div class="row">

                        <div class="col-6">
                            <a href="{{ route('absensi') }}" class="btn btnn w-100 "
                                style="background-color: #003366; color: #ffff; border-radius: 20px; transition: background-color 0.3s ease;">
                                Absen Masuk

                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('absensipulang') }}" class="btn btnn w-100 "
                                style="background-color: #003366; color: #ffff; border-radius: 20px; transition: background-color 0.3s ease;">
                                Absen Pulang

                            </a>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class=" mt-5" id="presence-section">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <p class="fw-bold text-white ">Absensi Terbaru</p>
                </div>
                <div class="col-6">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('homeabsen') }}">
                            <p class=" text-white ">Lihat Semua</p>
                        </a>


                    </div>

                </div>
            </div>
        </div>


    </div>
    <div class=" mt-5" id="absensi-section">
        <div class="container" style="margin-bottom: 90px">
            @foreach ($absensisiswa as $item)
                <div class="card mt-3" style="border-radius: 10px;">
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
                                                <p class="text-danger" style="font-size: 12px">Belum divalidasi Guru
                                                    Mapel
                                                    PKL
                                                </p>
                                            @elseif ($item->validasi == 'ditolak')
                                                <p class="text-danger">Di Tolak</p>
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
                                                    <ion-icon class="green" name="checkmark-circle"
                                                        style="font-size: 30px"></ion-icon>
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

        @if ($absensisiswa->isEmpty())
            <div style="margin-top: -80px">
                <div class="card" style="border-radius: 10px">
                    <div class="container">
                        <div class="card-body">
                            <div class="row">
                                <h6 class="text-muted text-center">Hi {{ $siswa->nama }}! Selamat datang di SIMAE-2024,
                                    aplikasi absensi PKL
                                    untuk memudahkan Anda dalam mengelola presensi harian. Kami siap mendukung kegiatan Anda
                                    selama
                                    PKL dengan teknologi terkini untuk pengalaman yang lebih baik!</h6>
                            </div>
                        </div>
                    </div>
    
                </div>
            </div>
           
        @endif



    </div>




    <script>
        var dropdownToggle = document.getElementById('dropdownToggle');
        var dropdownMenu = document.getElementById('dropdownMenu');

        dropdownToggle.addEventListener('click', function(event) {
            if (dropdownMenu.style.display === 'block') {
                dropdownMenu.style.display = 'none';
            } else {
                dropdownMenu.style.display = 'block';
            }
        });
    </script>

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
