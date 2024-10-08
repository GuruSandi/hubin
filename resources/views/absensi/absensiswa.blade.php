@extends('template.nav')
@section('title', 'Absensi Datang')

@section('content')
    <div  id="bg">
        <div class="container">
            <div style="width: 40px">
                <a href="{{ route('dashboardsiswa') }}">

                    <div style="background-color: #faac05; border-radius: 50px; width: 40px; height: 40px; padding: 2px; font-size: 22px;"
                        class="text-center text-white"> <i class="bi bi-arrow-left bi-lg"></i>
                    </div>
                </a>
            </div>
            <h4 class="text-white mt-3">Absensi Datang</h4>
            <p style="font-size: 12px" class="text-white">Mohon lengkapi absensi datang Anda dengan memilih salah satu
                keterangan berikut: hadir, libur, atau tidak masuk PKL.</p>

        </div>
    </div>
    <div class="" id="menu-form">
        <div class="mt-3">
            <div class="card" style="border-radius: 20px 20px 0 0; box-shadow: none; border: none">
                <div class="container card-body " style="margin-bottom: 90px">
                    <form action="{{ route('postabsensi') }}" method="POST" class="form-group"
                        enctype="multipart/form-data">
                        @csrf
                        <label for="">Tanggal:</label>
                        <p>{{ $tanggalsekarang }}</p>
                        <label for="">Jam:</label>
                        <p>
                        <input type="time" name="jam_masuk" required value="{{ $jamsekarang }}" readonly style="border: none; outline: none; ">
                        </p>
                        <label for="">Keterangan:</label>
                        <select name="keterangan" class="form-control" required>
                            <option value="hadir">Hadir</option>
                            <option value="libur">Libur</option>
                            <option value="tidak_hadir_pkl">Tidak Hadir PKL</option>
                        </select><br>

                        <input type="hidden" name="latitude" required id="latitude">
                        <input type="hidden" name="longitude" required id="longitude">

                        <button type="submit" class="btn w-100 text-white"
                            style="border-radius: 20px; background-color: #080761">Simpan</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        if ("geolocation" in navigator) {
            navigator.geolocation.getCurrentPosition(function(position) {
                // Mengambil latitude dan longitude dari objek position
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;
    
                // Mengisi nilai latitude dan longitude ke dalam input hidden
                document.getElementById('latitude').value = latitude;
                document.getElementById('longitude').value = longitude;
    
                // Menampilkan notifikasi menggunakan toastr
                toastr.success('Lokasi Anda sudah terdeteksi.');
            }, function(error) {
                // Menampilkan notifikasi jika terjadi kesalahan dalam mendapatkan lokasi
                toastr.error('Gagal mendeteksi lokasi. Silakan refresh halaman dan coba lagi.');
            });
        } else {
            // Menampilkan notifikasi jika geolocation tidak didukung
            toastr.warning('Geolocation tidak didukung di browser ini.');
        }
    </script>
    {{-- <script>
        // Cek apakah browser mendukung geolocation
        if ("geolocation" in navigator) {
            navigator.geolocation.getCurrentPosition(function(position) {
                // Mengambil latitude dan longitude dari objek position
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;
    
                // Mengisi nilai latitude dan longitude ke dalam input hidden
                document.getElementById('latitude').value = latitude;
                document.getElementById('longitude').value = longitude;
            });
        } else {
            console.log('Geolocation tidak didukung di browser ini.');
        }
    </script> --}}
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/locale/id.js"></script>

    <script>
        var waktuSekarang = moment().locale('id').format('HH:mm:ss');
        // document.getElementById('waktu-sekarang').textContent = waktuSekarang;
        document.getElementById('waktu-sekarang').value = latitude;
    </script>
    <script>
        var tanggalSekarang = moment().locale('id').format('dddd, D MMMM YYYY');
        document.getElementById('tanggal-sekarang').textContent = tanggalSekarang;
    </script>
@endsection
