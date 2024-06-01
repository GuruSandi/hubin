@extends('template.navbar')
@section('title', 'Absensi Siswa')

@section('content')




    <div class="section" id="bg">
        @if (Session::has('status'))
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <strong class="mr-auto">Success: {{ Session::get('status') }}</strong>
                <!-- mr-auto untuk memberikan margin kanan otomatis agar teks sejajar dengan tombol close -->
                <button type="button" class="close ml-2" data-dismiss="alert" aria-label="Close">
                    <!-- ml-2 untuk memberikan margin kiri -->
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <h1 id="current-time" class="fw-bold text-center text-white mt-5"></h1>
        <p id="date" class=" text-center text-white "></p>
        <div class="card text-center">
            <div class="card-body">

                <span>Jadwal : {{ $tanggal }} {{ $bulan }} {{ $tahun }}</span>
                <h3 class="mt-1">Normal</h3>
                <h2 style="margin-top: -5px">08:00 AM - 15:00 PM</h2>
                <hr>
                <div class="row">

                    <div class="col-12">
                        <a href="{{ route('absensi') }}">
                            <div class="card button">
                                <div class="card-body">
                                    <div class="icon-text-container">
                                        <ion-icon name="time" size="large" class="md hydrated"></ion-icon>
                                        <span class="text">Absen</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>
            </div>
        </div>
        <div class="row mt-5">
            @foreach ($absensisiswa as $item)
                @if ($item->updated_at->isToday())
                    <div class="col-12 col-md-12 col-lg-12 mb-4">
                        <div class="card ">
                            <div class="card-body">
                                <h6 class="card-title">Waktu {{ $item->updated_at->format('H:i') }}</h6>
                                <hr>
                                <p class="card-text">Nama: {{ $siswa->nama }}</p>
                                <hr>
                                <p class="card-text">Tanggal: {{ $item->updated_at->format('d M Y') }}</p>
                                <hr>
                                <p class="card-text">Keterangan:
                                    @if ($item->keterangan == 'hadir')
                                        <ion-icon class="green" name="checkmark-circle"></ion-icon> Hadir
                                    @elseif ($item->keterangan == 'libur')
                                        <ion-icon style="color: red;" name="calendar"></ion-icon> Libur
                                    @else
                                        <ion-icon style="color: red;" name="close-circle"></ion-icon> Tidak Hadir
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <div class=" mt-5">


            {{-- <div class="card col-12 col-md-12 col-sm-12 shadow mx-auto p-4">
                <h5 class="fw-bold mb-5">Absensi Siswa hari ini</h5>

                <div class="row">
                    <div class="col-12 col-md-12 col-sm-8">
                        <div class="table-responsive">
                            <table class="table table-bordered text-center" id="example">
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

        </div>
    </div>




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

            var timeString = hours + ":" + minutes + ":" + seconds + " " + meridiem;
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
